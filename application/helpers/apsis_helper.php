<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Function that will used by all combobox creation method
function common_in_combo($name,$sql,$where,$selected_value,$extra,$id_field,$value_field,$onchange = false){
    $CI =& get_instance(); 
    $condtion = '';
    if($where != NULL){
        $condtion = " WHERE 1";
        foreach ($where as $key => $value) {
            $condtion .= " AND $key='$value'";
        }
    }
    $sql = $sql.$condtion;
    $query = $CI->db->query($sql);
    $data = is_array($extra) && array_key_exists('multiple', $extra)?array():array(''=>'Select');
    $extra_str='';
    if(!empty($extra)){
        foreach ($extra as $key => $value) {
            $extra_str .= $key.'="'.$value.'"'; 
        }
    }
    if($onchange){
        $extra_str = $extra_str.$onchange;
    }
    
    foreach ($query->result_array() as $value){
        $data[$value[$id_field]] = $value[$value_field];
    }
    return form_dropdown($name,$data,$selected_value,$extra_str);
}

// Combobox for "user_level" table
function user_level( $selected_value=NULL, $extra_attr=array(), $name='user_level_id', $where=NULL ){
    $sql = "SELECT user_level_id, user_level_name FROM user_level";
    $id_field = 'user_level_id';
    $value_field = 'user_level_name';
    echo common_in_combo($name,$sql,$where,$selected_value,$extra_attr,$id_field,$value_field);
}

// Combobox for "user" table
function user( $selected_value = NULL, $extra_attr=array(), $name='user_id', $where=NULL){
    $sql = "SELECT user_id,CONCAT(username,' > ',first_name,' ',last_name) as name FROM user";
    $id_field = 'user_id';
    $value_field = 'name';
    echo common_in_combo($name,$sql,$where,$selected_value,$extra_attr,$id_field,$value_field);
}

// Combobox for "user - department" table
function user_department( $selected_value = NULL, $extra_attr=array(), $name='user_department_id', $where=NULL){
    $sql = "SELECT
            user.user_id,
            CONCAT(department.department_name,' > ',user.first_name,' ',user.last_name) AS name
            FROM
            user
            JOIN department ON user.department_id = department.department_id
            ORDER BY
            department.department_name ASC
            ";
    $id_field = 'user_id';
    $value_field = 'name';
    echo common_in_combo($name,$sql,$where,$selected_value,$extra_attr,$id_field,$value_field);
}

// Combobox for "user - designation" table
function user_designation( $selected_value = NULL, $extra_attr=array(), $name='user_designation_id', $where=NULL){
    $sql = "SELECT
            user.user_id,
            CONCAT(designation.designation_name,' > ',user.first_name,' ',user.last_name) AS name
            FROM
            user
            JOIN designation ON user.designation_id = designation.designation_id
            ORDER BY
            designation.designation_name ASC
            ";
    $id_field = 'user_id';
    $value_field = 'name';
    echo common_in_combo($name,$sql,$where,$selected_value,$extra_attr,$id_field,$value_field);
}

// Combobox for "user" table
function upazila( $selected_value = NULL, $extra_attr=array(), $name='upazila_id', $where=NULL){
    $sql = "SELECT upazila_id, upazila_name FROM upazila";
    $id_field = 'upazila_id';
    $value_field = 'upazila_name';
    echo common_in_combo($name,$sql,$where,$selected_value,$extra_attr,$id_field,$value_field);
}

// Combobox for "district" table
function district( $selected_value=NULL, $extra_attr=array(), $name='district_id', $where=NULL){
    $sql = "SELECT district_id,district_name FROM district";
    $id_field = 'district_id';
    $value_field = 'district_name';
    echo common_in_combo($name,$sql,$where,$selected_value,$extra_attr,$id_field,$value_field);
}

// Combobox for "division" table
function division( $selected_value=NULL, $extra_attr=array(), $name='division_id', $where=NULL){
    $sql = "SELECT division_id,division_name FROM division";
    $id_field = 'division_id';
    $value_field = 'division_name';
    echo common_in_combo($name,$sql,$where,$selected_value,$extra_attr,$id_field,$value_field);
}

