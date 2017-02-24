<!--<form class="form-horizontal"  id="my_form" method="post" action="<?php echo base_url() ?>sales/update_order/<?php echo $order_id; ?>">-->
    <input type="hidden" id="" class="order_id" name="order_id" value="<?php echo @$order_id; ?>">
    <input type="hidden" class="main_order_id" name="main_order_id" value="<?php echo @$order_id; ?>">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $title; ?> 
                        <p class="pull-right text-danger " style="font-size: 16px;font-style: oblique;padding-right: 24px;"><?php echo $status; ?></p>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="text-center sales_order_block"></div>
                    <form class="form-horizontal" id="sales_order" action="" method="post">
                        <input type="hidden" id="" class="order_id" name="order_id" value="<?php echo @$order_id; ?>">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="customer_id" class="col-lg-5 control-label">Customer</label>
                                <div class="col-lg-7">
                                    <?php echo customer_list(@$order_info->customer_id, array('class' => 'customer_id', 'required' => 'required')); ?>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="attention" class="col-lg-5 control-label">Attention</label>
                                <div class="col-lg-7">
                                    <input required type="text" class="form-control attention" id="attention" name="attention" value="<?php echo @$order_info->attention; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bill_to" class="col-lg-5 control-label">Bill to</label>
                                <div class="col-lg-7">
                                    <input required type="text" step="any" class="form-control bill_to" id="bill_to" name="bill_to" value="<?php echo @$order_info->bill_to; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address" class="col-lg-5 control-label ">Address</label>
                                <div class="col-lg-7">
                                    <textarea name="address" id="customer_address" class="form-control address"><?php echo @$order_info->address; ?></textarea>

                                </div>

                            </div>
                            <div class="form-group">
                                <label for="credit_limit" class="col-lg-5 control-label">Credit Limit</label>
                                <div class="col-lg-7">
                                    <input type="text" step="any" class="form-control credit_limit" id="credit_limit" value="" readonly="">
                                </div>
                            </div>
                        </div>	
                        <div class="col-lg-4">
                            <div class="form-group col-lg-12">
                                <label for="delivery_contact_person" class="col-lg-5 control-label ">Contact person</label>
                                <div class="col-lg-7">
                                    <input  type="text" class="form-control delivery_contact_person" id="delivery_contact_person" name="delivery_contact_person" value="<?php echo @$order_info->delivery_contact_person;?>" >
                                </div>
                            </div>
                            <div class="form-group col-lg-12">

                                <label for="delivery_mode_id" class="col-lg-5 control-label ">Delivery mode</label>
                                <div class="col-lg-7">
                                     <?php echo delivery_mode(@$order_info->delivery_mode_id, array('class' => 'delivery_mode_id', 'required' => 'required')); ?>
                                </div>
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="delivery_details" class="col-lg-5 control-label ">Delivery Details</label>
                                <div class="col-lg-7">
                                    <textarea name="delivery_details" class="form-control delivery_details"><?php echo @$order_info->delivery_details; ?></textarea>

                                </div>
                            </div>

                            <div class="form-group col-lg-12">
                                <label for="delivery_address" class="col-lg-5 control-label ">Delivery Address</label>
                                <div class="col-lg-7">
                                    <textarea name="delivery_address" class="form-control shipping_advice"><?php echo @$order_info->delivery_address; ?></textarea>

                                </div>
                            </div>		
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="sales_code" class="col-lg-5 control-label">Order No.</label>
                                <div class="col-lg-7">
                                    <input  readonly="true" required type="text" class="form-control sales_code" id="sales_code" name="sales_code" value="<?php echo $sales_code; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="order_date" class="col-lg-5 control-label order_date">Order Date</label>
                                <div class="col-lg-7">
                                    <input required type="date" class="form-control order_date" id="order_date" name="order_date" value="<?php echo @$order_info->order_date; ?>" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sales_person_id" class="col-lg-5 control-label">Sales Person</label>
                                <div class="col-lg-7">
                                    <?php echo sales_person_list((@$order_info->sales_person_id?$order_info->sales_person_id:$this->user_id), array('class' => 'sales_person_id', 'required' => 'required')); ?>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="remarks" class="col-lg-5 control-label ">Remarks</label>
                                <div class="col-lg-7">
                                    <textarea name="remarks" class="form-control remarks"><?php echo @$order_info->remarks; ?></textarea>
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
                    <h3 class="panel-title"><?php echo "Item List"; ?> </h3>
                </div>
                <div class="panel-body">
                    <div class="text-center product_block"></div>
                    <button type="button" id="add_item_button"class="pull-right btn btn-primary add_item" data-toggle="modal" >Add Item</button>
                    <div class="scrolltable">
                        <table class="table product_list_table">
                            <thead>
                                <tr>
                                    <th>#Sl</th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Action</th>
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
                                    <th class="pull-right">Total </th>
                                    <th class="total"></th>
                                    <th></th>
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
			
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo "Cost Component"; ?> </h3>
                </div>
                <div class="panel-body">
                    <div class="text-center cost_component_block"></div>
                    <div class="field_wrapper">
                        <div class="col-lg-8">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="" class="col-lg-5 control-label">Cost Component</label>
                                    <div class="col-lg-7">
                                        <?php echo cost_component('',array('class'=>'cost_component')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="" class="col-lg-3 control-label">Amount</label>
                                    <div class="col-lg-7">
                                        <input type="number" class="form-control cost_value" name="cost_value" placeholder="Amount">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 ">
                                <input id="percentage" type="checkbox" >
                            </div>
							<div class="row"></div>
                            <br>
                            <div class="row " style="margin-left: 713px;">
                                <div class="form-group cost_component_btn">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-primary add_button pull-left"><span class="glyphicon glyphicon-plus"></span> Add</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 cost_component_list">
                            <?php if(isset($cost_component_list)){?>
                            <div class="scrolltable">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#Sl</th>
                                            <th>Cost Component</th>
                                            <th>Amount</th>
                                            <th>Action</th>
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
                                                <td class="cost_amount"><?php echo $cost_component['amount'];?></td>
                                                <td>
                                                    <i style=" cursor: pointer;text-align: center;" class="fa fa-pencil edit_cost_component" aria-hidden="true" cost_total="<?php echo $cost_component['amount'];?>" cost_component_id="<?php echo $cost_component['cost_component_id'];?>" sales_order_id="<?php echo $cost_component['sales_cost_component_id'];?>"></i>
                                                    <i style=" cursor: pointer;text-align: center;" class="fa fa-times delete_cost_component" aria-hidden="true" cost_component_id="<?php echo $cost_component['cost_component_id'];?>" sales_order_id="<?php echo $cost_component['sales_cost_component_id'];?>"></i>
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
                                    </tfoot>
                                </table>

                            </div>
                            <?php }?>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo "Supporting Document"; ?> </h3>
                </div>
                <div class="panel-body">
                    <div class="text-center support_doc"></div>
                    <form  class="ajax_file" action="" method="post" enctype="multipart/formdata">
                        <input type="hidden" id="" class="order_id data" name="order_id_ajax" value="<?php echo $order_id; ?>">
                        <div class="col-lg-6">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="" class="col-lg-5 control-label">File Name</label>
                                    <div class="col-lg-7">
                                        <input class="form-control file_name data" type="text" name="file_name" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <input id="ajax_form" type="file" name="userfile" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <input class="btn btn-primary file_up" type="submit" name="upload" value="upload"/>
                            </div>
                        </div>
                        <div class="col-lg-6 upporting_doc_list">
                            <?php if(isset($supporting_doc_list)){?>
                                <div class="scrolltable">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#Sl</th>
                                                <th>Name</th>
                                                <th>URL</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; 
                                            foreach ($supporting_doc_list as $val){
                                                ?>
                                                <tr>
                                                    <td><?php echo $i;?></td>
                                                    <td><?php echo $val['sales_supporting_doc_name'];?></td>
                                                    <td><?php echo $val['sales_supporting_doc_url'];?></td>
                                                    <td>
                                                        <i style=" cursor: pointer;text-align: center;" class="fa fa-times delete_doc" aria-hidden="true" sales_supporting_doc_id="<?php echo $val['sales_supporting_doc_id'];?>" ></i>
                                                    </td>
                                                </tr>

                                            <?php $i++;} ?>
                                        </tbody>
                                    </table>

                                </div>
                           <?php  }?>
                        </div>
                        
                    </form>
                </div>
            </div>

            <div class="panel panel-default" style="margin-bottom: 50px;">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo "Others Info"; ?> </h3>
                </div>
                <div class="panel-body">
                    <div class="text-center adi_info_block"></div>
                    <div class="col-lg-6">
                        <div class="form-group col-lg-12">
                                   
                                    <label for="delivery_contact_number" class="col-lg-5 control-label delivery_contact_person">Delivery Contact number</label>
                                    <div class="col-lg-7">
                                        <input  type="text" class="form-control delivery_contact_number" id="delivery_contact_number" name="delivery_contact_number" value="<?php echo @$order_info->delivery_contact_number;?>" >
                                    </div>
                                </div>
                        <div class="form-group col-lg-12">
                                   
                                    <label for="delivery_cost" class="col-lg-5 control-label delivery_cost">Delivery Cost </label>
                                    <div class="col-lg-7">
                                        <input  type="number" step="any" class="form-control delivery_cost" id="delivery_cost" name="delivery_cost" value="<?php echo @$order_info->delivery_cost;?>" >
                                    </div>
                                </div>
                        </div>
                
                    <div class="col-lg-6">
                        <div class="form-group col-lg-12">
                                   
                                    <label for="payment_type_id" class="col-lg-5 control-label payment_type_id">Payment Type</label>
                                    <div class="col-lg-7">
                                         <?php echo payment_type(@$order_info->payment_type_id, array('class' => 'payment_type_id', 'required' => 'required')); ?>
                                    </div>
                                </div>
                        <div class="form-group col-lg-12">
                            <label for="delivery_address" class="col-lg-5 control-label shipping_advice">Delivery Address</label>
                            <div class="col-lg-7">
                                <textarea name="delivery_address" class="form-control delivery_address"><?php echo @$order_info->delivery_address; ?></textarea>

                            </div>
                        </div>
                        
                    </div>
                    <div class="row "></div>
                    <div class="" style="padding-right: 15px;">
                        <input type="submit" name="update_order" class="save btn btn-primary pull-right" value="Save">
                    </div>
                </div>

            </div>

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
                        <form id="sales_order_form" class="form-horizontal" action="">
                            <input type="hidden" id="" class="order_id" name="order_id" value="<?php echo $order_id; ?>">
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
<!--</form>-->

<script>
    var files;
    $('input#ajax_form').on('change', prepareUpload);
    function prepareUpload(event)
    {
       
        files = event.target.files;
    }
    $('form.ajax_file').on('submit', uploadFiles);
    function uploadFiles(event)
    {
        event.stopPropagation();
        event.preventDefault();
        

        var seles_id = parseInt($(".order_id").val());
//        alert(seles_id);
        if(seles_id == ''){
            
            var htm ='<div class="invalid alert alert-danger">';
            htm += 'Please create sales order first';
            htm +='</div>';
            $('.support_doc').html(htm);
            $('.invalid').slideUp(3000);
            return;
        }
        
//        return;
        
        var data = new FormData();
        $.each(files, function(key, value){
            data.append(key, value);
        });
        
        var input = $('input.data');
        $.each(input, function(key, value){
            data.append(key, $(this).val());
        });
        
        /*var order_id = $('input[name=order_id_ajax]');
        $.each(order_id, function(key, value){
            data.append(key, $(this).val());
        });*/
        
        $.ajax({
            url: '<?php echo base_url() ?>sales/ajax_file_upload',
            type: 'POST',
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data, textStatus, jqXHR){
                $('.upporting_doc_list').html(data);
                $('.file_name ').val('');
                $('#ajax_form').val('');
                if(typeof data.error === 'undefined'){
                    submitForm(event, data);
                }else{
                    console.log('ERRORS: ' + data.error);
                }
            }
        });
    }
