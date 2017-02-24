<form class="form-horizontal" role="form" method="post" id="my_form" action="<?php echo base_url();?>purchase/update_order/<?php echo $order_id; ?>">
     <input type="hidden" class="main_order_id" name="order_id" value="<?php echo $order_id; ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $title; ?> </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table ">

                            <tbody>

                                <tr>
                                    <th>Vendor</th>
                                    <td><?php echo $order_info->vendor_name;?></td>
                                    <th>Order No.</th>
                                    <td><?php echo $order_info->purchase_code; ?></td>
                                </tr>
                                <tr>
                                    <th>LC No.</th>
                                    <td><?php echo $order_info->lc_number;?></td>
                                    <th>LC Value.</th>
                                    <td><?php echo $order_info->lc_value; ?></td>
                                </tr>
                                <tr>
                                    <th>Bill Of Entry</th>
                                    <td><?php echo $order_info->bill_of_entry;?></td>
                                    <th>Bill Of Leading</th>
                                    <td><?php echo $order_info->bill_of_leading; ?></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td><?php echo $order_info->status_name;?></td>
                                    <th></th>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>   
                        </div>
                        </div>

<div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo "Item List"; ?> </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">

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
                                                    $total = $total+$value['quantity']*$value['purchase_price'];
                                                    ?>
                                                    <tr>
                                                      <td><?php echo $sl++;?></td>
                                                      <td><?php echo $value['product_name'];?></td>
                                                      <td><?php echo $value['quantity'];?></td>
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
                                            <th style="text-align: right;">Total</th>
                                            <th style="text-align: right;"><?php echo number_format($total,2);?></th>

                                        </tr>
                                    </tfoot>
                        </table>   
                        </div>
                        </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo "Others Info"; ?> </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table ">

                            <tbody>

                                <tr>
                                    <th>Due Date</th>
                                    <td><?php echo $order_info->due_date;?></td>
                                    <th>Currency</th>
                                    <td><?php echo $order_info->currency_name; ?></td>
                                </tr>
                                <tr>
                                    <th>Exchange Rate</th>
                                    <td><?php echo $order_info->exchange_rate;?></td>
                                    <th>Taxing Scheme</th>
                                    <td><?php echo $order_info->taxing_scheme; ?></td>
                                </tr>
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
                        <div class="btn-toolbar" style="padding-right: 15px;">
                            <input type="submit" class="btn btn-primary add_item pull-right" name="confirm" value="Confirm">
                            <input type="submit" class="packing btn btn-primary add_item pull-right" name="packing_slip" value="Packing Slip">
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
</script>