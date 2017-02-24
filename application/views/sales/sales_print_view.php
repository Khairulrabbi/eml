<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">Sales Order Details </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped dataTable " id="print_view">
            <tbody>
                    <tr>
                        <th>Customer name</th>
                        <td><?php echo $order_info->customer_name;?></td>
                        <th>Order No.</th>
                        <td><?php echo $order_info->sales_code; ?></td>
                    </tr>
                    <tr>
                        <th>Customer Mobile</th>
                        <td><?php echo @$order_info->mobile_number;?></td>
                        <th>Order  Date</th>
                        <td><?php echo $order_info->order_date; ?></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><?php echo @$order_info->customerAddress;?></td>
                        <th>Attention</th>
                        <td><?php echo @$order_info->attention;?></td>                                                                       
                    </tr>
                    <tr>
                        <th>Contact Person</th>
                        <td><?php echo @$order_info->contact_person;?></td>
                        <th>Bill to</th>
                        <td><?php echo $order_info->bill_to;?></td>

                    </tr>
                    <tr>
                        <th>Credit Limit</th>
                        <td><?php echo number_format(@$order_info->credit_limit,2);?></td>
                        <th>Sales Person</th>
                        <td><?php echo $order_info->sales_person_name; ?></td>                                    
                    </tr>

                    <tr>
                        <th>Due</th>
                        <td><?php echo number_format(@$due,2);?></td>
                        <th>Delivery Mode</th>
                        <td><?php echo @$order_info->delivery_mode_name;?></td>
                    </tr>
                    <tr>
                        <th>Delivery Address</th>
                        <td><?php echo @$order_info->delivery_address;?></td>
                        <th>Exchange Rate</th>
                        <td><?php echo @$order_info->exchange_rate;?></td>                                  
                    </tr>
                    <tr>
                        <th>Delivery Details</th>
                        <td><?php echo @$order_info->delivery_details;?></td>
                        <th>Status</th>
                        <td><?php echo @$order_info->status_name;?></td>                                  
                    </tr>
                </tbody>
      </table>
    </div>
</div>  
<div class="panel panel-default">
    <div class="panel-heading">
        <h5 class="panel-title"><?php echo "Item List"; ?> </h5>
    </div>
    <div class="panel-body">
        <table class="table table-striped dataTable table-bordered">
            <thead>
                    <tr>
                        <th>#Sl</th>
                        <th>Product Name</th>
                        <?php echo get_specification_json_type(array(),"title"); ?>
                        <th>Qty</th>
                        <th>Price(USD)</th>
                        <th>Price(BDT)</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                            $sl=1;
                            $total = 0;
                            if(!empty($selected_product)){
                            foreach($selected_product as $key=>$value){
                                $ps = json_decode($value['product_details_json'],TRUE);
                                $total = $total+$value['quantity']*$value['sales_price'];
                                ?>
                                <tr>
                                    <td><?php echo $sl++;?></td>
                                    <td><?php echo $value['product_name'];?></td>
                                    <?php echo get_specification_json_type($ps, "value"); ?>
                                    <td><?php echo $value['quantity'];?></td>
                                    <td><?php echo number_format($value['sales_price_usd'],2);?></td>
                                    <td><?php echo number_format($value['sales_price'],2);?></td>
                                    <td class="sub_total"><?php echo number_format($value['quantity']*$value['sales_price'],2); ?></td>
                                </tr>
                            <?php }} ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="<?= ccsbsid(NULL, NULL,(get_specification_json_type(array(),NULL,1)+4)); ?>" style="text-align: right">Total : </th>
                        <th colspan="<?= ccsbsid(NULL, NULL,2); ?>" class="total"><?php echo number_format($total,2);?></th>                                      
                    </tr>
                    <tr>
                        <th colspan="<?= ccsbsid(NULL, NULL,(get_specification_json_type(array(),NULL,1)+6)); ?>" class="total_inword" style="text-align: right;">
                        Total In Word : <?php echo convert_number_to_words($total); ?>
                        </th>
                    </tr>
                </tfoot>
        </table>   
    </div>
</div>

<script>
$(document).ready(function() {
    $('#print_view').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
        "bFilter": false
    });
});
</script>

<style>
    th{
        padding: 4px;
    }
</style>