</script>

<script>
	$('#percentage').checkboxpicker({
        html: true,
        offLabel: '<i class="fa fa-money" ></i>',
        onLabel: '%'
    });


    $(document).ready(function(){
        var order_id = parseInt($(".main_order_id").val());
        if(order_id){
            $('#save_sales_order').val('Update order');
        }
    });
    
    $(document).on("click","#save_sales_order",function(){
//        alert('here');
        var order_id = parseInt($('.order_id').val());
        var customer_id = $('.customer_id option:selected').val();
        var attention = $('.attention').val();
        var bill_to = $('.bill_to').val();
        var delivery_contact_person  = $('.delivery_contact_person ').val();
        var delivery_mode_id  = $('.delivery_mode_id ').val();
        var delivery_details   = $('.delivery_details ').val();
        var shipping_advice   = $('.shipping_advice ').val();
        var sales_code   = $('.sales_code ').val();
        var order_date  = $('#order_date').val();
        var sales_person_id  = $('.sales_person_id').val();
        var remarks  = $('.remarks').val();
        if(order_id){
            $.ajax({
                url: '<?php echo base_url(); ?>sales/update_sales_order_block',
                type: 'POST',
                data: $('#sales_order').serialize(),
                success: function(data){
                    var htm ='<div class="invalid alert alert-success">';
                    htm += 'Update Success..';
                    htm +='</div>';
                    $('.sales_order_block').html(htm);
                    $('.invalid').slideUp(3000);
                }
            });
        }else{
            if(customer_id && order_date ){
                $.ajax({
                    url: '<?php echo base_url(); ?>sales/save_sales_order_block',
                    type: 'POST',
                    data: $('#sales_order').serialize(),
                    success: function(data){
//                        alert(data);
                        $('.order_id').val(data);
                        $('#save_sales_order').val('Update');
                        var htm ='<div class="invalid alert alert-success">';
                        htm += 'Sales Order Saved..';
                        htm +='</div>';
                        $('.sales_order_block').html(htm);
                        $('.invalid').slideUp(3000);
                    }
                });
            }else{
                var htm ='<div class="invalid alert alert-danger">';
                htm += 'Please Select Required Field..';
                htm +='</div>';
                $('.sales_order_block').html(htm);
                $('.invalid').slideUp(3000);
            }
        }
    });
    
    
