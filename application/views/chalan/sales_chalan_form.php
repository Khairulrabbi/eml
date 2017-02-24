<div class="panel-body">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5 class="panel-title">Chalan Form</h5>
        </div>
        <div class="panel-body">
            <div class="text-center adi_info_block"></div>
            <form class="form-horizontal" id="sales_chalan_frm" action="" method="post">
            <div class="row">
                    <div class="col-lg-12">
                        <span style="font-weight: bold">Sales Code</span>:<span><?= $sales_info->sales_code; ?></span><br/>
                        <span style="font-weight: bold">Delivery To </span>:<span><?= $sales_info->customer_name."(".$sales_info->mobile_number.")"; ?></span>
                    </div>
                    <div class="col-lg-12">&nbsp;</div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="" class="col-lg-3 control-label">Delivery&nbsp;From&nbsp;<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="hidden" class="sales_id" name="sales_id" value="<?= $sales_id; ?>">
                                <input type="hidden" class="customer_id" name="customer_id" value="<?= $sales_info->customer_id; ?>">
                                <?php echo warehouse_list($warehouse_id, array('class' => 'delivery_location', 'id' => 'delivery_location'),"warehouse_id",array('warehouse.location_id'=>$this->session->userdata("LOCATION_ID"))); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="" class="col-lg-3 control-label">Delivery&nbsp;Date&nbsp;<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="date" class="form-control delivery_date" id="delivery_date" name="delivery_date" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Product Name</th>
                                    <th>P.CODE</th>
                                    <?php echo get_specification_json_type(array(), "title"); ?>
                                    <th>Available Qty</th> 
                                    <th>Order Qty</th> 
                                    <th>Approved Qty</th> 
                                    <th>Chalan Qty</th> 
                                    <th>Chalan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $data['sales_details'] = $sales_details;
                                    $this->load->view("chalan/sales_chalan_form_ajax_view");
                                ?>                                
                            </tbody>
                        </table>
                        
                        
                        <?php
                            if($sales_info->sales_type == "vendor")
                            { ?>
                                <input type="hidden" name="ps_type" value="sales">
                                <input <?= bpa('create_chalan')?'':'disabled="disabled"'; ?> type="button" id="save_sales_chalan_frm"class="btn btn-primary pull-right" value="Create Chalan">
                                <a style="margin-right: 10px;" class="btn btn-danger pull-right" href="<?= base_url().'sales/order_details/'.$sales_id; ?>">Back to Details page</a>
                            <?php }else if($sales_info->sales_type == "counter")
                            { ?>
                                <input type="hidden" name="ps_type" value="counter">
                                <input <?= bpa('create_chalan')?'':'disabled="disabled"'; ?> type="button" id="save_sales_chalan_frm"class="btn btn-primary pull-right" value="Create Chalan">
                                <a style="margin-right: 10px;" class="btn btn-danger pull-right" href="<?= base_url().'sales/front_desk_order_details/'.$sales_id; ?>">Back to Details page</a>
                            <?php }
                        ?>
                        
                    </div>
            </div>
        </form>
        </div> <!--Panel body close -->
    </div> <!--Panel div close -->
</div>


<script>
    $(document).on("change", "#delivery_location", function (e) {
        e.preventDefault();
        var sales_id = $('.sales_id').val();
        var delivery_to = $(this).val();
        $.ajax({
            url: '<?php echo base_url(); ?>chalan/load_sales_info',
            type: 'POST',
            data: {sales_id:sales_id,delivery_to:delivery_to},
            success: function (data) {
                $("table tbody").html(data);
            }
        });
    });
    
    
    $(document).on("input", ".confirm_quantity", function () {
        var t = $(this);
        var available_quantity = parseInt($(this).parent().parent().find(".availableProduct").text());
        var request_quantity = parseInt($(this).parent().parent().find(".rquest_quantity").text());
        var approve_quantity = parseInt($(this).parent().parent().find(".approve_quantity").text());
        var stock_requisition_details_id = $(this).parent().parent().find(".stock_requisition_details_id").val();
        var confirm_quantity = parseInt($(this).parent().parent().find(".confirm_quantity").val());
//        //var c_quantity = $(this).parent().parent().find(".chalan_quantity").val();
//        alert($(this).parent().parent().find(".confirm_quantity").val());
        var ex_chalan = parseInt($(this).parent().parent().find(".chalan_quantity").text());
        var chalan_quantity = parseInt($(this).val());
        var total_chalan = chalan_quantity+ex_chalan;
        if((available_quantity < confirm_quantity) || (approve_quantity < total_chalan) || (approve_quantity <chalan_quantity ))
        {
            alert("Invalid Quantity.");
            $(this).val(0);
        }
    });
    
    
    $(document).on("click", "#save_sales_chalan_frm", function (e) {
        e.preventDefault();
        var delivery_date = $('#delivery_date').val();
        var sales_id = $('.sales_id').val();
        if(delivery_date)
        {
            if(confirm('Are you sure you want to create chalan?')){
            $.ajax({
                //url: '<?php //echo base_url(); ?>chalan/save_requisition_chalan',
                url: '<?php echo base_url(); ?>chalan/save_chalan',
                type: 'POST',
                data: $('#sales_chalan_frm').serialize()+'&ps_type=sales',
                success: function (data) {
                    window.location.href = '<?php echo base_url(); ?>chalan/sales_chalan_form_details_preview/'+sales_id;
                }
            });
            }
//            
//            
//            $.ajax({
//                //url: '<?php //echo base_url(); ?>chalan/save_sales_chalan',
//                url: '<?php //echo base_url(); ?>chalan/save_chalan',
//                type: 'POST',
//                data: $('#sales_chalan_frm').serialize(),
//                success: function (data) {
//                    window.location.href = '<?php //echo base_url(); ?>chalan/sales_chalan_form/'+sales_id;
//                }
//            });
        }
        else
        {
            var htm ='<div class="invalid alert alert-danger">';
            htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            htm += 'Star(*) Marks Field are Required';
            htm +='</div>';
            $('.adi_info_block').html(htm); 
        }
    });
</script>
