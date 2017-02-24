<form class="form-horizontal" role="form" method="post" id="my_form" action="<?php echo base_url();?>purchase/update_order/<?php echo $order_id; ?>">
     <input type="hidden" class="main_order_id" name="order_id" value="<?php echo $order_id; ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="overflow: hidden;">
                        <h3 class="panel-title pull-left"><?php echo $title; ?> </h3>
                        <div class="btn-toolbar pull-right" style="padding-right: 15px;">                            
                            <?php if( $order_info->status=='5'){?>
                            <button id="edit" class="btn btn-primary add_item" name="Edit" value="Edit">Edit</button>
                            <button  id="confirm" class="btn btn-primary add_item" name="confirm" value="Confirm">Confirm</button>
                             <?php } ?>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table ">

                            <tbody>

                                <tr>
                                    <th>Vendor</th>
                                    <td><?php echo $order_info->vendor_name;?></td>
                                    <th>Bill Of Lading</th>
                                    <td><?php echo $order_info->bill_of_lading; ?></td>
                                    <th>Exchange Rate</th>
                                    <td><?php echo $order_info->exchange_rate;?></td>
                                    
                                </tr>
                                <tr>
                                    <th>Order No.</th>
                                    <td><?php echo $order_info->purchase_code; ?></td>
                                    <th>Bill Of Entry</th>
                                    <td><?php echo $order_info->bill_of_entry;?></td>
                                    <th>Currency</th>
                                    <td><?php echo $order_info->currency_name; ?></td>
                                    
                                    
                                </tr>
                                <tr>
                                    <th>Order Date</th>
                                    <td><?php echo $order_info->order_date;?></td>
                                    <th>Status</th>
                                    <td><?php echo $order_info->status_name;?></td>
                                    <th>Purchase Type</th>
                                    <td><?php echo $order_info->purchase_type_name; ?></td>
                                    
                                </tr>
                                
                            </tbody>
                        </table>   
                        </div>
                        </div>

<div class="panel panel-default">
                    <div class="panel-heading" style="overflow: hidden;">
                        <h3 class="panel-title pull-left"><?php echo "Item List"; ?> </h3>
                        <div class="btn-toolbar pull-right" style="padding-right: 15px;">                            
                            <?php if ($order_info->status=='16' || $order_info->status=='14' ) {?>
                                <button type="submit" class="goods_received btn btn-primary add_item" name="goods_received" value="Received Goods">Received Goods</button>
                             <?php }?>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table">

                                <thead>
                                        <tr>
                                            <th>#Sl</th>
                                            <th>Product Name</th>
                                            <th>Descriptions</th>
                                            <th>Ordered Qty</th>
                                            <th>Received Qty</th>
                                            <th  style="text-align: right;">Price</th>
                                            <th  style="text-align: right;">Total</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                                $sl=1;
                                                $total = 0;
                                                if(!empty($selected_product)){
                                                foreach($selected_product as $key=>$value){
                                                    $total = $total+$value['quantity']*$value['purchase_price'];
                                                    ?>
                                                    <tr>
                                                      <td><?php echo $sl++;?></td>
                                                      <td><?php echo $value['product_name'];?></td>
                                                      <td><?php echo $value['product_details'];?></td>
                                                      <td><?php echo $value['quantity'];?></td>
                                                      <td><?php echo $value['received_products'];?></td>
                                                      <td style="text-align: right;"><?php echo $value['purchase_price'];?></td>
                                                      <td class="sub_total" style="text-align: right;"><?php echo number_format($value['quantity']*$value['purchase_price'],2); ?></td>
                                                    </tr>
                                                <?php }} ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th style="text-align: right;">Total</th>
                                            <th style="text-align: right;"><?php echo number_format($total,2);?></th>

                                        </tr>
                                    </tfoot>
                        </table>   
                        </div>
                        </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo "Cost Component"; ?> </h3>
                    </div>
                    <div class="panel-body">
                        <div class="field_wrapper">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#Sl</th>
                                        <th>Cost Component</th>
                                        <th>Total Cost</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sl=1;
                                    if(!empty($cost_component)){
                                       foreach($cost_component as $key=>$value){?>
                                        <tr>
                                           <td><?php echo $sl++;?></td>
                                            <td><?php echo $value['cost_component_name'];?></td>
                                            <td><?php echo $value['total_cost'];?></td> 
                                        </tr>   
                                       
                                    <?php }}?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo "Others Info"; ?> </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table ">

                            <tbody>

                                <tr>
                                    <th>Request Ship Date</th>
                                    <td><?php echo $order_info->request_ship_date;?></td>
                                    <th>Shipping Method</th>
                                    <td><?php  echo $order_info->shipping_method_name; ?></td>
                                </tr>
                                <tr>
                                    <th>Shipping Advice</th>
                                    <td><?php echo $order_info->shipping_advice;?></td>
                                    <th>Remarks</th>
                                    <td><?php echo $order_info->remarks;?></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row "></div> 
                        


                        </div>
                    <br>
                        </div>



                    </div>
                </div>
            </div>
        </div>


</form>

<script>
    $(document).on("click", ".goods_received", function (e) {
        e.preventDefault();
        $("#my_form").attr("action", "<?php echo base_url() ?>purchase/goods_received").submit();

    });
	
    $(document).on("click","#edit",function(e){
        e.preventDefault();
         var redirectUrl ='<?php echo base_url(); ?>purchase/add_new';
        // var post_field ='order_id';
         var post_value = "<?php echo $order_id; ?>";
		 window.location.href = redirectUrl+'/'+post_value;
    });
	
	
	$(document).on("click","#confirm",function(e){
        e.preventDefault();
         var redirectUrl ='<?php echo base_url(); ?>purchase/purchase_history';
         var purchase_id = "<?php echo $order_id; ?>";
         var status = 16;
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/update_status',
            type: 'POST',
            data: {purchase_id: purchase_id,status:status},
            success: function (data) {
//                alert(data);
                    window.location.href = redirectUrl;
            }
        });
		

    });
</script>