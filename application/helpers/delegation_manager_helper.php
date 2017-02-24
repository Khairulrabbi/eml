<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * There are some pre requisit to make this functional for all
 * Such As Database table need some common field. To do that run the following 
 * SQL query by editing the table name 
 */
// QUERY 1
/*
 ALTER TABLE `TABLE_NAME`
ADD COLUMN `current_delegation_step`  int(2) NULL DEFAULT NULL COMMENT 'step_number of current situation' AFTER `warehouse_id`,
ADD COLUMN `current_delegation_person`  int(10) NULL DEFAULT NULL COMMENT 'if in this step \"All in one sort\" then this field will blank or Empty string' AFTER `current_delegation_step`,
ADD COLUMN `current_delegation_reliever_of`  int(10) NULL DEFAULT NULL AFTER `current_delegation_person`,
ADD COLUMN `current_delegation_start`  timestamp NULL DEFAULT NULL COMMENT 'the date time when the waiting has started' AFTER `current_delegation_reliever_of`,
ADD COLUMN `current_delegation_action`  enum('Approve','Decline') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `current_delegation_start`,
ADD COLUMN `current_delegation_actiontime`  timestamp NULL DEFAULT NULL COMMENT 'The date time when approve or decline' AFTER `current_delegation_action`;
 */

// QUERY 2
/*

*/

/*
 * Author: Saiful Islam
 * Created: 19 Dec 2016
 * Purpose: Maintain Approval Process
 * Function: delegation_action
 * Parameter: 
 *  references: is the id for which need the process, Like Sale_id, PO_id and so on
 *  user_in_action: The person who trigger event to approve or decline
 *  action: either Approve or Decline
 *  comment: some text to describe about the action
 * this information will come from the "id_manager" Table. 
 * 
 */
if(!function_exists('delegation_action')) 
{
    function delegation_action($user_in_action, $action, $comment, $references = array()){
        $CI = & get_instance();
        $return_res = array();
        // get idm details for any one of ref no
        $idm_details = get_idm_details( $references[0] );
        //print_r($idm_details);
        foreach ($references as $ref_no){
            // check if approve or decline as reliver
            $ref_details = get_action_as_reliever( $ref_no, $user_in_action, $idm_details->parent_db_table, $idm_details->parent_db_field  );
            //print_r( $ref_details );
            if( $ref_details->current_delegation_reliever_of == $user_in_action || !$ref_details->current_delegation_reliever_of ){
                // delegation not by reliever
                $data_action = array(
                    "ref_no" => $ref_no,
                    "approve_by" => $user_in_action,
                    "comment" => $comment,
                    "action_type" => $action,
                    "reliever_of" => $user_in_action,
                    "delegation_start" => $ref_details->current_delegation_start
                );
                delegation_log( $data_action );
                $actual_delegation = $user_in_action;
            }
            else{
                // delegation by reliever
                $data_action = array(
                    "ref_no" => $ref_no,
                    "approve_by" => $user_in_action,
                    "comment" => $comment,
                    "action_type" => $action,
                    "reliever_of" => $ref_details->current_delegation_reliever_of,
                    "delegation_start" => $ref_details->current_delegation_start                    
                );
                delegation_log( $data_action );
                $actual_delegation = $ref_details->current_delegation_reliever_of;
            }
            
            // check if approve or decline
            if( $action == "Approve" ){
                $return_res[$ref_no] = manage_delegation_approve( $ref_details, $idm_details, $actual_delegation );
            }
            else if( $action == "Decline" ){
                $return_res[$ref_no] = manage_delegation_decline( $ref_details, $idm_details, $actual_delegation );
            }
        }
        return $return_res;
    }
}

function get_action_as_reliever( $ref_no, $user_in_action, $parent_db_table, $parent_table_field ){
    $CI = & get_instance();
    $CI->db->select($parent_db_table.".*")
            ->from($parent_db_table)
            ->where( $parent_table_field,$ref_no );
    return $CI->db->get()->row();
}

function delegation_log( $data ){
    $CI = & get_instance();
    $CI->db->insert("delegation_log", $data);
}

