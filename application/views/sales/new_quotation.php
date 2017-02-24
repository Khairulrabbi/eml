
    <input type="hidden" id="" class="quotation_id" name="quotation_id" value="<?php echo @$quotation_id; ?>">
    <input type="hidden" class="main_order_id" name="main_order_id" value="<?php echo @$quotation_id; ?>">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo label_html(CREATE_NEW_QUOTATION, 'CREATE_NEW_QUOTATION'); ?> 
                        <p class="pull-right text-danger " style="font-size: 16px;font-style: oblique;padding-right: 24px;"><?php echo $status; ?></p>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="text-center quotation_order_block"></div>
                    <form class="form-horizontal" id="quotation_order" action="" method="post">
                        <input type="hidden" id="" class="quotation_order_id" name="quotation_order_id" value="<?php echo @$quotation_id; ?>">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="customer_id" class="col-lg-5 control-label"><?php echo label_html(CUSTOMER, 'CUSTOMER')?><span class="text-danger">*</span></label>
                                <div class="col-lg-7">
                                    <?php echo ap_drop_down(26,NULL,array("selected_value"=>@$quotation_info->customer_id)); ?>
                                    <?php //echo customer_list(@$quotation_info->customer_id, array('class' => 'customer_id', 'required' => 'required')); ?>
                                </div>
                            </div>
                            
