<div>
   <form class="form-horizontal" id="add_product" action="" method="post" enctype="multipart/form-data"> 

        <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php
                            if(isset($_GET['p_id'])) {
                                $p_id = $_GET['p_id'];
                                $title = label_html(UPDATE_PRODUCT, 'UPDATE_PRODUCT');
                            } else {
                                $title = label_html(ADD_NEW_PRODUCT, 'ADD_NEW_PRODUCT');
                            }
                            ?>
                            <h3 class="panel-title"> <?php echo $title; ?><p class="pull-right text-danger " style="font-size: 16px;font-style: oblique;padding-right: 24px;"><?php echo (isset($order_id)?$status:''); ?></p></h3>
                        </div>
                        <div class="panel-body">
                            <div class="text-center order_block"></div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="">
                                            <input type="hidden" name="product_id" id="product_id" value="<?php echo @$product_info->product_id?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_name" class="col-lg-3 control-label"><?php echo label_html(PRODUCT_NAME, 'PRODUCT_NAME'); ?><span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="product_name" id="product_name" placeholder="Product Name" value="<?php echo @$product_info->product_name; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="model_name" class="col-lg-3 control-label"><?php echo label_html(MODEL_NAME, 'MODEL_NAME'); ?> <span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="model_name" id="model_name" placeholder="Model Name" value="<?php echo @$product_info->model_name; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="product_code" class="col-lg-3 control-label"><?php echo label_html(PRODUCT_CODE, 'PRODUCT_CODE'); ?></label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="product_code" id="product_code" placeholder="Product Code" value="<?php echo @$product_info->product_code; ?>">
                                        </div>
                                    </div>

<!--                                    <div class="form-group">
                                        <label for="" class="col-lg-3 control-label">Do</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="do_product" id="do_product" placeholder="Do" value="<?php // echo @$product_info->do_product; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="col-lg-3 control-label">Line</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="line" id="line" placeholder="Line" value="<?php // echo @$product_info->line; ?>">
                                        </div>
                                    </div>-->
                                    <div class="form-group">
                                        <label for="region_id" class="col-lg-3 control-label"><?php echo label_html(REGION, 'REGION'); ?> <span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <?php 
                                            $dd_data['selected_value'] =@$product_info->region_id;
                                            $dd_data['extra_attr'] =array('class' => 'region_id', 'required' => 'required');
                                            echo ap_drop_down(22,null,$dd_data); 
                                            ?>
                                            <?php //echo region_id(@$product_info->region_id, array('class' => 'region_id', 'required' => 'required')); ?>
                                        </div>
                                    </div>
                                    <div class="form-group" style="display: none">
                                        <label for="product_category_id" class="col-lg-3 control-label"><?php echo label_html(PRODUCT_CATEGORY, 'PRODUCT_CATEGORY'); ?></label>
                                        <div class="col-lg-9">
                                            
                                            <?php echo category_list((@$product_info->product_category_id)?@$product_info->product_category_id:1, array('class' => 'product_category_id', 'required' => 'required')); ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-4">

                                    

                                    <div class="form-group">
                                        <label for="group_id" class="col-lg-3 control-label"><?php echo label_html(GROUP, 'GROUP'); ?> <span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <?php 
                                            $dd_Data['selected_value'] = @$product_info->product_group_id;
                                            $dd_Data['extra_attr'] = array('class' => 'product_group_id', 'required' => 'required');
                                            echo ap_drop_down(23,NULL,$dd_Data); 
                                            ?>
                                            <?php // echo product_group_id(@$product_info->product_group_id, array('class' => 'product_group_id', 'required' => 'required')); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="col-lg-3 control-label">Unit</label>
                                        <div class="col-lg-9">
                                            <?php
                                            $dd_Data['selected_value'] = @$product_info->unit;
                                            $dd_Data['extra_attr'] =array('class' => 'unit', 'required' => 'required');
                                            echo ap_drop_down(24,NULL,$dd_Data); 
                                            ?>
                                            <?php //echo unit(@$product_info->unit, array('class' => 'unit', 'required' => 'required')); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="unit_price_usd" class="col-lg-3 control-label">Unit M3<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="unit_m3" id="unit_m3" placeholder="Unit M3" value="<?php echo @$product_info->unit_m3; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="unit_price_usd" class="col-lg-3 control-label"><?php echo label_html(PRICE_USD, 'PRICE_USD')?><span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="unit_price_usd" id="unit_price_usd" placeholder="Unit Price(USD)" value="<?php echo @$product_info->unit_price_usd; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-lg-3 control-label">Price(BDT)<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="unit_price" id="unit_price" placeholder="Unit Price(BDT)" value="<?php echo @$product_info->unit_price; ?>">
                                        </div>
                                    </div>




                                </div>


                                <div class="col-lg-4">

                                    <div class="form-group">
                                        <label for="unit_measure" class="col-lg-3 control-label"><?php echo label_html(SDATA, 'SDATA')?></label>
                                        <div class="col-lg-9">
                                            <div class="col-lg-8" style="padding: 0px;">
                                                <input <?php echo strrchr(@$product_info->sdta,'S')?'checked="checked"':''; ?> fa="s" type="checkbox" class="sdta_checkbox1 sdtac" value="S">&nbsp;&nbsp;S&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input <?php echo strrchr(@$product_info->sdta,'D')?'checked="checked"':''; ?> fa="d" type="checkbox" class="sdta_checkbox2 sdtac" value="D">&nbsp;&nbsp;D&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input <?php echo strrchr(@$product_info->sdta,'T')?'checked="checked"':''; ?> fa="t" type="checkbox" class="sdta_checkbox3 sdtac" value="T">&nbsp;&nbsp;T&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input <?php echo strrchr(@$product_info->sdta,'A')?'checked="checked"':''; ?> fa="a" type="checkbox" class="sdta_checkbox4 sdtac" value="A">&nbsp;&nbsp;A
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-lg-3 control-label"></label>
                                        <div class="col-lg-9">
                                            <div class="col-lg-4" style="padding: 0px;">
                                                <input readonly="readonly" class="form-control sdta" type="text" name="sdta" value="<?php echo @$product_info->sdta; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="unit_measure" class="col-lg-3 control-label"><?php echo label_html(VEHICLE_TYPE, 'VEHICLE_TYPE')?><span class="text-danger">*</span></label>
        <!--                                <div class="col-lg-9">-->
                                            <div class="col-lg-4 vehicle_type_parrent">
                                                <?php
                                                $dd_Data['selected_value'] =@$product_info->vehicle_type_id;
                                                $dd_Data['extra_attr'] =array('class' => 'vehicle_type_id');
                                                echo ap_drop_down(35,NULL,$dd_Data);
                                                ?>
                                            </div>
                                            <div class="col-lg-4"><span class="btn btn-default create_button" style="">O.Type</span></div>

        <!--                                </div>-->
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="col-lg-3 control-label"></label>
                                            <div class="col-lg-9 show_new_vehicle_text_box">

                                            </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="vendor" class="col-lg-3 control-label"><?php echo label_html(DESCRIPTION, 'DESCRIPTION')?></label>
                                        <div class="col-lg-9">
                                            <textarea name="description" id="description" class="form-control" placeholder="Description" ><?php echo @$product_info->description;?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="unit_measure" class="col-lg-3 control-label"><?php echo label_html(STATUS, 'SATUS')?><span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <select name="status">
                                                <option value="">Select Status</option>
                                                <option selected="selected" value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">SPECEFICATION_DETAILS</div>                        
                            <div class="panel-body">
                                <div class="col-lg-12" style="padding: 0">
                                    <?php
                                        $pdj = @json_decode($product_info->product_details_json,TRUE);
                                        foreach ($specification_list as $sl)
                                        {?>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                    <label for="product_specification" class="col-lg-3 control-label"><?php echo $sl['specification_type_name']; ?></label>
                                                    <div class="col-lg-9">
                                                            <input class="form-control" type="text" name="product_specification[<?php echo $sl['specification_type_id']; ?>]" id="product_specification" placeholder="" value="<?php echo @$pdj[$sl['specification_type_id']]; ?>">
                                                    </div>
                                            </div>
                                        </div>
                                        <?php }
                                    ?>
                                </div> 
                            </div>
                        </div>
                  </div>
            </div>
      </form>
