<!--<form class="form-horizontal"  id="my_form" method="post" action="<?php echo base_url() ?>purchase/update_order/<?php echo $order_id; ?>">-->
    <input type="hidden" id="order_id" class="order_id gorder_id" name="order_id" value="<?php echo $order_id; ?>">
    <input type="hidden" class="main_order_id" name="main_order_id" value="<?php echo $order_id; ?>">  
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <?php echo label_html(CREATE_PURCHASE_ORDER,'CREATE_PURCHASE_ORDER'); ?>
                        <p class="pull-right text-danger po_generated" style="font-size: 16px;font-style: oblique;padding-right: 24px;"><?php echo (isset($_GET['p_code'])?"Purchase Code : ".$_GET['p_code'].", ":"").(isset($order_id)?"Status : ".$status:''); ?></p>
                    </h5>
                </div>
                <div class="panel-body">
                    <div class="text-center order_block"></div>
                    <form class="form-horizontal" id="purchase_order" action="" method="post">
                        <div class="col-lg-4">
<!--                            <div class="form-group">
                                <label for="purchase_code" class="col-lg-3 control-label"><?php// echo label_html(PO_NUMBER,'PO_NUMBER'); ?> <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input  readonly="true" required type="text" class="form-control purchase_code" id="purchase_code" name="purchase_code" value="<?php// echo @$purchase_code; ?>">
                                </div>
                            </div>-->
                            <div class="form-group">
                                <label for="order_date" class="col-lg-3 control-label order_date"><?php echo label_html(PO_DATE,'PO_DATE'); ?> <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input required type="date" class="form-control order_date" placeholder="Date" id="order_date" name="order_date" value="<?php echo @$order_info->order_date; ?>" >
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
<!--                            <div class="form-group">
                                <label for="order_number" class="col-lg-3 control-label"><?php //echo label_html(INDENT_NO,'INDENT_NO'); ?><span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input required type="text" step="any" class="form-control indent_number" title="Indent Number" placeholder="Indent Number" id="order_number" name="indent_number" value="<?php echo @$order_info->indent_number; ?>">
                                </div>
                            </div>-->
                            <div class="form-group">
                                <label for="currency_id" class="col-lg-3 control-label currency_id"><?php echo label_html(CURRENCY,'CURRENCY'); ?></label>
                                <div class="col-lg-9">
                                    <?php echo ap_drop_down(5,NULL,array("selected_value"=>144)); ?>
                                    <?php // echo curency_list((@$order_info->currency_id?$order_info->currency_id:144), array('class' => 'currency_id', '' => '')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            
