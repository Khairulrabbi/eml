<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function custom_search_panel($action = NULL,$data_array = array(),$search_item = array()) {  
    //$search_item_decode = json_encode($search_item);
    $base_url = base_url();
    $html = '';
    //$class = 12/$column;
    $html .= "<form id='serach_form' method='POST' action=$action>";
    $html .= "<div class='appendSearchPanel'>";
    foreach ($data_array as $key) {
        $function_name = '';
        $field_name = '';
        
        switch ($key) {
            case 'product_category_id':
                $function_name = 'category_list';
                $field_name = label_html(PRODUCT_CATEGORY,'PRODUCT_CATEGORY');
                $input_name = 'product_category_id';
                break;
            case 'product_subcategory_id':
                $function_name = 'sub_category_list';
                $field_name = label_html(PRODUCT_SUB_CATEGORY,'PRODUCT_SUB_CATEGORY');
                $input_name = 'product_subcategory_id';
                break;
            case 'product_brand_id':
                $function_name = 'brand_list';
                $field_name = label_html(PRODUCT_BRAND,'PRODUCT_BRAND');
                $input_name = 'product_brand_id';
                break;
            case 'product_id':
                $function_name = 'product_list';
                $field_name = label_html(PRODUCT_NAME,'PRODUCT_NAME');
                $input_name = 'product_id';
                break;
            case 'customer_id':
                $function_name = 'customer_list';
                $field_name = label_html(CUSTOMER_NAME,'CUSTOMER_NAME');
                $input_name = 'customer_id';
                break;
             case 'user_id':
                $function_name = 'user';
                $field_name = label_html(USER,'USER');
                $input_name = 'user_id';
                break;
            case 'service_type_id':
                $function_name = 'service_type';
                $field_name = label_html(SERVICE_TYPE,'SERVICE_TYPE');
                $input_name = 'service_type_id';
                break;
            case 'delivery_mode_id':
                $function_name = 'delivery_mode';
                $field_name = label_html(DELIVERY_MODE,'DELIVERY_MODE');
                $input_name = 'delivery_mode_id';
                break;
            case 'shipping_method_id':
                $function_name = 'shipping_method';
                $field_name = label_html(SHIPPING_METHOD,'SHIPPING_METHOD');
                $input_name = 'shipping_method_id';
                break;
            case 'vendor_id':
                $function_name = 'vendor_list';
                $field_name = label_html(VENDOR,'VENDOR');
                $input_name = 'vendor_id';
                break;
             case 'date_from':
                $function_name = 'generate_date_from';
                $field_name = label_html(FROM_DATE,'FROM_DATE');
                $input_name = 'date_from';
                break;
             case 'date_to':
                $function_name = 'generate_date_to';
                $field_name = label_html(TO_DATE,'TO_DATE');
                $input_name = 'date_to';
                break;
            case 'text_field':
                $function_name = 'generate_text_field';
                $field_name = label_html(TEXT_FIELD,'TEXT_FIELD');
                $input_name = 'text_field';
                break;
            case 'order_number':
                $function_name = 'order_number';
                $field_name = label_html(ORDER_NUMBER,'ORDER_NUMBER');
                $input_name = 'order_number';
                break;
            case 'serial_number':
                $function_name = 'serial_number';
                $field_name = label_html(SERIAL_NUMBER,'SERIAL_NUMBER');
                $input_name = 'serial_number';
                break;
            case 'vehicle_type2':
                $function_name = 'vehicle_type_id';
                $field_name = label_html(VEHICLE_TYPE,'VEHICLE_TYPE');
                $input_name = 'vehicle_type2';
                break;
            case 'region':
                $function_name = 'region_id';
                $field_name = label_html(REGION,'REGION');
                $input_name = 'region_id';
                break;
            case 'group':
                $function_name = 'product_group_id';
                $field_name = label_html(GROUP,'GROUP');
                $input_name = 'product_group_id';
                break;
            case 'po_number':
                $function_name = 'po_number';
                $field_name = label_html(PO_NUMBER,'PO_NUMBER');
                $input_name = 'purchase_id';
                break;
            case 'status':
                $function_name = 'status';
                $field_name = label_html(STATUS,'STATUS');
                $input_name = 'status_id';
                break;
            case 'purchase_type':
                $function_name = 'purchase_type';
                $field_name = label_html(PURCHASE_TYPE,'PURCHASE_TYPE');
                $input_name = 'purchase_type_id';
                break;
            case 'warehouse_list':
                $function_name = 'warehouse_list';
                $field_name = label_html(WAREHOUSE_NAME,'WAREHOUSE_NAME');
                $input_name = 'warehouse_id';
                break;
            case 'indent_number':
                $function_name = 'indent_number';
                $field_name = label_html(INDENT_NO, 'INDENT_NO');
                $input_name = 'indent_number';
                break;
            case 'requisition_code':
                $function_name = 'requisition_code';
                $field_name = label_html(REQUISITION_CODE, 'REQUISITION_CODE');
                $input_name = 'stock_requisition_id';
                break; 
            
        }
        
        $input_html='';
        $input_html .= "<div class='form-group ' style='margin-bottom:8px !important'>";
        $input_html .= "<label style='margin-top:4px; cursor:pointer' for='product_id' class='col-lg-5 control-label search_field_name'>$field_name <i class='fa fa-caret-down'></i></label>";
        $input_html .= "<ul class='morefunction'>".search_title($search_item)."</ul>";
        
        $input_html .= "<div class='inputParrent'>";
        $input_html .= "<div class='$function_name col-lg-7'>";
        $input_html.= $function_name('', '', $input_name, $where = NULL);
        $input_html .= "</div>";
        $input_html .= "</div>";
        $input_html .= "</div> ";
        
        $html .="<div class='col-lg-4'>";
        $html .=$input_html;
        $html .="</div>";
    }
    $html .="<div class='col-lg-12'>&nbsp;</div>";
    $html .= "</div>";
    $html .= "<div class='form-group col-lg-12' style='text-align:right;'>";
    $html .= "<input style='margin:6px 14px 0 0' type='button' class='search_panel moresearchfieldpanel btn btn-danger' value='Add More Search Option'>";
    $html .= "<ul class='moresearchfield'>".search_title($search_item,'null_close')."</ul>";
    $html .= "<input style='margin:6px 14px 0 0' type='submit' class='custom_search_submit btn btn-danger' value='Search'>";
    $html .= "</div>";
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
    



    $(document).on('click', '.search_field_name', function () {
       $(this).next().show();
       $('body').click(function () {
            $('.morefunction').hide();
        });
    })
    $(document).on('click', '.morefunction li', function () {
        var thisClick = $(this);
        var title_id = $(this).attr('title_id');
        var title_name = $(this).attr('title_name');
        var label_slug = $(this).attr('id');
        var function_name = $(this).attr('function_name');
        if(function_name == 'close')
        {
            $(this).parent().parent().parent().hide();
        }
        else
        {
            $(this).parent().prev().html('<span id=\"'+label_slug+'\" class=\"label_class\">'+title_name+'</span> <i class=\"fa fa-caret-down\"></i>');
            $.ajax({
                url: '$base_url'+'ajax_controller/change_input_html',
                type: 'POST',
                data: {title_id: title_id, title_name: title_name, function_name:function_name},
                success: function (data) {
                    thisClick.parent().next().html('<div class=\"'+function_name+' col-lg-7\">'+data+'</div>');
                    $('.'+function_name).find('select').select2();
                }
            });
        }        
    })
    $(document).on('click', '.moresearchfield li', function () {
        var thisClick = $(this);
        var title_id = $(this).attr('title_id');
        var title_name = $(this).attr('title_name');
        var function_name = $(this).attr('function_name');
        var input_name = $(this).attr('input_name');
        var label_slug = $(this).attr('id');
        var search_item = '".json_encode($search_item)."';
        $.ajax({
            url: '$base_url'+'ajax_controller/appendSearchPanel',
            type: 'POST',
            data: {title_id: title_id, title_name: title_name, function_name:function_name,label_slug:label_slug,input_name:input_name,search_item:search_item},
            success: function (data) {
                $('.appendSearchPanel').append(data);
                $('.'+function_name).find('select').select2();
            }
        });
    })
    
    $(document).on('click', '.moresearchfieldpanel', function () {
       $(this).next().show();
       $('body').click(function () {
            $('.moresearchfield').hide();
        });
    })
    
    $(document).on('click','.custom_search_submit',function(e){
        e.preventDefault();
        var action = $('#serach_form').attr('action');
        $.ajax({
            url: '$base_url'+action,
            type: 'POST',
            data: $('#serach_form').serialize(),
            success: function (data) {
                $('.show_search_data').html(data);
            }
        });
    })
</script>";
    $html .= "
            <style>
                .morefunction {
                    background: #FF2666;
                    display:none;
                    left: 30px;
                    position: absolute;
                    top: 19px;
                    width: auto;
                    padding: 0;
                    list-style: none;
                    z-index:99;
                  }
                
                  .morefunction > li {
                    cursor: pointer;
                    padding: 1px 10px;
                  }
                  .morefunction > li:hover {
                    background: #fff none repeat scroll 0 0;
                  }
                  .moresearchfield {
                    display:none;
                    background: #ff2666 none repeat scroll 0 0;
                    list-style: outside none none;
                    padding: 0;
                    position: absolute;
                    right: 100px;
                    top: 33px;
                    width: auto;
                    z-index: 99;
                  }
                  .moresearchfield > li {
                    cursor: pointer;
                    padding: 2px 36px;
                  }
                  
                  .moresearchfield > li:hover {
                    background: #fff none repeat scroll 0 0;
                  }
            </style>
            ";
    return $html;
    ?>
<?php

}


function search_title($search_item,$null_close=NULL)
{
    $CI = & get_instance();
    $CI->db->select('s.*');
    $CI->db->select('l.label_slug,l.label_name,l.custom_name');
    $CI->db->from('search_title s');
    $CI->db->join('label l','l.label_id=s.label_id','left');
    if(!empty($search_item))
    {
        if($null_close)
        {
            if(($key = array_search(6, $search_item)) !== false) {
                unset($search_item[$key]);
            }
        }
        $CI->db->where_in('s.search_title_id',$search_item);
    }
    $CI->db->order_by('s.sorting');
    $rows = $CI->db->get();
    $html = "";
    foreach ($rows->result() as $row)
    {
        $title = "";
        if($row->custom_name != NULL)
        {
            $title .= $row->custom_name;
        }
        else
        {
            $title .= $row->label_name;
        }
        $html .="<li id='".$row->label_slug."' input_name='".$row->input_name."' function_name='".$row->function_name."' title_id='".$row->search_title_id."' title_name='".$title."'>".$title."</li>";
    }
    return $html;
}


?>