</div>
<div class="col-lg-11">
    <?php
        //$p_id = $_GET['p_id'];
        if(isset($_GET['p_id']) && $_GET['p_id'] !='') {
            ?>
        <div>
            <input type="button" id="save_product_info"class="btn btn-primary pull-right" value="Update Product">
            <!--<input type="button" id="update_product_info"class="btn btn-primary pull-right update_product_info" value="Update Product">-->
        </div>
        <?php
        } else {
            ?>
        <div>
            <input type="button" id="save_product_info"class="btn btn-danger pull-right" value="Save Product">
        </div>
        <?php
        }
    ?>
</div> 
       
       
<div id="div2">
    
</div>


<script>    
    $(document).on("click", ".create_button", function () {
        $('.show_new_vehicle_text_box').html('<input style="margin-top:6px;" name="new_vehicle" class="form-control" type="text" placeholder="New Vehicle Type" value="">');      
        $(this).addClass('hide_button');
        $(this).removeClass('create_button');
    });
    $(document).on("click", ".hide_button", function () {
        $('.show_new_vehicle_text_box').html('');
        $(this).addClass('create_button');
        $(this).removeClass('hide_button');
    });
    $('.sdtac').click(function(){
        var s = '';
        var d = '';
        var t = '';
        var a = '';
        if($('.sdta_checkbox1').is(':checked'))
        {
           s = $('.sdta_checkbox1').val();
        }
        if($('.sdta_checkbox2').is(':checked'))
        {
           d = $('.sdta_checkbox2').val();
        }
        if($('.sdta_checkbox3').is(':checked'))
        {
           t = $('.sdta_checkbox3').val();
        }
        if($('.sdta_checkbox4').is(':checked'))
        {
           a = $('.sdta_checkbox4').val();
        }
        $('.sdta').val(s+d+t+a);
    });
    
    
    $('#save_product_info').click(function(e){
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>inventory/add_product_submit',
            type: 'POST',
            data: $("#add_product").serialize(),
            success: function (response) {
                if(response == true)
                {
                    var htm ='<div class="alert alert-success">';
                    htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                    htm += 'Successfully Completed.';
                    htm +='</div>';
                    $('.order_block').html(htm);
                }
                else
                {
                    var htm ='<div class="alert alert-danger">';
                    htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                    htm += response;
                    htm +='</div>';
                    $('.order_block').html(htm);
                }
                
            }
        });        
    });
    
    $(function(){
        var product_suggest = <?php echo $product_suggest; ?>;
        $("#product_name").autocomplete({
            source:product_suggest
        });
    });
    $(function(){
        var model_suggest = <?php echo $model_suggest; ?>;
        $("#model_name").autocomplete({
            source:model_suggest
        });
    });
</script>



<style>
    input[type="text"]{
        width: 200px;
    }
    
    .select2-container{
        width: 200px;
    }
    #description{
        width: 200px;
    }
    .vehicle_type_id{
        width: 140px !important;
    }
    .select2-search input {
        width: 190px !important;
      }
/*    .vehicle_type_parrent .select2-search input {
        width: 131px !important;
      }*/
</style>