<!--                            <div class="form-group">
                                <label for="" class="col-lg-5 control-label">Customer Mobile</label>
                                <div class="col-lg-7">
                                    <input type="text" readonly="readonly" value="" class="form-control customerMobile">
                                </div>
                            </div>-->
                            
                            <div class="form-group">
                                <label for="" class="col-lg-5 control-label"><?php echo label_html(DUE, 'DUE')?></label>
                                <div class="col-lg-7">
                                    <input placeholder="Due" type="text" readonly="readonly" value="<?php echo ((@$due)?number_format($due,2):""); ?>" class="form-control customerDue">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 cInfo">
                            <div class="form-group">
                                <label for="" class="col-lg-5 control-label"><?php echo label_html(COMPANY, 'COMPANY')?></label>
                                <div class="col-lg-7">
                                    <input placeholder="Company" type="text" readonly="readonly" value="<?php echo @$quotation_info->company_name; ?>" class="form-control companyName">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-lg-5 control-label"><?php echo label_html(CREDIT_LIMIT, 'CREDIT_LIMIT')?></label>
                                <div class="col-lg-7">
                                    <input placeholder="Credit Limit" type="text" readonly="readonly" value="<?php echo ((@$quotation_info->credit_limit)?number_format(@$quotation_info->credit_limit,2):""); ?>" class="form-control creditLimit">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 cInfo">
                            <div class="form-group">
                                <label for="" class="col-lg-5 control-label"><?php echo label_html(DEFAULT_ADDRESS, 'DEFAULT_ADDRESS')?></label>
                                <div class="col-lg-7">
                                    <input placeholder="Default Address" type="text" readonly="readonly" value="<?php echo @$quotation_info->address; ?>" class="form-control defaultAddress">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-lg-5 control-label"><?php echo label_html(CUSTOMER_TYPE, 'CUSTOMER_TYPE')?></label>
                                <div class="col-lg-7">
                                    <input placeholder="Customer Type" type="text" readonly="readonly" value="<?php echo @$quotation_info->customer_type_name; ?>" class="form-control customerType">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exchange_rate" class="col-lg-5 control-label"><?php echo label_html(EXCHANGE_RATE, 'EXCHANGE_RENT')?></label>
                                <div class="col-lg-7">
                                    <input type="number" name="exchange_rate" class="form-control exchange_rate" placeholder="Exchange Rate" value="<?php echo ((@$quotation_info->exchange_rate)?$quotation_info->exchange_rate:80); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4" style="display: none;">                            
                            <div class="row "></div>
                            <div style="padding-right: 15px;">
                                <input type="button" id="save_quotation_order"class="btn btn-primary" value="Save Quotation">
                            </div>
                    
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
                    <button type="button" id="add_item_button"class="btn btn-primary add_item" data-toggle="modal" >Add Item</button>
                    <div class="scrolltable">
                        <table class="table product_list_table">
                            <thead>
                                <tr>
                                    <th><?php echo label_html(SL_NO, 'SL_NO')?></th>
                                    <th><?php echo label_html(PRODUCT_NAME, 'PRODUCT_NAME')?></th>
                                    <th><?php echo label_html(QTY, 'QTY')?></th>
                                    <th><?php echo label_html(PRICE_USD, 'PRICE_USD')?></th>
                                    <th><?php echo label_html(PRICE_BDT, 'PRICE_BDT')?></th>
                                    <th><?php echo label_html(TOTAL, 'TOTAL')?></th>
                                    <th><?php echo label_html(ACTION, 'ACTION')?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $selected_product_list; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th style="">Total : </th>
                                    <th colspan="2" class="total"></th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th colspan="5" class="total_inword" style="text-align: right;"></th>
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
        </div>	
            
            
        
        
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo label_html(ADDITIONAL_CHARGES, 'ADDITIONAL_CHARGES'); ?> </h3>
                </div>
                <div class="panel-body">
                    <div class="text-center cost_component_block"></div>
                    <div class="field_wrapper">
                        <div class="col-lg-8">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="" class="col-lg-5 control-label"><?php echo label_html(COMPONENT, 'COMPONENT')?></label>
                                    <div class="col-lg-7">
                                        <input type="hidden" class="quotation_cost_component_id" value="">
                                        <?php //echo ap_drop_down(12,NULL,array("selected_value"=>'')); ?>
                                        <?php echo cost_component('',array('class'=>'cost_component'),'',array('cost_component.cost_for'=>'Sale')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="" class="col-lg-3 control-label"><?php echo label_html(AMOUNT, 'AMOUNT')?></label>
                                    <div class="col-lg-7">
                                        <input type="number" class="form-control cost_value" name="cost_value" placeholder="Amount">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 ">
                                <input id="percentage" type="checkbox" >
                            </div>
                            <div class="col-lg-2 ">
                                <div class="row ">
                                    <div class="form-group cost_component_btn">
                                        <a href="javascript:void(0);" class="btn btn-sm btn-primary add_button"><span class="glyphicon glyphicon-plus"></span> Add</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row"></div>
                        </div>
                        <div class="col-lg-4 cost_component_list">
                            <?php if(isset($cost_component_list)){?>
                            <div class="scrolltable">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><?php echo label_html(SL_NO, 'SL_NO');?></th>
                                            <th><?php echo label_html(COST_COMPONENT, 'COST_COMPONENT')?></th>
                                            <th><?php echo label_html(AMOUNT, 'AMOUNT')?></th>
                                            <th><?php echo label_html(ACTION, 'ACTION')?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; 
                                        $total = 0;
                                        foreach ($cost_component_list as $cost_component){

                                            $total = $total+$cost_component['amount'];
                                            ?>
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $cost_component['cost_component_name'];?></td>
                                                <td class="cost_amount"><?php echo number_format($cost_component['amount'],2);?></td>
                                                <td>
                                                    <i style=" cursor: pointer;text-align: center;" class="fa fa-pencil edit_cost_component" aria-hidden="true" cost_total="<?php echo $cost_component['amount'];?>" cost_component_id="<?php echo $cost_component['cost_component_id'];?>" quotation_cost_component_id="<?php echo $cost_component['quotation_cost_component_id'];?>"></i>
                                                    <i style=" cursor: pointer;text-align: center;" class="fa fa-times delete_cost_component" aria-hidden="true" cost_component_id="<?php echo $cost_component['cost_component_id'];?>" quotation_cost_component_id="<?php echo $cost_component['quotation_cost_component_id'];?>"></i>
                                                </td>
                                            </tr>

                                        <?php $i++;} ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Total</th>
                                            <th class="total_cost"><?php echo number_format($total,2);?></th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th>Total In Word : </th>
                                            <th colspan="2" class="totalInWord"><?php echo ucwords(convert_number_to_words($total))." Taka (Only)"; ?></th>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                            <?php }?>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        
        
        
        
        
        
        
        
        
        <form class="form-horizontal" id="quotation_order_save_submit" action="" method="post">
            <div class="col-lg-12">
            <div class="panel panel-default" style="margin-bottom: 10px;">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo label_html(DELEGATION, 'DELEGATION') ?> </h3>
                </div>
                <div class="panel-body">
                    
                    <div class="text-center adi_info_block"></div>
                    
                        <div class="form-group">
                            <label for="remarksText" class="col-lg-2 control-label "><?php echo label_html(REMARKS, 'REMARKS')?></label>
                            <div class="col-lg-12">
                                <textarea class="form-control" name="remarkText"><?php echo @$quotation_info->remark_quotation; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="remarks" class="col-lg-2 control-label "><?php echo label_html(REMARKS_TYPE, 'REMARKS_TYPE')?></label>
                            <div class="col-lg-12">
                                <input type="hidden" name="update_quotation_id" value="<?php echo @$update_quotation_id; ?>">
                                Auto <input <?php echo ($remark_type)?$remark_type == 1?"checked":"":"checked"; ?> type="radio" value="1" name="remark_type" class="auto_remarks"> 
                                Manually <input <?php echo ($remark_type == 2)?'checked':''; ?> type="radio" value="2" name="remark_type" class="manual_remarks">
                                <?php
                                    if($remark_type == 2)
                                    {
                                        echo "<script>";
                                        echo "jQuery(function(){";
                                        echo "jQuery('.manual_remarks').click();";
                                        echo "});";
                                        echo "</script>";
                                    }
                                ?>
                            </div>
                        </div>
                        <br/><br/>
                        <div class="form-group">
                            <div class="col-lg-6 approve_persons_parrent" style="display: none;">
                                <label for="remarks" class="col-lg-3 control-label ">Approval Persons</label>
                                <div class="col-lg-9">
                                    <?php echo approval_privilege_multiselect(explode(',',@$level_array),array('multiple'=>'multiple','class'=>'form-control multiple_user_value'),'userid[]',array("privilege_for_approval.approve_for_id"=>3,"user.status = Active")); ?>
                                   
                                </div>
                            </div>
                            
                        </div>
                    
                        </div>
                </div>
            </div>
            <div class="col-lg-12">
                <input type="submit" name="update_order" class="save btn btn-primary" value="Save">
            </div>
        </form>
        
        
        
        
        
        </div>

        <div id="add_item" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg" id="add_item_modal">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add item</h4>
                    </div>
                    <div class="modal-body">
                        <form id="quotation_order_form" class="form-horizontal" action="">
                            <input type="hidden" id="" class="quotation_order_id" name="quotation_order_id" value="<?php echo $quotation_id; ?>">
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <?php echo generate_search_panel('',4,array(
                                        'product_category_id' =>array(0,1,0),
                                        'product_subcategory_id' =>array(0,1,0),
                                        'product_brand_id' =>array(0,1,0),
                                        'product_id' =>array(0,1,0),
                                    ));?>
                                </div>
                                <div class="col-lg-12 product_list_item" style="margin-right: 15px;">

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
	$('#percentage').checkboxpicker({
        html: true,
        offLabel: '<i class="fa fa-money" ></i>',
        onLabel: '%'
    });


    $(document).ready(function(){
        var order_id = parseInt($(".main_order_id").val());
        if(order_id){
            $('#save_quotation_order').val('Update order');
        }
    });
    
    
//    jakir modify
    //$(document).on("click","#save_quotation_order",function(){
    $(document).on("change",".customer_id",function(){
        //alert();
        var quotation_order_id = parseInt($('.quotation_order_id').val());
        var customer_id = $('.customer_id option:selected').val();
        if(quotation_order_id){
            $.ajax({
                url: '<?php echo base_url(); ?>sales/update_quotation_order_block',
                type: 'POST',
                data: $('#quotation_order').serialize(),
                success: function(data){
//                    var htm ='<div class="invalid alert alert-success">';
//                    htm += 'Update Success..';
//                    htm +='</div>';
//                    $('.quotation_order_block').html(htm);
//                    $('.invalid').slideUp(3000);
                }
            });
        }else{
            if(customer_id){
                $.ajax({
                    url: '<?php echo base_url(); ?>sales/save_quotation_order_block',
                    type: 'POST',
                    data: $('#quotation_order').serialize(),
                    success: function(data){
                        var quotation_id = parseInt(data);
                        $('.quotation_order_id').val(quotation_id);
                        $('#save_quotation_order').val('Update');
//                        var htm ='<div class="invalid alert alert-success">';
//                        htm += 'Quotation Saved..';
//                        htm +='</div>';
//                        $('.quotation_order_block').html(htm);
//                        $('.invalid').slideUp(3000);
                    }
                });
            }else{
//                var htm ='<div class="invalid alert alert-danger">';
//                htm += 'Please Select Required Field..';
//                htm +='</div>';
//                $('.quotation_order_block').html(htm);
//                $('.invalid').slideUp(3000);
            }
        }
    });
    

 $(".customer_id").on("change", function () {
        var customer_id = $(this).val();
        $.ajax({
            url: '<?php echo base_url(); ?>common_controller/get_customer_info',
            type: 'POST',
            data: {customer_id: customer_id},
            success: function (data) {
                var obj = jQuery.parseJSON(data);
                $('.customerDue').val(addCommas(obj.customerDue));
                $('.customerType').val(obj.customer_type_name);
                $('.companyName').val(obj.company_name);
                $('.creditLimit').val(addCommas(obj.credit_limit));
                $('.defaultAddress').val(obj.address);               
            }
        });
        $.ajax({
            url: '<?php echo base_url(); ?>common_controller/get_customer_defult_address',
            type: 'POST',
            data: {customer_id: customer_id},
            success: function (data) {
                var obj = jQuery.parseJSON(data);
                $("#customer_address").text(obj.address_details);
            }
        });
    });



    $(".search_panel").on("click", function (e) {
        e.preventDefault();
        var category_id = $(".product_category_id option:selected").val();
        var brand_id = $(".product_brand_id option:selected").val();
        var sub_category_id = $(".product_subcategory_id option:selected").val();
        var product_id = $(".product_id option:selected").val();
        var quotation_order_id = $(".quotation_order_id").val();
        var flag='quotation';
        $.ajax({
            url: '<?php echo base_url(); ?>common_controller/get_product_list_view2',
            type: 'POST',
            data: {category_id: category_id, brand_id: brand_id, sub_category_id: sub_category_id, product_id: product_id, order_id: quotation_order_id,flag:flag},
            success: function (data) {
                $(".product_list_item").html(data);
            }
        });
    })
    
    $(".add_item").click(function () {
    
        var quotation_order_id = parseInt($('.quotation_order_id').val());
        if(quotation_order_id){
            $(this).attr("data-target", "#add_item");
        }else{
            var htm ='<div class="invalid alert alert-danger">';
            //htm += 'Please Save Sales Order First.';
            htm += 'Please Select Customer Name.';
            htm +='</div>';
            $('.product_block').html(htm);
            $('.invalid').slideUp(4000);
            
        }
    });
    
    $('.add_item ').on('click', function() {
        $(".product_list_item").html('');
    });
    
    $(document).on("click", ".add_product_btn", function (e) {
        e.preventDefault();
        var quotation_order_id = $('.quotation_order_id').val();
        $.ajax({
                url: '<?php echo base_url(); ?>sales/save_quotation_details',
                type: 'POST',
                data: $("#quotation_order_form").serialize(),
                success: function (data) {
//                    alert("Purchase Order Saved..");
                    $.ajax({
                        url: '<?php echo base_url(); ?>sales/get_product_list_for_quotation',
                        type: 'POST',
                        data: {quotation_order_id:quotation_order_id},
                        success: function (data) {
                            $('.product_list_table tbody').html(data);
                            calculation();
                            var htm ='<div class="invalid alert alert-success">';
                            htm += 'Product added..';
                            htm +='</div>';
                            $('.product_block').html(htm);
                            $('.invalid').slideUp(3000);
                        }
                    });
                }
            });
    });
    
    $(document).on('blur','.updates',function(){
        var quotation_id = parseInt($('.quotation_order_id').val());
        var field_name = $(this).attr('field_name');
        var value = $(this).val();
        var product_id = $(this).parent().parent().find(".product_id").val();
        $.ajax({
            url: '<?php echo base_url(); ?>sales/update_product_quotation',
            type: 'POST',
            data: {quotation_id: quotation_id,field_name:field_name,value:value,product_id:product_id},
            success: function (data) {
                calculation();
            }
        });
    });

    $(document).on("click",".delete_product", function () {

        var quotation_details_id = $(this).attr('quotation_details_id');
        var elem = $(this);
        $.ajax({
            url: '<?php echo base_url(); ?>sales/delete_product_quotation',
            type: 'POST',
            data: {quotation_details_id: quotation_details_id},
            success: function (data) {
                //alert(data);
//                $(".order_id").val(data);
                //$('select').select2();
                elem.parent().parent().remove();
                if (data == 1) {
                    calculation();
                }
            }
        });

    });

    $(document).ready(calculation);
    $(document).on("input",".quantity", function () {
        var quantity = $(this).val();
        var quotation_details_id = $(this).attr("quotation_details_id");
        var price = $(this).parent().parent().find(".price").val();
        var subtotal = parseFloat(parseFloat(quantity) * parseFloat(price)).toFixed(2);
        $(this).parent().parent().find(".sub_total").text(addCommas(subtotal));
        update_order_details(quotation_details_id, quantity, price);
        calculation();
    });
    $(document).on("input",".price", function () {
        var price = $(this).val();
        var quotation_details_id = $(this).attr("quotation_details_id");
        var quantity = $(this).parent().parent().find(".quantity").val();
        var subtotal = parseFloat(parseFloat(quantity) * parseFloat(price)).toFixed(2);
        $(this).parent().parent().find(".sub_total").text(addCommas(subtotal));
        update_order_details(quotation_details_id, quantity, price);
        calculation();
    });
    
    $(document).on("input",".price_usd", function () {
        var price_usd = $(this).val();
        var exchange_rate = $('.exchange_rate').val();
        var quotation_details_id = $(this).attr("quotation_details_id");
        $(this).parent().parent().find(".price").val(price_usd*exchange_rate);
        var price = $(this).parent().parent().find(".price").val();
        var quantity = $(this).parent().parent().find(".quantity").val();
        var subtotal = parseFloat(parseFloat(quantity) * parseFloat(price)).toFixed(2);
        $(this).parent().parent().find(".sub_total").text(addCommas(subtotal));
        update_order_details(quotation_details_id, quantity, price);
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
    function update_order_details(quotation_details_id, quantity, price) {
        $.ajax({
            url: '<?php echo base_url(); ?>sales/update_product_details_quotation',
            type: 'POST',
            data: {quotation_details_id: quotation_details_id, quantity: quantity, quotation_price: price},
            success: function (data) {
            }
        });
    }
    $(".save").on("click", function (e) {
        e.preventDefault();        
        var quotation_order_id = parseInt($('.quotation_order_id').val());
        if (quotation_order_id) {            
            $.ajax({
                url: '<?php echo base_url(); ?>sales/check_quotation_details',
                type: 'POST',
                data: $('#quotation_order_save_submit').serialize()+'&quotation_id='+quotation_order_id,
                success: function (data) {
                    if (data == true) {
                        window.location.href = "<?php echo base_url(); ?>sales/quotation_details/"+quotation_order_id;
                    } else {
                        var htm ='<div class="invalid alert alert-danger">';
                        htm += data;
                        htm +='</div>';
                        $('.adi_info_block').html(htm);
                        $('.invalid').slideUp(4000);
                    }
                }
            });           
        } else {
            var htm ='<div class="invalid alert alert-danger">';
            htm += 'Please Save Order First.';
            htm +='</div>';
            $('.adi_info_block').html(htm);
            $('.invalid').slideUp(4000);        
        }
    });
    
    $(document).on('click','.manual_remarks',function(){
        $('.approve_persons_parrent').show();
    });
    $(document).on('click','.auto_remarks',function(){
        $('.approve_persons_parrent').hide();
    });
    
    
    $(document).on("input",".exchange_rate", function () {
        var quotation_id = parseInt($('.quotation_order_id').val());
        var exchange_rate = $(this).val();
        if(quotation_id)
        {
            $.ajax({
                url: '<?php echo base_url(); ?>sales/quotation_exchange_rate_update',
                type: 'POST',
                data: {exchange_rate: exchange_rate,quotation_id:quotation_id},
                success: function (data) {
                }
            });
        }        
    });
    
    function calculation_parsentage() {
        var sum = 0;
        var total = $('.total').text();
        var cost_value = $(".cost_value").val();
        sum = (parseFloat(cost_value)*parseFloat(total))/100;
        return sum;
    }
    
    $(document).on("click",".add_button", function () {
        var quotation_order_id = parseInt($('.quotation_order_id').val());
        //var sales_id = parseInt($(".order_id").val());
        if(quotation_order_id){
            var cost_component = $(".cost_component option:selected").val();
            var cost_value ;
            if($('#percentage').is(':checked')){
                cost_value = calculation_parsentage();
            }else{
               cost_value = $(".cost_value").val();
            }
            $.ajax({
                url: '<?php echo base_url(); ?>sales/add_ajax_cost_component_view_for_quotation',
                type: 'POST',
                data: {quotation_order_id:quotation_order_id,cost_component:cost_component,cost_value:cost_value},
                success: function (data) {
                    
                    var htm ='<div class="invalid alert alert-success">';
                    htm += 'Cost Component Saved..';
                    htm +='</div>';
                    $('.cost_component_block').html(htm);
                    $('.invalid').slideUp(4000);
    //                alert(data);
                    $('.cost_component_list').html(data);
//                    $("select").select2();
                    $(".cost_component").select2('val','');
                    $(".cost_value").val(' ');

                }
            });
        }else{
            var htm ='<div class="invalid alert alert-danger">';
            htm += 'Please Save Quotation Order First.';
            htm +='</div>';
            $('.cost_component_block').html(htm);
            $('.invalid').slideUp(4000);
        }
        

    });
    
    
    $(document).on("click",'.edit_cost_component', function () {
        var cost_component_id = $(this).attr('cost_component_id');
        var quotation_cost_component_id = $(this).attr('quotation_cost_component_id');
        var cost_total = $(this).attr('cost_total');
        var elem = $(this);
        var html = '<a href="javascript:void(0);" class="btn btn-sm btn-primary update_cost_button pull-right"><span class=""></span> Update </a>';
        $('.cost_component_btn').html(html);
        $('.quotation_cost_component_id').val(quotation_cost_component_id);
        $(".cost_component").select2('val',cost_component_id);
        $(".cost_value").val(cost_total);

    });
    
    
    
    $(document).on("click",".update_cost_button", function () {
        
        var quotation_order_id = parseInt($(".quotation_order_id").val());
        var quotation_cost_component_id = $('.quotation_cost_component_id').val();
        
        var cost_component = $(".cost_component option:selected").val();
        var cost_value = $(".cost_value").val();
//        alert(sales_order_id);
        var html= '<a href="javascript:void(0);" class="btn btn-sm btn-primary add_button pull-right"><span class="glyphicon glyphicon-plus"></span> Add </a>';
        if(quotation_order_id && cost_component && cost_value){
            $.ajax({
                url: '<?php echo base_url(); ?>sales/update_cost_component_for_quotation',
                type: 'POST',
                data: {quotation_order_id:quotation_order_id,cost_component:cost_component,cost_value:cost_value,quotation_cost_component_id:quotation_cost_component_id},
                success: function (data) {
                    $(".cost_component_list").html(data);
                    $('.cost_component_btn').html(html);
                   $('.quotation_cost_component_id').val('');
                   $(".cost_component").select2('val','');
                $(".cost_value").val('');

                }
            });
        }else{
            alert("Give Input Properly");
        }

    });
    
    $(document).on("click",'.delete_cost_component', function () {

        var sales_order_id = $(this).attr('sales_order_id');
        var cost_component_id = $(this).attr('cost_component_id');
        var quotation_cost_component_id = $(this).attr('quotation_cost_component_id');
        var elem = $(this);
        $.ajax({
            url: '<?php echo base_url(); ?>sales/delete_cost_component_for_quotation',
            type: 'POST',
            data: {sales_order_id: sales_order_id,cost_component_id:cost_component_id,quotation_cost_component_id:quotation_cost_component_id},
            success: function (data) {
                console.log(data);
                elem.parent().parent().remove();
                calculation_cost_component();
            }
        });

    });
    function calculation_cost_component() {
        var sum = 0;
        $(".cost_amount").each(function () {
            var subtotal_text = $(this).text();
            var subtotal_string = subtotal_text.replace(",", "");
            var sub_total = parseFloat(subtotal_string).toFixed(2);
            sum = parseFloat(parseFloat(sum) + parseFloat(sub_total)).toFixed(2);

        });
        $(".total_cost").text(addCommas(sum));
        var translator = new T2W("EN_US");
        $(".totalInWord").text(capitalizeEachWord(translator.toWords(Math.floor( sum )))+' Taka (Only)');
    }
</script>
