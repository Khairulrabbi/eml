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