/*
 * Author: Saiful Islam
 * Created: 14 Dec 2016
 * Purpose: Maintain Approval Process
 * Function: manage_delegation_decline
 * Parameter: 
 *  ref_details: details about the ref
 *  idm_details: details about the id to fetch the store information 
 * this information will come from the "id_manager" Table. 
 * 
 */
if(!function_exists('manage_delegation_decline')) 
{
    function manage_delegation_decline( $ref_details, $idm_details ){
        $CI = & get_instance();
        $parent_db_field = $idm_details->parent_db_field;
        $parent_db_table = $idm_details->parent_db_table;
        $ref_id = $ref_details->$parent_db_field;
        $current_step = $ref_details->current_delegation_step;
        $postdecline_status = $ref_details->postdecline_status;
        if(!$postdecline_status){
            $postdecline_status = 55;
        }
    }    
}


/*
 * Author: Saiful Islam
 * Created: 14 Dec 2016
 * Purpose: Maintain Approval Process
 * Function: manage_delegation
 * Parameter: 
 *  ref_details: details about the ref
 *  idm_details: details about the id to fetch the store information 
 * this information will come from the "id_manager" Table. 
 * 
 */
if(!function_exists('manage_delegation_approve')) 
{
    function manage_delegation_approve( $ref_details, $idm_details, $current_user ){
        $parent_db_field = $idm_details->parent_db_field;
        $parent_db_table = $idm_details->parent_db_table;
        $parent_db_status = $idm_details->parent_db_status;
        $ref_id = $ref_details->$parent_db_field;
        $current_step = $ref_details->current_delegation_step;
        $postapprove_status = $idm_details->postapprove_status;
        if(!$postapprove_status){
            $postapprove_status = 54;
        }
        $CI = & get_instance();
        $manage_by = get_delegation_manage_by( $ref_id,$current_step );
        if( $manage_by == "No more delegation" ){
            
        }
        else if( $manage_by == "Limit" ){
            
        }
        else if( $manage_by == "Sorting" ){
            $sort_logic = get_step_wise_sort_logic( $ref_id,$current_step);
        
            if( $sort_logic == "Same Sort" ){
                $same_sort_priority = get_same_sort_priority( $ref_id,$current_step );
                if( $same_sort_priority == "Minority" ){
                    //go to next step 1st person
                    initiate_delegation_next_step( $ref_id, $parent_db_table, $parent_db_field, $current_step, $postapprove_status );                                    
                }
                else if( $same_sort_priority == "Majority" ){
                    //check if majority approved

                }
                else if( $same_sort_priority == "All" ){
                    //Check if all person approved
                }
            }
            else if( $sort_logic == "Not Same Sort" ){
                //check if any one else in the same sort
                $next_person = get_next_person_same_step( $ref_id, $current_step, $current_user );
                if( !$next_person ){
                    $next_person = get_next_person_next_step( $ref_id, $current_step );
                }

                // if still its false that means final approve done
                if( !$next_person ){
                    // Decide Delegation process completed
                    $data = array( 
                            "current_delegation_step" => NULL,
                            "current_delegation_start" => NULL,
                            "current_delegation_person" => NULL,
                            "current_delegation_reliever_of" => NULL,
                            $parent_db_status => $postapprove_status
                            );
                    update_delegation( $parent_db_table,$data,array($parent_db_field => $ref_id));
                }else{
                    // get the person who will be in delegation now
                    $delegation_user = $next_person;
                    //print_r($delegation_user);exit();
                    $actual_delegation_userid = $delegation_user->userid;

                    //get the person who set for the actual delegate person's reliever
                    $person_in_reliever = get_person_in_reliever( $actual_delegation_userid );   
                    if( $person_in_reliever == "Not in Reliever" ){
                        $data = array( 
                            "current_delegation_step" => $next_person->step_number,
                            "current_delegation_person" => $actual_delegation_userid,
                            "current_delegation_reliever_of" => $actual_delegation_userid,
                            "current_delegation_start" => date("Y-m-d H:i:s")
                            );
                        update_delegation( $parent_db_table,$data,array($parent_db_field => $ref_id));
                    }
                    else{
                        $data = array( 
                            "current_delegation_step" => $next_person->step_number,
                            "current_delegation_person" => $person_in_reliever,
                            "current_delegation_reliever_of" => $actual_delegation_userid,
                            "current_delegation_start" => date("Y-m-d H:i:s")
                            );
                        update_delegation( $parent_db_table,$data,array($parent_db_field => $ref_id));
                    }
                }
            }
        }        
    }
}

