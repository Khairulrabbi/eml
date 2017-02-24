<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('debug')) 
{
    function debug($dt=null,$true=false) 
    {
        if(defined('DEBUG_REMOTE_ADDR') && $_SERVER['REMOTE_ADDR'] != DEBUG_REMOTE_ADDR) return;
            $bt     = debug_backtrace();
            $caller = array_shift($bt);
            $file_line = "<strong>" . $caller['file'] . "(line " . $caller['line'] . ")</strong>\n";
            echo "<br/>";
                print_r ( $file_line );
            echo "<br/>";
            echo "<pre>";
                print_r($dt);
            echo "</pre>";
        if($true)
        {
            die("<b>die();</b>");
        }           
    }
}


function vendor_value($name=NULL,$mobile=NULL,$address=NULL)
{
    $return_value = "";
    if($name != NULL)
    {
        $return_value .= $name." ";
    }
    if($mobile != NULL)
    {
        $return_value .= $mobile." ";
    }
    if($address != NULL)
    {
        $return_value .= $address;
    }
    return $return_value;
} 

function cart_quantity()
{
    $CI = & get_instance();
    $CI->db->where('user_id',$CI->session->userdata('USER_ID'));
    $CI->db->from("cart");
    return $CI->db->count_all_results();
}


function mpdf_create($data, $file_name = '', $page_size = 'A4-L') {
    $CI = & get_instance();
    $sess_id = $CI->session->userdata('USER_ID');
    if (empty($sess_id)) {
        show_404();
    } 
    //$data['infoIFneed'] = "";
    $CI->load->helper('dompdf');
    $CI->load->view('pdf_template', $data);
    $html = $CI->output->get_output();
    if (empty($file_name)) {
        $file_name = "eml report - " . date("jS M, Y");
    }
    do_mpdf_create($html, $file_name, $page_size, 190, 236, $data);
    /**
     * Legal
     * Letter
     * Demy
     * Ledger
     * A4
     */
}


function label_change_permission()
{
    $CI = & get_instance();
    $user_label = $CI->session->userdata('LEVEL_ID');
    if(in_array(1, $user_label))
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}



