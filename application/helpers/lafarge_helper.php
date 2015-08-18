<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Created by Md. Riad Hossain at 26.11.2014
 * This function is used for keeping log when any requisition status is changed for any module
 * This function acccept 1(One) parameter whisch is array
 * This array parameter must contain 5 element 
 * 0 => Module Name, 
 * 1=> Requisition ID, 
 * 2=> User ID, 
 * 3=> Status ID and 
 * 4=> Comment
 * log_requisition_status(array($module_name,$requisition_id,$user_id,$status_id,$comment))
 */
function log_requisition_status($data_array){
    $CI =& get_instance();
    $table_name = $data_array[0].'_approval_log';
    $data = array(
        'requisition_id' => $data_array[1] ,
        'approved_by' => $data_array[2] ,
        'approved_status_id' => $data_array[3] ,
        'comment' => $data_array[4]
     );
    $CI->db->insert($table_name, $data);
}
?>