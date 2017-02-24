
<div class="panel-body">
    <div class="panel panel-default">
        <div class="panel-heading">
          
        </div>
        <div class="panel-body">
            <div class="text-center adi_info_block"></div>
            <form class="form-horizontal" id="requisition_chalan_frm" action="" method="post">
            <div class="row">
                    <div class="col-lg-12">
                        <span style="font-weight: bold">Requisition Code</span>:<span><?= $requisition_info->requisition_code; ?></span><br/>
                        <span style="font-weight: bold">Delivery To</span>:<span><?= $requisition_info->warehouse_name; ?></span>
                    </div>
                    <div class="col-lg-12">&nbsp;</div>
<!--                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="" class="col-lg-3 control-label">Chalan Code <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="hidden" class="requisition_id" name="requisition_id" value="<?= $requisition_id; ?>">
                                <input type="hidden" name="delivery_to" value="<?= $requisition_info->warehouse_id; ?>">
                                <input  readonly="true" required type="text" class="form-control chalan_code" id="chalan_code" name="chalan_code" value="<?php echo @$chalan_code; ?>">
                            </div>
                        </div>
                    </div>-->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="" class="col-lg-3 control-label">Delivery&nbsp;From&nbsp;<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="hidden" class="requisition_id" name="requisition_id" value="<?= $requisition_id; ?>">
                                <input type="hidden" name="delivery_to" value="<?= $requisition_info->warehouse_id; ?>">
                                <?php 
                                $dd_data['selected_value'] =@$warehouse_id;
                                $dd_data['extra_attr'] =array('class' => 'delivery_location', 'id' => 'delivery_location');
                                echo ap_drop_down(20,NULL,$dd_data);
                                ?>
                                <?php // echo warehouse_list((@$warehouse_id), array('class' => 'delivery_location', 'id' => 'delivery_location')); ?>
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
                                    <th>Requisition Qty</th> 
                                    <th>Approved Qty</th> 
                                    <th>Chalan Qty</th> 
                                    <th>Chalan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $data['requisition_details'] = $requisition_details;
                                    $this->load->view("chalan/requisition_chalan_form_ajax_view");
                                ?>                                
                            </tbody>
                        </table>
                        <input <?= bpa('create_chalan')?'':'disabled="disabled"'; ?> type="button" id="save_requisition_chalan_frm"class="btn btn-danger pull-right" value="Create Chalan">
                    </div>
            </div>
        </form>
        </div> <!--Panel body close -->
    </div> <!--Panel div close -->
</div>


<script>
    $(document).on("change", "#delivery_location", function (e) {
        e.preventDefault();
        var requsition_id = $('.requisition_id').val();
        var delivery_to = $(this).val();
        $.ajax({
            url: '<?php echo base_url(); ?>chalan/load_requisition_info',
            type: 'POST',
            data: {requsition_id:requsition_id,delivery_to:delivery_to},
            success: function (data) {
                $("table tbody").html(data);
            }
        });
    });
    
    
    $(document).on("input", ".confirm_quantity", function () {
        var t = $(this);
        var available_quantity = parseInt($(this).parent().parent().find(".available_product").text());
        var request_quantity = parseInt($(this).parent().parent().find(".rquest_quantity").text());
        var approve_quantity = parseInt($(this).parent().parent().find(".approve_quantity").text());
        var stock_requisition_details_id = $(this).parent().parent().find(".stock_requisition_details_id").val();
        var ex_chalan = parseInt($(this).parent().parent().find(".chalan_quantity").text());
        var confirm_quantity = parseInt($(this).parent().parent().find(".confirm_quantity").text());
        //var cnfrm_quantity = parseInt($(this).val());
        //alert($(this).parent().parent().find(".chalan_quantity").text());
        var chalan_quantity = parseInt($(this).val());
        //if(available_quantity="Nan"?available_quantity=0:"");
        
        
        var total_chalan = chalan_quantity+ex_chalan;
        //alert(approve_quantity);
        //alert(available_quantity+"/"+total_chalan+"/"+approve_quantity);
        if((available_quantity < chalan_quantity) || (approve_quantity < total_chalan) || (available_quantity < total_chalan))
        {
            alert("Invalid Quantity.");
            $(this).val(0);
        }
    });
    
    
    $(document).on("click", "#save_requisition_chalan_frm", function (e) {
        e.preventDefault();
        var delivery_date = $('#delivery_date').val();
        var requisition_id = $('.requisition_id').val();
        if(delivery_date)
        {
            if(confirm('Are you sure you want to create chalan?')){
            $.ajax({
                //url: '<?php //echo base_url(); ?>chalan/save_requisition_chalan',
                url: '<?php echo base_url(); ?>chalan/save_chalan',
                type: 'POST',
                data: $('#requisition_chalan_frm').serialize()+'&ps_type=requisition',
                success: function (data) {
                    window.location.href = '<?php echo base_url(); ?>chalan/requisition_chalan_form_details_preview/'+requisition_id;
                }
            });
            }
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
