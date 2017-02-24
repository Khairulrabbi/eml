<!--<form class="form-horizontal"  id="my_form" method="post" action="<?php echo base_url() ?>purchase/update_order/<?php echo $order_id; ?>">-->
    <input type="hidden" id="order_id" class="order_id" name="order_id" value="<?php echo $order_id; ?>">
    <input type="hidden" class="main_order_id" name="main_order_id" value="<?php echo $order_id; ?>">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $title; ?> <p class="pull-right text-danger " style="font-size: 16px;font-style: oblique;padding-right: 24px;"><?php echo (isset($order_id)?$status:''); ?></p></h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" id="purchase_order" action="" method="post">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="vendor" class="col-lg-3 control-label">Vendor <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <?php echo vendor_list(@$order_info->vendor_id, array('class' => 'vendor_id', 'required' => 'required')); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="purchase_code" class="col-lg-3 control-label">Order No. <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input  readonly="true" required type="text" class="form-control purchase_code" id="purchase_code" name="purchase_code" value="<?php echo @$purchase_code; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="order_date" class="col-lg-3 control-label order_date">Order Date <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input required type="date" class="form-control order_date" id="order_date" name="order_date" value="<?php echo @$order_info->order_date; ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="bill_of_entry" class="col-lg-4 control-label">Bill Of Entry <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input required type="number" step="any" class="form-control bill_of_entry" placeholder="Bill Of Entry" id="bill_of_entry" name="bill_of_entry" value="<?php echo @$order_info->bill_of_entry; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bill_of_leading" class="col-lg-4 control-label">Bill Of Lading <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input required type="number" step="any" class="form-control bill_of_lading" placeholder="Bill Of Lading" id="bill_of_lading" name="bill_of_lading" value="<?php echo @$order_info->bill_of_lading; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            
                            <div class="form-group">
                                <label for="currency_id" class="col-lg-5 control-label currency_id">Currency</label>
                                <div class="col-lg-7">
                                    <?php echo curency_list((@$order_info->currency_id?$order_info->currency_id:12), array('class' => 'currency_id', '' => '')); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exchange_rate" class="col-lg-5 control-label exchange_rate">Exchange Rate</label>
                                <div class="col-lg-7">
                                    <input type="number" class="form-control exchange_rate" placeholder="Exchange Rate" name="exchange_rate" step="any" value="<?php echo (@$order_info->exchange_rate?$order_info->exchange_rate:1); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="purchase_type" class="col-lg-5 control-label exchange_rate">Purchase Type</label>
                                <div class="col-lg-7">
                                    <?php echo purchase_type(1,array('class' => 'purchase_type'));?>
                                </div>
                            </div>

                        </div>
                        <div class="row "></div>
                        <div style="padding-right: 15px;">
                            <input type="button" id="save_purchase"class="btn btn-primary pull-right" value="Save Order">
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
                    <button type="button" id="add_product"class="btn btn-primary add_products pull-right" data-toggle="modal" >Add Item</button>
                    <div class="scrolltable">
                        <table class="table product_list_table">
                            <thead>
                                <tr>
                                    <th>#Sl</th>
                                    <th>Product Name</th>
                                    <th>Descriptions</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $selected_product_list; ?>
                            </tbody>
                        </table>


                        <div class="col-lg-6">

                        </div>
                        <div class="col-lg-2"></div>

                        <div class="col-lg-2" style="text-align: left">Total:<span class="total"></span></div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo "Cost Component"; ?> </h3>
                </div>
                <div class="panel-body">
                    <div class="field_wrapper">
                        <div class="col-lg-8">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="" class="col-lg-6 control-label">Cost Component <span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <?php echo cost_component('',array('class'=>'cost_component')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5"> 
                                <div class="form-group">
                                    <label for="" class="col-lg-4 control-label">Total Cost <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <input type="number" class="form-control cost_value" name="cost_value" placeholder="Cost">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2" style="padding-right: 30px;">
                                <div class="form-group cost_component_btn">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-primary add_button pull-right"><span class="glyphicon glyphicon-plus"></span> Add </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 cost_component_list">
                            <?php if(isset($cost_component)){?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#Sl</th>
                                        <th>Cost Component </th>
                                        <th>Total Cost</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sl =1; foreach ($cost_component as $key=>$value){?>
                                    <tr>
                                        <td><?php echo $sl;?></td>
                                        <td><?php echo $value['cost_component_name'];?></td>
                                        <td><?php echo $value['total_cost'];?></td> 
                                        <td>
                                            <i style=" cursor: pointer;text-align: center;" class="fa fa-pencil edit_cost_component" aria-hidden="true" cost_total="<?php echo $value['total_cost'];?>" cost_component_id="<?php echo $value['cost_component_id'];?>" order_details_id="<?php echo $value['purchase_order_id'];?>"></i>
                                            <i style=" cursor: pointer;text-align: center;" class="fa fa-times delete_cost_component" aria-hidden="true" cost_component_id="<?php echo $value['cost_component_id'];?>" order_details_id="<?php echo $value['purchase_order_id'];?>"></i>
                                        </td>
                                    </tr>
                                    <?php $sl++; } ?>
                                </tbody>
                            </table>
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
                    <form  class="ajax_file" action="" method="post" enctype="multipart/formdata">
                        <input type="hidden" id="order_id" class="order_id data" name="order_id_ajax" value="<?php echo $order_id; ?>">
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
                                <input class="btn btn-primary" type="submit" name="upload" value="upload"/>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            
                        </div>
                        
                    </form>
                </div>
            </div>

            <div class="panel panel-default" style="margin-bottom: 50px;">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo "Others Info"; ?> </h3>
                </div>
                <div class="panel-body">
                    <div class="col-lg-4">
                        <div class="form-group col-lg-12">
                            <label for="request_ship_date" class="col-lg-5 control-label due_date">Request Ship Date</label>
                            <div class="col-lg-7">
                                <input  type="date" class="form-control request_ship_date" id="request_ship_date" name="request_ship_date" value="<?php echo @$order_info->request_ship_date; ?>" >
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="remarks" class="col-lg-5 control-label">Remarks</label>
                            <div class="col-lg-7">
                                <textarea name="remarks" class="form-control remarks"><?php echo @$order_info->remarks; ?></textarea>

                            </div>

                        </div>
                    </div>
                   
                    <div class="col-lg-4">
                         <div class="form-group col-lg-12">
                            <label for="shipping_method_id" class="col-lg-5 control-label shipping_method_id">Shipping Method</label>
                            <div class="col-lg-7">
                                <?php echo shipping_method(@$order_info->shipping_method_id, array('class' => 'shipping_method_id', '' => '')); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group col-lg-12">
                            <label for="shipping_advice" class="col-lg-5 control-label">Shipping Advice</label>
                            <div class="col-lg-7">
                                <textarea name="shipping_advice" class="form-control shipping_advice"><?php echo @$order_info->shipping_advice; ?></textarea>

                            </div>
                        </div>
                    </div>
                    <div class="row "></div>
                    <div style="padding-right: 15px;">
                        <input type="submit" name="update_order" class="btn btn-primary save pull-right" value="Save Info">
                    </div>
                    
                    
                </div>

            </div>

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
                        <form id="product_form" class="form-horizontal" action="">
                        <input type="hidden" id="order_id" class="order_id" name="order_id" value="<?php echo $order_id; ?>">
                        <div class="form-group">
                            <div class="col-lg-6">
                                <div class="col-lg-4">
                                    Category
                                </div>
                                <div class="col-lg-8">
                                    <?php echo category_list(null, array('class' => 'category_id get_product')); ?>
                                </div>

                                <div class="col-lg-4" style="margin-top: 5px;">
                                    Brand
                                </div>
                                <div class="col-lg-8" style="margin-top: 5px;">
                                    <?php echo brand_list(null, array('class' => 'brand_id get_product')); ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="col-lg-4">
                                    Sub Category
                                </div>
                                <div class="col-lg-8 sub_category_list">
                                    <?php echo sub_category_list(null, array('class' => 'sub_category_id get_product')); ?>
                                </div>
                                <div class="col-lg-4" style="margin-top: 5px;">
                                    Product
                                </div>
                                <div class="col-lg-8 product_list" style="margin-top: 5px;">
                                    <?php echo product_list(null, array('class' => 'product_id')); ?>
                                </div>
                            </div>
                            <div class="col-lg-12" style="padding-right: 30px; margin-top: 10px; margin-bottom: 10px">
                                &nbsp;&nbsp;&nbsp;
                                <button type="submit" class="btn btn-primary search pull-right class" style="padding-right: 15px;" >Search</button>
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
//        var files;


        event.stopPropagation();
        event.preventDefault();
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
            url: '<?php echo base_url() ?>purchase/ajax_upload',
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(data, textStatus, jqXHR){
                if(typeof data.error === 'undefined'){
                    submitForm(event, data);
                }else{
                    console.log('ERRORS: ' + data.error);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log('ERRORS: ' + textStatus);
            }
        });
    }
