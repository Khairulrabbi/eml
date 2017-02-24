<form class="form-horizontal" role="form" method="post" id="my_form" action="<?php echo base_url();?>purchase/lc_settlement_list">
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
                                    <th>PO Number</th>
                                    <td><?php echo $order_info->purchase_code; ?></td>
                                    <th>Order Date</th>
                                    <td><?php echo $order_info->order_date;?></td>
                                </tr>
                                
                            </tbody>
                        </table>   
                        </div>
                        </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo "Settlement Datails"; ?> </h3>
                    </div>
                    <div class="panel-body">
                        <div class="row"></div>
                        
                       <div class="col-lg-8">
                            <div class="form-group col-lg-12">
                               <!--<label for="shipping_method_id" class="col-lg-5 control-label ">Products Cost</label>-->
                               <div class="col-lg-8 pull-right">
                                   <table class="table">
                                      <thead>
                                           <tr>
                                               <th>Name</th>
                                               <th>Amount</th>
                                           </tr>
                                       </thead> 
                                       <tbody>
                                           <tr>
                                               <td>Products Cost</td>
                                               <td><?php echo $product_cost; ?></td>
                                           </tr>
										   <tr>
                                               <td>Other Cost Component</td>
                                               <td></td>
                                           </tr>
										   <?php $total = 0; foreach ($cost_component as $key=>$val){
                                           if($val > 0 ){
											   ?>
										   <tr>
											   <td><?php echo $key;?></td>
											   <td><?php echo $val;?></td>
										   </tr>
                                        <?php $total = $total+$val;}} ?>
                                       </tbody>
									   <tfoot>
											<tr>
												<th>Total</th>
												<th><?php echo $total+$product_cost ?></th>
											</tr>
									   </tfoot>
                                   </table>
                                   
                               </div>
							   <div class="row"></div>
									<button type="submit" class="btn btn-primary text-center" style="margin-left: 656px;">Confirm</button>
                           </div>
                       </div>
                        
                    </div>
                </div>
                
                
                    </div>
                </div>
            </div>
        </div>


</form>