<!--                            <div class="form-group">
                                <label for="" class="col-lg-5 control-label "><?php //echo label_html(NUMBER_OF_DAYS,'NUMBER_OF_DAYS'); ?></label>
                                <div class="col-lg-7">
                                    <input  type="number" class="form-control " id="lc_settlement_duration" placeholder="Number of Days" name="lc_settlement_duration" value="<?php echo@$order_info->lc_settlement_duration; ?>" >
                                </div>
                            </div>-->
                            
                            
                            <div class="form-group">
                                <label for="exchange_rate" class="col-lg-5 control-label"><?php echo label_html(EXCHANGE_RATE,'EXCHANGE_RATE'); ?></label>
                                <div class="col-lg-7">
                                    <input type="number" class="form-control exchange_rate" placeholder="Exchange Rate" name="exchange_rate" step="any" value="<?php echo (@$order_info->exchange_rate?$order_info->exchange_rate:(@$last_exchange_rate[0]['exchange_rate']?$last_exchange_rate[0]['exchange_rate']:80)); ?>">
                                </div>
                            </div>
                            
                        </div>
                        <div class="row "></div>
                        <div style="padding-right: 15px;">
                            <input <?= bpa('save_purchase_order')?'':'disabled="disabled"'; ?> type="button" id="save_purchase"class="btn btn-danger pull-right" value="<?php echo SAVE_ORDER; ?>">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title"><?php echo label_html(ITEM_LIST,'ITEM_LIST'); ?> </h5>
                </div>
                <div class="panel-body">
                    <div class="text-center product_block"></div>
                    <button module="purchase" type="button" id="add_product"class="btn btn-danger add_products" data-toggle="modal"><?php echo ADD_ITEM; ?></button>
                    <button type="button" table="product_group" field="product_group_name" class="btn btn-danger list_ordering">Group Wise Ordering</button>
                    <button type="button" table="region" field="region_name" class="btn btn-danger list_ordering">Region Wise Ordering</button>
                    <div class="scrolltable">
                        <table class="table product_list_table">
                            <thead>
                                <tr>
                                    <th><?php echo label_html(SL,'SL'); ?> </th>
                                    <th style="width: 130px;"><?php echo label_html(PRODUCT_NAME,'PRODUCT_NAME'); ?></th>
                                   <th><?php echo label_html(PRODUCT_CODE, 'PRODUCT_CODE');?></th>
                                    <?php echo get_specification_json_type(array(), "title"); ?>
                                    <th style="width: 100px;"><?php echo label_html(QTY,'QTY'); ?></th>
                                    <th style="width: 100px;"><?php echo label_html(PRICE_USD,'PRICE_USD'); ?></th>
                                    <th style="width: 100px;"><?php echo label_html(PRICE_BDT,'PRICE_BDT'); ?></th>
                                    <th style="width: 40px;"><?php echo label_html(TOTAL,'TOTAL'); ?></th>
                                    <th><?php echo label_html(ACTION,'ACTION'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $selected_product_list; ?>
                            </tbody>
                            <tfoot>
                              <tr>
                                    <th colspan="<?= ccsbsid(NULL, NULL,(get_specification_json_type(array(),NULL,1)+7)); ?>" style="text-align: right">Total : </th>
                                    <th colspan="<?= ccsbsid(NULL, NULL,2); ?>" class="total"></th>
                              </tr>  
                              <tr>
                                  <th colspan="<?= ccsbsid(NULL, NULL,(get_specification_json_type(array(),NULL,1)+8)); ?>" class="total_inword" style="text-align: right;"></th>
                              </tr>
                            </tfoot>
                        </table>


                        <div class="col-lg-6">

                        </div>
                        <div class="col-lg-2"></div>

                        <!----<div class="col-lg-2" style="text-align: left">Total:<span class="total"></span></div>--->
                    </div>
                </div>
            </div>
            
            <?php /*
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo label_html(COST_COMPONENT,'COST_COMPONENT'); ?> </h3>
                </div>
                <div class="panel-body">
                    <div class="text-center cost_component_block"></div>
                    <div class="field_wrapper">
                        <div class="col-lg-8">
                            <div class="col-lg-3 cost_component_padding0">
                                <div class="form-group">
<!--                                    <label for="" class="col-lg-6 control-label">Cost Component <span class="text-danger">*</span></label>-->
                                    <div class="col-lg-12">
                                        <div><?php echo label_html(COST_COMPONENT,'COST_COMPONENT'); ?></div>
                                        <?php echo cost_component('',array('class'=>'cost_component'),'',array('cost_component.cost_for'=>'Purchase')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 cost_component_padding0"> 
                                <div class="form-group">
<!--                                    <label for="" class="col-lg-4 control-label">Amount <span class="text-danger">*</span></label>-->
                                    <div class="col-lg-12">
                                        <div><?= label_html(AMOUNT_USD,'AMOUNT_USD'); ?></div>
                                        <input type="hidden" class="purchase_cost_component_id" value="">
                                        <input type="number" class="form-control cost_value_usd" name="cost_value_usd" placeholder="<?= AMOUNT_USD; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 cost_component_padding0"> 
                                <div class="form-group">
<!--                                    <label for="" class="col-lg-4 control-label">Amount <span class="text-danger">*</span></label>-->
                                    <div class="col-lg-12">
                                        <div><?= label_html(AMOUNT_BDT,'AMOUNT_BDT'); ?></div>
                                        <input type="number" class="form-control cost_value" name="cost_value" placeholder="<?= AMOUNT_BDT; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 cost_component_padding0" style="width: 84px;">
                                <!--<input type="checkbox" data-off-title="Amount" data-on-title="Yes">-->
                                <div>&nbsp;</div>
                                <input id="percentage" type="checkbox" >
                            
                            </div>
                            <div class="col-lg-1 cost_component_padding0"> 
                                <div class="form-group">
<!--                                    <label for="" class="col-lg-4 control-label">Amount <span class="text-danger">*</span></label>-->
                                    <div class="col-lg-12">
                                        <div>&nbsp;</div>
                                        <div class="cost_component_btn">                                            
                                            <a style="margin-right: 58px;" href="javascript:void(0);" class="btn btn-sm btn-primary add_button"><span class="glyphicon glyphicon-plus"></span> <?= ADD; ?> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row"></div>
                            <br>
<!--                            <div class="row" style="padding-right: 30px;">
                                <div class="form-group cost_component_btn">
                                    <a style="margin-right: 58px;" href="javascript:void(0);" class="btn btn-sm btn-primary add_button pull-right"><span class="glyphicon glyphicon-plus"></span> Add </a>
                                </div>
                            </div>-->
                        </div>
                        <div class="col-lg-4 cost_component_list">
                            <?php 
                                if(isset($cost_component)){
                                    $data['cost_component_list'] = $cost_component;
                                    $this->load->view('purchase/add_cost_component_view',$data);                                
                                }
                            ?>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
            
            */ ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title"><?= label_html(SUPPORTING_DOCUMENT,'SUPPORTING_DOCUMENT'); ?> </h5>
                </div>
                <div class="panel-body">
                    <form  class="ajax_file" action="" method="post" enctype="multipart/formdata">
                        <input type="hidden" id="order_id" class="order_id data" name="order_id_ajax" value="<?php echo $order_id; ?>">
                        <div class="col-lg-7">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="" class="col-lg-5 control-label"><?= label_html(FILE_NAME,'FILE_NAME'); ?></label>
                                    <div class="col-lg-7">
                                        <input class="form-control file_name data" type="text" name="file_name" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="" class="col-lg-4 control-label"><?php echo "File Type"; ?></label>
                                    <div class="col-lg-8">
                                        <?php 
                                        $dd_data['selected_value']=array();
                                        echo ap_drop_down(33,NULL,$dd_data); 
                                        ?>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <input id="ajax_form" type="file" name="userfile" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <input class="btn btn-primary" type="submit" name="upload" value="<?= UPLOAD; ?>"/>
                            </div>
                        </div>
                        <div class="col-lg-5 upporting_doc_list">
                            <?php if(isset($supporting_doc_list)){?>
                                <div class="scrolltable">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#<?= label_html(SI,'SI'); ?></th>
                                                <th><?= label_html(NAME,'NAME'); ?></th>
                                                <th><?= label_html(URL,'URL'); ?></th>
                                                <th><?= label_html(ACTION,'ACTION'); ?></th>
                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; 
                                            foreach ($supporting_doc_list as $val){
                                                ?>
                                                <tr>
                                                    <td><?php echo $i;?></td>
                                                    <td><?php echo ($val['purchase_supporting_doc_name']); ?></td>
                                                    <td><a target="_blank" href='<?php echo base_url().$val['purchase_supporting_doc_url'];?>' > <?php echo $val['purchase_supporting_doc_url'];?> </a></td>
                                                    <td>
                                                        <i style=" cursor: pointer;text-align: center;" class="fa fa-times delete_doc" aria-hidden="true" puchase_supporting_doc_id="<?php echo $val['puchase_supporting_doc_id'];?>" ></i>
                                                    </td>
                                                    
                                                </tr>

                                            <?php $i++;} ?>
                                        </tbody>
                                    </table>

                                </div>
                           <?php  }?>
                        </div>
                        
                    </form>
                </div>
            </div>

            <div class="panel panel-default" style="margin-bottom: 50px;">
                <div class="panel-heading">
                    <h5 class="panel-title"><?= label_html(OTHERS_INFO,'OTHERS_INFO'); ?> </h5>
                </div>
                <div class="panel-body">
                    <div class="text-center adi_info_block"></div>
                    <div class="col-lg-4">
                        <div class="form-group col-lg-12">
                            <label for="request_ship_date" class="col-lg-5 control-label due_date"><?= label_html(REQUEST_SHIP_DATE,'REQUEST_SHIP_DATE'); ?></label>
                            <div class="col-lg-7">
                                <input  type="date" class="form-control request_ship_date" id="request_ship_date" name="request_ship_date" value="<?php echo @$order_info->request_ship_date; ?>" >
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="remarks" class="col-lg-5 control-label"><?= label_html(REMARKS,'REMARKS'); ?></label>
                            <div class="col-lg-7">
                                <textarea name="remarks" class="form-control remarks"><?php echo @$order_info->remarks; ?></textarea>

                            </div>

                        </div>
                    </div>
                   
                    <div class="col-lg-4">
                         <div class="form-group col-lg-12">
                            <label for="shipping_method_id" class="col-lg-5 control-label shipping_method_id"><?= label_html(SHIPING_METHOD,'SHIPING_METHOD'); ?></label>
                            <div class="col-lg-7">
                                <?php //echo ap_drop_down(6,NULL,array("selected_value"=>$order_info->shipping_method_id)); ?>
                                <?php  echo shipping_method(@$order_info->shipping_method_id, array('class' => 'shipping_method_id', '' => '')); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group col-lg-12">
                            <label for="shipping_advice" class="col-lg-5 control-label"><?= label_html(SHIPING_ADVICE,'SHIPING_ADVICE'); ?></label>
                            <div class="col-lg-7">
                                <textarea name="shipping_advice" class="form-control shipping_advice"><?php echo @$order_info->shipping_advice; ?></textarea>

                            </div>
                        </div>
                    </div>
                    <div class="row "></div>
                    
                </div>
                <div class="pull-right" style="padding-right: 10px;margin-top:20px;">
                        <input <?= bpa('save_purchase')?'':'disabled="disabled"'; ?> type="submit" name="update_order" class="btn large btn-primary save pull-right" value="<?= SAVE; ?>">
                </div>
            </div>
        </div>
        <div id="add_product_m" class="modal fade " role="dialog">
            <div class="modal-dialog modal-lg" id="add_item_modal" style="width: 980px;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title"><?= label_html(ADD_ITEM,'ADD_ITEM'); ?></h5>
                    </div>
                    <div class="modal-body" style="overflow: hidden">
<!--                        <form id="product_form" class="form-horizontal" action="">
                        <input type="hidden" id="order_id" class="order_id" name="order_id" value="<?php //echo $order_id; ?>">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <?php 
//                                    echo generate_search_panel('',4,array(
//                                        'product_category_id' =>array(0,1,0),
//                                        'product_subcategory_id' =>array(0,1,0),
//                                        'product_brand_id' =>array(0,1,0),
//                                        'product_id' =>array(0,1,0),
//                                    ));
                                ?>
                            </div>
                            <div class="col-lg-12 product_list_item" style="margin-right: 15px;">

                            </div>

                        </div>
                        </form>-->
                        
                            <?php
                                echo custom_search_panel('common_controller/get_product_list_view',array("region","group","warehouse_list"),array('2','3','5','6'));
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
    var files;
    $('input#ajax_form').on('change', prepareUpload);
    function prepareUpload(event)
    {
       
        files = event.target.files;
    }
    $('form.ajax_file').on('submit', uploadFiles);
    function uploadFiles(event)
    {
//        var files;


        event.stopPropagation();
        event.preventDefault();
        var data = new FormData();
        $.each(files, function(key, value){
            data.append(key, value);
        });
        
        var input = $('input.data');
        $.each(input, function(key, value){
            data.append(key, $(this).val());
        });
        
        /*var order_id = $('input[name=order_id_ajax]');
        $.each(order_id, function(key, value){
            data.append(key, $(this).val());
        });*/
        var order_id = $('.order_id').val();
        var file_name = $('.file_name').val();
        var file_value = $('#ajax_form').val();
        if(order_id && file_name && file_value)
        {
            $.ajax({
                url: '<?php echo base_url() ?>purchase/ajax_upload',
                type: 'POST',
                data: data,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data, textStatus, jqXHR){
                    $('.upporting_doc_list').html(data);
                    $('.file_name ').val('');
                    $('#ajax_form').val('');
                    if(typeof data.error === 'undefined'){
                        submitForm(event, data);
                    }else{
                        console.log('ERRORS: ' + data.error);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log('ERRORS: ' + textStatus);
                }
            });
        }
        
    }
</script>


<script>
	var myBtn;
	$(document).on('click','.model_select', function() {
        $('.model_select').not(this).prop('checked', false);
     });
    
    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
      });
  
