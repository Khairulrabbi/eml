<form class="form-horizontal" role="form" method="post" id="my_form" action="<?php echo base_url();?>purchase/update_order/<?php echo $order_id; ?>">
     <input type="hidden" class="main_order_id" name="order_id" value="<?php echo $order_id; ?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $title; ?> </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table ">

                            <tbody>

                                <tr>
                                    <th>Vendor</th>
                                    <td><?php echo $order_info->vendor_name;?></td>
                                    <th>LC No.</th>
                                    <td><?php echo $order_info->lc_number;?></td>
                                    <th>Number of Days</th>
                                    <td><?php echo $order_info->lc_settlement_duration;?></td>
                                    
                                </tr>
                                <tr>
                                    <th>PO Number</th>
                                    <td><?php echo $order_info->purchase_code; ?></td>
                                    <th>LC Value.</th>
                                    <td><?php echo number_format($order_info->lc_value,2); ?></td>
                                    <th>LC Settlement Date</th>
                                    <td><?php echo $order_info->lc_settlement_date; ?></td>
                                </tr>
                                <tr>
                                    <th>PO Date</th>
                                    <td><?php echo $order_info->order_date;?></td>
                                    <th>Bill Of Entry</th>
                                    <td><?php echo $order_info->bill_of_entry;?></td>
                                    <th>Currency</th>
                                    <td><?php echo $order_info->currency_name; ?></td>
                                    
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td><?php echo $order_info->status_name;?></td>
                                    <th>Bill Of Lading</th>
                                    <td><?php echo $order_info->bill_of_lading; ?></td>
                                    <th>Exchange Rate</th>
                                    <td><?php echo $order_info->exchange_rate;?></td>
                                </tr>
                            </tbody>
                        </table>   
                        </div>
                        </div>

<div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo "Item List"; ?> </h3>
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
                                            <th style="text-align: right;">Price</th>
                                            <th style="text-align: right;">Total</th>

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
                                                      <td style="text-align: right;"><?php echo number_format($value['purchase_price'],2);?></td>
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
                                        <th>Amount</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sl=1;
									$cost_total = 0;
                                    if(!empty($cost_component)){
                                       foreach($cost_component as $key=>$value){
										   $cost_total = $cost_total+$value['total_cost'];
										   ?>
                                        <tr>
                                           <td><?php echo $sl++;?></td>
                                            <td><?php echo $value['cost_component_name'];?></td>
                                            <td><?php echo $value['total_cost'];?></td> 
                                        </tr>   
                                       
                                    <?php }}?>
                                </tbody>
								<tfoot>
                                    <tr>
                                    <th></th>
                                    <th style="text-align: right;">Total: </th>
                                    <th style=""><?php echo number_format($cost_total,2);?></th>

                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
				<div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo "Doument"; ?> </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#Sl</th>
                                    <th>Document Name</th>
                                    <th>URL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                        $sl3=1;
                                        if(!empty($support_doc)){
                                        foreach($support_doc as $key=>$value){
                                            ?>
                                            <tr>
                                              <td><?php echo $sl3;?></td>
                                              <td><?php echo $value['purchase_supporting_doc_name'];?></td>
                                              <td><a target="_blank" href='<?php echo base_url().$value['purchase_supporting_doc_url'];?>' > <?php echo $value['purchase_supporting_doc_url'];?> </a></td>
                                            </tr>
                                        <?php $sl3++;}} ?>
                            </tbody>
                        </table>
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
                        
						<div class="btn-toolbar pull-right" style="padding-right: 15px;">
                            <?php if( $order_info->status=='5'){?>
                            <button id="edit" class="btn btn-primary add_item" name="Edit" value="Edit">Edit</button>
                            <button  id="confirm" class="btn btn-primary add_item" name="confirm" value="Confirm">Confirm</button>
                             <?php }
                                 elseif ($order_info->status=='6' OR $order_info->status=='14' ) {?>
                                <button type="submit" class="packing btn btn-primary btn-sm add_item" name="packing_slip" value="Packing Slip">Packing Slip</button>
                             <?php }?>
                        </div> 
                        


                        </div>
                    <br>
                        </div>



                    </div>
                </div>
            </div>
        </div>


</form>

<script>
    $(document).on("click", ".packing", function (e) {
        e.preventDefault();
        $("#my_form").attr("action", "<?php echo base_url() ?>purchase/packing_slip").submit();

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
		 var purchase_type = "<?php echo $order_info->purchase_type_id; ?>";
		 var status;
         if(purchase_type == 1){
            status = 16;
         }else{
            status = 6;
         }
		$.ajax({
            url: '<?php echo base_url(); ?>purchase/update_status',
            type: 'POST',
            data: {purchase_id: purchase_id,status:status},
            success: function (data) {
			   window.location.href = redirectUrl;
            }
        });
		

    });
</script>