//    $(".category_id").on("change", function () {
//        var category_id = $(this).val();
//        $.ajax({
//            url: '<?php echo base_url(); ?>common_controller/get_sub_category',
//            type: 'POST',
//            data: {category_id: category_id},
//            success: function (data) {
//                //alert(data);
//                $(".sub_category_list").html(data);
//                $('select').select2();
//            }
//        });
//    })
 $(".customer_id").on("change", function () {
        var customer_id = $(this).val();
        $.ajax({
            url: '<?php echo base_url(); ?>common_controller/get_customer_info',
            type: 'POST',
            data: {customer_id: customer_id},
            success: function (data) {
                var obj = jQuery.parseJSON(data);
                $("#customer_address").val(obj.address);
                $('#delivery_contact_person ').val(obj.contact_person);
                $('#credit_limit ').val(obj.credit_limit);
                //alert();
            }
        });
        $.ajax({
            url: '<?php echo base_url(); ?>common_controller/get_customer_defult_address',
            type: 'POST',
            data: {customer_id: customer_id},
            success: function (data) {
                var obj = jQuery.parseJSON(data);
                $("#customer_address").text(obj.address_details);
                //alert();
            }
        });
    });

//    $(document).on("change", '.get_product', function () {
//        get_product_list();
//
//    })
//    function get_product_list() {
//        var category_id = $(".category_id option:selected").val();
//        ;
//        //alert(category_id);
//        var brand_id = $(".brand_id option:selected").val();
//        var sub_category_id = $(".sub_category_id option:selected").val();
//        $.ajax({
//            url: '<?php echo base_url(); ?>common_controller/get_product_list_combo',
//            type: 'POST',
//            data: {category_id: category_id, brand_id: brand_id, sub_category_id: sub_category_id},
//            success: function (data) {
//                //alert(data);
//                $(".product_list").html(data);
//                $('select').select2();
//            }
//        });
//    }


    $(".search_panel").on("click", function (e) {
        e.preventDefault();
        var category_id = $(".product_category_id option:selected").val();
        var brand_id = $(".product_brand_id option:selected").val();
        var sub_category_id = $(".product_subcategory_id option:selected").val();
        //var sub_category_id = $(".sub_category_id option:selected").val();
        var product_id = $(".product_id option:selected").val();
        var order_id = $(".order_id").val();
        var flag='sales';
        // alert(order_id);
        $.ajax({
            url: '<?php echo base_url(); ?>common_controller/get_product_list_view',
            type: 'POST',
            data: {category_id: category_id, brand_id: brand_id, sub_category_id: sub_category_id, product_id: product_id, order_id: order_id,flag:flag},
            success: function (data) {
                //alert(data);
                $(".product_list_item").html(data);
                //$('select').select2();
            }
        });
    })
    $(".add_item").click(function () {
        var order_id = parseInt($('.order_id').val());
        if(order_id){
            $(this).attr("data-target", "#add_item");
        }else{
            var htm ='<div class="invalid alert alert-danger">';
            htm += 'Please Save Sales Order First.';
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
        var order_id = $('.order_id').val();
        $.ajax({
                url: '<?php echo base_url(); ?>sales/save_sales_details',
                type: 'POST',
                data: $("#sales_order_form").serialize(),
                success: function (data) {
//                    alert("Purchase Order Saved..");
                    $.ajax({
                        url: '<?php echo base_url(); ?>sales/get_product_list',
                        type: 'POST',
                        data: {order_id:order_id},
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
        var order_details_id = $(this).attr("order_details_id");
        var price = $(this).parent().parent().find(".price").val();
        var subtotal = parseFloat(parseFloat(quantity) * parseFloat(price)).toFixed(2);
        $(this).parent().parent().find(".sub_total").text(subtotal);
        update_order_details(order_details_id, quantity, price);
        calculation();
    });
    $(document).on("input",".price", function () {
        var price = $(this).val();
        var order_details_id = $(this).attr("order_details_id");
        var quantity = $(this).parent().parent().find(".quantity").val();
        var subtotal = parseFloat(parseFloat(quantity) * parseFloat(price)).toFixed(2);
        $(this).parent().parent().find(".sub_total").text(subtotal);
        update_order_details(order_details_id, quantity, price);
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
        $(".total").text(sum);
    }
    function update_order_details(order_details_id, quantity, price) {
        $.ajax({
            url: '<?php echo base_url(); ?>sales/update_product_details',
            type: 'POST',
            data: {order_details_id: order_details_id, quantity: quantity, sales_price: price},
            success: function (data) {
            }
        });
    }
    $(".save").on("click", function (e) {
        e.preventDefault();
        var sales_order_id = parseInt($('.order_id').val());
        var delivery_contact_number = $('#delivery_contact_number').val();
        var payment_type_id = $(".payment_type_id option:selected").val();
        var delivery_cost = $("#delivery_cost").val();
        var delivery_address = $(".delivery_address").val();
        if (sales_order_id) {
            if(delivery_contact_number || payment_type_id || delivery_cost|| delivery_address){
                $.ajax({
                    url: '<?php echo base_url(); ?>sales/check_order_details',
                    type: 'POST',
                    data: {sales_order_id: sales_order_id},
                    success: function (data) {
                        if (data > 0) {
                            $.ajax({
                                url: '<?php echo base_url(); ?>sales/save_aditional_info',
                                type: 'POST',
                                data: {sales_order_id: sales_order_id,delivery_contact_number:delivery_contact_number,payment_type_id:payment_type_id,delivery_cost:delivery_cost,delivery_address:delivery_address}, 
                                success: function (data) {
                                    window.location.href = "<?php echo base_url(); ?>sales/order_details/"+sales_order_id; 
                                }
                            });
                        } else {
                            var htm ='<div class="invalid alert alert-danger">';
                            htm += 'you have not select any product';
                            htm +='</div>';
                            $('.adi_info_block').html(htm);
                            $('.invalid').slideUp(4000);
                        }
                        //return true;
                    }
                });
            }else{
                $.ajax({
                    url: '<?php echo base_url(); ?>sales/check_order_details',
                    type: 'POST',
                    data: {sales_order_id: sales_order_id},
                    success: function (data) {
                        if (data > 0) {
                            window.location.href = "<?php echo base_url(); ?>sales/order_details/"+sales_order_id; 
                                
                        } else {
                            var htm ='<div class="invalid alert alert-danger">';
                            htm += 'No product selected';
                            htm +='</div>';
                            $('.adi_info_block').html(htm);
                            $('.invalid').slideUp(4000);
                        }
                        //return true;
                    }
                });
            }
            
        } else {
            var htm ='<div class="invalid alert alert-danger">';
            htm += 'Please Save Order First.';
            htm +='</div>';
            $('.adi_info_block').html(htm);
            $('.invalid').slideUp(4000);
        
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
		//alert(sales_id);
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
            htm += 'Please Save Sales Order First.';
            htm +='</div>';
            $('.cost_component_block').html(htm);
            $('.invalid').slideUp(4000);
        }
        

    });
    $(document).on("click",".remove_btn", function () {
//        alert("bjghgj");
        $(this).parent('div').parent('div').parent('div.remove_div').remove();
    });
    
    function calculation_cost_component() {
        var sum = 0;
        $(".cost_amount").each(function () {
            var subtotal_text = $(this).text();
            var subtotal_string = subtotal_text.replace(",", "");
            var sub_total = parseFloat(subtotal_string).toFixed(2);
            sum = parseFloat(parseFloat(sum) + parseFloat(sub_total)).toFixed(2);

        });
        $(".total_cost").text(sum);
    }
    $(document).on("click",'.delete_cost_component', function () {

        var sales_order_id = $(this).attr('sales_order_id');
        var cost_component_id = $(this).attr('cost_component_id');
        var elem = $(this);
        $.ajax({
            url: '<?php echo base_url(); ?>sales/delete_cost_component',
            type: 'POST',
            data: {sales_order_id: sales_order_id,cost_component_id:cost_component_id},
            success: function (data) {
                console.log(data);
                elem.parent().parent().remove();
                calculation_cost_component();
            }
        });

    });
    
    $(document).on("click",'.edit_cost_component', function () {

        var sales_order_id = parseInt($(".order_id").val());
        var cost_component_id = $(this).attr('cost_component_id');
        var cost_total = $(this).attr('cost_total');
        var elem = $(this);
        var html = '<a href="javascript:void(0);" class="btn btn-sm btn-primary update_cost_button pull-right"><span class=""></span> Update </a>';
        $('.cost_component_btn').html(html);
        
        $(".cost_component").select2('val',cost_component_id);
        $(".cost_value").val(cost_total);

    });
    $(document).on("click",".update_cost_button", function () {

        var sales_order_id = parseInt($(".order_id").val());
        var cost_component = $(".cost_component option:selected").val();
        var cost_value = $(".cost_value").val();
//        alert(sales_order_id);
        var html= '<a href="javascript:void(0);" class="btn btn-sm btn-primary add_button pull-right"><span class="glyphicon glyphicon-plus"></span> Add </a>';
        if(sales_order_id && cost_component && cost_value){
            $.ajax({
                url: '<?php echo base_url(); ?>sales/update_cost_component',
                type: 'POST',
                data: {sales_order_id:sales_order_id,cost_component:cost_component,cost_value:cost_value},
                success: function (data) {
                    $(".cost_component_list").html(data);
                    $('.cost_component_btn').html(html);
                   
                   $(".cost_component").select2('val','');
                $(".cost_value").val('');

                }
            });
        }else{
            alert("Give Input Properly");
        }

    });
    
    $(document).on('click','.delete_doc',function(){
        var sales_supporting_doc_id = $(this).attr('sales_supporting_doc_id');
        var elem = $(this);
        $.ajax({
            url: '<?php echo base_url(); ?>sales/delete_supporting_doc',
            type: 'POST',
            data: {sales_supporting_doc_id:sales_supporting_doc_id},
            success: function (data) {
                elem.parent().parent().remove();
            }
        });
    });
</script>