function get_next_person_next_step( $ref_id, $current_step ){
    $CI = & get_instance();
    $CI->db->select("delegation_by_ref.*")
            ->from("delegation_by_ref")
            ->where("delegation_by_ref.ref_no",$ref_id)
            ->where("delegation_by_ref.step_number >",$current_step)
            ->order_by("delegation_by_ref.step_number","ASC")
            ->order_by("delegation_by_ref.sort_number","ASC")
            ->limit(1);
    
    return $CI->db->get()->row();
}

function get_next_person_same_step( $ref_id, $current_step,$current_user ){
    $CI = & get_instance();
    $CI->db->select("delegation_by_ref.*")
            ->from("delegation_by_ref")
            ->where("delegation_by_ref.ref_no",$ref_id)
            ->where("delegation_by_ref.userid",$current_user);
    $thisSort = $CI->db->get()->row()->sort_number;
    //echo $CI->db->last_query();exit();
    $CI->db->select("delegation_by_ref.*")
            ->from("delegation_by_ref")
            ->where("delegation_by_ref.ref_no",$ref_id)
            ->where("delegation_by_ref.step_number",$current_step)
            ->where("delegation_by_ref.sort_number >",$thisSort)
            ->order_by("delegation_by_ref.sort_number","ASC")
            ->limit(1);
    
    return $CI->db->get()->row();
}

/*
 * Author: Saiful Islam
 * Created: 14 Dec 2016
 * Purpose: Maintain Approval Process
 * Function: initiate_delegation_next_step
 * Parameter: 
 *  ref_id: is the id for which need the process, Like Sale_id, PO_id and so on
 * this information will come from the "id_manager" Table. 
 * 
 */
