<!--<form class="form-horizontal"  id="my_form" method="post" action="<?php echo base_url() ?>sales/update_order/<?php echo $order_id; ?>">-->
    <input type="hidden" id="" class="order_id" name="order_id" value="<?php echo @$order_id; ?>">
    <input type="hidden" class="main_order_id" name="main_order_id" value="<?php echo @$order_id; ?>">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo label_html(CREATE_SALES_ORDER, 'CREATE_SALES_ORDER'); ?> 
                        <p class="pull-right text-danger so_generated" style="font-size: 16px;font-style: oblique;padding-right: 24px;"><?php echo (isset($_GET['s_code'])?"Sales Code : ".$_GET['s_code'].", ":"").(isset($order_id)?"Status : ".$status:''); ?></p>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="text-center sales_order_block"></div>
                    <form class="form-horizontal" id="sales_order" action="" method="post">
                        <input type="hidden" id="" class="order_id" name="order_id" value="<?php echo @$order_id; ?>">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="" class="col-lg-5 control-label"><?php echo label_html(CUSTOMER, 'CUSTOMER')?> <span class="text-danger">*</span></label>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control customer_name" name="customer_name" value="<?php echo @$order_info->customer_name; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-lg-5 control-label"><?php echo label_html(CUSTOMER_MOBILE, 'CUSTOMER_MOBILE'); ?> <span class="text-danger">*</span></label>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control mobile_number" name="mobile_number" value="<?php echo @$order_info->mobile_number; ?>">
                                </div>
                            </div>
                            <div style="display: none" class="form-group">
                                <label for="sales_person_id" class="col-lg-5 control-label"><?php echo label_html(SALES_PERSON, 'SALES_PERSON');?></label>
                                <div class="col-lg-7">
                                    <?php echo sales_person_list((@$order_info->sales_person_id?$order_info->sales_person_id:$this->user_id), array('class' => 'sales_person_id', 'required' => 'required')); ?>

                                </div>
                            </div>
                            

                            
                        </div>	
                        
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="address" class="col-lg-5 control-label ">Customer Address</label>
                                <div class="col-lg-7">
                                    <textarea name="address" id="customer_address" class="form-control address"><?php echo @$order_info->address; ?></textarea>

                                </div>

                            </div>
                            <div class="form-group">
                                <label for="order_date" class="col-lg-5 control-label order_date"><?php echo label_html(ORDER_DATE, 'ORDER_DATE');?> <span class="text-danger">*</span></label>
                                <div class="col-lg-7">
                                    <input required type="date" class="form-control order_date" id="order_date" name="order_date" value="<?php echo @$order_info->order_date; ?>" >
                                </div>
                            </div>		
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="remarks" class="col-lg-5 control-label "><?php echo label_html(REMARKS, 'REMARKS');?></label>
                                <div class="col-lg-7">
                                    <textarea name="remarks" class="form-control remarks"><?php echo @$order_info->remarks; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exchangeRate" class="col-lg-5 control-label "><?php echo label_html(EXCHANGE_RATE, 'EXCHANGE_RATE');?></label>
                                <div class="col-lg-7">
                                    <input required type="number" class="form-control exchange_rate" id="exchange_rate" name="exchange_rate" value="<?php echo ((@$order_info->exchange_rate)?$order_info->exchange_rate:80); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row "></div>
                        <div style="padding-right: 15px;">
                            <input type="button" id="save_sales_order"class="btn btn-primary pull-right" value="Save Order">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo label_html(ITEM_LIST, 'ITEM_LIST'); ?> </h3>
                </div>
                <div class="panel-body">
                    <div class="text-center product_block"></div>
                    <button module="counter" type="button" id="add_product"class="btn btn-danger add_item" data-toggle="modal" >Add Item</button>
                    <button type="button" table="product_group" field="product_group_name" class="btn btn-danger list_ordering">Group Wise Ordering</button>
                    <button type="button" table="region" field="region_name" class="btn btn-danger list_ordering">Region Wise Ordering</button>
                    <div class="scrolltable">
                        <table class="table product_list_table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th><?php echo label_html(PRODUCT_NAME, 'PRODUCT_NAME'); ?> </th>
                                    <?php echo get_specification_json_type(array(), "title"); ?>
                                    <th><?php echo label_html(QTY, 'QTY'); ?> </th>
                                    <th><?php echo label_html(PRICE_USD, 'PRICE_USD'); ?> </th>
                                    <th><?php echo label_html(PRICE_BDT, 'PRICE_BDT'); ?> </th>
                                    <th><?php echo label_html(WARRANTY_PERIOD, 'WARRANTY_PERIOD'); ?></th>
                                    <th><?php echo label_html(TOTAL, 'TOTAL'); ?></th>
                                    <th><?php echo label_html(ACTION, 'ACTION'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $selected_product_list; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="<?= ccsbsid(NULL, NULL,(get_specification_json_type(array(),NULL,1)+6)); ?>" style="text-align: right">Total : </th>
                                    <th colspan="<?= ccsbsid(NULL, NULL,2); ?>" class="total"></th>
                                </tr>
                                <tr>
                                    <th colspan="<?= ccsbsid(NULL, NULL,(get_specification_json_type(array(),NULL,1)+8)); ?>" class="total_inword" style="text-align: right;"></th>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="col-lg-6">

                        </div>
                        <div class="col-lg-4"></div>

                        <!--<div class="col-lg-2" style="text-align: left">Total:<span class="total"></span></div>-->
                    </div>
                </div>
            </div>
			
            
            

            
            <form id="sales_order_save" action="" method="post">
                <div class="row "></div>
                <div class="pull-right">
                    <input type="submit" name="update_order" class="save btn btn-primary" value="Save">
                </div>
            </form>
            
        </div>

        <div id="add_product_m" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg" id="add_item_modal">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add item</h4>
                    </div>
                    <div class="modal-body">
                        <?php
                            echo custom_search_panel('common_controller/get_product_list_view',array("region","group","warehouse_list"),array('2','3','5','6'));
                        ?>
                        <form id="sales_order_form" class="form-horizontal" action="">
                            <input type="hidden" id="" class="order_id" name="order_id" value="<?php echo $order_id; ?>">
                            <div class="form-group">                                
                                <div class="col-lg-12 product_list_item show_search_data" style="margin-right: 15px;">

                                </div>
                            </div>
                        </form>

                    </div>     
                </div>

            </div>
        </div>
    </div>
<!--</form>-->



<script>
    $(document).ready(function(){
        var order_id = parseInt($(".main_order_id").val());
        if(order_id){
            $('#save_sales_order').val('Update order');
        }
    });
    
    $(document).on("click","#save_sales_order",function(){
        var order_id = parseInt($('.order_id').val());
        var customer_name = $('.customer_name').val();
        var mobile_number = $('.mobile_number').val();        
        var order_date  = $('#order_date').val();
        var remarks  = $('.remarks').val();
        if(order_id){
            $.ajax({
                url: '<?php echo base_url(); ?>sales/update_front_desk_sales_order_block',
                type: 'POST',
                data: $('#sales_order').serialize(),
                success: function(data){ 
                    var htm ='<div class="invalid alert alert-success">';
                        htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                        htm += 'Sales order Updated.';
                        htm +='</div>';   
                        $('.sales_order_block').html(htm);
                }
            });
        }else{
            if(customer_name && mobile_number && order_date ){
                $.ajax({
                    url: '<?php echo base_url(); ?>sales/save_front_desk_sales_order_block',
                    type: 'POST',
                    data: $('#sales_order').serialize(),
                    success: function(response){
                        try {
                            var data=jQuery.parseJSON(response);
                            $(".order_id").val(data.id);
                            $(".main_order_id").val(data.id);
                            var htm ='<div class="invalid alert alert-success">';
                            htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                            htm += 'Sales order successfully saved.';
                            htm +='</div>';
                            $('.so_generated').text('Sales Order : '+data.code+", Status : SO Draft")
                            $('.sales_order_block').html(htm);
                            $('#save_sales_order').val('Update');
                        } catch(e) {
                            var htm ='<div class="invalid alert alert-danger">';
                            htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                            htm += data;
                            htm +='</div>';
                           $('.sales_order_block').html(htm);
                        }
                        
                    }
                });
            }else{
            var htm ='<div class="invalid alert alert-danger">';
            htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            htm += 'Star(*) Marks Field are Required';
            htm +='</div>';
            $('.sales_order_block').html(htm); 
            
            
            }
        }
    });
    




    $(".search_panel").on("click", function (e) {
        e.preventDefault();
        var category_id = $(".product_category_id option:selected").val();
        var brand_id = $(".product_brand_id option:selected").val();
        var sub_category_id = $(".product_subcategory_id option:selected").val();
        //var sub_category_id = $(".sub_category_id option:selected").val();
        var product_id = $(".product_id option:selected").val();
        var order_id = $(".order_id").val();
        var flag='sales';
        $.ajax({
            url: '<?php echo base_url(); ?>common_controller/get_product_list_view',
            type: 'POST',
            data: {category_id: category_id, brand_id: brand_id, sub_category_id: sub_category_id, product_id: product_id, order_id: order_id,flag:flag},
            success: function (data) {
                $(".product_list_item").html(data);
            }
        });
    })
    
    $('.add_item ').on('click', function() {
        $(".product_list_item").html('');
    });
    
    $(document).on("click", ".add_product_btn", function (e) {
        e.preventDefault();
        var order_id = $('.order_id').val();
        $.ajax({
                url: '<?php echo base_url(); ?>sales/save_sales_details',
                type: 'POST',
                data: $("#sales_order_form").serialize(),
                success: function (data) {
                    $.ajax({
                        url: '<?php echo base_url(); ?>sales/get_product_list',
                        type: 'POST',
                        data: {order_id:order_id,table:"product_group",field:"product_group_name"},
                        success: function (data) {
                            $('.product_list_table tbody').html(data);
                            calculation();
                            var htm ='<div class="invalid alert alert-success">';
                                htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                htm += 'Product added.';
                                htm +='</div>'; 
                                $('.product_block').html(htm);
                        }
                    });
                }
            });
    });
    
    $(document).on('blur','.updates',function(){
        var sales_order_id = parseInt($('.order_id').val());
        var field_name = $(this).attr('field_name');
        var value = $(this).val();
        var product_id = $(this).parent().parent().find(".product_id").val();
        $.ajax({
            url: '<?php echo base_url(); ?>sales/update_product',
            type: 'POST',
            data: {sales_order_id: sales_order_id,field_name:field_name,value:value,product_id:product_id},
            success: function (data) {
                calculation();
            }
        });
    });

    $(document).on("click",".delete_product", function () {

        var order_details_id = $(this).attr('order_details_id');
        var elem = $(this);
        $.ajax({
            url: '<?php echo base_url(); ?>sales/delete_product',
            type: 'POST',
            data: {order_details_id: order_details_id},
            success: function (data) {
                elem.parent().parent().remove();
                if (data == 1) {
                    calculation();
                }
            }
        });

    });

    $(document).ready(calculation);
    $(document).on("input",".quantity", function () {
        var quantity = $(this).val()||0;
        var order_details_id = $(this).attr("order_details_id");
        var price_usd = $(this).parent().parent().find(".price_usd").val();
        var price = $(this).parent().parent().find(".price").val();
        var subtotal = parseFloat(parseFloat(quantity) * parseFloat(price)).toFixed(2);
        $(this).parent().parent().find(".sub_total").text(subtotal);
        update_order_details(order_details_id, quantity, price, price_usd);
        calculation();
    });
    $(document).on("input",".price", function () {
        var price = $(this).val()||0;
        var price_usd = $(this).parent().parent().find(".price_usd").val();
        var order_details_id = $(this).attr("order_details_id");
        var quantity = $(this).parent().parent().find(".quantity").val();
        var subtotal = parseFloat(parseFloat(quantity) * parseFloat(price)).toFixed(2);
        $(this).parent().parent().find(".sub_total").text(subtotal);
        update_order_details(order_details_id, quantity, price, price_usd);
        calculation();
    });
    $(document).on("input",".warranty_period", function () {
        var warranty_period = $(this).val();
        var order_details_id = $(this).attr("order_details_id");
        $.ajax({
            url: '<?php echo base_url(); ?>sales/update_product_details',
            type: 'POST',
            data: {order_details_id: order_details_id, warranty_period: warranty_period},
            success: function (data) {
            }
        });
    });
    
    $(document).on("input",".price_usd", function () {
        var price_usd = $(this).val();
        var exchange_rate = $('.exchange_rate').val();
        var order_details_id = $(this).attr("order_details_id");
        $(this).parent().parent().find(".price").val(price_usd*exchange_rate);
        var price = $(this).parent().parent().find(".price").val();
        var quantity = $(this).parent().parent().find(".quantity").val();
        var subtotal = parseFloat(parseFloat(quantity) * parseFloat(price)).toFixed(2);
        $(this).parent().parent().find(".sub_total").text(addCommas(subtotal));
        update_order_details(order_details_id, quantity, price, price_usd);
        calculation();
    });
    function calculation() {
        var sum = 0;
        $(".sub_total").each(function () {
            var subtotal_text = $(this).text();
            var subtotal_string = subtotal_text.replace(",", "");
            var sub_total = parseFloat(subtotal_string).toFixed(2);
            sum = parseFloat(parseFloat(sum) + parseFloat(sub_total)).toFixed(2);

        });
        $(".total").text(addCommas(sum));
        var translator = new T2W("EN_US");
        $(".total_inword").text('Total In Word : '+capitalizeEachWord(translator.toWords(Math.floor( sum )))+' Taka (Only)');
    }
    function update_order_details(order_details_id, quantity, price, price_usd) {
        $.ajax({
            url: '<?php echo base_url(); ?>sales/update_product_details',
            type: 'POST',
            data: {order_details_id: order_details_id, quantity: quantity, sales_price: price, sales_price_usd: price_usd},
            success: function (data) {
            }
        });
    }
    $(".save").on("click", function (e) {
        e.preventDefault();
        var sales_order_id = parseInt($('.order_id').val());
        if (sales_order_id) {
            $.ajax({
                url: '<?php echo base_url(); ?>sales/check_front_desk_order_details',
                type: 'POST',
                data: $('#sales_order_save').serialize()+'&sales_order_id='+sales_order_id,
                success: function (data) {
                    if (data > 0) {
                        window.location.href = "<?php echo base_url(); ?>sales/front_desk_order_details/"+sales_order_id; 

                    } else {           

                       var htm ='<div class="invalid alert alert-danger">';
                            htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                            htm += 'No product selected..';
                            htm +='</div>'; 
                            $('.adi_info_block').html(htm);
                    }
                }
            });            
        } else {
            var htm ='<div class="invalid alert alert-danger">';
            htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            htm += 'Please Save Order First.';
            htm +='</div>'; 
            $('.adi_info_block').html(htm);
        }

    });
    $(document).on("click", ".add_product", function (e) {
        e.preventDefault();
        $("#my_form").attr("action", "<?php echo base_url() ?>sales/save_order_details");
        $("#my_form").submit();
    });
	
	function calculation_parsentage() {
        var sum = 0;
        var total = $('.total').text();
        var cost_value = $(".cost_value").val();
        sum = (parseFloat(cost_value)*parseFloat(total))/100;
        return sum;
    }
	
    $(document).on("click",".add_button", function () {
        var sales_id = parseInt($(".order_id").val());
        if(sales_id){
            var cost_component = $(".cost_component option:selected").val();
            var cost_value ;
            if($('#percentage').is(':checked')){
                cost_value = calculation_parsentage();
            }else{
               cost_value = $(".cost_value").val();
            }
            $.ajax({
                url: '<?php echo base_url(); ?>sales/add_ajax_cost_component_view',
                type: 'POST',
                data: {sales_id:sales_id,cost_component:cost_component,cost_value:cost_value},
                success: function (data) {
                    
                    var htm ='<div class="invalid alert alert-success">';
                    htm += 'Cost Component Saved..';
                    htm +='</div>';
                    $('.cost_component_block').html(htm);
                    $('.cost_component_list').html(data);
                    $(".cost_component").select2('val','');
                    $(".cost_value").val(' ');

                }
            });
        }else{
                             
            var htm ='<div class="invalid alert alert-danger">';
                    htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                    htm += 'Please Save Sales Order First.';
                    htm +='</div>'; 
                    $('.cost_component_block').html(htm);
            
           
        }
        

    });
    $(document).on("click",".remove_btn", function () {
        $(this).parent('div').parent('div').parent('div.remove_div').remove();
    });
    
    
  
      
    
    $(document).on("click", ".list_ordering", function (e) {
        e.preventDefault();
        var order_id = $(".order_id").val();
        var table = $(this).attr("table");
        var field = $(this).attr("field");
        $.ajax({
            url: '<?php echo base_url(); ?>sales/get_product_list',
            type: 'POST',
            data: {order_id:order_id,table:table,field:field},
            success: function (data) {
                $('.product_list_table tbody').html(data);
                calculation();
            }
        });
    });
</script>