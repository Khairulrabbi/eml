<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Author: Saiful Islam
 * Created: 14 Dec 2016
 * Purpose: Maintain Approval Process
 * Function: manage_delegation
 * Parameter: 
 *  ref_id: is the id for which need the process, Like Sale_id, PO_id and so on
 *  parent_db_table: the table name from where the information fetch. Basically 
 *  user_in_action: The person who trigger event to approve or decline
 *  current_step: Pass the current step from the parent table
 *  action: either Approve or Decline
 * this information will come from the "id_manager" Table. 
 * 
 */
if(!function_exists('manage_delegation')) 
{
    function manage_delegation( $ref_id, $parent_db_table, $parent_table_field, $user_in_action, $current_step, $action, $decline_status = 52 ){
        $CI = & get_instance();
        $sort_logic = get_step_wise_sort_logic( $ref_id,$current_step );
        
        if( $sort_logic == "Same Sort" ){
            $same_sort_priority = get_same_sort_priority( $ref_id,$current_step );
            if( $same_sort_priority == "Minority" ){
                if( $action == "Approve" ){
                    //go to next step 1st person
                    initiate_delegation( $ref_id, $parent_db_table, $parent_table_field, $current_step += 1 );                    
                }
                else{
                    $data = array( 
                        "status" => $decline_status,
                        "current_delegation_step" => NULL,
                        "current_delegation_person" => NULL,
                        "current_delegation_action" => "Decline",
                        "current_delegation_actiontime" => date("Y-m-d H:i:s")
                    );
                    update_delegation( $parent_db_table,$data,array($parent_table_field => $ref_id));
                }                
            }
            else if( $same_sort_priority == "Majority" ){
                
            }
            else if( $same_sort_priority == "All" ){
                
            }
        }
        else if( $sort_logic == "Not Same Sort" ){
            if( $action == "Approve" ){
                // search for the next person either in same step or next step
            }else{
                $data = array( 
                    "status" => $decline_status,
                    "current_delegation_step" => NULL,
                    "current_delegation_person" => NULL,
                    "current_delegation_action" => "Decline",
                    "current_delegation_actiontime" => date("Y-m-d H:i:s")
                );
                update_delegation( $parent_db_table,$data,array($parent_table_field => $ref_id));
            }
        }
    }
}

/*
 * Author: Saiful Islam
 * Created: 14 Dec 2016
 * Purpose: Maintain Approval Process
 * Function: initiate_delegation
 * Parameter: 
 *  ref_id: is the id for which need the process, Like Sale_id, PO_id and so on
 *  parent_db_table: the table name from where the information fetch. Basically 
 *  parent_table_field: The field will use as referance field
 *  current_step: the step is running to manage deligation
 *  current_user: the person who just in delegation
 * this information will come from the "id_manager" Table. 
 * 
 */
if(!function_exists('initiate_delegation')) 
{
    function initiate_delegation( $ref_id, $parent_db_table, $parent_table_field, $current_step = 1, $current_user = "" ){
        $CI = & get_instance();
        
        // Decide if the first step in same sort. 
        // parameter 1 for the very first step
        $manage_by = get_delegation_manage_by( $ref_id,$current_step );
        if( $manage_by == "No more delegation" ){
            // Do what to do
        }
        else if( $manage_by == "Limit" ){
            
        }
        else if( $manage_by == "Sorting" ){
            $sort_logic = get_step_wise_sort_logic( $ref_id,$current_step );
            if( $sort_logic == "Same Sort" ){
                // in this case no need to check for reliever
                // some people will be in same sort. any exception will handle by the admin
                $data = array( 
                        "current_delegation_step" => $current_step,
                        "current_delegation_start" => date("Y-m-d H:i:s")
                        );
                update_delegation( $parent_db_table,$data,array($parent_table_field => $ref_id));
            }
            else if( $sort_logic == "Not Same Sort" ){
                // get the person who will be in delegation now
                $delegation_user = get_delegation_1st_user( $ref_id, $current_step );
                $actual_delegation_userid = $delegation_user->userid;

                //get the person who set for the actual delegate person's reliever
                $person_in_reliever = get_person_in_reliever( $actual_delegation_userid );   
                if( $person_in_reliever == "Not in Reliever" ){
                    $data = array( 
                        "current_delegation_step" => $current_step,
                        "current_delegation_person" => $actual_delegation_userid,
                        "current_delegation_reliever_of" => $actual_delegation_userid,
                        "current_delegation_start" => date("Y-m-d H:i:s")
                        );
                    update_delegation( $parent_db_table,$data,array($parent_table_field => $ref_id));
                }
                else{
                    $data = array( 
                        "current_delegation_step" => $current_step,
                        "current_delegation_person" => $person_in_reliever,
                        "current_delegation_reliever_of" => $actual_delegation_userid,
                        "current_delegation_start" => date("Y-m-d H:i:s")
                        );
                    update_delegation( $parent_db_table,$data,array($parent_table_field => $ref_id));
                }
            }
        }        
    }
}

