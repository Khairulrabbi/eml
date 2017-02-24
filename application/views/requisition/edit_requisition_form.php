<!--<form class="form-horizontal"  id="my_form" method="post" action="<?php echo base_url() ?>purchase/update_order/<?php echo $order_id; ?>">-->
    <input type="hidden" id="order_id" class="order_id gorder_id" name="order_id" value="<?php echo $order_id; ?>">
    <input type="hidden" class="main_order_id" name="main_order_id" value="<?php echo $order_id; ?>">
    
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Create Requisition
                        <p class="pull-right text-danger " style="font-size: 16px;font-style: oblique;padding-right: 24px;"><?php echo (isset($order_id)?$status:''); ?></p>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="text-center order_block"></div>
                    <form class="form-horizontal" id="requisition_frm" action="" method="post">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="requisition_code" class="col-lg-3 control-label">Requisition Number <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input  readonly="true" required type="text" class="form-control requisition_code" id="requisition_code" name="requisition_code" value="<?php echo @$requisition_code; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="delivery_location" class="col-lg-3 control-label delivery_location">Delivery Location <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <?php echo ap_drop_down(20,NULL,array("selected_value"=>@$order_info->warehouse_id)); ?>
                                    <?php //echo warehouse_list((@$order_info->warehouse_id), array('class' => 'delivery_location', 'id' => 'delivery_location')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="requist_date_for_delivery" class="col-lg-3 control-label order_date">Delivery Date</label>
                                <div class="col-lg-9">
                                    <input required type="date" class="form-control requist_date_for_delivery" id="requist_date_for_delivery" name="request_date_for_delivery" value="<?php echo @$order_info->requist_date_for_delivery; ?>" >
                                </div>
                            </div>
                            
                        </div>
                        <div class="row "></div>
                        <div style="padding-right: 15px;">
                            <input <?= bpa('requisition_form')?'':'disabled="disabled"'; ?> type="button" id="save_requisition"class="btn btn-danger pull-right" value="Save Requisition">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo label_html(ITEM_LIST,'ITEM_LIST'); ?> </h3>
                </div>
                <div class="panel-body">
                    <div class="text-center product_block"></div>
                    <button type="button" id="add_product"class="btn btn-danger add_products" data-toggle="modal" ><?php echo ADD_ITEM; ?></button>
                    <button type="button" table="product_group" field="product_group_name" class="btn btn-danger list_ordering">Group Wise Ordering</button>
                    <button type="button" table="region" field="region_name" class="btn btn-danger list_ordering">Region Wise Ordering</button>
                    <div class="scrolltable">
                        <table class="table product_list_table">
                            <thead>
                                <tr>
                                    <th>#<?php echo SI; ?></th>
                                    <th style="width: 130px;"><?php echo label_html(PRODUCT_NAME,'PRODUCT_NAME'); ?></th>
                                    <th>P.CODE</th>
                                    <th>Rim Size</th>
                                    <th>PR</th>
                                    <th>PATT</th>
                                    <th>UNIT</th>
                                    <th>H.S CODE</th>
                                    <th style="width: 100px;"><?php echo label_html(QTY,'QTY'); ?></th>
                                    <th><?php echo label_html(ACTION,'ACTION'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $selected_product_list; ?>
                            </tbody>
                        </table>


                        <div class="col-lg-6">

                        </div>
                        <div class="col-lg-2"></div>

                        <!----<div class="col-lg-2" style="text-align: left">Total:<span class="total"></span></div>--->
                    </div>
                </div>
            </div>
            
            
            

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Approval Process</h3>
                </div>
                <div class="panel-body">
                    <div class="text-center adi_info_block"></div>                       
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="customer_id" class="col-lg-5 control-label">Approval Persons <span class="text-danger">*</span></label>
                            <div class="col-lg-7">
                                <input checked="" type="radio" name="approve_person" value="0">&nbsp;Predifine Hierarchy&nbsp;&nbsp;
                                <input type="radio" name="approve_person" value="1">&nbsp;Manually
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="col-lg-12" style="margin-top: 10px;">
                    <input type="submit" name="update_order" class="btn btn-primary save" value="<?= SAVE; ?>">
                </div>
            </div>
        </div>
        <div id="add_product_m" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg" id="add_item_modal">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><?= label_html(ADD_ITEM,'ADD_ITEM'); ?></h4>
                    </div>
                    <div class="modal-body" style="overflow: hidden">
                        
                        
                            <?php
                                echo custom_search_panel('common_controller/get_product_list_view',array("region","group","product_id"),array('2','3','5','6'));
                            ?>
                        <form id="product_form" class="form-horizontal" action="">
                            <input type="hidden" id="order_id" class="order_id" name="order_id" value="<?php echo $order_id; ?>">
                            <div class="col-lg-12 product_list_item show_search_data" style="margin-right: 15px; min-height: 200px;">

                            </div>
                        </form>
                    </div>     
                </div>

            </div>
        </div>
		
		<!--- add Model         -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true" class="fa fa-remove red"></span>
                        </button>
                       <h4 class="modal-title" id="myModalLabel">Choose Model</h4>
                    </div>
                    <div class="modal-body">
                        <form action="" id="purchase_model_spec_form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="hidden" name="selected_model" id="checked_model_name" value="">
                                    <input type="hidden" name="product_id" class="product_id_insert" value="">
                                    <input type="hidden" id="order_id" class="order_id" name="order_id" value="<?php echo $order_id; ?>">
                                    <input type="hidden" name="purchase_order_details_id" class="purchase_order_details_id_modal" value="">
                                    <div class="col-lg-5">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Model</h3>
                                            </div>
                                            
                                            <div class="panel-body">
                                                <div class="product_model_list"></div>                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Specification</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="spec_list"></div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="btn-toolbar" style="padding-right: 15px;">
                                    <div class="form-group pull-right">
                                        <input type="submit" class="btn btn-primary model_spec_select" value="Select" data-dismiss="modal" name="select">
                                    </div>
                                    <!--<input type="submit" value="ADD" class="btn btn-primary add_product_btn pull-right" data-dismiss="modal" name="add">-->
                                </div>
                                
                            </div>
                        </form>    
                    </div>
                </div>
            </div>
        </div>
		</div>
<!--</form>-->




<script>
	var myBtn;
	$(document).on('click','.model_select', function() {
            $('.model_select').not(this).prop('checked', false);
         });
    
    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
      });
      

    

	
	 
    $(document).ready(function(){
        var order_id = $('.main_order_id').val();
        if(order_id){
            $('#save_purchase').val('Update order');
        }
    });
    
    
    
    
    $(document).on("click","#save_requisition",function(){
        var order_id = $('.main_order_id').val();
        var requist_date_for_delivery = $("#requist_date_for_delivery").val();
        var warehouse_id = $("#delivery_location").val();
        var requisition_code = $("#requisition_code").val();
        
        if(order_id){
           $.ajax({
                url: '<?php echo base_url(); ?>requisition/update_requisition_for_requisition_order_block',
                type: 'POST',
                data: {order_id:order_id,requist_date_for_delivery:requist_date_for_delivery,warehouse_id:warehouse_id},
                success: function (data) {
                    var htm ='<div class="invalid alert alert-success">';
                    htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                    htm += 'Update Success.';
                    htm +='</div>';
                    $('.order_block').html(htm);
                    $('#save_requisition').val('Update Requisition');
                }
            }) ;
        }else{            
            $.ajax({
                url: '<?php echo base_url(); ?>requisition/save_requisition_for_reauisition_order_block',
                type: 'POST',
                data: $("#requisition_frm").serialize(),
                success: function (data) {
                    var returnValue = data.replace(/(\r\n|\n|\r)/gm,"");
                    if($.isNumeric(returnValue))
                    {
                        $(".main_order_id").val(returnValue);
                        var htm ='<div class="invalid alert alert-success">';
                        htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                        htm += 'New Requisition successfully saved.';
                        htm +='</div>';
                       $('.order_block').html(htm);
                       $('#save_requisition').val('Update Requisition');                        
                    }
                    else
                    {
                        var htm ='<div class="invalid alert alert-danger">';
                        htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                        htm += returnValue;
                        htm +='</div>';
                       $('.order_block').html(htm);
                      // $('#save_purchase').val('Update order');
                    }                    
                }
            });
        }        
    });
    
    
    
    $('#add_product').on("click",function(){
        var order_id = $(".main_order_id").val();
        $('.order_id').val(order_id);
        if(order_id){
            $('.appendSearchPanel').append('<input type="hidden" name="order_id" value="'+order_id+'">');//this line only add item search panel
            $(this).attr("data-target", "#add_product_m");
        }else{
            var htm ='<div class="invalid alert alert-danger">';
            htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            htm += 'Please Save Order First.';
            htm +='</div>';
            $('.product_block').html(htm);
         
            
        }
    });
    
    $(document).on("click", ".add_product_btn", function (e) {
        e.preventDefault();
        var order_id = $(".main_order_id").val();
        $.ajax({
                url: '<?php echo base_url(); ?>requisition/save_requisition_details',
                type: 'POST',
                data: $("#product_form").serialize(),
                success: function (data) {
                    $.ajax({
                        url: '<?php echo base_url(); ?>requisition/get_product_list',
                        type: 'POST',
                        data: {order_id:order_id,table:"product_group",field:"product_group_name"},
                        success: function (data) {
                            $('.product_list_table tbody').html(data);
                            var htm ='<div class="invalid alert alert-success">';
                            htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                            htm += 'Product added..';
                            htm +='</div>';
                            $('.product_block').html(htm);
                            
                        }
                    });
                }
            });
    });
    
    $(document).on("click", ".list_ordering", function (e) {
        e.preventDefault();
        var order_id = $(".main_order_id").val();
        var table = $(this).attr("table");
        var field = $(this).attr("field");
        $.ajax({
            url: '<?php echo base_url(); ?>requisition/get_product_list',
            type: 'POST',
            data: {order_id:order_id,table:table,field:field},
            success: function (data) {
                $('.product_list_table tbody').html(data);
            }
        });
    });
    
    
    $('.add_products ').on('click', function() {
        $(".product_list_item").html('');
        
    });

    $(document).on("click",".delete_product", function () {

        var order_details_id = $(this).attr('order_details_id');
        var elem = $(this);
        $.ajax({
            url: '<?php echo base_url(); ?>requisition/delete_product',
            type: 'POST',
            data: {order_details_id: order_details_id},
            success: function (data) {
               elem.parent().parent().remove();
            }
        });

    });
    
    $(document).on('blur','.updates',function(){
        var order_details_id = $("#order_id").val();
        var field_name = $(this).attr('field_name');
        var value = $(this).val();
        var product_id = $(this).parent().parent().find(".product_id").val();
        $.ajax({
            url: '<?php echo base_url(); ?>requisition/update_product',
            type: 'POST',
            data: {order_details_id: order_details_id,field_name:field_name,value:value,product_id:product_id},
            success: function (data) {
                
            }
        });
    });
    
    
    
    

  
    
    $(document).on("input",".quantity", function () {
        var quantity = $(this).val();
        var order_details_id = $(this).attr("order_details_id");        
        update_order_details(order_details_id, quantity);
    });
    
    
    
    
    
    function update_order_details(order_details_id, quantity) {
        $.ajax({
            url: '<?php echo base_url(); ?>requisition/update_product_details',
            type: 'POST',
            data: {order_details_id: order_details_id, quantity: quantity},
            success: function (data) {
                //
            }
        });
    }
    $(".save").on("click", function (e) {
        e.preventDefault();
        var order_id = $(".main_order_id").val();
        var approve_person = $("input[name='approve_person']:checked"). val();
        if (order_id) {
            if(approve_person){
                $.ajax({
                    url: '<?php echo base_url(); ?>requisition/check_order_details',
                    type: 'POST',
                    data: {order_id: order_id},
                    success: function (data) {
                        if (data > 0) {
                            $.ajax({
                                url: '<?php echo base_url(); ?>requisition/save_aditional_info',
                                type: 'POST',
                                data: {order_id: order_id,approve_person:approve_person}, 
                                success: function (data) {
                                    window.location.href = "<?php echo base_url(); ?>requisition/requisition_history/"; 
                                }
                            });
                        } else {
                            var htm ='<div class="invalid alert alert-danger">';
                            htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                            htm += 'you have not select any product';
                            htm +='</div>';
                            $('.adi_info_block').html(htm);
                           
                        }
                    }
                });
            
        } else {
        
            var htm ='<div class="invalid alert alert-danger">';
            htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            htm += 'Please Select Approve Person.';
            htm +='</div>';
            $('.adi_info_block').html(htm);        
        }

    }
    else
    {
        var htm ='<div class="invalid alert alert-danger">';
        htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        htm += 'Please Save requisition First.';
        htm +='</div>';
        $('.adi_info_block').html(htm); 
    }
    });
    
    
	
    

</script>