//    $(document).on('click','.model_btn_name',function(){
//        myBtn = $(this);
//        $('.spec_list').html("");
//        var product_id = $(this).closest('tr').find('.product_id').val();        
//        $('.purchase_order_details_id_modal').val($(this).closest('tr').find('.purchase_order_details_id').val());
//        $('#checked_model_name').val($(this).closest('tr').find('.model_btn_name').text());
//        var model_id = $(this).attr('get_model_id');
//        $('.product_id_insert').val(product_id);
//        var modelOrModelId = $(this).text();
//        $.ajax({
//            url: '<?php //echo base_url(); ?>purchase/get_product_model_list',
//            type: 'POST',
//            data: {product_id:product_id,model_id:model_id,modelOrModelId:modelOrModelId},
//            success: function (data) {
//                $('.product_model_list').html(data);
//                
//                
//                if($('.model_select').is(':checked')){
//                    var order_id = $(".order_id").val();
//                    var model_id ;
//                    var product_id = $('.product_id_insert').val();
//                    var model_name;
//                    var purchase_order_details_id = $('.purchase_order_details_id_modal').val();
//                    
//                    $('.model_select').each(function(){
//                        if($(this).is(':checked')){
//                            model_id = $(this).val();
//                            model_name = $(this).attr('model_name');
//                        }
//                    });
//                    
//                    $.ajax({
//                        url: '<?php //echo base_url(); ?>purchase/get_spec_list',
//                        type: 'POST',
//                        data: {product_id:product_id,model_id:model_id,order_id:order_id,purchase_order_details_id:purchase_order_details_id},
//                        success: function (data) {
//                            $('.spec_list').html(data);
//                            $('#checked_model_name').val(model_name);
//                        }
//                    }) ;
//                }
//            }
//        });
//    });
//    $('.model_spec_select').on('click',function(e){
//        e.preventDefault();
//        var model_name  = $('#checked_model_name').val();
//        myBtn.text(model_name);
//        $.ajax({
//            url: '<?php //echo base_url(); ?>purchase/save_purchase_model_spec',
//            type: 'POST',
//            data: $("#purchase_model_spec_form").serialize(),
//            success: function (data) {
//                $('.model_btn_name').attr('get_model_id',data);
//                $('.spec_list').html("");
//            }
//        });
//        
//    });
    
