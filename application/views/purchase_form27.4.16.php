<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $title; ?> </h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="post" id="my_form">
                        <input type="hidden" class="main_order_id" name="main_order_id" value="<?php echo $order_id;?>">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="vendor" class="col-lg-3 control-label">Vendor</label>
                                <div class="col-lg-9">
                                    <?php echo vendor_list($vendor_id, array('class' => 'vendor_id', 'required' => 'required')); ?>

                                </div>
                            </div>



                            <div class="form-group">
                                <label for="lc_number" class="col-lg-3 control-label">LC No.</label>
                                <div class="col-lg-9">
                                    <input required type="text" class="form-control lc_number" id="lc_number" name="lc_number" value="<?php echo $lc_number;?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lc_value" class="col-lg-3 control-label">LC Value.</label>
                                <div class="col-lg-9">
                                    <input required type="number" step="any" class="form-control lc_value" id="lc_value" name="lc_value" value="<?php echo $lc_value;?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bill_of_entry" class="col-lg-3 control-label">Bill Of Entry</label>
                                <div class="col-lg-9">
                                    <input required type="number" step="any" class="form-control bill_of_entry" id="bill_of_entry" name="bill_of_entry" value="<?php echo $bill_of_entry;?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-9">
                                    <button type="button" id="add_item_button"class="btn btn-primary add_item" data-toggle="modal" >Add Item</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="purchase_code" class="col-lg-3 control-label">Order No.</label>
                                <div class="col-lg-9">
                                    <input  readonly="true" required type="text" class="form-control purchase_code" id="purchase_code" name="purchase_code" value="<?php echo $purchase_code; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="order_date" class="col-lg-3 control-label order_date">Order Date</label>
                                <div class="col-lg-9">
                                    <input required type="date" class="form-control order_date" id="order_date" name="order_date" value="<?php echo $order_date;?>" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-lg-3 control-label">Status</label>
                                <div class="col-lg-9">

                                    <input required type="hidden" class="form-control" id="status" name="status" value="<?php echo $status;?>" >
                                    <span style="display: block;margin-top: 8px;"><?php echo $status; ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bill_of_leading" class="col-lg-3 control-label">Bill Of Leading</label>
                                <div class="col-lg-9">
                                    <input required type="number" step="any" class="form-control bill_of_leading" id="bill_of_leading" name="bill_of_leading" value="<?php echo $bill_of_leading;?>">
                                </div>
                            </div>
                        </div>

                    </form>

                    <!-- Modal for adding item-->



                    <!-- End of modal-->

                    <div class="col-lg-12">
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
                                    <?php echo $selected_product_list;?>
                                </tbody>
                            </table>
                            <form class="form-horizontal" role="form" id="others_data" method="post" action="<?php echo base_url() ?>purchase/update_order">
                        <input type="hidden" id="order_id" class="order_id" name="order_id" value="<?php echo $order_id;?>">
                            <div class="col-lg-6">
                                <div class="form-group col-lg-12">
                                    <label for="due_date" class="col-lg-4 control-label due_date">Due Date</label>
                                    <div class="col-lg-8">
                                        <input required type="date" class="form-control due_date" id="order_date" name="due_date" value="<?php echo $due_date;?>" >
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="currency_id" class="col-lg-4 control-label currency_id">Currency</label>
                                    <div class="col-lg-8">
                                        <?php echo curency_list($currency_id, array('class' => 'currency_id', 'required' => 'required')); ?>
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="exchange_rate" class="col-lg-4 control-label exchange_rate">Exchange Rate</label>
                                    <div class="col-lg-8">
                                        <input type="number" class="form-control exchange_rate" name="exchange_rate" step="any" value="<?php echo $exchange_rate;?>">
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                   
                                    <label for="taxing_scheme" class="col-lg-4 control-label due_date">Taxing Scheme</label>
                                    <div class="col-lg-8">
                                        <input required type="text" class="form-control taxing_scheme" id="taxing_scheme" name="taxing_scheme" value="<?php echo $taxing_scheme;?>" >
                                    </div>
                                </div>
                               
                                
                               <div class="form-group col-lg-12">
                                    <label for="request_ship_date" class="col-lg-4 control-label due_date">Request Ship Date</label>
                                    <div class="col-lg-8">
                                        <input required type="date" class="form-control request_ship_date" id="request_ship_date" name="request_ship_date" value="<?php echo $request_ship_date;?>" >
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="shipping_advice" class="col-lg-4 control-label shipping_advice">Shipping Advice</label>
                                    <div class="col-lg-8">
                                        <textarea name="shipping_advice" class="form-control"><?php echo $shipping_advice;?></textarea>
                                        
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="shipping_method_id" class="col-lg-4 control-label shipping_method_id">Shipping Method</label>
                                    <div class="col-lg-8">
                                        <?php echo shipping_method($shipping_method_id, array('class' => 'shipping_method_id', 'required' => 'required')); ?>
                                        
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="remarks" class="col-lg-4 control-label remarks">Remarks</label>
                                    <div class="col-lg-8">
                                        <textarea name="remarks" class="form-control"><?php echo $remarks;?></textarea>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4"></div>
                            
                            <div class="col-lg-2" style="text-align: left">Total:<span class="total"></span></div>
                            <div class="col-lg-12"><input type="submit" name="update_order" class="save" value="Save"></div>
                        
                            </form>
                        </div>
                    </div>

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

                    <form class="form-horizontal" role="form" id="details_data" method="post" action="<?php echo base_url() ?>purchase/save_order_details">
                        <input type="hidden" id="order_id" class="order_id" name="order_id" value="<?php echo $order_id;?>">
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
                    </form>
                </div>     
            </div>

        </div>
    </div>

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
           // alert(order_id);
            $.ajax({
                url: '<?php echo base_url(); ?>common_controller/get_product_list_view',
                type: 'POST',
                data: {category_id: category_id, brand_id: brand_id, sub_category_id: sub_category_id, product_id: product_id,order_id:order_id},
                success: function (data) {
                    //alert(data);
                    $(".product_list_item").html(data);
                    //$('select').select2();
                }
            });
        })
        $(".add_item").click(function () {
        $(".product_list_item").html('');
        var vendor_id = $(".vendor_id option:selected").val();
        var order_date = $("#order_date").val();
        var lc_number = $(".lc_number").val();
        //var order_date = $(".order_date").val();
        ///alert(order_date);
        if(vendor_id && order_date && lc_number && order_date){
            $(this).attr("data-target","#add_item");
            
            $.ajax({
                url: '<?php echo base_url(); ?>purchase/save_purchase_order',
                type: 'POST',
                data: $("#my_form").serialize(),
                success: function (data) {
                    //alert(data);
                    $(".order_id").val(data);
                    //$('select').select2();
                }
            });
            }else{
             alert("Please fill all field currectly");
            }
        });
        
        $(".delete_product").on("click",function(){
        
            var order_details_id = $(this).attr('order_details_id');
            var elem = $(this);
            $.ajax({
                url: '<?php echo base_url(); ?>purchase/delete_product',
                type: 'POST',
                data: {order_details_id:order_details_id},
                success: function (data) {
                    //alert(data);
                    $(".order_id").val(data);
                    //$('select').select2();
                    elem.parent().parent().remove();
                    if(data==1){
                        calculation();
                    }
                }
            });
            
        });
        
        $( document ).ready(calculation );
        $(".quantity").on("input",function(){
            var quantity = $(this).val();
            var order_details_id = $(this).attr("order_details_id");
            var price = $(this).parent().parent().find(".price").val();
            var subtotal = parseFloat(parseFloat(quantity)*parseFloat(price)).toFixed(2);
            $(this).parent().parent().find(".sub_total").text(subtotal);
            update_order_details(order_details_id,quantity,price);
            calculation();
        });
        $(".price").on("input",function(){
            var  price= $(this).val();
            var order_details_id = $(this).attr("order_details_id");
            var quantity = $(this).parent().parent().find(".quantity").val();
            var subtotal = parseFloat(parseFloat(quantity)*parseFloat(price)).toFixed(2);
            $(this).parent().parent().find(".sub_total").text(subtotal);
            update_order_details(order_details_id,quantity,price);
            calculation();
        });
        function calculation(){
            var sum = 0;
            $(".sub_total").each(function (){
                var subtotal_text = $(this).text();
                var subtotal_string = subtotal_text.replace(",", "");
                var sub_total= parseFloat(subtotal_string).toFixed(2);
                sum = parseFloat(parseFloat(sum)+parseFloat(sub_total)).toFixed(2);
                
            });
            $(".total").text(sum);
        }
       function update_order_details(order_details_id,quantity,price){
            $.ajax({
                url: '<?php echo base_url(); ?>purchase/update_product_details',
                type: 'POST',
                data: {order_details_id:order_details_id,quantity:quantity,purchase_price:price},
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
       $(".save").on("click",function(e){
            e.preventDefault();
            var order_id = $("#others_data .order_id").val();
            if(order_id){
             $.ajax({
                url: '<?php echo base_url(); ?>purchase/check_order_details',
                type: 'POST',
                data: {order_id:order_id},
                success: function (data) {
                    
                    if(data >0){
                        $( "#others_data" ).submit();
                    }else{
                         alert("you have not select any product");
                    }
                    //return true;
                }
            });
            }else{
                alert("you have not select any product");
            }
            
       })
    </script>