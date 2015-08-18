<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Combobox for "customer" table
function customer( $selected_value=NULL, $extra_attr=array(), $name='customer_id',$where=NULL){
    $sql = "SELECT
            customer_id,
            customer_name
            FROM
            customer";
    $id_field = 'customer_id';
    $value_field = 'customer_name';
    echo common_in_combo($name,$sql,$where,$selected_value,$extra_attr,$id_field,$value_field);   
}
?>