<ul class="nav nav-pills" style="margin: 0 0 15px 15px;">
    <li class="active"><a data-toggle="tab" href="#sales_details">Sales Details</a></li>
    <li><a data-toggle="tab" href="#approve_history">Approve History</a></li>
    <li><a data-toggle="tab" href="#chalan_list">Chalan List</a></li>
</ul>

<div class="tab-content">
    <div id="sales_details" class="tab-pane fade in active">
        <form class="form-horizontal" role="form" method="post" id="my_form" action="<?php echo base_url();?>sales/update_order/<?php echo $order_id; ?>">
             <input type="hidden" class="main_order_id" name="order_id" value="<?php echo $order_id; ?>">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="sales_details" class="tab-pane fade in active">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title" style="overflow: hidden;"><?php echo $title; ?> 
                                            <span class="pull-right">
                                                <?php if((@$order_info->sales_status == 10)){
                                                    ?>                                        
                                                    <a class="btn btn-primary" href="<?php echo base_url()."chalan/sales_chalan_form/".$order_id; ?> ">Create Chalan</a>
                                                <?php }else if (($order_info->sales_status == 2)||($order_info->sales_status == 3)){
                                                   ?> <a class="btn btn-primary" href='<?php echo base_url()."sales/add_new/".$order_id; ?>'>Edit</a>
                                                <?php } ?>

                                                   <a class="btn btn-primary" href="<?php echo base_url()."sales/sales_print_view/".$order_id; ?> ">Print</a>
                                            </span>
                                        </h5>
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
                                                        <?php echo get_specification_json_type(array(),"title"); ?>
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
                                                                $ps = json_decode($value['product_details_json'],TRUE);
                                                                $total = $total+$value['quantity']*$value['sales_price'];
                                                                ?>
                                                                <tr>
                                                                  <td><?php echo $sl++;?></td>
                                                                  <td><?php echo $value['product_name'];?></td>
                                                                  <?php echo get_specification_json_type($ps, "value"); ?>
                                                                  <td><?php echo $value['quantity'];?></td>
                                                                  <td style="text-align: right;"><?php echo number_format($value['sales_price_usd'],2);?></td>
                                                                  <td style="text-align: right;"><?php echo number_format($value['sales_price'],2);?></td>
                                                                  <td class="sub_total" style="text-align: right;"><?php echo number_format($value['quantity']*$value['sales_price'],2); ?></td>
                                                                </tr>
                                                            <?php }} ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="<?= ccsbsid(NULL, NULL,(get_specification_json_type(array(),NULL,1)+5)); ?>" style="text-align: right">Total : </th>
                                                        <th colspan="<?= ccsbsid(NULL, NULL,1); ?>" class="total"><?php echo number_format($total,1);?></th>                                      
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
                                    <h3 class="panel-title"><?php echo "Document"; ?> </h3>
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
                                    </div>
                                </div>


                            <!--<div id="payment" class="tab-pane fade">-->
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



                            <?php 
            //debug(approval_comments_access($order_info->sales_code, $this->session->userdata("USER_ID"),"sales_order","sales_code"),1);
                                    //if (($order_info->status == '36') && (purchase_approval_comments_access($order_info->purchase_code, $this->session->userdata("USER_ID")))) { 
                                    if (($order_info->sales_status == '3') && (approval_comments_access($order_info->sales_code, $this->session->userdata("USER_ID"),"sales_order","sales_code"))) { 
                                        ?>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Approve Comment</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="comment_block"></div>
                                                <div class="row "></div>                                
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <div class="col-lg-7">
                                                            <textarea style="width: 600px;" class="approve_comment"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                        <button style="margin-left: 10px;" id="" class="btn btn-primary approve_submit pull-right" name="" value="">Approve</button>
                                        <button  id="" class="btn btn-danger decline_submit pull-right" name="" value="">Decline</button>
                                    <?php } ?>

                            <?php
                                if($order_info->sales_status == 2)
                                {
                                ?>
                                    <div class="btn-toolbar pull-right" style="padding-right: 15px;">
                                        <a class="btn btn-primary send_for_approval" purchase_code="<?php echo $order_info->sales_code;?>" href=''>Send for approval</a>
                                    </div>
                                <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="approve_history" class="tab-pane fade">
        <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5 class="panel-title">Approved  List</h5>
            </div>
            <div class="panel-body">
                <table class="table table-striped dataTable approve_history">
                    <thead>
                        <tr>
                            <th>#SL</th>
                            <th>Sales Code</th>
                            <th>Approved Date</th>
                            <th>Approved By</th>
                            <th>Reliever To</th>
                            <th>Comments</th>
                            <th>Action Type</th>
                            <th>Delegation Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $sl = 1;
                                if (!empty($approve_history)) {
                                    foreach ($approve_history as $key => $value) {
                                        ?>
                                        <tr>
                                            <td><?php echo $sl++; ?></td>
                                            <td><?php echo $value['ref_no']; ?></td>
                                            <td><?php echo date('Y-m-d',strtotime($value['created'])); ?></td>
                                            <td><?php echo $value['username']; ?></td>
                                            <td><?php echo $value['username']; ?></td>
                                            <td><?php echo $value['comment']; ?></td>
                                            <td><?php echo $value['action_type']; ?></td>
                                            <td><?php echo date("Y-m-d",strtotime($value['delegation_start'])) ; ?></td>
                                        </tr>   

                                    <?php }
                                } ?>
                    </tbody>
                </table>
             </div>
        </div>
        </div>
    </div>
    
    <div id="chalan_list" class="tab-pane fade">
            <div class="panel-body">
           <div class="panel panel-default">
               <div class="panel-heading">
                   <h5 class="panel-title"><?php echo label_html(CHALAN_LIST, 'CHALAN_LIST'); ?></h5>
               </div>
                        <div class="panel-body">
                            <div class="text-center order_block"></div>
                            <div class="row">
                                <table class="table table-striped dataTable" id="chalan_list_1">
                                    <thead>
                                    <th>Chalan Code</th>
                                    <th>Delivery From</th>
                                    <th>Delivery To</th>
                                    <th>Delivery Date</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if($chalan_info != ""){
                                        foreach ($chalan_info as $k=>$v){ ?>
                                        <tr>
                                            <td><?php echo $v['chalan_code']; ?></td>
                                            <td><?php echo $v['frwarehouse']; ?></td>
                                            <td><?php echo $v['dtowarehouse']; ?></td>
                                            <td><?php echo $v['delivery_date']; ?></td>
                                            <td><a href="<?php echo base_url() . 'sales/sales_chalan_details_info/'.$v['chalan_id']; ?>"><input type="button" class="btn btn-primary" value="View Details"></a></td>
                                        </tr>
                                        
                                        <?php
                                            }
                                        }
                                   ?>
                                    </tbody>
                                </table>     
               
                         
                            </div>
                    
                             </div> <!--Panel body close -->
                        <br>
           </div> <!--Panel div close -->
       </div>
    </div>
    
</div>
<script>

$(document).ready(function(){
    $('#sales_order_id').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
        "searching": false
    });
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
    
    $(document).on("click", ".send_for_approval", function (e) {
        e.preventDefault();
        var sales_id = "<?php echo $order_id; ?>";
        var sales_code = $(this).attr("purchase_code");
        $.ajax({
            url: '<?php echo base_url(); ?>sales/send_for_approval',
            type: 'POST',
            data: {sales_id:sales_id,sales_code: sales_code},
            success: function (data) {
                location.reload();
            }
        });
    });
    
    
    $(document).on("click",".approve_submit", function (e) {
        e.preventDefault();
        var comments = $('.approve_comment').val();
        
        var ref_id = "<?php echo $order_info->sales_code; ?>";
        if(comments)
        {
            $.ajax({
                url: '<?php echo base_url(); ?>common_controller/approve_delegation_action',
                type: 'POST',
                data: {ref_id:ref_id,comments:comments},
                success: function (data) {
                   if(data == true)
                   {
                       window.location.href = "<?php echo base_url(); ?>common_controller/waiting_approval_list/sales";
                   }
                }
            });
        }
        else
        {
            var htm = '<div class="invalid alert alert-danger">';
            htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            htm += 'Comments Field can not be empty.';
            htm += '</div>';
            $('.comment_block').html(htm);
        }
        
    });
</script>
