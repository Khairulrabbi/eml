
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Search Product or Order no</h3>
                </div>
                <div class="panel-body">
                    <div class="text-center search_order_block"></div>
                    <form class="form-horizontal"  id="my_form" method="post" action="">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="product_code" class="col-lg-3 control-label">Product Code</label>
                            <input type="hidden" name="token_id" value="<?php echo @$token_info->token_id; ?>">
                            <div class="col-lg-9">
                                <?php echo sold_product_code('', array('class' => 'product_code',''=>'')); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-1" style="text-align: center; color: green;">
                        <b>Or</b>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="sales_code" class="col-lg-4 control-label">Sales Code </label>
                            <div class="col-lg-8">
                                <?php echo sold_sales_code('', array('class' => 'sales_code')); ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-2">
                        <div class="form-group">
                            <div class="col-lg-8">
                                <input type="submit" id="save_ticket"class="btn btn-primary search_product_info_for_ticket" value="Search">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Create Ticket</h3>
            </div>
            <div class="panel-body">
                <div class="text-center ticket_order_block"></div>
                <form class="ticketForm" id="ticketForm" method="post" action="">
                    <input type="hidden" class="token_id" name="token_id" value="<?php echo @$ticket_info->token_id; ?>">
                    <input type="hidden" class="ticket_id" name="ticket_id" value="<?php echo @$ticket_info->ticket_id; ?>">
                    <input type="hidden" class="product_id" name="product_id" value="<?php echo @$ticket_info->product_id; ?>">
                    <input type="hidden" class="warranty_start" name="warranty_start" value="<?php echo @$ticket_info->warranty_start; ?>">
                    <input type="hidden" class="warranty_end" name="warranty_end" value="<?php echo @$ticket_info->warranty_end; ?>">
                    <input type="hidden" class="warranty_left" name="warranty_left" value="<?php echo @$ticket_info->warranty_left; ?>">
                    <input type="hidden" class="customer_warranty_start" name="customer_warranty_start" value="<?php echo @$ticket_info->customer_warranty_start; ?>">
                    <input type="hidden" class="customer_warranty_end" name="customer_warranty_end" value="<?php echo @$ticket_info->customer_warranty_end; ?>">
                    <input type="hidden" class="customer_warranty_left" name="customer_warranty_left" value="<?php echo @$ticket_info->customer_warranty_left; ?>">
                    
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="" class="col-lg-3 control-label">Ticket&nbsp;Code&nbsp;<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" readonly="" class="form-control ticket_code" name="ticket_code" value="<?php echo $ticket_code; ?>">
                            </div>
                        </div>
                        <br/><br/>
                        
                        <div class="form-group">
                            <label for="" class="col-lg-3 control-label">Serial&nbsp;Number&nbsp;<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input readonly="" type="text" class="form-control serial_number" name="serial_number" value="<?php echo $serial_number; ?>">
                            </div>
                        </div> 
                        
                        <br/><br/>
                        <div class="form-group">
                            <label for="" class="col-lg-3 control-label">Product&nbsp;Code</label>
                            <div class="col-lg-9">
                                <input type="text" readonly="" class="form-control product_code" name="product_code" value="<?php echo @$ticket_info->product_code; ?>">
                            </div>
                        </div>
                        <br/><br/>
                        <div class="form-group">
                            <label for="" class="col-lg-3 control-label">Product&nbsp;Name&nbsp;<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control product_name" name="product_name" value="<?php echo @$ticket_info->product_name; ?>">
                            </div>
                        </div>
                        
                    </div>
                    
                    
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="" class="col-lg-3 control-label">C.Name&nbsp;<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control customer_name" name="customer_name" value="<?php echo @$ticket_info->customer_name; ?>">
                            </div>
                        </div>                        
                        <br/><br/>
                        <div class="form-group">
                            <label for="" class="col-lg-3 control-label">C.Address&nbsp;<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control customer_address" name="customer_address" value="<?php echo @$ticket_info->customer_address; ?>">
                            </div>
                        </div>
                        <br/><br/>
                        <div class="form-group">
                            <label for="" class="col-lg-3 control-label">C.Mobile&nbsp;<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control customer_mobile" name="customer_mobile" value="<?php echo @$ticket_info->customer_mobile; ?>">
                            </div>
                        </div>
                                               
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="" class="col-lg-3 control-label">Service&nbsp;Tag</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control service_tag" name="service_tag" value="<?php echo @$ticket_info->service_tag; ?>">
                            </div>
                        </div>
                        <br/><br/>
                        <div class="form-group">
                            <label for="" class="col-lg-3 control-label">Problem&nbsp;<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <textarea class="form-control problem_details" name="problem_details"><?php echo @$ticket_info->problem_details; ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <input style="margin-top: 20px;" class="btn btn-primary ticket_submit" type="submit" name="ticket_submit" value="Save">
                                <a  style="margin-top: 20px;" class="btn btn-primary" href="">Reload</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>






<!--Start Product Order info modal-->
<div id="create_schedule_button" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" id="add_item_modal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Product Warranty Information</h4>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body tab-content">
                                    <div id="sales_details" class="tab-pane fade in active">
                                    <!--here show sales details-->
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
<!--end Product Order info modal-->




<script>
    $(".search_product_info_for_ticket").on("click",function(e){
        e.preventDefault();
        var product_code = $('.product_code :selected').val();
        var sales_id = $('.sales_code :selected').val();
        
        
        var field_type;
        if(product_code)
        {
            field_type = 'code';
        }
        else if(!(product_code) && sales_id)
        {
            field_type = 'sales_id';
        }
        if(field_type)
        {
            $.ajax({
                url: '<?php echo base_url(); ?>ticket/sales_info_view_for_token_create',
                type: 'POST',
                data: {product_code:product_code,sales_code:sales_id,field_type:field_type,for_ticket:'for_ticket'},
                success: function (data) {
                    $('#sales_details').html(data);
                    $('#create_schedule_button').modal({ show: true });
                }
            });
        }
        else
        {
            var htm ='<div class="alert alert-danger">';
            htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            htm += 'Please Select Product Code or Order No.';
            htm +='</div>';
            $('.search_order_block').html(htm);
        }
    });
    
    
    
    $(".ticket_submit").on("click",function(e){
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>ticket/create_ticket_submit',
            type: 'POST',
            data: $('#ticketForm').serialize(),
            success: function (data) {
                if(data == true)
                {
                    window.location.href = "<?php echo base_url(); ?>ticket/ticket_history";
                }
                else
                {
                    var htm ='<div class="alert alert-danger">';
                    htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                    htm += data;
                    htm +='</div>';
                    $('.ticket_order_block').html(htm);
                }
                
            }
        });
    });
    
</script>