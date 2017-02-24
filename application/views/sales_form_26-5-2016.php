<form class="form-horizontal"  id="my_form" method="post" action="<?php echo base_url() ?>sales/update_order/<?php echo $order_id; ?>">
    <input type="hidden" id="order_id" class="order_id" name="order_id" value="<?php echo $order_id; ?>">
    <input type="hidden" class="main_order_id" name="main_order_id" value="<?php echo $order_id; ?>">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $title; ?> 
					<p class="pull-right text-danger " style="font-size: 16px;font-style: oblique;padding-right: 24px;"><?php echo $status; ?></p>
					</h3>
                </div>
                <div class="panel-body">


                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="customer_id" class="col-lg-3 control-label">Customer</label>
                            <div class="col-lg-9">
                                <?php echo customer_list(@$order_info->customer_id, array('class' => 'customer_id', 'required' => 'required')); ?>

                            </div>
                        </div>



                        <div class="form-group">
                            <label for="attention" class="col-lg-3 control-label">Attention</label>
                            <div class="col-lg-9">
                                <input required type="text" class="form-control attention" id="attention" name="attention" value="<?php echo @$order_info->attention; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bill_to" class="col-lg-3 control-label">Bill to</label>
                            <div class="col-lg-9">
                                <input required type="text" step="any" class="form-control bill_to" id="bill_to" name="bill_to" value="<?php echo @$order_info->bill_to; ?>">
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label for="address" class="col-lg-3 control-label ">Address</label>
                            <div class="col-lg-9">
                                <textarea name="address" id="customer_address" class="form-control address"><?php echo @$order_info->address; ?></textarea>

                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-9">
                                <button type="button" id="add_item_button"class="btn btn-primary add_item" data-toggle="modal" >Add Item</button>
                            </div>
                        </div>
                    </div>
					
					
					
					<div class="col-lg-4">
					   <div class="form-group col-lg-12">
                                   
                                    <label for="delivery_contact_person" class="col-lg-3 control-label delivery_contact_person">Contact person</label>
                                    <div class="col-lg-9">
                                        <input  type="text" class="form-control delivery_contact_person" id="delivery_contact_person" name="delivery_contact_person" value="<?php echo @$order_info->delivery_contact_person;?>" >
                                    </div>
                                </div>
                        <div class="form-group col-lg-12">
                                   
                                    <label for="delivery_mode_id" class="col-lg-3 control-label delivery_mode_id">Delivery mode</label>
                                    <div class="col-lg-9">
                                         <?php echo delivery_mode(@$order_info->delivery_mode_id, array('class' => 'delivery_mode_id', 'required' => 'required')); ?>
                                    </div>
                                </div>
                        <div class="form-group col-lg-12">
                            <label for="delivery_details" class="col-lg-3 control-label delivery_details">Delivery Details</label>
                            <div class="col-lg-9">
                                <textarea name="delivery_details" class="form-control"><?php echo @$order_info->delivery_details; ?></textarea>

                            </div>
                        </div>
						
						<div class="form-group col-lg-12">
                            <label for="delivery_address" class="col-lg-3 control-label shipping_advice">Delivery Address</label>
                            <div class="col-lg-9">
                                <textarea name="delivery_address" class="form-control"><?php echo @$order_info->delivery_address; ?></textarea>

                            </div>
                        </div>
						
						
					</div>
					

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="sales_code" class="col-lg-3 control-label">Order No.</label>
                            <div class="col-lg-9">
                                <input  readonly="true" required type="text" class="form-control sales_code" id="sales_code" name="sales_code" value="<?php echo $sales_code; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="order_date" class="col-lg-3 control-label order_date">Order Date</label>
                            <div class="col-lg-9">
                                <input required type="date" class="form-control order_date" id="order_date" name="order_date" value="<?php echo @$order_info->order_date; ?>" >
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="sales_person_id" class="col-lg-3 control-label">Sales Person</label>
                            <div class="col-lg-9">
                                <?php echo sales_person_list(@$order_info->sales_person_id, array('class' => 'sales_person_id', 'required' => 'required')); ?>

                            </div>
                        </div>
                       
					   <div class="form-group col-lg-12">
                            <label for="remarks" class="col-lg-3 control-label remarks">Remarks</label>
                            <div class="col-lg-9">
                                <textarea name="remarks" class="form-control"><?php echo @$order_info->remarks; ?></textarea>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo "Item List"; ?> </h3>
                </div>
                <div class="panel-body">
                    <div class="scrolltable">
                        <table class="table table-bordered">
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
                        </table>


                        <div class="col-lg-6">

                        </div>
                        <div class="col-lg-4"></div>

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
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="" class="col-lg-5 control-label">Cost Component Name</label>
                                <div class="col-lg-7">
                                    <?php echo cost_component('',array('class'=>'cost_component')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="" class="col-lg-3 control-label">Total Cost</label>
                                <div class="col-lg-7">
                                    <input type="number" class="form-control" name="cost_value[]" placeholder="Cost">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 " style="padding-right: 30px;">
                            <div class="form-group">
                                <a href="javascript:void(0);" class="btn btn-sm btn-primary add_button pull-right"><span class="glyphicon glyphicon-plus"></span> Add More</a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo "Supporting Document"; ?> </h3>
                </div>
                <div class="panel-body">
                    
                    <input type="file" class="filestyle" data-buttonName="btn-primary">
                </div>
            </div>

            <div class="panel panel-default" style="margin-bottom: 50px;">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo "Others Info"; ?> </h3>
                </div>
                <div class="panel-body">
                    <div class="col-lg-5">
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
                
                    <div class="col-lg-5">
                        <div class="form-group col-lg-12">
                                   
                                    <label for="payment_type_id" class="col-lg-5 control-label payment_type_id">Payment Type</label>
                                    <div class="col-lg-7">
                                         <?php echo payment_type(@$order_info->payment_type_id, array('class' => 'payment_type_id', 'required' => 'required')); ?>
                                    </div>
                                </div>
                        <div class="form-group col-lg-12">
                            <label for="delivery_address" class="col-lg-5 control-label shipping_advice">Delivery Address</label>
                            <div class="col-lg-7">
                                <textarea name="delivery_address" class="form-control"><?php echo @$order_info->delivery_address; ?></textarea>

                            </div>
                        </div>
                        
                    </div>
                    <div class="col-lg-2"></div>
                    <div class="form-group col-lg-12"><input type="submit" name="update_order" class="save btn btn-primary" value="Save"></div>
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
                            <div class="col-lg-6" style="margin-right: 15px;">
                                &nbsp;&nbsp;&nbsp;
                                <button class="btn btn-primary search" style="padding-right: 15px;" >Search</button>
                            </div>
                            <div class="col-lg-12 product_list_item" style="margin-right: 15px;">

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" id="add">Close</button>
                        </div>
                        <br>

                    </div>     
                </div>

            </div>
        </div>
</form>
<script>
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
 $(".customer_id").on("change", function () {
        var customer_id = $(this).val();
        $.ajax({
            url: '<?php echo base_url(); ?>common_controller/get_customer_info',
            type: 'POST',
            data: {customer_id: customer_id},
            success: function (data) {
                var obj = jQuery.parseJSON(data);
                $("#customer_address").val(obj.address);
                //alert();
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
        ;
        var brand_id = $(".brand_id option:selected").val();
        var sub_category_id = $(".sub_category_id option:selected").val();
        //var sub_category_id = $(".sub_category_id option:selected").val();
        var product_id = $(".product_id option:selected").val();
        var order_id = $("#order_id").val();
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
        $(".product_list_item").html('');
        var customer_id = $(".customer_id option:selected").val();
        var order_date = $("#order_date").val();
        
        //var order_date = $(".order_date").val();
        ///alert(order_date);
        if (customer_id && order_date  && order_date) {
            $(this).attr("data-target", "#add_item");

            $.ajax({
                url: '<?php echo base_url(); ?>sales/save_sales_order',
                type: 'POST',
                data: $("#my_form").serialize(),
                success: function (data) {
                    //alert(data);
                    $(".order_id").val(data);
                    //$('select').select2();
                }
            });
        } else {
            alert("Please fill all field currectly");
        }
    });

    $(".delete_product").on("click", function () {

        var order_details_id = $(this).attr('order_details_id');
        var elem = $(this);
        $.ajax({
            url: '<?php echo base_url(); ?>sales/delete_product',
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

    $(document).ready(calculation);
    $(".quantity").on("input", function () {
        var quantity = $(this).val();
        var order_details_id = $(this).attr("order_details_id");
        var price = $(this).parent().parent().find(".price").val();
        var subtotal = parseFloat(parseFloat(quantity) * parseFloat(price)).toFixed(2);
        $(this).parent().parent().find(".sub_total").text(subtotal);
        update_order_details(order_details_id, quantity, price);
        calculation();
    });
    $(".price").on("input", function () {
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
        if (order_id) {
            $.ajax({
                url: '<?php echo base_url(); ?>sales/check_order_details',
                type: 'POST',
                data: {order_id: order_id},
                success: function (data) {

                    if (data > 0) {
                        $("#my_form").submit();
                    } else {
                        alert("you have not select any product");
                    }
                    //return true;
                }
            });
        } else {
            alert("you have not select any product");
        }

    })
    $(document).on("click", ".add_product", function (e) {
        e.preventDefault();
        $("#my_form").attr("action", "<?php echo base_url() ?>sales/save_order_details");
        $("#my_form").submit();
    })
	
	$(".add_button").on("click", function () {

        $.ajax({
            url: '<?php echo base_url(); ?>purchase/add_ajax_cost_component_view',
            type: 'POST',
            data: {},
            success: function (data) {
                //alert(data);
                $('.field_wrapper').append(data);
                $("select").select2();
                
            }
        });

    });
    $(document).on("click",".remove_btn", function () {
//        alert("bjghgj");
        $(this).parent('div').parent('div').parent('div.remove_div').remove();
    });
</script>