function stock_view_privilege_wise()
{
    $CI = & get_instance();
    
    $CI->db->select("SUM(user_level.privilege_nation_access) as total");
    $CI->db->from("user");
    $CI->db->join("privilege_level","privilege_level.user_id=user.user_id","left");
    $CI->db->join("user_level","privilege_level.user_level_id=user_level.user_level_id","left");
    $CI->db->where("user.user_id",$CI->session->userdata("USER_ID"));
    $CI->db->group_by("user.user_id");
    $row = $CI->db->get()->row();
    
    $user_privilege = $CI->session->userdata("PRIVILEGE_NATION_ACCESS");
    //debug($user_privilege,1);
    if($user_privilege == 2)
    {
        return TRUE;
    }
    else if($user_privilege == 0)
    {
        if($row->total > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    else
    {
        return FALSE;
    }
}


function bpa($key) // bpa means button privilege access
{
    switch ($key) {
        case 'create_chalan':
            return TRUE;
            break;
        case 'save_purchase_order':            
            return TRUE;
            break;
        case 'save_proforma':
            return TRUE;
            break;
        case 'receive_order':
            return TRUE;
            break;
        case 'chalan_info':
            return TRUE;
            break;
        case 'fob_setting':
            return TRUE;
            break;
        case 'requisition_form':
            return TRUE;
            break;
        case 'save_purchase':
            return TRUE;
            break;
        default :
            return FALSE;
            break;
    }
}

function ccsbsid($status,$type,$json_field=NULL)
    {
        $json_column = 0;
        if($json_field)
        {
            $json_column = $json_field;
        }
        if($status == 5)
        {
            if($type == 'one')
            {
                return 6+$json_column;
            }
            else if($type == 'two')
            {
                return 8+$json_column;
            }
        }
        else if($status == 6)
        {
            if($type == 'one')
            {
                return 13+$json_column;
            }
            else if($type == 'two')
            {
                return 14+$json_column;
            }
        }else if($status == 12)
        {
            if($type == 'one')
            {
                return 15+$json_column;
            }
            else if($type == 'two')
            {
                return 16+$json_column;
            }
        }if($status == 36)
        {
            if($type == 'one')
            {
                return 6+$json_column;
            }
            else if($type == 'two')
            {
                return 8+$json_column;
            }
        }
        else if($status == 37)
        {
            if($type == 'one')
            {
                return 6+$json_column;
            }
            else if($type == 'two')
            {
                return 12+$json_column;
            }
        }
        else if($status == 47)
        {
            if($type == 'one')
            {
                return 11+$json_column;
            }
            else if($type == 'two')
            {
                return 6+$json_column;
            }
        }
        else if($status == 49)
        {
            if($type == 'one')
            {
                return 11+$json_column;
            }
            else if($type == 'two')
            {
                return 12+$json_column;
            }
        }
        else
        {
            return $json_column;
        }
        
    }
    
function get_specification_json_type($json_details,$flag,$json_column=NULL)
{
    $CI = & get_instance();
    $rows = $CI->db->query("SELECT
                specification_type_id,
                specification_type_name
        FROM
                specification_type
        WHERE
                specification_type_id NOT IN (8, 9)
        ORDER BY
                specification_type_id");

    $html = "";
    if($flag == 'title')
    {
        foreach ($rows->result() as $row)
        {
            $html .= "<th>".$row->specification_type_name."</th>";
        }
    }
    else if($flag == "value")
    {
        foreach ($rows->result() as $row)
        {
            $html .= "<td>".@$json_details[@$row->specification_type_id]."</td>";
        }
    }
    if($json_column)
    {
        return $rows->num_rows();
    }
    else
    {
        return $html;
    }
}




function get_generated_code($id)
{
    $CI = & get_instance();
    $CI->db->select("*");
    $CI->db->from("id_manager");
    $CI->db->where("id_manager_id",$id);
    $id_manager = $CI->db->get()->row();
    $prefix = $id_manager->pre_fix;
    $sq_id = $CI->db->query("SELECT sequential_id FROM generated_id WHERE sequential_id=(SELECT MAX(sequential_id) FROM generated_id WHERE prefix='$prefix')")->row();
    
    if(empty($sq_id))
    {
        $new_sq_id = $id_manager->id_start_from;
    }
    else
    {
        $new_sq_id = $sq_id->sequential_id+1;
    }
    
    if(strlen($new_sq_id) > $id_manager->actual_id_char)
    {
        die("Formated id limit exited!");
    }
    
    $default_number = '';
    for($i = 1; $i<=$id_manager->default_char; $i++){
       $default_number .= '0';		
    }
    
    
    $actual_id = $prefix.'-'.$default_number.'-'.$new_sq_id;
    
    
    $check_sq_id = $CI->db->query("SELECT sequential_id FROM generated_id WHERE sequential_id='".$new_sq_id."' AND prefix='".$prefix."'")->row();

    if(empty($check_sq_id))
    {
        $CI->db->query("INSERT INTO generated_id (prefix,default_char,sequential_id,actual_id)values('$prefix','$default_number','$new_sq_id','$actual_id')");
        return $actual_id;
    }
    else
    {
        get_generated_code($id);
    }
}


//function purchase_approval_comments_access($purchase_code,$user_id)
//{
//    $CI = & get_instance();
//    $row = $CI->db->query("SELECT
//            Count(purchase_order.purchase_id) AS total
//            FROM
//            delegation_by_ref
//            LEFT JOIN purchase_order ON delegation_by_ref.step_number = purchase_order.current_delegation_step AND delegation_by_ref.ref_no = purchase_order.purchase_code
//            WHERE
//            delegation_by_ref.userid = ".$user_id." AND purchase_order.purchase_code='".$purchase_code."'")->row();
//    if($row->total > 0)
//    {
//        return TRUE;
//    }
//    else
//    {
//        return FALSE;
//    }
//}


function approval_comments_access($code,$user_id,$table,$field)
{
    $CI = & get_instance();
    $row = $CI->db->query("SELECT
            Count(".$table.".".$field.") AS total
            FROM
            delegation_by_ref
            LEFT JOIN $table ON delegation_by_ref.step_number = ".$table.".current_delegation_step AND delegation_by_ref.ref_no = ".$table.".".$field."
            WHERE
            delegation_by_ref.userid = ".$user_id." AND ".$table.".".$field."='".$code."'")->row();
    if($row->total > 0)
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}



function generate_specefic_list_view($details_info,$flag)
{
    $CI = & get_instance();
    $html = "";
    if($flag == "title")
    {
        //debug($details_info,1);
        foreach ($details_info[0] as $key=>$val)
        {   
            $html .= "<th>".$key."</th>";
        }
    }
    else if($flag == "value")
    {
        foreach ($details_info as $value)
        {
            $html .= "<tr>";
            
            foreach ($value as $k=>$v)
            {
                $html .= "<td>".@$v."</td>";    
            }
            $html .= "</tr>";
        }
    }
    return $html;
}

