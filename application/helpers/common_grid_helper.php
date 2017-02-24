<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');
    
    function get_text_field($data)
    {
        $html = '';
        $html .= '<div class="col-lg-'.(isset($data['column'])?$data['column']:"").' form-group">';
        $html .= '<label class="custom_label">'.(isset($data['title_name'])?$data['title_name']:"").'</label>';
        $html .= '<input type="text" name="'.(isset($data['fild_name'])?$data['fild_name']:"").'" placeholder="'.(isset($data['placeholder'])?$data['placeholder']:"").'" value="" class="form-control user-error" aria-invalid="true">';
        $html .= '</div>';
        return $html;
    }
    
//    function get_date_field($column,$field_title,$field_name,$placeholder,$mindate,$maxdate)
//    {
//        $html = '';
//        $html .= '<div class="col-lg-'.$column.' form-group">';
//        $html .= '<label>'.$field_title.'</label>';
//        $html .= '<input type="date" name="'.$field_name.'" placeholder="'.$placeholder.'" min="'.$mindate.'" max="'.$maxdate.'" value="" class="form-control user-error" aria-invalid="true">';
//        $html .= '</div>';
//        return $html;
//    }
    
    
    function get_time_field($data,$column,$field_title,$field_name,$placeholder,$mintime,$maxtime)
    {
        $html = '';
        $html .= '<div class="col-lg-'.(isset($data['column'])?$data['column']:"").' form-group">';
        $html .= '<label class="custom_label">'.(isset($data['title_name'])?$data['title_name']:"").'</label>';
        $html .= '<input type="time" name="'.(isset($data['field_name'])?$data['field_name']:"").'" placeholder="'.(isset($data['placeholder'])?$data['placeholder']:"").'" min="'.(isset($data['min_time'])?$data['min_time']:"").'" max="'.(isset($data['max_time'])?$data['max_time']:"").'" value="" class="form-control user-error" aria-invalid="true">';
        $html .= '</div>';
        return $html;
    }
    
    function get_date_time_field($data)
    {
        $html = '';
        $html .= '<div class="col-lg-'.(isset($data['column'])?$data['column']:"").' form-group">';
        $html .= '<label class="custom_label">'.(isset($data['title_name'])?$data['title_name']:"").'</label>';
        $html .= '<input type="text" name="'.(isset($data['field_name'])?$data['field_name']:"").'" placeholder="'.(isset($data['placeholder'])?$data['placeholder']:"").'" min="'.(isset($data['min_date'])?$data['min_date']:"").'" max="'.(isset($data['max_date'])?$data['max_date']:"").'" single_date_picker="'.(isset($data['single_date_picker'])?$data['single_date_picker']:"").'" value="" class="form-control user-error date_range" aria-invalid="true">';
        $html .= '</div>';
        $html .= '<script>$(document).ready(function () {
                    var minDate = $(".date_range").attr("min");
                    var maxDate = $(".date_range").attr("max");
                    var singleDatePicker = $(".date_range").attr("single_date_picker");


                    $(".date_range").daterangepicker({
                        "locale":{
                            format:"YYYY/MM/DD"
                        },
                        "singleDatePicker": (singleDatePicker=="true")?true:false,
                        "autoApply": true,
                        "minDate": minDate,
                        "maxDate": maxDate,
                        "showDropdowns": true,
                        "alwaysShowCalendars": true
                    });
                });</script>';
        return $html;
    }
    
    function get_drop_down_list($data)
    {
        $html = '';
        $html .= '<div class="col-lg-'.(isset($data['column'])?$data['column']:"").' form-group">';
        $html .= '<label class="custom_label">'.(isset($data['title_name'])?$data['title_name']:"").'</label>';
        //ap_drop_down(27,NULL,array('class' => 'delivery_mode_id', 'required' => 'required'));
        $html .= ap_drop_down($data['drop_down_id'],NULL,array("selected_value"=>""));
        $html .= '</div>';
        return $html;
    }
?>