if(!function_exists('initiate_delegation_next_step')) 
{
    function initiate_delegation_next_step( $ref_id, $parent_db_table, $parent_db_field, $current_step, $postapprove_status ){
        $CI = & get_instance();
        $current_step += 1;
        //echo $ref_id; echo $parent_db_table; echo $parent_table_field; echo "<h1>Hello There</h1>";exit();
        // Decide if the first step in same sort. 
        // parameter 1 for the very first step
        $manage_by = get_delegation_manage_by( $ref_id,$current_step );
        if( $manage_by == "No more delegation" ){
            // Do what to do
            // Decide Delegation process completed
            $data = array( 
                    "current_delegation_step" => NULL,
                    "current_delegation_start" => NULL,
                    "staus" => $postapprove_status
                    );
            update_delegation( $parent_db_table,$data,array($parent_db_field => $ref_id));
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
                update_delegation( $parent_db_table,$data,array($parent_db_field => $ref_id));
            }
            else if( $sort_logic == "Not Same Sort" ){
                // get the person who will be in delegation now
                $delegation_user = get_delegation_1st_user( $ref_id, $current_step );
                //print_r($delegation_user);exit();
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
                    update_delegation( $parent_db_table,$data,array($parent_db_field => $ref_id));
                }
                else{
                    $data = array( 
                        "current_delegation_step" => $current_step,
                        "current_delegation_person" => $person_in_reliever,
                        "current_delegation_reliever_of" => $actual_delegation_userid,
                        "current_delegation_start" => date("Y-m-d H:i:s")
                        );
                    update_delegation( $parent_db_table,$data,array($parent_db_field => $ref_id));
                }
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
 * this information will come from the "id_manager" Table. 
 * 
 * This function will use only for the first time when any process comes under the
 * Delegation process.
 * 
 */
if(!function_exists('initiate_delegation')) 
{
    function initiate_delegation( $ref_id ){
        // get id details
        $idm_details = get_idm_details( $ref_id );
        
        // fetch the initial step here
        $initial_step = get_initial_step( $ref_id );
        
        $CI = & get_instance();
        //echo $ref_id; echo $parent_db_table; echo $parent_table_field; echo "<h1>Hello There</h1>";exit();
        // Decide if the first step in same sort. 
        // parameter 1 for the very first step
        $manage_by = get_delegation_manage_by( $ref_id,$initial_step );
        if( $manage_by == "No more delegation" ){
            // Do what to do
        }
        else if( $manage_by == "Limit" ){
            
        }
        else if( $manage_by == "Sorting" ){
            $sort_logic = get_step_wise_sort_logic( $ref_id,$initial_step );
            
            if( $sort_logic == "Same Sort" ){
                // in this case no need to check for reliever
                // some people will be in same sort. any exception will handle by the admin
                $data = array( 
                        "current_delegation_step" => $initial_step,
                        "current_delegation_start" => date("Y-m-d H:i:s")
                        );
                update_delegation( $idm_details->parent_db_table,$data,array($idm_details->parent_db_field => $ref_id));
            }
            else if( $sort_logic == "Not Same Sort" ){
                // get the person who will be in delegation now
                $delegation_user = get_delegation_1st_user( $ref_id, $initial_step );
                //print_r($delegation_user);exit();
                $actual_delegation_userid = $delegation_user->userid;

                //get the person who set for the actual delegate person's reliever
                $person_in_reliever = get_person_in_reliever( $actual_delegation_userid );   
                if( $person_in_reliever == "Not in Reliever" ){
                    $data = array( 
                        "current_delegation_step" => $initial_step,
                        "current_delegation_person" => $actual_delegation_userid,
                        "current_delegation_reliever_of" => $actual_delegation_userid,
                        "current_delegation_start" => date("Y-m-d H:i:s")
                        );
                    update_delegation( $idm_details->parent_db_table,$data,array($idm_details->parent_db_field => $ref_id));
                }
                else{
                    $data = array( 
                        "current_delegation_step" => $initial_step,
                        "current_delegation_person" => $person_in_reliever,
                        "current_delegation_reliever_of" => $actual_delegation_userid,
                        "current_delegation_start" => date("Y-m-d H:i:s")
                        );
                    update_delegation( $idm_details->parent_db_table,$data,array($idm_details->parent_db_field => $ref_id));
                }
            }
        }        
    }
}

// find the very first step of any ref delegation
function get_initial_step( $ref_no ){
    $CI = & get_instance();
    $CI->db->select("delegation_by_ref.*")
            ->from("delegation_by_ref")
            ->where("ref_no",$ref_no)
            ->order_by("delegation_by_ref.step_number", "ASC")
            ->limit(1);
    return $CI->db->get()->row()->step_number;
}

// Just update the parent table of the ref no
function update_delegation( $tablename, $data, $where ){
    $CI = & get_instance();
    $CI->db->update( $tablename, $data, $where );
}

// get id manager details by ref no
// first two char of any ref no will describe the prefix
function get_idm_details( $ref_no ){
    $CI = & get_instance();
    //echo "<h1>$ref_no</h1>";
    $CI->db->select("id_manager.*")
            ->from("id_manager")
            ->where("pre_fix", substr($ref_no, 0, 2));
    return $CI->db->get()->row();
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
            ->from("user")
            ->where("user_id",$userid);
    $query = $CI->db->get()->row();
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
            ->from("delegation_by_ref")
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
    $CI->db->select("sort_number")
            ->from("delegation_by_ref")
            ->where("ref_no", $ref_id)
            ->where("step_number", $step_no)
            ->group_by("sort_number");
    $number_of_sort = $CI->db->get()->num_rows();
    //echo $res;exit();
    //$number_of_sort = $CI->db->count_all_results();
    if( $number_of_sort > 1 ){
        return "Not Same Sort";
    }else{
        $CI->db->select("COUNT(sort_number) AS number_of_person");
        $CI->db->from("delegation_by_ref");
        $CI->db->where("ref_no", $ref_id);
        $CI->db->where("step_number", $step_no);
        $CI->db->group_by("step_number");
        $number_of_person = $CI->db->get()->row()->number_of_person;
        //echo $CI->db->last_query();exit();
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