// Combobox for "Religion" table
function religion( $selected_value=NULL, $extra_attr=array(), $name='religion_id', $where=NULL){
    $sql = "SELECT religion_id,religion_name FROM religion order by religion_id asc";
    $id_field = 'religion_id';
    $value_field = 'religion_name';
    echo common_in_combo($name,$sql,$where,$selected_value,$extra_attr,$id_field,$value_field);
}

// Combobox for "Identification_type" table
function identification_type( $selected_value=NULL, $extra_attr=array(), $name='identification_type_id', $where=NULL){
    $sql = "SELECT identification_type_id,identification_type_name FROM identification_type order by identification_type_id asc";
    $id_field = 'identification_type_id';
    $value_field = 'identification_type_name';
    echo common_in_combo($name,$sql,$where,$selected_value,$extra_attr,$id_field,$value_field);
}

// Combobox for "Bank" table
function bank( $selected_value=NULL, $extra_attr=array(), $name='bank_id', $where=NULL){
    $sql = "SELECT bank_id, bank_name FROM bank order by bank_id asc";
    $id_field = 'bank_id';
    $value_field = 'bank_name';
    echo common_in_combo($name,$sql,$where,$selected_value,$extra_attr,$id_field,$value_field);
}

// Combobox for "module" table
function module( $selected_value=NULL, $extra_attr=array(), $name='module_id', $where=NULL ){
    $sql = "SELECT module_id,module_name FROM module WHERE module_id<>2";
    $id_field = 'module_id';
    $value_field = 'module_name';
    echo common_in_combo($name,$sql,$where,$selected_value,$extra_attr,$id_field,$value_field);
}

// Combobox for "master_entry" table
function master_entry_table($name='master_entry_table_name',$where=NULL,$selected_value=NULL,$extra_attr=array()){
    $sql = "SELECT master_entry_table_id,master_entry_table_name FROM master_entry_table";
    $id_field = 'master_entry_table_name';
    $value_field = 'master_entry_table_name';
    echo common_in_combo($name,$sql,$where,$selected_value,$extra_attr,$id_field,$value_field);
}

// Combobox for "view" table
function view_table($name='master_entry_table_name',$where=NULL,$selected_value=NULL,$extra_attr=array()){
    $sql = "SELECT master_entry_table_id,master_entry_table_name FROM master_entry_table";
    $id_field = 'master_entry_table_name';
    $value_field = 'master_entry_table_name';
    echo common_in_combo($name,$sql,$where,$selected_value,$extra_attr,$id_field,$value_field);
}

// Combobox for get table field of a table
function table_field($table_name,$name='master_entry_table_name',$where=NULL,$selected_value=NULL,$extra_attr=array()){
    $sql = "DESCRIBE $table_name";
    $id_field = 'Field';
    $value_field = 'Field';
    echo common_in_combo($name,$sql,$where,$selected_value,$extra_attr,$id_field,$value_field);
}

// Combobox for "status" table
function status( $selected_value=NULL,$extra_attr=array(), $name='status_id',$where=NULL ){
    $sql = "SELECT
            status.status_id,
            status.status_name
            FROM
            status";
    $id_field = 'status_id';
    $value_field = 'status_name';
    echo common_in_combo($name,$sql,$where,$selected_value,$extra_attr,$id_field,$value_field);
}
function email_subject( $selected_value=NULL,$extra_attr=array(), $name='email_subject',$where=NULL ){
    $sql = "SELECT
            email_subject_name,
            email_subject_name
            FROM
            email_subject";
    $id_field = 'email_subject_name';
    $value_field = 'email_subject_name';
    echo common_in_combo($name,$sql,$where,$selected_value,$extra_attr,$id_field,$value_field);
}

// for browse to uploading file
function file_browse($name = null, $title = null, $attribute = null){
    if($name == null){
        $name = 'image_up';
    }
    
    if($title == null){
        $title = 'Browse to Upload';
    }
    
    echo '<script>$(document).ready(function(){$(".file-inputs").bootstrapFileInput();});</script>';
    echo "<input class='file-inputs' type='file' name='".$name."' data-filename-placement='inside' title='".$title."' ".$attribute."/>";
}


?>