// Just update the parent table of the ref no
function update_delegation( $tablename, $data, $where ){
    $CI = & get_instance();
    $CI->db->update( $tablename, $data, $where );
}

/*
 * Author: Saiful Islam
 * Created: 14 Dec 2016
 * Purpose: This function will help to decide if the person in reliever or not. 
 * If in reliever return the reliver details. if not return "Not in Reliever"
 * Parameter:
 * 
 * Return:
 *  if in Reliever: return reliever user id
 *  if not: send a text msg "Not in Reliever"
 */
function get_person_in_reliever( $userid ){
    $CI = & get_instance();
    $CI->db->select("user.*")
            ->where("user_id",$userid);
    $query = $query->get()->row();
    if( $query->is_reliever == 1 ){
        // check if today is in between the date
        $current_timestamp = date("Y-m-d H:i:s");
        $date_is_ok = check_in_range( $query->reliever_start_datetime, $query->reliever_end_datetime, $current_timestamp );
        if( $date_is_ok ){
            return $query->reliever_to;
        }else{
            return "Not in Reliever"; 
        }
    }else{
        return "Not in Reliever";        
    }
}

/*
 * All Parameter must in timestamp
 * Return TRUE or FALSE
 */
function check_in_range($start_date, $end_date, $date_from_user)
{
    // Check that user date is between start & end
    return (($date_from_user >= $start_date) && ($date_from_user <= $end_date));
}

/*
 * Author: Saiful Islam
 * Created: 14 Dec 2016
 * Purpose: This function will use to find the next regular delegated person
 * Parameter:
 *  ref_id: is the id for which need the process, Like Sale_id, PO_id and so on
 *  current_user: Who just approve / decline
 *  current_step: current user is current step
 *  current_sort: could be in different sort in same step
 * Return: return as an object
 *  
 */
function get_delegation_1st_user( $ref_id, $current_step = 1 ){
    $CI = & get_instance();
    $CI->db->select("delegation_by_ref.*")
            ->where("ref_no", $ref_id)
            ->where("step_number", $current_step)                
            ->order_by("delegation_by_ref.sort_number","ASC")
            ->limit(1);
    return $CI->db->get()->row();
}

function get_same_sort_priority( $ref_id, $step_no ){
    $CI = & get_instance();
    $CI->db->select("approve_priority");
    $CI->db->from("delegation_by_ref");
    $CI->db->where("ref_no", $ref_id);
    $CI->db->where("step_number", $step_no);
    $CI->db->group_by("approve_priority");
    return $CI->db->get()->row()->approve_priority;
}

function get_delegation_manage_by( $ref_id, $step_no ){
    $CI = & get_instance();
    $CI->db->select("manage_by");
    $CI->db->from("delegation_by_ref");
    $CI->db->where("ref_no", $ref_id);
    $CI->db->where("step_number", $step_no);
    $CI->db->group_by("sort_number");
    $manage_by = $CI->db->get()->row()->manage_by;
    if( $manage_by ){
        return $manage_by;
    }else{
        return "No more delegation";
    }
}

function get_step_wise_sort_logic( $ref_id, $step_no ){
    $CI = & get_instance();
    $CI->db->select("sort_number");
    $CI->db->from("delegation_by_ref");
    $CI->db->where("ref_no", $ref_id);
    $CI->db->where("step_number", $step_no);
    $CI->db->group_by("sort_number");
    $number_of_sort = $CI->db->count_all_results();
    if( $number_of_sort > 1 ){
        return "Not Same Sort";
    }else{
        $CI->db->select("COUNT(sort_number) AS number_of_person");
        $CI->db->from("delegation_by_ref");
        $CI->db->where("ref_no", $ref_id);
        $CI->db->where("step_number", $step_no);
        $CI->db->group_by("step_number");
        $number_of_person = $CI->db->get()->row()->number_of_person;

        // if more then one person are in delegation and all are in same sort
        if( $number_of_person > 1 ){
            return "Same Sort";
        }else{// if only one person in delegation then it will act as not in same sort
            return "Not Same Sort";
        }        
    }    
}

function get_ref_hierarchy( $ref_id ){
    $CI = & get_instance();
    $CI->db->select("*");
    $CI->db->from("delegation_by_ref");
    $CI->db->where("ref_no",$ref_id);
    $ref_hierarchy = $CI->db->get()->result();
    return $ref_hierarchy;
}
/*End of Maintain Approval Process*/