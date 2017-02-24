<form class="form-horizontal" role="form" method="post" id="my_form" action="<?php echo base_url();?>purchase/save_settelment">
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
                        <h3 class="panel-title"><?php echo "Products List"; ?> </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">

                                <thead>
                                        <tr>
                                            <th>#Sl</th>
                                            <th>Product Name</th>
                                            <th>Descriptions</th>
                                            <th>Qty</th>
                                            <th>Received Products</th>
                                            <th style="text-align: right;">Price</th>
                                            <th style="text-align: right;width: 10%">Total</th>
                                            <th style="width: 10%"></th>

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
                                                      <td></td>
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
                                            <th style="text-align: right;"><input class="form-control text-right" readonly="" value="<?php echo number_format($total,2);?>"></th>
                                            <th style=""><input name="product_cost" class="form-control text-right product_price_pay" value="0"></th>
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
                                        <th style="text-align: right;">Amount</th>
                                        <th style="text-align: right;">Paid</th>
                                        <th></th>

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
                                            <td>
                                                <?php echo $value['cost_component_name'];?>
                                                <input type="hidden" name="cost_component_name[]" value="<?php echo $value['cost_component_name'];?>">
                                            </td>
                                            <td><input class="form-control text-right" readonly="" value="<?php echo number_format($value['total_cost'],2);?>"></td> 
                                            <td><input class="form-control text-right " readonly="" value="<?php echo number_format(0,2);?>"></td>
                                            <td><input name="cost_compnent_payment[]" class="form-control text-right cost_pay" value="0"></td>
                                        </tr>   
                                       
                                    <?php }}?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <th></th>
                                    <th style="text-align: right;">Total: </th>
                                    <th style=""><input class="form-control text-right" readonly="" value="<?php echo number_format($cost_total,2);?>"></th>
                                    <th style="text-align: right;">Total Other: </th>
                                    <th style=""><input class="form-control text-right oters_total" readonly="" value="0"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo "Total"; ?> </h3>
                    </div>
                    <div class="panel-body">
                        <div class="field_wrapper">
                            <div class="row"></div>
                            <div class="col-lg-12 text-center">
                                <div class="col-lg-5 text-right">
                                    <h4>Total Settlement Value </h4>
                                </div>
                                <div class="col-lg-3">
                                    <input class="form-control gr_total text-right col-lg-4" readonly="" value="">
                                </div>
                            </div>
                            <div class="row"></div>
                            <button type="submit" class="btn btn-primary text-center" style="margin-left: 656px;">Settlement</button>
                        </div>
                    </div>
                </div>
                    </div>
                </div>
            </div>
        </div>


</form>

<script>
    function calculation() {
        var grand_total = 0;
        $('.product_price_pay').each(function(){
            var product_price_pay = $(this).val();
             var gtotal_string = product_price_pay.replace(",", "");
             var grand = parseFloat(gtotal_string).toFixed(2);
             grand_total = parseFloat(parseFloat(grand_total) + parseFloat(grand)).toFixed(2);
        });
        var sum = 0;
        $(".cost_pay").each(function () {
            var subtotal_text = $(this).val();
            var subtotal_string = subtotal_text.replace(",", "");
            var sub_total = parseFloat(subtotal_string).toFixed(2);
            sum = parseFloat(parseFloat(sum) + parseFloat(sub_total)).toFixed(2);

        });
        $(".oters_total").val(sum);
        
        grand_total = parseFloat(parseFloat(grand_total)+parseFloat(sum)).toFixed(2);
        $('.gr_total').val(grand_total);
    }
    
    $(document).on('input','.cost_pay ',function(){
        calculation();
    })
    $(document).on('input','.product_price_pay ',function(){
        calculation();
    })
</script>