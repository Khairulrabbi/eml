<form class="form-horizontal" role="form" method="post" id="my_form" action="<?php echo base_url();?>sales/update_order/<?php echo $order_id; ?>">
     <input type="hidden" class="main_order_id" name="order_id" value="<?php echo $order_id; ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
				<ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a data-toggle="tab" href="#sales_details">Sales Details</a></li>
                    <li role="presentation"><a data-toggle="tab" href="#payment">Payment History</a></li>
                </ul>
				<div class="panel panel-default">
				<div id="collapseOne" class="panel-collapse collapse in">
				<div class="panel-body tab-content">
				<div id="sales_details" class="tab-pane fade in active">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $title; ?> </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">

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
                        <table class="table">

                                <thead class="thead-default">
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
                        <h3 class="panel-title"><?php echo "Cost Component"; ?> </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#Sl</th>
                                    <th>Cost Component Name</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                        $sl2=1;
                                        $total2 = 0;
                                        if(!empty($cost_component)){
                                        foreach($cost_component as $key=>$value){
                                            $total2 = $total2+$value['amount'];
                                            ?>
                                            <tr>
                                              <td><?php echo $sl2++;?></td>
                                              <td><?php echo $value['cost_component_name'];?></td>
                                              <td><?php echo $value['amount'];?></td>
                                            </tr>
                                        <?php }} ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th style="text-align: right;">Total</th>
                                    <th style=""><?php echo number_format($total2,2);?></th>

                                </tr>
                            </tfoot>
                        </table>
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
                                              <td><?php echo $sl2++;?></td>
                                              <td><?php echo $value['sales_supporting_doc_name'];?></td>
                                              <td><?php echo $value['sales_supporting_doc_url'];?></td>
                                            </tr>
                                        <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo "Others Info"; ?> </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">

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
                        <div class="row "></div>
                        
                        <?php if(@$order_info->sales_status){?>
                            <div class="btn-toolbar pull-right" style="padding-right: 15px;">
                                <input id="approve" class="btn btn-primary btn-sm add_item" name="approve" value="Approve">
                            </div> 
                        <?php }else{?>
                        <div class="btn-toolbar pull-right" style="padding-right: 15px;">
                            <input id="edit" class="btn btn-primary btn-sm add_item" name="Edit" value="Edit">
                            <input  id="confirm" class="btn btn-primary btn-sm add_item" name="confirm" value="Confirm">
                        </div>  
                        <?php } ?>  
                        
                        </div>
                    <br>
                        </div>

                       </div> 
						<div id="payment" class="tab-pane fade">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo "Payment History"; ?> </h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer" id="sales_order_id">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Transaction Details</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2016-5-26</td>
                                        <td>Other Cost</td>
                                        <td>5000</td>
                                    </tr>
                                    <tr>
                                        <td>2016-5-28</td>
                                        <td>Other Cost</td>
                                        <td>500</td>
                                    </tr>
                                    <tr>
                                        <td>2016-5-30</td>
                                        <td>Products Price</td>
                                        <td>12000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>    
                    
                </div>
                </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
        
</form>
<script>

$(document).ready(function(){
    $('#sales_order_id').DataTable();
});

</script>
<script>
    $(document).on("click","#edit",function(e){
        e.preventDefault();
        var redirectUrl ='<?php echo base_url(); ?>sales/add_new';
        var post_value = "<?php echo $order_id; ?>";
        window.location.href = redirectUrl+'/'+post_value;
    });
	
	
    $(document).on("click","#confirm",function(e){
        e.preventDefault();
         var redirectUrl ='<?php echo base_url(); ?>sales/sales_order_history';
         var sales_order_id = "<?php echo $order_id; ?>";
         var status = 3;
        $.ajax({
            url: '<?php echo base_url(); ?>sales/update_status',
            type: 'POST',
            data: {sales_order_id: sales_order_id,status:status},
            success: function (data) {
//                alert(data);
                    window.location.href = redirectUrl;
            }
        });
		

    });
	
	$(document).on('click','#approve',function(){
        var redirectUrl ='<?php echo base_url(); ?>sales/available_product_list';
        var post_value = "<?php echo $order_id; ?>";
        window.location.href = redirectUrl+'/'+post_value;
    });
</script>
