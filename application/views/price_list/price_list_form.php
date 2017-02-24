<!--<form class="form-horizontal"  id="my_form" method="post" action="<?php echo base_url() ?>purchase/update_order/<?php echo @$order_id; ?>">-->
    <input type="hidden" id="order_id" class="order_id gorder_id" name="order_id" value="<?php echo @$order_id; ?>">
    <input type="hidden" class="main_order_id" name="main_order_id" value="<?php echo @$order_id; ?>">  
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        Create Price List
                        <p class="pull-right text-danger po_generated" style="font-size: 16px;font-style: oblique;padding-right: 24px;"><?php echo (isset($_GET['p_code'])?"Purchase Code : ".$_GET['p_code'].", ":"").(isset($order_id)?"Status : ".$status:''); ?></p>
                    </h5>
                </div>
                <div class="panel-body">
                    <div class="text-center order_block"></div>
                    <form class="form-horizontal" id="price_list" action="" method="post">
                        <div class="col-lg-3">   
                            <div class="form-group">
                                <label for="" class="col-lg-5 control-label">Name<span class="text-danger">*</span></label>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control price_list_name" placeholder="Price List Name" name="price_list_name" step="any" value="<?php echo @$p_list->price_list_name; ?>">
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-lg-3">   
                            <div class="form-group">
                                <label for="" class="col-lg-5 control-label">Budget&nbsp;Year<span class="text-danger">*</span></label>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control budget_year" placeholder="Budget Year" name="budget_year" step="any" value="<?php echo @$p_list->budget_year; ?>">
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="" class="col-lg-3 control-label">Effective&nbsp;Date<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="date" class="form-control effective_date" placeholder="Effective date" id="effective_date" name="effective_date" value="<?php echo @$p_list->effective_date; ?>" >
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="" class="col-lg-3 control-label">Price&nbsp;Type<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <select class="list_type" name="list_type">
                                        <?php foreach ($price_type as $k=>$v) {?>
                                        <option <?php echo (($type2 == $v)?"selected='selected'":"") ?> value="<?php echo $v; ?>"><?php echo $v; ?> </option>
                                            <?php  }  ?>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row "></div>
                        <div style="padding-right: 15px;">
                            <input type="button" id="save_price_list"class="btn btn-primary pull-right" value="Save">
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
                    <div class="text-center adi_info_block"></div>
                    <button module="price_list" type="button" id="add_product" class="btn btn-danger add_products" data-toggle="modal"><?php echo ADD_ITEM; ?></button>
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
                                    <th style="width: 100px;"><?php echo label_html(PRICE_BDT,'PRICE_BDT'); ?></th>
                                    <th><?php echo label_html(ACTION,'ACTION'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo @$selected_product_list; ?>
                            </tbody>
                            

                        </table>


                        <div class="col-lg-6">

                        </div>
                        <div class="col-lg-2"></div>

                    </div>
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

                        
                            <?php
                                echo custom_search_panel('common_controller/get_product_list_view',array("region","group","warehouse_list"),array('2','3','5','6'));
                            ?>
                        <form id="product_form" class="form-horizontal" action="">
                            <input type="hidden" id="order_id" class="order_id" name="order_id" value="<?php echo @$order_id; ?>">
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
	 
    $(document).ready(function(){
        var order_id = $('.main_order_id').val();
        if(order_id){
            $('#save_price_list').val('Update order');
        }
    });
    
  
    $(document).on("click","#save_price_list",function(){        
        var order_id = $('.main_order_id').val();        
        var price_list_name = $(".price_list_name").val();
        var budget_year = $(".budget_year").val();
        var effective_date  = $(".effective_date").val();
        var list_type = $(".list_type option:selected").val();
        
        if(order_id){
           $.ajax({
               // url: '<?php //echo base_url(); ?>purchase/update_purchase_for_purchase_order_block',
                url: '<?php echo base_url(); ?>price_list/update_price_list_for_price_list_order_block',
                type: 'POST',
                data: {order_id:order_id,price_list_name:price_list_name,budget_year:budget_year,effective_date:effective_date,list_type:list_type},
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
                url: '<?php echo base_url(); ?>price_list/save_price_for_price_list_block',
                type: 'POST',
                data: $("#price_list").serialize(),
                success: function (data) {
                    try {
                        var response=jQuery.parseJSON(data);
                        $(".order_id").val(response.id);
                        $(".main_order_id").val(response.id);
                        var htm ='<div class="invalid alert alert-success">';
                        htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                        htm += 'Price List successfully saved.';
                        htm +='</div>';
                        $('.po_generated').text('Price List : '+response.code+", Status : Draft")
                       $('.order_block').html(htm);
                       $('#save_price_list').val('Update Price List');
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
    
    
    
    
    $(document).on("click", ".add_product_btn", function (e) {
        e.preventDefault();
        var order_id = $(".order_id").val();
        $.ajax({
                url: '<?php echo base_url(); ?>price_list/save_order_details',
                type: 'POST',
                data: $("#product_form").serialize(),
                success: function (data) {
                    $.ajax({
                        url: '<?php echo base_url(); ?>price_list/get_product_list',
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
            url: '<?php echo base_url(); ?>price_list/get_product_list',
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

    $(document).on("click",".delete_product", function () {

        var order_details_id = $(this).attr('order_details_id');
        var elem = $(this);
        $.ajax({
            url: '<?php echo base_url(); ?>price_list/delete_product',
            type: 'POST',
            data: {order_details_id: order_details_id},
            success: function (data) {
                elem.parent().parent().remove();
            }
        });

    });
    
    
    $(document).on("input",".price", function () {
        var price = $(this).val()||0;
        var price_list_details = $(this).attr("price_list_details");
         $.ajax({
            url: '<?php echo base_url(); ?>price_list/update_price',
            type: 'POST',
            data: {price: price,price_list_details:price_list_details},
            success: function (data) {
                //
            }
        });
    });
    
    
    
    $(".save").on("click", function (e) {
        e.preventDefault();
        var order_id = $(".order_id").val();
        var list_type = $(".list_type option:selected").val();
        if (order_id) {
            $.ajax({
                url: '<?php echo base_url(); ?>price_list/check_order_details',
                type: 'POST',
                data: {order_id: order_id},
                success: function (data) {
                    if (data > 0) {
                        //window.location.href = "<?php echo base_url(); ?>price_list/price_list_details/"+order_id;
                        //window.location.href = "<?php echo base_url(); ?>price_list/price_history/"+list_type;
                        window.location.href = "<?php echo base_url(); ?>price_list/price_list_details/"+order_id;
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
            htm += 'Please Save price list First.';
            htm +='</div>';
            $('.adi_info_block').html(htm);
        }

    });
    
  
</script>


<style>
    .modal {
    width: 100%;
   
}
</style>