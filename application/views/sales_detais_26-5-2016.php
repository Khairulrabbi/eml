<form class="form-horizontal" role="form" method="post" id="my_form" action="<?php echo base_url();?>sales/update_order/<?php echo $order_id; ?>">
     <input type="hidden" class="main_order_id" name="order_id" value="<?php echo $order_id; ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $title; ?> </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">

                            <tbody>

                                <tr>
                                    <th>Customer name</th>
                                    <td><?php echo $order_info->customer_name;?></td>
                                    <th>Order No.</th>
                                    <td><?php echo $order_info->sales_code; ?></td>
                                </tr>
                                <tr>
                                    <th>Attention</th>
                                    <td><?php echo @$order_info->attention;?></td>
                                    <th>Order  Date</th>
                                    <td><?php echo $order_info->order_date; ?></td>
                                </tr>
                                <tr>
                                    <th>Bill to</th>
                                    <td><?php echo $order_info->bill_to;?></td>
                                    <th>Sales Person</th>
                                    <td><?php echo $order_info->sales_person_name; ?></td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td><?php echo @$order_info->address;?></td>
                                    <th>Status</th>
                                    <td><?php echo @$order_info->status_name;?></td>
                                    
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
                        <table class="table table-bordered">

                                <thead>
                                        <tr>
                                            <th>#Sl</th>
                                            <th>Product Name</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                                $sl=1;
                                                $total = 0;
                                                if(!empty($selected_product)){
                                                foreach($selected_product as $key=>$value){
                                                    $total = $total+$value['quantity']*$value['sales_price'];
                                                    ?>
                                                    <tr>
                                                      <td><?php echo $sl++;?></td>
                                                      <td><?php echo $value['product_name'];?></td>
                                                      <td><?php echo $value['quantity'];?></td>
                                                      <td style="text-align: right;"><?php echo $value['sales_price'];?></td>
                                                      <td class="sub_total" style="text-align: right;"><?php echo number_format($value['quantity']*$value['sales_price'],2); ?></td>
                                                    </tr>
                                                <?php }} ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
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
                        <h3 class="panel-title"><?php echo "Others Info"; ?> </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">

                            <tbody>

                                <tr>
                                    <th>Delivery contact person</th>
                                    <td><?php echo @$order_info->delivery_contact_person;?></td>
                                    <th>Delivery Contact number</th>
                                    <td><?php echo @$order_info->delivery_contact_number; ?></td>
                                </tr>
                                <tr>
                                    <th>Delivery mode</th>
                                    <td><?php  echo @$order_info->delivery_mode_name; ?></td>
                                    <th>Delivery Cost</th>
                                    <td><?php echo @$order_info->delivery_cost; ?></td>
                                </tr>
                                <tr>
                                    <th>Delivery Details</th>
                                    <td><?php  echo @$order_info->delivery_details; ?></td>
                                    <th>Payment Type</th>
                                    <td><?php  echo $order_info->payment_type_name; ?></td>
                                </tr>
                                <tr>
                                    <th>Delivery Address</th>
                                    <td><?php echo @$order_info->delivery_address;?></td>
                                    <th>Remarks</th>
                                    <td><?php echo @$order_info->remarks;?></td>
                                </tr>
                            </tbody>
                        </table> 
                        <input type="submit" name="confirm" value="Confirm">
                        
                        </div>
                    <br>
                        </div>

                        

                    </div>
                </div>
            </div>
        </div>

        
</form>
