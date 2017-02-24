<div class="panel panel-default"> 
    <div class="panel-heading"> 
        <h3 class="panel-title">Sales Order Details</h3> 
    </div> 
    <div class="panel-body"> 
        <table class="table"> 
        <tbody>
            <tr> 
                <th>Customer name</th> 
                <td> <?php echo $order_info->customer_name; ?></td> 
                <th>Order No.</th> 
                <td> <?php echo $order_info->sales_code; ?></td> 
            </tr> 
            <tr> 
                <th>Attention</th> 
                <td> <?php echo @$order_info->attention; ?></td> 
                <th>Order  Date</th> 
                <td> <?php echo $order_info->order_date; ?></td> 
            </tr> 
            <tr> 
                <th>Bill to</th> 
                <td> <?php echo $order_info->bill_to; ?></td> 
                <th>Sales Person</th> 
                <td> <?php echo $order_info->sales_person_name; ?></td> 
            </tr> 
            <tr> 
                <th>Address</th> 
                <td> <?php echo @$order_info->address; ?></td> 
                <th>Status</th> 
                <td> <?php echo @$order_info->status_name; ?></td>
            </tr> 
         </tbody> 
         </table> 
     </div> 
 </div> 

        
<div class="panel panel-default"> 
    <div class="panel-heading">         
        <h3 class="panel-title">Item List </h3> 
    </div> 
    <div class="panel-body"> 
    <table class="table"> 
    <thead class="thead-default"> 
        <tr> 
            <th>#Sl</th> 
            <th>P.Name</th> 
            <th>P.Code</th> 
            <th>W.Start</th> 
            <th>W.Period</th> 
            <th>W.End</th> 
            <th>W.Left</th> 
            <th>C.W.Start</th> 
            <th>C.W.Period</th> 
            <th>C.W.End</th> 
            <th>C.W.Left</th> 
            <th>Service</th> 
            <!--//        only for ticket page-->
            <?php
            if(isset($_POST['for_ticket']))
            { ?>
                <th>Action</th> 
            <?php }
            ?>
            <!--//        end only for ticket-->
        </tr> 
    </thead> 
    <tbody>  
        <?php 
       $sl=1;
       $total = 0;                                                
       if(!empty($selected_product)){
       foreach($selected_product->result() as $key=>$value)
       {
           $service = $this->db->query("SELECT COUNT(product_code) AS service FROM ticket WHERE product_code='".$value->product_code."'")->row();
           $warranty_left = $this->common_model->warranty_count('days',$value->warranty_expired_on);
           $customer_warranty_left = $this->common_model->warranty_count('days',$value->customer_warranty_end_date);
           ?>
            <tr> 
            <td> <?php echo $sl++; ?></td> 
            <td> <?php echo $value->product_name; ?></td> 
            <td> <?php echo $value->product_code; ?></td> 
            <td> <?php echo $value->warranty_start_date; ?></td> 
            <td> <?php echo $value->warranty_period; ?> Month</td> 
            <td> <?php echo $value->warranty_expired_on; ?></td> 
            <td> <?php echo $warranty_left; ?></td> 
            <td> <?php echo $value->customer_warranty_start_date; ?></td> 
            <td> <?php echo $value->customer_warranty_period; ?> Month</td> 
            <td> <?php echo $value->customer_warranty_end_date; ?></td> 
            <td> <?php echo $customer_warranty_left; ?></td> 
            <td style="text-align:right;"> <?php echo $service->service; ?></td> 
    <!--                //        only for ticket page-->
           <?php 
           if(isset($_POST['for_ticket']))
           { ?>
                <td> 
                <a 
                       class="product_info_for_ticket_form"  
                       href="" 
                       product_id="<?php echo $value->product_id; ?>" 
                       product_code=" <?php echo $value->product_code; ?>" 
                       product_name=" <?php echo $value->product_name; ?>" 
                       customer_name=" <?php echo $value->customer_name; ?>" 
                       customer_mobile=" <?php echo $value->mobile_number; ?>" 
                       customer_address=" <?php echo $value->address; ?>" 
                       warranty_start=" <?php echo $value->warranty_start_date; ?>" 
                       warranty_end=" <?php echo $value->warranty_expired_on; ?>" 
                       warranty_left=" <?php echo $this->common_model->warranty_count_integer_day($value->warranty_expired_on); ?>" 
                       customer_warranty_start=" <?php echo $value->customer_warranty_start_date; ?>" 
                       customer_warranty_end=" <?php echo $value->customer_warranty_end_date; ?>" 
                       customer_warranty_left=" <?php echo $this->common_model->warranty_count_integer_day($value->customer_warranty_end_date); ?>"
                   > 
                Go 
                </a> 
                </td> 
           <?php } ?>
    <!--                //        end only for ticket-->
            </tr> 
       <?php }} ?> 
    </tbody> 
    <tfoot>         
    </tfoot> 
    </table> 
    </div> 
</div>


<script>
    $(".product_info_for_ticket_form").on("click",function(e){
        e.preventDefault();
        $('.product_code').val($(this).attr('product_code').trim());
        $('.product_name').val($(this).attr('product_name').trim());
        $('.customer_address').val($(this).attr('customer_address').trim());
        $('.customer_mobile').val($(this).attr('customer_mobile').trim());
        $('.customer_name').val($(this).attr('customer_name').trim());
        $('.product_id').val($(this).attr('product_id').trim());
        $('.warranty_start').val($(this).attr('warranty_start').trim());
        $('.warranty_end').val($(this).attr('warranty_end').trim());
        $('.warranty_left').val($(this).attr('warranty_left').trim());
        $('.customer_warranty_start').val($(this).attr('customer_warranty_start').trim());
        $('.customer_warranty_end').val($(this).attr('customer_warranty_end').trim());
        $('.customer_warranty_left').val($(this).attr('customer_warranty_left').trim());
        
        $('#create_schedule_button').modal('hide');
    });
</script>