//    $(document).on('change','.model_select',function(){
//        if(this.checked) {
//            var order_id = $(".order_id").val();
//            var model_id = $(this).val();
//            var product_id = $(this).attr('product_id');
//            var model_name = $(this).attr('model_name');
//            var purchase_order_details_id = $('.purchase_order_details_id_modal').val();
//            $.ajax({
//               url: '<?php //echo base_url(); ?>purchase/get_spec_list_click',
//                type: 'POST',
//                data: {product_id:product_id,model_id:model_id,order_id:order_id,purchase_order_details_id:purchase_order_details_id},
//                success: function (data) {
//                    $('.spec_list').html(data);
//                    $('#checked_model_name').val(model_name);
//                }
//            }) ;
//            
//        } else{
//            $('.spec_list').html('');
//            $('#checked_model_name').val('Model');
//        }  
//        
//    });
    
    
    /*
    * 
    * 
    */


        //var total = parseFloat(parseFloat(exchange_rate) * parseFloat(lc_value)).toFixed(2);
	function calculate_currency(){
        var lc_value = $('.lc_value ').val();
        var exchange_rate = $('.exchange_rate').val();
        var total = exchange_rate * lc_value;
        //alert(typeof total);
         $('.lc_value_bdt').val(total.toFixed(2));
    }
    
    $(document).ready(function(){
        calculate_currency();
    });
    
    $(document).on('input','.lc_value',function(){
        calculate_currency();
    });
    $(document).on('input','.exchange_rate',function(){
        calculate_currency();
    });
	
    /*
     * 
     */
	 $('#percentage').checkboxpicker({
        html: true,
        offLabel: '<i class="fa fa-money" ></i>',
        onLabel: '%'
    });
	 
    $(document).ready(function(){
        var order_id = $('.main_order_id').val();
        if(order_id){
            $('#save_purchase').val('Update order');
        }
    });
    
    
    
    
    $(document).on("click","#save_purchase",function(){        
        var order_id = $('.main_order_id').val();
        //alert(order_id);
        var vendor_id = $(".vendor_id option:selected").val();
        var order_date = $("#order_date").val();
        var lc_number = $(".lc_number").val();
        var lc_value  = $(".lc_value").val();
        var bill_of_entry = $("#bill_of_entry").val();
        var bill_of_lading = $("#bill_of_lading").val();
        var lc_settlement_duration = $("#lc_settlement_duration").val();
        var lc_settlement_date = $("#lc_settlement_date").val();
        var order_number = $("#order_number ").val();
        
        if(order_id){
           $.ajax({
                url: '<?php echo base_url(); ?>purchase/update_purchase_for_purchase_order_block',
                type: 'POST',
                data: {order_id:order_id,vendor_id:vendor_id,order_date:order_date,lc_number:lc_number,bill_of_entry:bill_of_entry,bill_of_lading:bill_of_lading,lc_settlement_duration:lc_settlement_duration,lc_settlement_date:lc_settlement_date,lc_value:lc_value},
                success: function (data) {
                    var htm ='<div class="invalid alert alert-success">';
                    htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                    htm += 'Update Success.';
                    htm +='</div>';
                    $('.order_block').html(htm);           
                    $('#save_purchase').val('Update order');
                }
            }) ;
        }else{            
            $.ajax({
                url: '<?php echo base_url(); ?>purchase/save_purchase_for_purchase_order_block',
                type: 'POST',
                data: $("#purchase_order").serialize(),
                success: function (data) {
                    try {
                        var response=jQuery.parseJSON(data);
                        //alert(response.id);
                        $(".order_id").val(response.id);
                        $(".main_order_id").val(response.id);
                        var htm ='<div class="invalid alert alert-success">';
                        htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                        htm += 'Purchase order successfully saved.';
                        htm +='</div>';
                        $('.po_generated').text('Purchase Order : '+response.code+", Status : PI Draft")
                        $('.order_block').html(htm);
                        $('#save_purchase').val('Update order');
                    } catch(e) {
                        var htm ='<div class="invalid alert alert-danger">';
                        htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                        htm += data;
                        htm +='</div>';
                       $('.order_block').html(htm);
                    }                  
                }
            });
        }        
    });
    
    
    
