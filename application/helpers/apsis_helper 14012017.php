<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// Function that will used by all combobox creation method
function common_in_combo($name, $sql, $where, $selected_value, $extra, $id_field, $value_field, $onchange = false) {
    $CI = & get_instance();
    $condtion = '';
    if ($where != NULL) {
        $condtion = " WHERE 1";
        foreach ($where as $key => $value) {
            $condtion .= " AND $key='$value'";
        }
    }
    $sql = $sql . $condtion;
    $query = $CI->db->query($sql);
    $data = is_array($extra) && array_key_exists('multiple', $extra) ? array() : array('' => 'Select');
    $extra_str = '';
    if (!empty($extra)) {
        foreach ($extra as $key => $value) {
            $extra_str .= $key . '="' . $value . '"';
        }
    }
    if ($onchange) {
        $extra_str = $extra_str . $onchange;
    }

    foreach ($query->result_array() as $value) {
        $data[$value[$id_field]] = $value[$value_field];
    }
    return form_dropdown($name, $data, $selected_value, $extra_str);
}

/* 
 * A common function to create Drop Down by using DB Data
 * Author: Saiful Islam
 * Created: 31 Dec 2016
 * 
*/
if(!function_exists('ap_drop_down')) 
{
    function ap_drop_down( $id, $where = NULL, $selected_value = NULL, $extra_attr = array(), $name = NULL ){
        $CI = & get_instance();
        $CI->db->select("dropdown_list.*")
                ->from("dropdown_list")
                ->where("dd_id",$id);
        $drop_down = $CI->db->get()->row();
//        echo $CI->db->last_query();
//        print_r($drop_down);
        $sql = $drop_down->query;
        $id_field = $drop_down->option_id;
        $value_field = $drop_down->option_value;
        if( $drop_down->multiselect ){
            $extra_attr['multiple'] = 1;
        }
        if(!$name){
            $name = $drop_down->field_id;//Html tag id
        }
        return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
    }
}

// Combobox for "user_level" table
function user_level($selected_value = NULL, $extra_attr = array(), $name = 'user_level_id', $where = NULL) {
    $sql = "SELECT user_level_id, user_level_name FROM user_level";
    $id_field = 'user_level_id';
    $value_field = 'user_level_name';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}
function approval_privilege_multiselect($selected_value = NULL, $extra_attr = array(), $name = 'userid', $where = NULL) {
    $sql = "SELECT privilege_for_approval.userid, 
        CONCAT(user.first_name,' ',user.last_name) AS name 
                        FROM
                            privilege_for_approval
                        INNER JOIN `user` ON privilege_for_approval.userid = `user`.user_id ";
    $id_field = 'userid';
    $value_field = 'name';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}
function approve_for_list($selected_value = NULL, $extra_attr = array(), $name = 'approve_for_id', $where = NULL) {
    $sql = "SELECT approve_for_id, approve_for_name
                        FROM
                            approve_for WHERE status='Active'";
    $id_field = 'approve_for_id';
    $value_field = 'approve_for_name';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}





// Combobox for "size" table
function search_size($selected_value = NULL, $extra_attr = array(), $name = 'size_id', $where = NULL) {
    $sql = "SELECT size_id, size_details FROM size";
    $id_field = 'size_id';
    $value_field = 'size_details';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}


function sdta()
{
    $html = '<input <?php fa="s" type="checkbox" class="sdta_checkbox1 sdtac" value="S">&nbsp;&nbsp;S&nbsp;&nbsp;';
    $html .= '<input <?php fa="d" type="checkbox" class="sdta_checkbox2 sdtac" value="D">&nbsp;&nbsp;D&nbsp;&nbsp;';
    $html .= '<input <?php fa="t" type="checkbox" class="sdta_checkbox3 sdtac" value="T">&nbsp;&nbsp;T&nbsp;&nbsp;';
    $html .= '<input <?php fa="a" type="checkbox" class="sdta_checkbox4 sdtac" value="A">&nbsp;&nbsp;A&nbsp;&nbsp;';
    $html .= '<input name="sdta" type="hidden" class="sdta" value="">';
    $html .= '<script>';
    $html .= "$('.sdtac').click(function(){
        var s = '';
        var d = '';
        var t = '';
        var a = '';
        if($('.sdta_checkbox1').is(':checked'))
        {
           s = $('.sdta_checkbox1').val();
        }
        if($('.sdta_checkbox2').is(':checked'))
        {
           d = $('.sdta_checkbox2').val();
        }
        if($('.sdta_checkbox3').is(':checked'))
        {
           t = $('.sdta_checkbox3').val();
        }
        if($('.sdta_checkbox4').is(':checked'))
        {
           a = $('.sdta_checkbox4').val();
        }
        $('.sdta').val(s+d+t+a);
    });";
    $html .= '</script>';
    return $html;
}


function region_id($selected_value = NULL, $extra_attr = array(), $name = 'region_id', $where = NULL) {
    $sql = "SELECT region_id,region_name FROM region";
    $id_field = 'region_id';
    $value_field = 'region_name';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}


function product_group_id($selected_value = NULL, $extra_attr = array(), $name = 'product_group_id', $where = NULL) {
    $sql = "SELECT product_group_id,product_group_name FROM product_group";
    $id_field = 'product_group_id';
    $value_field = 'product_group_name';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}
function unit($selected_value = NULL, $extra_attr = array(), $name = 'unit', $where = NULL) {
    $sql = "SELECT unit_id,unit_name FROM unit";
    $id_field = 'unit_id';
    $value_field = 'unit_name';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}



