<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function poolcar_requsition_type($selected_value = NULL, $extra_attr = array(), $name = 'poolcar_requsition_type_id', $where = NULL) {
    $sql = "SELECT
            poolcar_requsition_type.poolcar_requisition_type_id,
            poolcar_requsition_type.poolcar_requisition_type_name
            FROM
            poolcar_requsition_type";
    $id_field = 'poolcar_requisition_type_id';
    $value_field = 'poolcar_requisition_type_name';
    echo common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

// Combobox for "requsition_type" table
function vehicle_type($selected_value = NULL, $extra_attr = array(), $name = 'vehicle_type_id', $where = NULL, $onchange = FALSE) {
    $sql = "SELECT
            vehicle_type.vehicle_type_id,
            vehicle_type.vehicle_type_name
            FROM
            vehicle_type";
    $id_field = 'vehicle_type_id';
    $value_field = 'vehicle_type_name';
    
    $ajax_function = '';
    if($onchange){
        $ajax_function = ' onchange="ajax_call(\'vehicle_model\',this.value,\'vehicle_model_id\',\'vehicle_type_id\',\'model_combo\')"';
    }
    echo common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field, $ajax_function);
}

function vehicle_model($selected_value = NULL, $extra_attr = array(), $name = 'vehicle_model_id', $where = NULL, $onchange = FALSE) {
    $sql = "SELECT
            vehicle_model.vehicle_model_id,
            vehicle_model.vehicle_model_name
            FROM
            vehicle_model             
           ";
    $id_field = 'vehicle_model_id';
    $value_field = 'vehicle_model_name';
    
    $ajax_function = '';
    if($onchange){
        $ajax_function = ' onchange="ajax_call(\'vehicle\',this.value,\'vehicle_id\',\'vehicle_model_id\',\'vehicle_combo\')"';
    }
    echo common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field, $ajax_function);
}

function users($selected_value = NULL, $extra_attr = array(), $name = 'requisition_for', $where = NULL) {
    $sql = "SELECT
            user.user_id,
            CONCAT(user.first_name,' ',user.last_name,'->',location.location_name,'->',department.department_name) AS name
            FROM
            user
            LEFT JOIN location ON user.location_id=location.location_id
            LEFT JOIN department ON user.department_id=department.department_id";
    $id_field = 'user_id';
    $value_field = 'name';
    echo common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

// Function added by Md Riad Hossain at 25.11.2014
function vehicle($selected_value = NULL, $extra_attr = array(), $name = 'vehicle_id', $where = NULL, $onchange = FALSE) {
    $sql = "SELECT
            vehicle.vehicle_id,
            vehicle.vehicle_plate_number
            FROM
            vehicle             
           ";
    $id_field = 'vehicle_id';
    $value_field = 'vehicle_plate_number';
    $ajax_function = '';
    if($onchange){
        $ajax_function = ' onchange="ajax_call(\'I am going to search a new table\',this.value)"';
    }
    echo common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field, $ajax_function);
}
function get_color($status,$conflict){
    if($status == 12 && $conflict == 1){
        return "red";
    }elseif ($conflict == 1) {
        return "orange";
    }  else {
        return "green";
    }
}
function get_color_class($array_data){
    $confirm_counter = 0;
    $conflict_counter = 0;
    foreach ($array_data as $value) {
        if($value['requisition_status'] == 12 && $value['conflict'] == 1){
            $confirm_counter++;
        }
        if($value['conflict'] == 1){
            $conflict_counter++;
        }
    }
    if($confirm_counter > 0){
        return array("danger","disabled");
    }  elseif ($conflict_counter) {
        return array("warning","");
    }  else {
        return array("primary","");
    }
}
?>