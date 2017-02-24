<!--<form class="form-horizontal" role="form" method="post" id="my_form" action="<?php echo base_url();?>sales/update_order/<?php echo $order_id; ?>">
     <input type="hidden" class="main_order_id" name="order_id" value="<?php //echo $order_id; ?>">-->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                
                <!-- if requirement want to tab then this part will be comments out.-->				
                <!--<ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a data-toggle="tab" href="#sales_details">Quotation Details</a></li>
                    <li role="presentation"><a data-toggle="tab" href="#payment">Remarks History</a></li>
                </ul>-->
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
                                    <td><?php echo $quotation_details->customer_name;?></td>
                                    <th>Quotation Code.</th>
                                    <td><?php echo $quotation_details->quotation_code; ?></td>
                                </tr>
                                <tr>
                                    <th>Sales Person</th>
                                    <td><?php echo $quotation_details->username;?></td>
                                    <th>Order  Date</th>
                                    <td><?php echo $quotation_details->date; ?></td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td><?php echo $quotation_details->address;?></td>
                                    <th>Status</th>
                                    <td><?php echo $quotation_details->status_name;?></td>
                                    
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
                                                if(!empty($item_list)){
                                                foreach($item_list as $key=>$value){
                                                    $total = $total+$value['quantity']*$value['quotation_price'];
                                                    ?>
                                                    <tr>
                                                      <td><?php echo $sl++;?></td>
                                                      <td><?php echo $value['product_name'];?></td>
                                                      <td><?php echo $value['quantity'];?></td>
                                                      <td style="text-align: right;"><?php echo $value['quotation_price'];?></td>
                                                      <td class="sub_total" style="text-align: right;"><?php echo number_format($value['quantity']*$value['quotation_price'],2); ?></td>
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
                        <h3 class="panel-title"><?php echo "Remarks History"; ?> </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                                <thead class="thead-default">
                                        <tr>
                                            <th>User</th>
                                            <th>Remarks</th>
                                            <th>Date</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
                                        if(!empty($remarks_history)){
                                        foreach($remarks_history as $key=>$value){ ?>
                                            <tr>
                                              <td><?php echo $value['username'];?></td>
                                              <td><?php echo $value['comments'];?></td>
                                              <td><?php echo $value['date'];?></td>
                                              </tr>
                                        <?php }} 
                                    ?>
                                    </tbody>
                                    
                        </table>
                        <div class="btn-toolbar pull-right" style="padding-right: 15px;">
                            <?php //echo $ifremarked; ?>
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
</div>
        
<!--</form>-->
<!--<script>

$(document).ready(function(){
    $('#sales_order_id').DataTable();
});

</script>
<script>
    $(document).on("click","#edit",function(e){
        e.preventDefault();
        var redirectUrl ='<?php //echo base_url(); ?>sales/add_new';
        var post_value = "<?php //echo $order_id; ?>";
        window.location.href = redirectUrl+'/'+post_value;
    });
	
	
    $(document).on("click","#confirm",function(e){
        e.preventDefault();
         var redirectUrl ='<?php //echo base_url(); ?>sales/sales_order_history';
         var sales_order_id = "<?php //echo $order_id; ?>";
         var status = 3;
        $.ajax({
            url: '<?php //echo base_url(); ?>sales/update_status',
            type: 'POST',
            data: {sales_order_id: sales_order_id,status:status},
            success: function (data) {
                    window.location.href = redirectUrl;
            }
        });
		

    });
	
	$(document).on('click','#approve',function(){
        var redirectUrl ='<?php //echo base_url(); ?>sales/available_product_list';
        var post_value = "<?php //echo $order_id; ?>";
        window.location.href = redirectUrl+'/'+post_value;
    });
</script>-->