</script>


<script>
    /*
     * 
     */
    $(document).ready(function(){
        var order_id = $('.main_order_id').val();
        if(order_id){
            $('#save_purchase').val('Update order');
        }
    });
    $("#save_purchase").on("click",function(){
        var order_id = $('.main_order_id').val();
        var vendor_id = $(".vendor_id option:selected").val();
        var order_date = $("#order_date").val();
        var bill_of_entry = $("#bill_of_entry").val();
        var bill_of_lading = $("#bill_of_lading").val();
        if(order_id){
           $.ajax({
                url: '<?php echo base_url(); ?>purchase/update_purchase_for_purchase_order_block',
                type: 'POST',
                data: {order_id:order_id,vendor_id:vendor_id,order_date:order_date,bill_of_entry:bill_of_entry,bill_of_lading:bill_of_lading},
                success: function (data) {
                    alert('Update Success.');
                }
            }) ;
        }else{
            if (vendor_id && order_date && order_date && bill_of_entry && bill_of_lading ) {

                $.ajax({
                    url: '<?php echo base_url(); ?>purchase/save_local_purchase_from_purchase_order_block',
                    type: 'POST',
                    data: $("#purchase_order").serialize(),
                    success: function (data) {
    //                    alert(data);
                        $(".order_id").val(data);
                        alert("Purchase Order Saved..");

                        $('#save_purchase').val('Update order');

                    }
                });
            } else {
                alert("Please fill all field currectly");
            }
        }
        ///alert(order_date);
        
    });
    $('#add_product').on("click",function(){
        var order_id = $(".order_id").val();
        if(order_id){
            $(this).attr("data-target", "#add_product_m");
        }else{
            alert("Please Save Order First");
        }
    });
    
    $(document).on("click", ".add_product_btn", function (e) {
        e.preventDefault();
        var order_id = $(".order_id").val();
        var product_id = 
        $.ajax({
                url: '<?php echo base_url(); ?>purchase/save_order_details',
                type: 'POST',
                data: $("#product_form").serialize(),
                success: function (data) {
                    alert("Purchase Order Saved..");
                    $.ajax({
                        url: '<?php echo base_url(); ?>purchase/get_product_list',
                        type: 'POST',
                        data: {order_id:order_id},
                        success: function (data) {
                            $('.product_list_table tbody').html(data);
                            calculation();
                        }
                    });
                }
            });
    });
    $('.add_products ').on('click', function() {
        $(".product_list_item").html('');
        
    });
 
    $(".category_id").on("change", function () {
        var category_id = $(this).val();
        $.ajax({
            url: '<?php echo base_url(); ?>common_controller/get_sub_category',
            type: 'POST',
            data: {category_id: category_id},
            success: function (data) {
                //alert(data);
                $(".sub_category_list").html(data);
                $('select').select2();
            }
        });
    })


    $(document).on("change", '.get_product', function () {
        get_product_list();

    })
    function get_product_list() {
        var category_id = $(".category_id option:selected").val();
        ;
        //alert(category_id);
        var brand_id = $(".brand_id option:selected").val();
        var sub_category_id = $(".sub_category_id option:selected").val();
        $.ajax({
            url: '<?php echo base_url(); ?>common_controller/get_product_list_combo',
            type: 'POST',
            data: {category_id: category_id, brand_id: brand_id, sub_category_id: sub_category_id},
            success: function (data) {
                //alert(data);
                $(".product_list").html(data);
                $('select').select2();
            }
        });
    }


    $(".search").on("click", function (e) {
        e.preventDefault();
        var category_id = $(".category_id option:selected").val();
        var brand_id = $(".brand_id option:selected").val();
        var sub_category_id = $(".sub_category_id option:selected").val();
        //var sub_category_id = $(".sub_category_id option:selected").val();
        var product_id = $(".product_id option:selected").val();
        var order_id = $("#order_id").val();
        // alert(order_id);
        $.ajax({
            url: '<?php echo base_url(); ?>common_controller/get_product_list_view',
            type: 'POST',
            data: {category_id: category_id, brand_id: brand_id, sub_category_id: sub_category_id, product_id: product_id, order_id: order_id},
            success: function (data) {
                //alert(data);
                $(".product_list_item").html(data);
                //$('select').select2();
            }
        });
    });

    $(document).on("click",".delete_product", function () {

        var order_details_id = $(this).attr('order_details_id');
        var elem = $(this);
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/delete_product',
            type: 'POST',
            data: {order_details_id: order_details_id},
            success: function (data) {
                //alert(data);
                $(".order_id").val(data);
                //$('select').select2();
                elem.parent().parent().remove();
                if (data == 1) {
                    calculation();
                }
            }
        });

    });
    
    $(document).on('click','.update_product',function(){
        var order_details_id = $(this).attr('order_details_id');
        var product_details = $(this).parent().parent().find(".product_details").val();
        var quantity  = $(this).parent().parent().find(".quantity").val();
        var price = $(this).parent().parent().find(".price").val();
//        alert(quantity);
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/update_product',
            type: 'POST',
            data: {order_details_id: order_details_id,product_details:product_details,quantity:quantity,price:price},
            success: function (data) {
                if(data){
                    alert("Successfuly Updated");
                }else{
                    alert("Something Wrong");
                }
                
            }
        });
    });
    
    $(document).on("click",'.delete_cost_component', function () {

        var order_details_id = $(this).attr('order_details_id');
        var cost_component_id = $(this).attr('cost_component_id');
        var elem = $(this);
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/delete_cost_component',
            type: 'POST',
            data: {order_details_id: order_details_id,cost_component_id:cost_component_id},
            success: function (data) {
                elem.parent().parent().remove();
            }
        });

    });
    $(document).on("click",'.edit_cost_component', function () {

        var order_details_id = $(this).attr('order_details_id');
        var cost_component_id = $(this).attr('cost_component_id');
        var cost_total = $(this).attr('cost_total');
        var elem = $(this);
        var html = '<a href="javascript:void(0);" class="btn btn-sm btn-primary update_cost_button pull-right"><span class=""></span> Update </a>';
        $('.cost_component_btn').html(html);
        $('.cost_component').val(cost_component_id);
        $('.cost_value').val(cost_component_id);
        $('.cost_value').val(cost_total);

    });
    $(document).on("click",".update_cost_button ", function () {

        var order_id = $(".order_id").val();
        var cost_component = $(".cost_component option:selected").val();
        var cost_value = $(".cost_value").val();
        var html= '<a href="javascript:void(0);" class="btn btn-sm btn-primary add_button pull-right"><span class="glyphicon glyphicon-plus"></span> Add </a>';
        if(order_id && cost_component && cost_value){
            $.ajax({
                url: '<?php echo base_url(); ?>purchase/update_cost_component',
                type: 'POST',
                data: {order_id:order_id,cost_component:cost_component,cost_value:cost_value},
                success: function (data) {
                    $(".cost_component_list").html(data);
                    $('.cost_component_btn').html(html);
                    $('.cost_component').val('');
                    $('.cost_value').val('');
                    $('.cost_value').val('');

                }
            });
        }else{
            alert("Give Input Properly");
        }

    });

    $(document).ready(calculation);
    $(document).on("input",".quantity", function () {
        var quantity = $(this).val();
        //alert(quantity);
        var order_details_id = $(this).attr("order_details_id");
        var price = $(this).parent().parent().find(".price").val();
        //alert(price);
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
            url: '<?php echo base_url(); ?>purchase/update_product_details',
            type: 'POST',
            data: {order_details_id: order_details_id, quantity: quantity, purchase_price: price},
            success: function (data) {
//                    //alert(data);
//                    $(".order_id").val(data);
//                    //$('select').select2();
//                    elem.parent().parent().remove();
//                    if(data==1){
//                        calculation();
//                    }
            }
        });
    }
    $(".save").on("click", function (e) {
        e.preventDefault();
        var order_id = $(".order_id").val();
        var request_ship_date = $('#request_ship_date').val();
        var shipping_method_id = $(".shipping_method_id option:selected").val();
        var shipping_advice = $(".shipping_advice").val();
        var remarks = $(".remarks").val();
        if (order_id) {
            $.ajax({
                url: '<?php echo base_url(); ?>purchase/check_order_details',
                type: 'POST',
                data: {order_id: order_id},
                success: function (data) {
                    //alert(data);

                    if (data > 0) {
                        $.ajax({
                            url: '<?php echo base_url(); ?>purchase/save_aditional_info',
                            type: 'POST',
                            data: {order_id: order_id,request_ship_date:request_ship_date,shipping_method_id:shipping_method_id,shipping_advice:shipping_advice,remarks:remarks}, 
                            success: function (data) {
                                window.location.href = "<?php echo base_url(); ?>purchase/local_order_details/"+order_id; 
                            }
                        });
                    } else {
                        alert("you have not select any product");
                    }
                    //return true;
                }
            });
        } else {
            alert("Please Save Order First");
        }

    });
    
    
    $(document).on("click",'.add_button', function () {
        var order_id = $(".order_id").val();
        var cost_component = $(".cost_component option:selected").val();
        var cost_value = $(".cost_value").val();
        if(order_id ){
            if(cost_component && cost_value){
                $.ajax({
                    url: '<?php echo base_url(); ?>purchase/add_ajax_cost_component_view',
                    type: 'POST',
                    data: {order_id:order_id,cost_component:cost_component,cost_value:cost_value},
                    success: function (data) {
                        $(".cost_component_list").html(data);
                    }
                });
            }else{
                alert('Please fill required values');
            }
            
        }else{
            alert("Submit Order First..");
        }
        

    });
//    $(document).on("click",".remove_btn", function () {
////        alert("bjghgj");
//        $(this).parent('div').parent('div').parent('div.remove_div').remove();
//    });

    
</script>