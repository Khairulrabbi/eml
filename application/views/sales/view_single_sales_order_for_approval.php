<!--<form class="form-horizontal" role="form" method="post" id="my_form" action="<?php //echo base_url();?>sales/update_order/<?php //echo $order_id; ?>">-->
     <input type="hidden" class="main_order_id" name="order_id" value="<?php echo $order_id; ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!--if requirement wants tab then the following line will be comments out-->
<!--                <ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a data-toggle="tab" href="#sales_details">Sales Details</a></li>
                    <li role="presentation"><a data-toggle="tab" href="#payment">Approve By Me</a></li>
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
                        <h3 class="panel-title"><?php echo "Item List"; ?> </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">

                                <thead class="thead-default">
                                        <tr>
                                            <th>#Sl</th>
                                            <th>Product Name</th>
                                            <th>Qty</th>
                                            <th style="text-align: right;">Price(USD)</th>
                                            <th style="text-align: right;">Price(BDT)</th>
                                            <th style="text-align: right;">Total</th>
                                            
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
                                                      <td style="text-align: right;"><?php echo number_format($value['sales_price_usd'],2);?></td>
                                                      <td style="text-align: right;"><?php echo number_format($value['sales_price'],2);?></td>
                                                      <td class="sub_total" style="text-align: right;"><?php echo number_format($value['quantity']*$value['sales_price'],2); ?></td>
                                                    </tr>
                                                <?php }} ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th style="text-align: right;">Total</th>
                                            <th style="text-align: right;"><?php echo number_format($total,2);?></th>                                            
                                        </tr>
                                        <tr>
                                            <th colspan="6" style="text-align: right;">Total In Word : <?php echo convert_number_to_words($total); ?></th>                                           
                                        </tr>
                                    </tfoot>
                        </table>  
                        </div>
                        </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo "Additional Charges"; ?> </h3>
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
                                <tr>
                                    <th colspan="2" style="text-align: right;">Total In Word : <?php echo convert_number_to_words($total2); ?></th>
                                    <th></th>
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
                        
                        <?php //if(@$order_info->sales_status){?>
<!--                            <div class="btn-toolbar pull-right" style="padding-right: 15px;">
                                <input id="approve" class="btn btn-primary btn-sm add_item" name="approve" value="Approve">
                            </div>-->
                        <?php //}else{?>
<!--                        <div class="btn-toolbar pull-right" style="padding-right: 15px;">
                            <input id="edit" class="btn btn-primary btn-sm add_item" name="Edit" value="Edit">
                            <input  id="confirm" class="btn btn-primary btn-sm add_item" name="confirm" value="Confirm">
                        </div>  -->
                        <?php //} ?>  
                        

                        <?php
                            $ap = $this->sales_model->ifsalesorderapproved($order_id);
                            if($ap == 1)
                            {
                                ?>
                                    <div class="btn-toolbar pull-right" style="padding-right: 15px;">
                                        <a class="btn btn-primary" href='<?php echo base_url()."sales/add_new/".$order_id; ?>'>Edit</a>
                                    </div>
                                <?php
                            }
                            else if($ap == 2)
                            {
                                ?>
                                    <div class="btn-toolbar pull-right" style="padding-right: 15px;">
                                        <span style="color:red;">Waiting for Approve</span> <a href='<?php echo base_url()."sales/add_new/".$order_id; ?>'>Edit</a>
                                    </div>
                                <?php
                            }
                            else if($ap == 3)
                            {
                                ?>
                                    <div class="btn-toolbar pull-right" style="padding-right: 15px;">
                                        <span style="color:red;">Waiting for Approve</span>
                                    </div>
                                <?php
                            }
                            else if($ap == 4)
                            {
                                ?>
                                    <div class="btn-toolbar pull-right" style="padding-right: 15px;">
                                        <span style="color:green;">Approved</span>
                                    </div>
                                <?php
                            }
                        ?>

                        </div>
                    <br>
                        </div>

                       </div> 
                    <!--<div id="payment" class="tab-pane fade">-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo "Approve by Me"; ?> </h3>
                        </div>
                        <div class="panel-body">
                            <div class="text-center quotation_order_block"></div>
                            <form id="myapprovalform" method="post" action="">
                                <div class="form-group">
                                    <label for="comment">Comment:</label>
                                    <input type="hidden" name="order_id" value="<?php echo $order_id ?>">
                                    <textarea name="comments" class="form-control" rows="5" id="comment"><?php echo $mycomments->comments; ?></textarea>
                                </div>
                                <input class="btn btn-primary" type="submit" id="approval_submit" value="Approve">
                            </form>
                        </div>
                    </div>    
                    
<!--                </div>-->
                </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
        
<!--</form>-->
<script>

$(document).ready(function(){
    $('#sales_order_id').DataTable();
});

</script>


<script>
    $(document).on("click","#approval_submit",function(e){
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>sales/personal_sales_approval_submit',
            type: 'POST',
            data: $('#myapprovalform').serialize(),
            success: function (data) {
                //alert(data);
                if(data == true)
                {
                    location.reload();
//                    var htm ='<div class="invalid alert alert-success">';
//                    htm += 'Save Success..';
//                    htm +='</div>';
//                    $('.quotation_order_block').html(htm);
//                    $('.invalid').slideUp(3000);
                }
                else
                {
                    var htm ='<div class="invalid alert alert-danger">';
                    htm += data;
                    htm +='</div>';
                    $('.quotation_order_block').html(htm);
                    //$('.invalid').slideUp(4000); 
                }
            }
        });
    });
</script>