//    $('#add_product').on("click",function(){
//        var order_id = $(".order_id").val();
//        if(order_id){
//            $('.appendSearchPanel').append('<input type="hidden" name="order_id" value="'+order_id+'">');//this line only add item search panel
//            $(this).attr("data-target", "#add_product_m");
//        }else{
//            var htm ='<div class="invalid alert alert-danger">';
//            htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
//            htm += 'Please Save Order First.';
//            htm +='</div>';
//            $('.product_block').html(htm);
//            
//            
//        }
//    });
    
    $(document).on("click", ".add_product_btn", function (e) {
        e.preventDefault();
        var order_id = $(".order_id").val();
        $.ajax({
                url: '<?php echo base_url(); ?>purchase/save_order_details',
                type: 'POST',
                data: $("#product_form").serialize(),
                success: function (data) {
                    $.ajax({
                        url: '<?php echo base_url(); ?>purchase/get_product_list',
                        type: 'POST',
                        data: {order_id:order_id,table:"product_group",field:"product_group_name"},
                        success: function (data) {
                            $('.product_list_table tbody').html(data);
                            calculation();
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
        var order_id = $(".order_id").val();
        var table = $(this).attr("table");
        var field = $(this).attr("field");
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/get_product_list',
            type: 'POST',
            data: {order_id:order_id,table:table,field:field},
            success: function (data) {
                $('.product_list_table tbody').html(data);
                calculation();
            }
        });
    });
    
    
    $('.add_products ').on('click', function() {
        $(".product_list_item").html('');
        
    });
//    function get_product_list(order_id) {
//        var order_id = order_id;
//        
//        $.ajax({
//                url: '<?php //echo base_url(); ?>purchase/get_product_list',
//                type: 'POST',
//                data: order_id,
//                success: function (data) {
//                    $('.product_list_table tbody').html(data);
//                    alert(data);
////                    $(".order_id").val(data);
////                    alert("Purchase Order Saved..");
//                }
//            });
//    }
    
    
//    $(".category_id").on("change", function () {
//        var category_id = $(this).val();
//        $.ajax({
//            url: '<?php //echo base_url(); ?>common_controller/get_sub_category',
//            type: 'POST',
//            data: {category_id: category_id},
//            success: function (data) {
//                //alert(data);
//                $(".sub_category_list").html(data);
//                $('select').select2();
//            }
//        });
//    })


//    $(document).on("change", '.get_product', function () {
//        get_product_list();
//
//    })
//    function get_product_list() {
//        var category_id = $(".category_id option:selected").val();
//        ;
//        //alert(category_id);
//        var brand_id = $(".brand_id option:selected").val();
//        var sub_category_id = $(".sub_category_id option:selected").val();
//        $.ajax({
//            url: '<?php //echo base_url(); ?>common_controller/get_product_list_combo',
//            type: 'POST',
//            data: {category_id: category_id, brand_id: brand_id, sub_category_id: sub_category_id},
//            success: function (data) {
//                //alert(data);
//                $(".product_list").html(data);
//                $('select').select2();
//            }
//        });
//    }


//    $(".search_panel ").on("click", function (e) {
//        e.preventDefault();
//        var category_id = $(".product_category_id option:selected").val();
//        var brand_id = $(".product_brand_id option:selected").val();
//        var sub_category_id = $(".product_subcategory_id option:selected").val();
//        var product_id = $(".product_id option:selected").val();
//        var order_id = $("#order_id").val();
//        $.ajax({
//            url: '<?php //echo base_url(); ?>common_controller/get_product_list_view',
//            type: 'POST',
//            data: {category_id: category_id, brand_id: brand_id, sub_category_id: sub_category_id, product_id: product_id, order_id: order_id},
//            success: function (data) {
//                $(".product_list_item").html(data);
//            }
//        });
//    });
//    $(".add_item").click(function () {
//        $(".product_list_item").html('');
//        var vendor_id = $(".vendor_id option:selected").val();
//        var order_date = $("#order_date").val();
//        var lc_number = $(".lc_number").val();
//        //var order_date = $(".order_date").val();
//        ///alert(order_date);
//        if (vendor_id && order_date && lc_number && order_date) {
//            $(this).attr("data-target", "#add_item");
//
//            $.ajax({
//                url: '<?php echo base_url(); ?>purchase/save_purchase_order',
//                type: 'POST',
//                data: $("#my_form").serialize(),
//                success: function (data) {
//                    //alert(data);
//                    $(".order_id").val(data);
//                    //$('select').select2();
//                }
//            });
//        } else {
//            alert("Please fill all field currectly");
//        }
//    });

    $(document).on("click",".delete_product", function () {

        var order_details_id = $(this).attr('order_details_id');
        var elem = $(this);
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/delete_product',
            type: 'POST',
            data: {order_details_id: order_details_id},
            success: function (data) {
                //alert(data);
                //$(".order_id").val(data);
                //$('select').select2();
                elem.parent().parent().remove();
                if (data == 1) {
                    calculation();
                }
            }
        });

    });
    
    $(document).on('blur','.updates',function(){
        var order_details_id = $("#order_id").val();
        var field_name = $(this).attr('field_name');
        var value = $(this).val();
        var product_id = $(this).parent().parent().find(".product_id").val();
//        alert(value);
//        alert(field_name);
//        alert(order_details_id);
//        return false;
//        var quantity  = $(this).parent().parent().find(".quantity").val();
//        var price = $(this).parent().parent().find(".price").val();
//        alert(quantity);
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/update_product',
            type: 'POST',
            data: {order_details_id: order_details_id,field_name:field_name,value:value,product_id:product_id},
            success: function (data) {
                
            }
        });
    });
    
    $(document).on("click",'.delete_cost_component', function () {

        var order_details_id = $(this).attr('order_details_id');
        var cost_component_id = $(this).attr('cost_component_id');
        var purchase_cost_component_id = $(this).attr('purchase_cost_component_id');
        var order_id = $('.order_id').val();
        var elem = $(this);
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/delete_cost_component',
            type: 'POST',
            data: {order_details_id: order_details_id,cost_component_id:cost_component_id,order_id:order_id,purchase_cost_component_id:purchase_cost_component_id},
            success: function (data) {
                $(".cost_component_list").html(data);
                //elem.parent().parent().remove();
            }
        });

    });
    $(document).on("click",'.edit_cost_component', function () {

        var order_details_id = $(this).attr('order_details_id');
        var purchase_cost_component_id = $(this).attr('purchase_cost_component_id');
        $('.purchase_cost_component_id').val(purchase_cost_component_id);
        var cost_component_id = $(this).attr('cost_component_id');
        var cost_total_usd = $(this).attr('cost_total_usd');
        //alert(cost_total_usd);
        var cost_total = $(this).attr('cost_total');
        var elem = $(this);
        var html = '<a href="javascript:void(0);" class="btn btn-sm btn-primary update_cost_button"><span class=""></span> Update </a>';
        $('.cost_component_btn').html(html);
        $('.cost_component').select2('val',cost_component_id);
        $('.cost_value').val(cost_component_id);
        $('.cost_value_usd').val(cost_total_usd);
        $('.cost_value').val(cost_total);

    });
    $(document).on("click",".update_cost_button ", function () {

        var order_id = $(".order_id").val();
        var cost_component = $(".cost_component option:selected").val();
        var cost_value_usd = $(".cost_value_usd").val();
        var cost_value = $(".cost_value").val();
        var purchase_cost_component_id = $(".purchase_cost_component_id").val();
        var html= '<a href="javascript:void(0);" class="btn btn-sm btn-primary add_button"><span class="glyphicon glyphicon-plus"></span> Add </a>';
        if(order_id && cost_component && cost_value){
            $.ajax({
                url: '<?php echo base_url(); ?>purchase/update_cost_component',
                type: 'POST',
                data: {order_id:order_id,cost_component:cost_component,cost_value:cost_value,cost_value_usd:cost_value_usd,purchase_cost_component_id:purchase_cost_component_id},
                success: function (data) {
                    $(".cost_component_list").html(data);
                    $('.cost_component_btn').html(html);
                    $('.cost_component').select2('val','');
                    $('.cost_value_usd').val('');
                    $('.cost_value').val('');

                }
            });
        }else{
            alert("Give Input Properly");
        }

    });

    $(document).ready(calculation);
    $(document).on("input",".quantity", function () {
        var quantity = $(this).val()||0;
        //alert(quantity);
        var order_details_id = $(this).attr("order_details_id");
        var price = $(this).parent().parent().find(".price").val()||0;
        //alert(price);
        var subtotal = parseFloat(parseFloat(quantity) * parseFloat(price)).toFixed(2);
        $(this).parent().parent().find(".sub_total").text(addCommas(subtotal));
        update_order_details(order_details_id, quantity, price);
        calculation();
    });
    $(document).on("input",".price", function () {
        var price = $(this).val()||0;
        var order_details_id = $(this).attr("order_details_id");
        var quantity = $(this).parent().parent().find(".quantity").val()||0;
        var subtotal = parseFloat(parseFloat(quantity) * parseFloat(price)).toFixed(2);
        $(this).parent().parent().find(".sub_total").text(addCommas(subtotal));
        update_order_details(order_details_id, quantity, price);
        calculation();
    });
    $(document).on("input",".price_usd", function () {
        
        var price_usd = $(this).val()||0;
        var order_details_id = $(this).attr("order_details_id");
        var quantity = $(this).parent().parent().find(".quantity").val()||0;
        var unit_price = $('.exchange_rate').val();
        
        var usdtobdtprice = parseFloat(parseFloat(unit_price) * parseFloat(price_usd)).toFixed(2);
        $(this).parent().parent().find(".price").val(usdtobdtprice);
        var price = $(this).parent().parent().find(".price").val()||0;
        var subtotal = parseFloat(parseFloat(quantity) * parseFloat(price)).toFixed(2);
        $(this).parent().parent().find(".sub_total").text(addCommas(subtotal));
        //alert(usdtobdtprice);
        update_order_details_usd(order_details_id, quantity, price_usd);
        update_order_details(order_details_id, quantity, price);
        calculation();
    });
    
    $(document).on("input",".cost_value_usd", function () {
        var usd_price = $(this).val();
        var exchange_rate = $('.exchange_rate').val();
        var total = usd_price*exchange_rate;
        $('.cost_value').val(total);
    });
    function update_order_details_usd(order_details_id, quantity, price_usd) {
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/update_product_details_usd',
            type: 'POST',
            data: {order_details_id: order_details_id, quantity: quantity, purchase_price_usd: price_usd},
            success: function (data) {
//                    //alert(data);
//                    $(".order_id").val(data);
//                    //$('select').select2();
//                    elem.parent().parent().remove();
//                    if(data==1){
//                        calculation();
//                    }
            }
        });
    }
    function calculation() {
        var sum = 0;
        $(".sub_total").each(function () {
            var subtotal_text = $(this).text();
            var subtotal_string = subtotal_text.replace(",", "");
            var sub_total = parseFloat(subtotal_string).toFixed(2);
            sum = parseFloat(parseFloat(sum) + parseFloat(sub_total)).toFixed(2);
			

        });
        $(".total").text(addCommas(sum));
        var translator = new T2W("EN_US");
        $(".total_inword").text('Total In Word : '+capitalizeEachWord(translator.toWords(Math.floor( sum )))+' Taka (Only)');
    }
    function update_order_details(order_details_id, quantity, price) {
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/update_product_details',
            type: 'POST',
            data: {order_details_id: order_details_id, quantity: quantity, purchase_price: price},
            success: function (data) {
//                    //alert(data);
//                    $(".order_id").val(data);
//                    //$('select').select2();
//                    elem.parent().parent().remove();
//                    if(data==1){
//                        calculation();
//                    }
            }
        });
    }
    $(".save").on("click", function (e) {
        e.preventDefault();
        var order_id = $(".order_id").val();
        //alert(order_id);
        var request_ship_date = $('#request_ship_date').val();
        var shipping_method_id = $(".shipping_method_id option:selected").val();
        var shipping_advice = $(".shipping_advice").val();
        var remarks = $(".remarks").val();
        //var model_btn_name = $('.model_btn_name').text();
        if (order_id) {
            if(request_ship_date || shipping_method_id || shipping_advice|| remarks){
                $.ajax({
                    url: '<?php echo base_url(); ?>purchase/check_order_details',
                    type: 'POST',
                    data: {order_id: order_id},
                    success: function (data) {
                        if (data > 0) {
                            $.ajax({
                                url: '<?php echo base_url(); ?>purchase/save_aditional_info',
                                type: 'POST',
                                data: {order_id: order_id,request_ship_date:request_ship_date,shipping_method_id:shipping_method_id,shipping_advice:shipping_advice,remarks:remarks}, 
                                success: function (data) {
                                    window.location.href = "<?php echo base_url(); ?>purchase/order_details/"+order_id; 
                                }
                            });
                        } else {
                            var htm ='<div class="invalid alert alert-danger">';
                            htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                            htm += 'you have not select any product';
                            htm +='</div>';
                            $('.adi_info_block').html(htm);
                            
                        }
                        //return true;
                    }
                });
            }else{
                $.ajax({
                    url: '<?php echo base_url(); ?>purchase/check_order_details',
                    type: 'POST',
                    data: {order_id: order_id},
                    success: function (data) {
                        if (data > 0) {
                            window.location.href = "<?php echo base_url(); ?>purchase/order_details/"+order_id; 
                                
                        } else {
                            var htm ='<div class="invalid alert alert-danger">';
                            htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                            htm += 'No product selected';
                            htm +='</div>';
                            $('.adi_info_block').html(htm);
                            
                        }
                        //return true;
                    }
                });
            }
            
        } else {
            var htm ='<div class="invalid alert alert-danger">';
            htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            htm += 'Please Save Order First.';
            htm +='</div>';
            $('.adi_info_block').html(htm);
            
        
        }

    });
    
    function calculation_parsentage() {
        var sum = 0;
        var total = $('.total').text();
        var cost_value = $(".cost_value").val();
        sum = (parseFloat(cost_value)*parseFloat(total))/100;
        return sum;
    }
	
    $(document).on("click",'.add_button', function () {
        var order_id = $(".order_id").val();
        var cost_component = $(".cost_component option:selected").val();
        var cost_value_usd = $(".cost_value_usd").val();
        //alert(cost_value_usd);
        var cost_value ;
        if($('#percentage').is(':checked')){
            cost_value = calculation_parsentage();
        }else{
           cost_value = $(".cost_value").val();
        }
        if(order_id ){
            if(cost_component && cost_value){
                $.ajax({
                    url: '<?php echo base_url(); ?>purchase/add_ajax_cost_component_view',
                    type: 'POST',
                    data: {order_id:order_id,cost_component:cost_component,cost_value:cost_value,cost_value_usd:cost_value_usd},
                    success: function (data) {
                        $(".cost_component_list").html(data);
                        $(".cost_component").select2('val','');
                        $(".cost_value").val('');
                        $(".cost_value_usd").val('');
                    }
                });
            }else{
                var htm ='<div class="invalid alert alert-danger">';
                htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                htm += 'Please fill required values.';
                htm +='</div>';
                $('.cost_component_block').html(htm);
                
            }
            
        }else{
            var htm ='<div class="invalid alert alert-danger">';
            htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            htm += 'Submit Order First..';
            htm +='</div>';
            $('.cost_component_block').html(htm);
            
        }
        

    });
	
	$(document).on('click','.delete_doc',function(){
        var puchase_supporting_doc_id = $(this).attr('puchase_supporting_doc_id');
        var elem = $(this);
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/delete_supporting_doc',
            type: 'POST',
            data: {puchase_supporting_doc_id:puchase_supporting_doc_id},
            success: function (data) {
                elem.parent().parent().remove();
            }
        });
    });
	
//    $(document).on("click",".remove_btn", function () {
////        alert("bjghgj");
//        $(this).parent('div').parent('div').parent('div.remove_div').remove();
//    });
</script>


<style>
    .modal {
    /* new custom width */
    width: 100%;
    /* must be half of the width, minus scrollbar on the left (30px) */
   
}
</style>