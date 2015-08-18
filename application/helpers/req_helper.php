<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Combobox for "conroom_conference_room" table
function conroom_conference_room( $selected_value=NULL, $extra_attr=array(), $name='conroom_conference_room_id',$where=NULL){
    $sql = "SELECT
            conroom_conference_room_id,
            CONCAT(conroom_conference_room_name,' << ',room_number) as room_name
            FROM
            conroom_conference_room";
    $id_field = 'conroom_conference_room_id';
    $value_field = 'room_name';
    echo common_in_combo($name,$sql,$where,$selected_value,$extra_attr,$id_field,$value_field);   
}
?>