// Combobox for "user" table
function user($selected_value = NULL, $extra_attr = array(), $name = 'user_id', $where = NULL) {
    $sql = "SELECT user_id,CONCAT(username,' > ',first_name,' ',last_name) as name FROM user";
    $id_field = 'user_id';
    $value_field = 'name';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}


//function user_name($selected_value = NULL, $extra_attr = array(), $name = 'user_id', $where = NULL) {
//    $sql = "SELECT user_id,username FROM user";
//    $id_field = 'user_id';
//    $value_field = 'username';
//    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
//}

function vehicle_type2($selected_value = NULL, $extra_attr = array(), $name = 'vehicle_type_id', $where = NULL, $onchange = FALSE) {
    $sql = "SELECT
            vehicle_type.vehicle_type_id,
            vehicle_type.vehicle_type_name
            FROM
            vehicle_type";
    $id_field = 'vehicle_type_id';
    $value_field = 'vehicle_type_name';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

// Combobox for "user - department" table
function user_department($selected_value = NULL, $extra_attr = array(), $name = 'user_department_id', $where = NULL) {
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
    echo common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

// Combobox for "user - designation" table
function user_designation($selected_value = NULL, $extra_attr = array(), $name = 'user_designation_id', $where = NULL) {
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
    echo common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

// Combobox for "user" table
function upazila($selected_value = NULL, $extra_attr = array(), $name = 'upazila_id', $where = NULL) {
    $sql = "SELECT upazila_id, upazila_name FROM upazila";
    $id_field = 'upazila_id';
    $value_field = 'upazila_name';
    echo common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}



// Combobox for "district" table
function district($selected_value = NULL, $extra_attr = array(), $name = 'district_id', $where = NULL) {
    $sql = "SELECT district_id,district_name FROM district";
    $id_field = 'district_id';
    $value_field = 'district_name';
    echo common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

// Combobox for "division" table
function division($selected_value = NULL, $extra_attr = array(), $name = 'division_id', $where = NULL) {
    $sql = "SELECT division_id,division_name FROM division";
    $id_field = 'division_id';
    $value_field = 'division_name';
    echo common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

// Combobox for "Religion" table
function religion($selected_value = NULL, $extra_attr = array(), $name = 'religion_id', $where = NULL) {
    $sql = "SELECT religion_id,religion_name FROM religion order by religion_id asc";
    $id_field = 'religion_id';
    $value_field = 'religion_name';
    echo common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

// Combobox for "Identification_type" table
function identification_type($selected_value = NULL, $extra_attr = array(), $name = 'identification_type_id', $where = NULL) {
    $sql = "SELECT identification_type_id,identification_type_name FROM identification_type order by identification_type_id asc";
    $id_field = 'identification_type_id';
    $value_field = 'identification_type_name';
    echo common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

// Combobox for "Bank" table
function bank($selected_value = NULL, $extra_attr = array(), $name = 'bank_id', $where = NULL) {
    $sql = "SELECT bank_id, bank_name FROM bank order by bank_id asc";
    $id_field = 'bank_id';
    $value_field = 'bank_name';
    echo common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

// Combobox for "module" table
function module($selected_value = NULL, $extra_attr = array(), $name = 'module_id', $where = NULL) {
    $sql = "SELECT module_id,module_name FROM module WHERE module_id<>2";
    $id_field = 'module_id';
    $value_field = 'module_name';
    echo common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

// Combobox for "master_entry" table
function master_entry_table($name = 'master_entry_table_name', $where = NULL, $selected_value = NULL, $extra_attr = array()) {
    $sql = "SELECT master_entry_table_id,master_entry_table_name FROM master_entry_table";
    $id_field = 'master_entry_table_name';
    $value_field = 'master_entry_table_name';
    echo common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

// Combobox for "view" table
function view_table($name = 'master_entry_table_name', $where = NULL, $selected_value = NULL, $extra_attr = array()) {
    $sql = "SELECT master_entry_table_id,master_entry_table_name FROM master_entry_table";
    $id_field = 'master_entry_table_name';
    $value_field = 'master_entry_table_name';
    echo common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

// Combobox for get table field of a table
function table_field($table_name, $name = 'master_entry_table_name', $where = NULL, $selected_value = NULL, $extra_attr = array()) {
    $sql = "DESCRIBE $table_name";
    $id_field = 'Field';
    $value_field = 'Field';
    echo common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

// Combobox for "status" table
function status($selected_value = NULL, $extra_attr = array(), $name = ' ', $where = NULL) {
    $sql = "SELECT
            status.status_id,
            status.status_name
            FROM
            status";
    $id_field = 'status_id';
    $value_field = 'status_name';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

function email_subject($selected_value = NULL, $extra_attr = array(), $name = 'email_subject', $where = NULL) {
    $sql = "SELECT
            email_subject_name,
            email_subject_name
            FROM
            email_subject";
    $id_field = 'email_subject_name';
    $value_field = 'email_subject_name';
    echo common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

// for browse to uploading file
function file_browse($name = null, $title = null, $attribute = null) {
    if ($name == null) {
        $name = 'image_up';
    }

    if ($title == null) {
        $title = 'Browse to Upload';
    }

    echo '<script>$(document).ready(function(){$(".file-inputs").bootstrapFileInput();});</script>';
    echo "<input class='file-inputs' type='file' name='" . $name . "' data-filename-placement='inside' title='" . $title . "' " . $attribute . "/>";
}

function vendor_list($selected_value = NULL, $extra_attr = array(), $name = 'vendor_id', $where = NULL) {
    $sql = "SELECT
            vendor.vendor_id,
            vendor.vendor_name

            FROM
            vendor
            ";
    $id_field = 'vendor_id';
    $value_field = 'vendor_name';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

function category_list($selected_value = NULL, $extra_attr = array(), $name = 'product_category_id', $where = NULL) {
    $sql = "SELECT
            product_category.product_category_id,
            product_category.product_category_name
            FROM
            product_category
            ";
    $id_field = 'product_category_id';
    $value_field = 'product_category_name';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

function po_number($selected_value = NULL, $extra_attr = array(), $name = 'purchase_code', $where = NULL) {
    $sql = "SELECT
            purchase_order.purchase_id,
            purchase_order.purchase_code 
            FROM
            purchase_order
            ";
    $id_field = 'purchase_id';
    $value_field = 'purchase_code';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

function order_number($selected_value = NULL, $extra_attr = array(), $name = 'order_number', $where = NULL) {
    $sql = "SELECT
            purchase_order.purchase_id,
            purchase_order.order_number 
            FROM
            purchase_order
            ";
    $id_field = 'purchase_id';
    $value_field = 'order_number';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

//function added by Khairul 12.07.16
//Combo Box for 
function serial_number($selected_value = NULL, $extra_attr = array(), $name = 'serial_number', $where = NULL) {
    $sql = "SELECT
            product_stock_manager.serial_number,
            product_stock_manager.product_id
            FROM 
            product_stock_manager
            ";
    $id_field = 'serial_number';
    $value_field = 'serial_number';
    
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}
//end khairul

function lc_number($selected_value = NULL, $extra_attr = array(), $name = 'lc_number', $where = NULL) {
    $sql = "SELECT
            proforma_invoice.purchase_order_id,
            proforma_invoice.lc_number 
            FROM
            proforma_invoice
            WHERE proforma_invoice.lc_number != ''
            ";
    $id_field = 'purchase_order_id';
    $value_field = 'lc_number';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

function indent_number($selected_value = NULL, $extra_attr = array(), $name = 'proforma_invoice_id', $where = NULL) {
    $sql = "SELECT
            proforma_invoice.proforma_invoice_id,
            proforma_invoice.indent_number 
            FROM
            proforma_invoice
            ";
    $id_field = 'proforma_invoice_id';
    $value_field = 'indent_number';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

function sub_category_list($selected_value = NULL, $extra_attr = array(), $name = 'product_subcategory_id', $where = NULL) {
    $sql = "SELECT
            product_subcategory.product_subcategory_id,
            product_subcategory.product_subcategory_name
            FROM
            product_subcategory
            ";
    $id_field = 'product_subcategory_id';
    $value_field = 'product_subcategory_name';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

function brand_list($selected_value = NULL, $extra_attr = array(), $name = 'product_brand_id', $where = NULL) {
    $sql = "SELECT
            product_brand.product_brand_id,
            product_brand.product_brand_name
            FROM
            product_brand
            ";
    $id_field = 'product_brand_id';
    $value_field = 'product_brand_name';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

function unit_measure($selected_value = NULL, $extra_attr = array(), $name = 'unit_measure_id', $where = NULL) {
    $sql = "SELECT
            unit_measure.unit_measure_id,
            unit_measure.unit_measure_name
            FROM
            unit_measure
            ";
    $id_field = 'unit_measure_id';
    $value_field = 'unit_measure_name';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

function product_list($selected_value = NULL, $extra_attr = array(), $name = 'product_id', $where = NULL) {
    $sql = "SELECT
            product.product_id,
            product.product_name
            FROM
            product
            ";
    $id_field = 'product_id';
    $value_field = 'product_name';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

function model_list($selected_value = NULL, $extra_attr = array(), $name = 'model_id', $where = NULL) {
    $sql = "SELECT
            product_model.product_model_id,
            product_model.product_model_name
            FROM
            product_model
            ";
    $id_field = 'product_model_id';
    $value_field = 'product_model_name';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

function warehouse_list($selected_value = NULL, $extra_attr = array(), $name = 'warehouse_id', $where = NULL) {
    $sql = "SELECT
            warehouse.warehouse_id,
            warehouse.warehouse_name
            FROM
            warehouse
            ";
    $id_field = 'warehouse_id';
    $value_field = 'warehouse_name';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}


function curency_list($selected_value = NULL, $extra_attr = array(), $name = 'currency_id', $where = NULL) {
    $sql = "SELECT
            currency.currency_id,
            currency.currency_name
            FROM
            currency
            ";
    $id_field = 'currency_id';
    $value_field = 'currency_name';
    echo common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}
function requisition_code($selected_value = NULL, $extra_attr = array(), $name = 'stock_requisition_id', $where = NULL) {
    $sql = "SELECT
            stock_requisition.stock_requisition_id,
            stock_requisition.requisition_code
            FROM
            stock_requisition
            ";
    $id_field = 'stock_requisition_id';
    $value_field = 'requisition_code';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}


function shipping_method($selected_value = NULL, $extra_attr = array(), $name = 'shipping_method_id', $where = NULL) {
    $sql = "SELECT
shipping_method.shipping_method_id,
shipping_method.shipping_method_name
FROM
shipping_method
            ";
    $id_field = 'shipping_method_id';
    $value_field = 'shipping_method_name';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

function customer_list($selected_value = NULL, $extra_attr = array(), $name = 'customer_id', $where = NULL) {
    $sql = "SELECT
            customer.customer_id,
            CONCAT(customer.customer_name, '(', IF(customer.mobile_number IS NULL,' ',customer.mobile_number), ')') as customer_name
            FROM customer";
    $id_field = 'customer_id';
    $value_field = 'customer_name';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

function servicing_engineer_list($selected_value = NULL, $extra_attr = array(), $name = 'servicing_engineer_list', $where = NULL) {
    $sql = "SELECT
            user.user_id,
            user.username 
            FROM user WHERE designation_id=14";
    $id_field = 'user_id';
    $value_field = 'username';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

function sales_person_list($selected_value = NULL, $extra_attr = array(), $name = 'sales_person_id', $where = NULL) {
    $sql = "SELECT
            user.user_id,
            CONCAT(`user`.first_name,' ',`user`.last_name) AS user_name
            FROM
            `user`";
    $id_field = 'user_id';
    $value_field = 'user_name';
    echo common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

function sold_sales_code($selected_value = NULL, $extra_attr = array(), $name = 'sales_id', $where = NULL) {
    $sql = "SELECT
            sales_id,sales_code
            FROM
            sales_order WHERE sales_status=27";
    $id_field = 'sales_id';
    $value_field = 'sales_code';
    echo common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}


function sold_product_code($selected_value = NULL, $extra_attr = array(), $name = 'product_stock_id', $where = NULL)
{
    $sql = "SELECT
            product_code
            FROM
            product_stock_manager WHERE sale_status_id=27";
    $id_field = 'product_code';
    $value_field = 'product_code';
    echo common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

function faulty_type($selected_value = NULL, $extra_attr = array(), $name = 'faulty_type', $where = NULL)
{
    $sql = "SELECT
            faulty_type_id,faulty_type_name
            FROM
            faulty_type WHERE status='Active'";
    $id_field = 'faulty_type_id';
    $value_field = 'faulty_type_name';
    echo common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

function delivery_location_list($selected_value = NULL, $extra_attr = array(), $name = 'delivery_location', $where = NULL) {
    $sql = "SELECT delivery_address_id, address FROM delivery_address";
    $id_field = 'delivery_address_id';
    $value_field = 'address';
    echo common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

function delivery_van_list($selected_value = NULL, $extra_attr = array(), $name = 'delivery_van', $where = NULL) {
    $sql = "SELECT delivery_van_id, van_no FROM delivery_van";
    $id_field = 'delivery_van_id';
    $value_field = 'van_no';
    echo common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

function delivery_mode($selected_value = NULL, $extra_attr = array(), $name = 'delivery_mode_id', $where = NULL) {
    $sql = "SELECT
delivery_mode.delivery_mode_id,
delivery_mode.delivery_mode_name
FROM
delivery_mode";
    $id_field = 'delivery_mode_id';
    $value_field = 'delivery_mode_name';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

function payment_type($selected_value = NULL, $extra_attr = array(), $name = 'payment_type_id', $where = NULL) {
    $sql = "SELECT
            payment_type.payment_type_id,
            payment_type.payment_type_name
            FROM
            payment_type";
    $id_field = 'payment_type_id';
    $value_field = 'payment_type_name';
    echo common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

function service_type($selected_value = NULL, $extra_attr = array(), $name = 'service_type_id', $where = NULL) {
    $sql = "SELECT
service_type.service_type_id,
service_type.service_type_name
FROM
service_type";
    $id_field = 'service_type_id';
    $value_field = 'service_type_name';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}

function sla_amc_term($selected_value = NULL, $extra_attr = array(), $name = 'sla_amc_term_id', $where = NULL) {
    $sql = "SELECT
sla_amc_term.sla_amc_term_id,
sla_amc_term.sla_amc_term_name
FROM
sla_amc_term";
    $id_field = 'sla_amc_term_id';
    $value_field = 'sla_amc_term_name';
    echo common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}
function purchase_type($selected_value = NULL, $extra_attr = array(), $name = 'purchase_type_name', $where = NULL) {
    $sql = "SELECT
            purchase_type.purchase_type_id,
            purchase_type.purchase_type_name
            FROM `purchase_type`
            ";
    $id_field = 'purchase_type_id';
    $value_field = 'purchase_type_name';
    return common_in_combo($name, $sql, $where, $selected_value, $extra_attr, $id_field, $value_field);
}
 function generate_date_from($selected_value = NULL, $extra_attr = array(), $name = 'date_from', $where = NULL){
            $ext ='';
            foreach ($extra_attr as $key=>$value){
                $ext .= $key.'='."'$value'";
            }
     return "<input type='date' style='margin-bottom:8px !important' class='form-control' name='$name' $ext value='$selected_value'>";
}
function generate_date_to($selected_value = NULL, $extra_attr = array(), $name = 'date_to', $where = NULL){
            $ext ='';
            foreach ($extra_attr as $key=>$value){
                $ext .= $key.'='."'$value'";
            }
     return "<input type='date' style='margin-bottom:8px !important' class='form-control' name='$name' $ext value='$selected_value'>";
}
 function generate_text_field($selected_value = NULL, $extra_attr = array(), $name = '', $where = NULL){
            $ext ='';
            foreach ($extra_attr as $key=>$value){
                $ext .= $key.'='."'$value'";
            }
     return "<input type='text' style='margin-bottom:8px !important' class='form-control' name='$name' $ext value='$selected_value'>";
}
function view_loader($view, $data = array(), $output = false) {
    $CI = &get_instance();
    return $CI->load->view($view, $data, $output);
}
function cost_component($selected_value=NULL,$extra_attr=array(), $name='cost_component',$where=NULL ){
    $sql = "SELECT
        cost_component.cost_component_id,
        cost_component.cost_component_name
        FROM `cost_component`";
    $id_field = 'cost_component_id';
    $value_field = 'cost_component_name';
    echo common_in_combo($name,$sql,$where,$selected_value,$extra_attr,$id_field,$value_field);
}

//$data_array = array('product_id' => array(Required(1 is required 0 not required), Ajaxcall(1 is ajaxcall true and 0 is ajaxcall false),selected_value))
function generate_search_panel($action = NULL,$column=6, $data_array = array('product_id' => array(1, 1,1))) {
    ?>

    <?php
    $base_url = base_url();
    $html = '';
    $class = 12/$column;
    //echo $column;
    //exit();
    //$i=1;
    //$total_input_field = count($data_array);
    //$total_field_first_colum  = ceil($total_input_field/3);
    //$total_field_second_colum  = $total_field_first_colum+ceil(($total_input_field-$total_field_first_colum)/2);
    //$total_field_third_colum  = ceil($total_input_field-($total_field_first_colum+$total_field_second_colum));
    //$html .= "<form id='serach_form' method='POST' action=$base_url$action>";
    $html .= "<form id='serach_form' method='POST' action=$action>";
    foreach ($data_array as $key => $input_field) {
        $function_name = '';
        $field_name = '';
		         if(strpos($key,'text_field')!== false){
            
            $key = 'text_field';
        }
        switch ($key) {
            case 'product_category_id':
                $function_name = 'category_list';
                $field_name = isset($input_field[4]) ? $input_field[4] :PRODUCT_CATEGORY;
                break;
            case 'product_subcategory_id':
                $function_name = 'sub_category_list';
                $field_name = isset($input_field[4]) ? $input_field[4] :PRODUCT_SUB_CATEGORY;
                break;
            case 'product_brand_id':
                $function_name = 'brand_list';
                $field_name = isset($input_field[4]) ? $input_field[4] :PRODUCT_BRAND;
                break;
            case 'product_id':
                $function_name = 'product_list';
                $field_name = isset($input_field[4]) ? $input_field[4] :PRODUCT_NAME;
                break;
            case 'customer_id':
                $function_name = 'customer_list';
                $field_name = isset($input_field[4]) ? $input_field[4] :CUSTOMER;
                break;
             case 'user_id':
                $function_name = 'user';
                $field_name = isset($input_field[4]) ? $input_field[4] :USER;
                break;
            case 'service_type_id':
                $function_name = 'service_type';
                $field_name = isset($input_field[4]) ? $input_field[4] :SERVICE_TYPE;
                break;
            case 'delivery_mode_id':
                $function_name = 'delivery_mode';
                $field_name = isset($input_field[4]) ? $input_field[4] :DELIVERY_MODE;
                break;
            case 'shipping_method_id':
                $function_name = 'shipping_method';
                $field_name = isset($input_field[4]) ? $input_field[4] :SHIPPING_METHOD;
                break;
            case 'vendor_id':
                $function_name = 'vendor_list';
                $field_name = isset($input_field[4]) ? $input_field[4] :VENDOR;
                break;
             case 'date_from':
                $function_name = 'generate_date_from';
                $field_name = isset($input_field[4]) ? $input_field[4] :FROM_DATE;
                break;
             case 'date_to':
                $function_name = 'generate_date_to';
                $field_name = isset($input_field[4]) ? $input_field[4] :TO_DATE;
                break;
            case 'text_field':
                $function_name = 'generate_text_field';
                $field_name = isset($input_field[4]) ? $input_field[4] :TEXT_FIELD;
                break;
            case 'order_number':
                $function_name = 'order_number';
                $field_name = isset($input_field[4]) ? $input_field[4] : ORDER_NUMBER;
                break;
            case 'serial_number':
                $function_name = 'serial_number';
                $field_name = isset($input_field[4]) ? $input_field[4] : SERIAL_NUMBER;
                break;
        }
        $selected_value = $input_field[2];
        $required_style = (isset($input_field[0])) ? ($input_field[0]==1 ? '' : 'display:none') : 'display:none';
        unset($input_field['selected_value']);
        $ext_array = array();
        $name = isset($input_field[3]) ? $input_field[3] :$key;
        $ext_array['class'] = $key;
        $ext_array['id'] = $name;
        if($input_field[0]==1){
            $ext_array['required']=true;
        }
        if($input_field[1]==1){
            $ext_array['ajax_call']=true;
        }  else {
            $ext_array['ajax_call']=false;
        }
        $input_html='';
        $input_html .= "
                        <div class='form-group ' style='margin-bottom:8px !important'>
                        <label for='product_id' class=' control-label'>$field_name<span style='color:red;$required_style'>*</span></label>
                        <div class=' $function_name'>";
        $input_html.= $function_name($selected_value, $ext_array, $name, $where = NULL);

        $input_html .= "</div></div> ";
            $html .="<div class='col-lg-$class' style='line-height:10px;'>";
            $html .=$input_html;
            $html .="</div>";

        //$i++;
    }
    $html .= "<div class='form-group col-lg-12' style='text-align:right'><input type='submit' name='search_panel' class='search_panel btn btn-danger' value='Search'></div>";
    $html .= "</form>";
    $html .="<script>
    $('.product_category_id').on('change', function () {
        var product_category_id = $(this).val();
        var ajax_call = $(this).attr('ajax_call');
        if(ajax_call){
            $.ajax({
                url: '$base_url'+'ajax_controller/get_sub_category',
                type: 'POST',
                data: {product_category_id: product_category_id},
                success: function (data) {
                    //alert(data);
                    $('.sub_category_list').html(data);
                    $('select').select2();
                    get_product_list();
                }
            });
        }
    })
 

    $(document).on('change', '.product_brand_id', function () {
     var ajax_call = $(this).attr('ajax_call');
        if(ajax_call){
            get_product_list();
        }

    })
    $(document).on('change', '.product_subcategory_id', function () {
         var ajax_call = $(this).attr('ajax_call');
        if(ajax_call){
            get_product_list();
        }

    })
    function get_product_list() {
        var product_category_id = $('.product_category_id option:selected').val();
        ;
        //alert(category_id);
        var product_brand_id = $('.product_brand_id option:selected').val();
        var product_subcategory_id = $('.product_subcategory_id option:selected').val();
        $.ajax({
            url: '$base_url'+'ajax_controller/get_product_list_combo',
            type: 'POST',
            data: {product_category_id: product_category_id, product_brand_id: product_brand_id, sub_category_id: product_subcategory_id},
            success: function (data) {
                //alert(data);
                $('.product_list').html(data);
                $('select').select2();
            }
        });
    }


    
</script>";
    return $html;
    ?>
<?php

}
function generate_search_panel2($action = NULL, $data_array = array('product_id' => array('required' => true, 'ajax_call' => true, 'selected_value' => NULL))) {
    ?>

    <?php
$base_url = base_url();
    $html = '';
    $html .= "<form method='POST'>";
    foreach ($data_array as $key => $input_field) {
        $function_name = '';
        $field_name = '';
        switch ($key) {
            case 'product_category_id':
                $function_name = 'category_list';
                $field_name = "Product Category";
                break;
            case 'product_subcategory_id':
                $function_name = 'sub_category_list';
                $field_name = "Product Sub category";
                break;
            case 'product_brand_id':
                $function_name = 'brand_list';
                $field_name = 'Product Brand';
                break;
            case 'product_id':
                $function_name = 'product_list';
                $field_name = 'Product';
                break;
            case 'customer_id':
                $function_name = 'customer_list';
                $field_name = 'Customer';
                break;
             case 'user_id':
                $function_name = 'user';
                $field_name = 'User';
                break;
            case 'service_type_id':
                $function_name = 'service_type';
                $field_name = 'Service Type';
                break;
            case 'delivery_mode_id':
                $function_name = 'delivery_mode';
                $field_name = 'Delivery Mode';
                break;
            case 'shipping_method_id':
                $function_name = 'shipping_method';
                $field_name = 'Shipping Method';
                break;
            case 'vendor_id':
                $function_name = 'vendor_list';
                $field_name = 'Vendor';
                break;
            
        }
        $selected_value = $input_field['selected_value'];
        $required_style = (isset($input_field['required'])) ? ($input_field['required'] ? '' : 'display:none') : 'display:none';
        unset($input_field['selected_value']);
        $input_field['class'] = $key;
        $html .= "
                        <div class='form-group col-lg-12'>
                            <label for='product_id' class='col-lg-4 control-label'>$field_name<span style='color:red;$required_style'>*</span></label>
                            <div class='col-lg-8 $function_name'>";
        $html.= $function_name($selected_value, $input_field, $key, $where = NULL);

        $html .= "</div></div> ";
    }
    $html .= "<div class='form-group col-lg-12'><input type='submit' name='search_panel' class='search_panel btn btn-primary' value='Search'></div>";
    $html .= "</form>";
    $html .="<script>
    $('.product_category_id').on('change', function () {
        var product_category_id = $(this).val();
        var ajax_call = $(this).attr('ajax_call');
        if(ajax_call){
            $.ajax({
                url: '$base_url'+'ajax_controller/get_sub_category',
                type: 'POST',
                data: {product_category_id: product_category_id},
                success: function (data) {
                    //alert(data);
                    $('.sub_category_list').html(data);
                    $('select').select2();
                    get_product_list();
                }
            });
        }
    })
 

    $(document).on('change', '.product_brand_id', function () {
     var ajax_call = $(this).attr('ajax_call');
        if(ajax_call){
            get_product_list();
        }

    })
    $(document).on('change', '.product_subcategory_id', function () {
         var ajax_call = $(this).attr('ajax_call');
        if(ajax_call){
            get_product_list();
        }

    })
    function get_product_list() {
        var product_category_id = $('.product_category_id option:selected').val();
        ;
        //alert(category_id);
        var product_brand_id = $('.product_brand_id option:selected').val();
        var product_subcategory_id = $('.product_subcategory_id option:selected').val();
        $.ajax({
            url: '$base_url'+'ajax_controller/get_product_list_combo',
            type: 'POST',
            data: {product_category_id: product_category_id, product_brand_id: product_brand_id, sub_category_id: product_subcategory_id},
            success: function (data) {
                //alert(data);
                $('.product_list').html(data);
                $('select').select2();
            }
        });
    }


    
</script>";
    echo $html;
    ?>
<?php

}
function generate_search_panel1($action = NULL, $data_array = array('product_id' => array('required' => true, 'ajax_call' => true, 'selected_value' => NULL))) {
    ?>

    <?php

    $html = '';
    $html .= "<form method='POST'>";
    foreach ($data_array as $key => $input_field) {
        switch ($key) {
            case 'category_id':
                $selected_value = $input_field['selected_value'];
                $required_style = (isset($input_field['required'])) ? ($input_field['required'] ? '' : 'display:none') : 'display:none';
                unset($input_field['selected_value']);
                $input_field['class'] = $key;
                $html .= "
                        <div class='form-group col-lg-12'>
                            <label for='category_id' class='col-lg-4 control-label'>Product Category<span style='color:red;$required_style'>*</span></label>
                            <div class='col-lg-8'>";
                $html.= category_list($selected_value, $input_field, $key, $where = NULL);

                $html .= "</div></div> ";

                break;

            case 'product_subcategory_id':
                $selected_value = $input_field['selected_value'];
                $required_style = (isset($input_field['required'])) ? ($input_field['required'] ? '' : 'display:none') : 'display:none';
                unset($input_field['selected_value']);
                $input_field['class'] = $key;
                $html .= "
                        <div class='form-group col-lg-12'>
                            <label for='category_id' class='col-lg-4 control-label'>Product Sub Category<span style='color:red;$required_style'>*</span></label>
                            <div class='col-lg-8'>";
                $html.= sub_category_list($selected_value, $input_field, $key, $where = NULL);

                $html .= "</div></div> ";

                break;
            case 'product_brand_id':
                $selected_value = $input_field['selected_value'];
                $required_style = (isset($input_field['required'])) ? ($input_field['required'] ? '' : 'display:none') : 'display:none';
                unset($input_field['selected_value']);
                $input_field['class'] = $key;
                $html .= "
                        <div class='form-group col-lg-12'>
                            <label for='category_id' class='col-lg-4 control-label'>Product Brand<span style='color:red;$required_style'>*</span></label>
                            <div class='col-lg-8'>";
                $html.= brand_list($selected_value, $input_field, $key, $where = NULL);

                $html .= "</div></div> ";

                break;
            case 'product_id':
                $selected_value = $input_field['selected_value'];
                $required_style = (isset($input_field['required'])) ? ($input_field['required'] ? '' : 'display:none') : 'display:none';
                unset($input_field['selected_value']);
                $input_field['class'] = $key;
                $html .= "
                        <div class='form-group col-lg-12'>
                            <label for='product_id' class='col-lg-4 control-label'>Product<span style='color:red;$required_style'>*</span></label>
                            <div class='col-lg-8'>";
                $html.= product_list($selected_value, $input_field, $key, $where = NULL);

                $html .= "</div></div> ";

                break;
        }
    }
    $html .= "<div class='form-group col-lg-12'><input type='submit' name='search_panel' class='search_panel btn btn-primary' value='Search'></div>";
    $html .= "</form>";
    $html .="<script>  
                $('.product_id').on('change',function(){
                    alert($(this).val());
                });
            </script>";
    echo $html;
    ?>
<?php }


//Dynamically add Javascript files to header page
if(!function_exists('add_js')){
    function add_js($file='')
    {
        $str = '';
        $ci = &get_instance();
        $header_js  = $ci->config->item('header_js');

        if(empty($file)){
            return;
        }

        if(is_array($file)){
            if(!is_array($file) && count($file) <= 0){
                return;
            }
            foreach($file AS $item){
                $header_js[] = $item;
            }
            $ci->config->set_item('header_js',$header_js);
        }else{
            $str = $file;
            $header_js[] = $str;
            $ci->config->set_item('header_js',$header_js);
        }
    }
}

//Dynamically add CSS files to header page
if(!function_exists('add_css')){
    function add_css($file='')
    {
        $str = '';
        $ci = &get_instance();
        $header_css = $ci->config->item('header_css');

        if(empty($file)){
            return;
        }

        if(is_array($file)){
            if(!is_array($file) && count($file) <= 0){
                return;
            }
            foreach($file AS $item){   
                $header_css[] = $item;
            }
            $ci->config->set_item('header_css',$header_css);
        }else{
            $str = $file;
            $header_css[] = $str;
            $ci->config->set_item('header_css',$header_css);
        }
    }
}

if(!function_exists('put_headers')){
    function put_headers()
    {
        $str = '';
        $ci = &get_instance();
        $header_css = $ci->config->item('header_css');
        $header_js  = $ci->config->item('header_js');

        foreach($header_css AS $item){
            $str .= '<link rel="stylesheet" href="'.base_url().'css/'.$item.'" type="text/css" />'."\n";
        }

        foreach($header_js AS $item){
            $str .= '<script type="text/javascript" src="'.base_url().'js/'.$item.'"></script>'."\n";
        }

        return $str;
    }
}


/*
 * Added Rokib Hasnat
 * 24-5-2016
 */
function company($selected_value=NULL,$extra_attr=array(), $name='company_id',$where=NULL ){
    $sql = "SELECT
    company.company_id,
    company.company_name
    FROM `company`
    WHERE
    `status` = 'Active'";
    $id_field = 'company_id';
    $value_field = 'company_name';
    echo common_in_combo($name,$sql,$where,$selected_value,$extra_attr,$id_field,$value_field);
}

function credit_note($selected_value=NULL,$extra_attr=array(), $name='credit_note_id',$where=NULL ){
    $sql = "SELECT
    credit_note.credit_note_id,
    credit_note.credit_note_name
    FROM `credit_note`
    WHERE
    `status` = 'Active'";
    $id_field = 'credit_note_id';
    $value_field = 'credit_note_name';
    echo common_in_combo($name,$sql,$where,$selected_value,$extra_attr,$id_field,$value_field);
}

function customer_type($selected_value=NULL,$extra_attr=array(), $name='customer_type_id',$where=NULL ){
    $sql = "SELECT
        customer_type.customer_type_id,
        customer_type.customer_type_name
        FROM `customer_type`
        WHERE
        `status` = 'Active'";
    $id_field = 'customer_type_id';
    $value_field = 'customer_type_name';
    echo common_in_combo($name,$sql,$where,$selected_value,$extra_attr,$id_field,$value_field);
}

function card_type($selected_value=NULL,$extra_attr=array(), $name='card_type_id',$where=NULL ){
    $sql = "SELECT
	credit_card_type.credit_card_type_id,
	credit_card_type.credit_card_type_name
        FROM
	`credit_card_type`
        WHERE
	`status` = 'Active'";
    $id_field = 'credit_card_type_id';
    $value_field = 'credit_card_type_name';
    echo common_in_combo($name,$sql,$where,$selected_value,$extra_attr,$id_field,$value_field);
}



    
    /*
     * Added 
     * Jakir Hosan
     * 28-06-2016
     * 
     * 
     * get_grid_list(array('search_panel'=>TRUE,'search_action'=>'','custom_search_column'=>2,'custom_search_panel'=>$custom_search_panel,'tboday'=>TRUE,'columns'=>$columns,'sql'=>$sql,'action'=>$action));
     * 
     * search_panel
     * true = show
     * flase = hide
     * 
     * search_action = search panel form action without base url
     * 
     * custom_search_columnn = how many search field 
     * 
     * custom_search_panel = if you does not show default search panel you may create custom_search_panel ex. $custom_search_panel = array("product_category_id" =>array(0,1,0),"product_subcategory_id" =>array(0,1,0),);
     * if you show default search panel just passing empty array ex. $custom_search_panel = array();
     * 
     * default search panel column product category, product subcategory, product brand, product
     * 
     * tboday
     * true = show
     * false = hide
     * 
     * columns name must be database field name except first column name(#SL_no) and last column name(Action) if you does not want Action column you must remove Action in column name array
     * sql select query field must be same serial as columns field and id which is use in action column must set anonymous name id (suppose product_id as id)
     * 
     * action
     * if array value false then this item does not show in grid.
     * 
     */
    function get_grid_list($list_array)
    {
        $html = "";
        if($list_array['search_panel'])
        {
            $html .= '<div style="text-align: right; margin-bottom: 5px; position: absolute; right: 34px; top: 85px;">';
            $html .= '<button title="Show/Hide Search Panel" type="button" class="btn btn-default panel-controller"><i class="fa fa-search"></i> Search</button>';
            $html .= '</div>';

            $html .= '<div class="panel panel-default search_panel_header" style="'.(($list_array['search_panel'] == TRUE) && ($list_array['tboday'] == FALSE)?"":"display:none").'">';
            $html .= '<div class="panel-heading">Search By</div>';
            $html .= '<div class="panel-body">';
            
            if(empty($list_array['custom_search_panel']))
            {
                $html .= generate_search_panel($list_array['search_action'], 4, array(
                    "product_category_id" =>array(0,1,0),
                    "product_subcategory_id" =>array(0,1,0),
                    "product_brand_id" =>array(0,1,0),
                    "product_id" =>array(0,1,0),
                    ));
            }
            else
            {
                $html .= generate_search_panel($list_array['search_action'],$list_array['custom_search_column'],$list_array['custom_search_panel']);
            }
            

            $html .= '</div>';
            $html .= '</div>';
        }

        if($list_array['tboday'] || $_POST)
        {
            $html .= '<div class="panel panel-default">';
            $html .= '<div class="panel-heading">'.$list_array['title'].'</div>';
            $html .= '<div class="panel-body">';
            $html .= '<table class="table table-striped table-bordered table-hover dataTable no-footer" id="purchase_list">';
            $html .= '<thead>';
            $html .= '<tr>';
            for ($c = 0; $c < count($list_array['columns']); $c++) {
                $html .= '<th>'.ucwords(str_replace("_", " ", $list_array['columns'][$c])).'</th>';
            }
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            $sl = 1;
            foreach ($list_array['sql'] as $row)
            {
                $html .= '<tr>';
                $html .= '<td>'.$sl.'</td>';
                
                $action = "";
                for ($c = 1; $c < count($list_array['columns']); $c++) {
                    if($list_array['columns'][$c] != 'Action')
                    {
                        $html .= '<td>';
                        if($list_array['action']['common'])
                        {
                            $html .= '<a style="display:block; width:100%; height:100%;" href="'.base_url().$list_array['action']['common'].$row['id'].'">'.(($row[$list_array['columns'][$c]] != "")?$row[$list_array['columns'][$c]]:"&nbsp;").'</a>';
                        }
                        else
                        {
                            $html .= (($row[$list_array['columns'][$c]] != "")?$row[$list_array['columns'][$c]]:"&nbsp;");
                        }
                        
                        $html .= '</td>';
                    }
                    if($list_array['columns'][$c] == 'Action')
                    {
                        $action = $list_array['columns'][$c];
                    }
                }
                
                
                if($action != "")
                {
                    $html .= '<td>';
                    
                    if($list_array['action']['edit'])
                    {
                        $html .= '<a href="'.base_url().$list_array['action']['edit'].$row['id'].'"><i class="glyphicon glyphicon-pencil"></i></a> ';
                    } 
                    if($list_array['action']['view'])
                    {
                        $html .= '<a href="'.base_url().$list_array['action']['view'].$row['id'].'"><i class="glyphicon glyphicon-eye-open"></i></a> ';
                    } 
                    if($list_array['action']['delete'])
                    {
                        $html .= '<a href="'.base_url().$list_array['action']['delete'].$row['id'].'"><i class="glyphicon glyphicon-remove"></i></a>';
                    }
                    $html .= '</td>';
                }
                                
                
                $html .= '</tr>';
                $sl++;
            }
            $html .= '</tbody>';
            $html .= '</table>';
            $html .'</div>';
            $html .= '</div>';
        }

        $html .= '<script>';
        $html .= '$(document).ready(function(){$("#purchase_list").DataTable();});';
        $html .= '$(".panel-controller").click(function(e){$(".search_panel_header").slideToggle();})';
        $html .= '</script>';
        return $html;
    }
    
    
    function convert_number_to_words($number) {
        $hyphen      = '-';
        $conjunction = ' and ';
        $separator   = ', ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= convert_number_to_words($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return ucwords($string);
    }

    
    function label_html($value,$slug)
    {
        $html = "";
        $html .= "<span class='label_class' id='$slug'>".$value."</span>";
        return $html;
    }

?>

