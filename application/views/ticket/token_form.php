<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $title; ?> <p class="pull-right text-danger " style="font-size: 16px;font-style: oblique;padding-right: 24px;"><?php echo (isset($order_id)?$status:''); ?></p></h3>
        </div>
        <div class="panel-body">
            <div class="text-center order_block"></div>
            <form class="form-horizontal" id="creat_token" action="<?php echo $action; ?>" method="post">
                <?php if(validation_errors()){?>
                <div class="text-center adi_info_block"><div class="invalid alert alert-danger"><?php echo validation_errors(); ?></div></div>
                <?php } ?>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="product_code" class="col-lg-3 control-label">Product Code</label>
                        <input type="hidden" name="token_id" value="<?php echo @$token_info->token_id; ?>">
                        <div class="col-lg-9">
                            <?php echo sold_product_code(@$token_info->product_code, array('class' => 'product_code',''=>'')); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12" style="text-align: right">                            
                            <button type="button" <?php echo ((@$token_info->product_code)?'':'style="display: none;"'); ?>  class="btn btn-link product_details_warranty">Product Details Warranty</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="token_code" class="col-lg-3 control-label">Token Code <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input  readonly="true" required type="text" class="form-control token_code" id="token_code" name="token_code" value="<?php echo (@$token_info->token_code)?@$token_info->token_code:$token_code; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="customer_name" class="col-lg-3 control-label">Customer&nbsp;Name&nbsp;<span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control customer_name" placeholder="Customer Name." id="customer_name" name="customer_name" value="<?php echo @$token_info->customer_name; ?>">
                        </div>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="sales_code" class="col-lg-4 control-label">Sales Code </label>
                        <div class="col-lg-8">
                            <?php echo sold_sales_code(@$token_info->sales_id, array('class' => 'sales_code')); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12" style="text-align: right">
                            <button type="button" <?php echo ((@$token_info->sales_id)?'':'style="display: none;"'); ?> class="btn btn-link order_details_warranty">Order Details Warranty</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="customer_mobile" class="col-lg-4 control-label">Customer Mobile <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control customer_mobile" placeholder="Customer Mobile" id="customer_mobile" name="customer_mobile" value="<?php echo @$token_info->customer_mobile; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="product_name" class="col-lg-4 control-label">Product&nbsp;Name<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control product_name" placeholder="Product Name." id="product_name" name="product_name" value="<?php echo @$token_info->product_name; ?>">
                        </div>
                    </div>

                    
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="customer_address" class="col-lg-5 control-label ">Customer Address</label>
                        <div class="col-lg-7">
                            <textarea name="customer_address" class="form-control customer_address" id="customer_address"><?php echo @$token_info->customer_address; ?></textarea>
                        </div>
                    </div>                    
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="problem_details" class="col-lg-5 control-label ">Problem Details <span class="text-danger">*</span></label>
                        <div class="col-lg-7">
                            <textarea name="problem_details" class="form-control problem_details" id="problem_details"><?php echo @$token_info->problem_details; ?></textarea>
                        </div>
                    </div>                    
                </div>
                <div class="row "></div>
                <div style="padding-right: 15px;">
                    <input type="submit" id="save_token"class="btn btn-primary pull-right" value="Save Token">
                </div>
            </form>
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
  $( function() {
    var product_name = <?php echo $product_info_name.";"; ?>
    $( ".product_name" ).autocomplete({
      source: product_name
    });
  });
  
$(".sales_code").on("change",function(){
    var sales_id = $(this).val();    
    $.ajax({
        url: '<?php echo base_url(); ?>ticket/auto_complete_sales_info_for_token',
        type: 'POST',
        data: {sales_code:sales_id},
        dataType: "json",
        success: function (data) {
            $('.customer_address').val(data['address']);
            $('.customer_name').val(data['customer_name']);
            $('.customer_mobile').val(data['mobile_number']);
            $('.product_code').select2("val","");
            if(sales_id)
            {
                $('.order_details_warranty').show();
            }
            else
            {
                $('.order_details_warranty').hide();
            }
            $('.product_details_warranty').hide();
        }
    });
});

$(".order_details_warranty").on("click",function(){
    var sales_id = $('.sales_code :selected').val();    
    if(sales_id)
    {
        $.ajax({
            url: '<?php echo base_url(); ?>ticket/sales_info_view_for_token_create',
            type: 'POST',
            data: {sales_code:sales_id,field_type:"sales_id"},
            success: function (data) {
                $('#sales_details').html(data);
                $('#create_schedule_button').modal({ show: true });
            }
        });
    }
});


$(".product_code").on("change",function(){
    var product_code = $(this).val();    
    $.ajax({
        url: '<?php echo base_url(); ?>ticket/auto_complete_sales_info_for_token2',
        type: 'POST',
        data: {product_code:product_code},
        dataType: "json",
        success: function (data) {
            $('.customer_address').val(data['address']);
            $('.customer_name').val(data['customer_name']);
            $('.customer_mobile').val(data['mobile_number']);
            $('.product_name').val(data['product_name']);
            $('.sales_code').select2("val",data["sale_order_id"]);
            if(product_code)
            {
                $('.product_details_warranty').show();
                $('.order_details_warranty').show();
            }
            else
            {
                $('.product_details_warranty').hide();
                $('.order_details_warranty').hide();
            }
            
        }
    });
});

$(".product_details_warranty").on("click",function(){
    var product_code = $('.product_code :selected').val();
    if(product_code)
    {
        $.ajax({
            url: '<?php echo base_url(); ?>ticket/sales_info_view_for_token_create',
            type: 'POST',
            data: {product_code:product_code,field_type:"code"},
            success: function (data) {
                $('#sales_details').html(data);
                $('#create_schedule_button').modal({ show: true });
            }
        });
    }
});
  </script>
  