


<div class="col-lg-12">
            <form class="form-horizontal" id="details_info_save" action="" method="post">
            <input type="hidden" id="one" name="panel_id" value="<?php echo $p_id; ?>">
            <input type="hidden" id="two" name="field_type_id" value="<?php echo $v; ?>">
            
            <div class="col-lg-5">
                <?php
                    $selected_value= $v;
                    
                    switch ($selected_value) {
                    case 6 :
                    case 7 :?>
                        <div class="form-group" >
                            <label for="" class="col-lg-4 control-label"><?php echo "Item Title"; ?></label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control item_title" placeholder="Item Title Name" name="item_title" id="item_title" style="margin-bottom: 10px;" value="<?php echo @$edit_info->item_title; ?>">
                            </div>
                        </div>
                        <div class="form-group" >
                            <label for="" class="col-lg-4 control-label"><?php echo "Field Name"; ?></label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control field_name"  name="field_name" id="field_name" style="margin-bottom: 10px;" value="<?php echo @$edit_info->field_name; ?>">
                            </div>
                        </div>  
                        <div class="form-group" >
                            <label for="" class="col-lg-4 control-label"><?php echo "Field Id"; ?></label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control field_id"  name="field_id" id="field_id" style="margin-bottom: 10px;" value="<?php echo @$edit_info->field_id; ?>">
                            </div>
                        </div>
                        <div class="form-group" >
                            <label for="" class="col-lg-4 control-label"><?php echo "Description"; ?></label>
                            <div class="col-lg-8">
                                <textarea class="form-control description" style="margin-bottom: 10px;" placeholder="Add Description" name="description" id="description" value="<?php echo @$edit_info->description; ?>"></textarea>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label for="" class="col-lg-4 control-label"><?php echo "Dropdown"; ?></label>
                            <div class="col-lg-8">
                                <?php echo ap_drop_down(3); ?>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label for="" class="col-lg-4 control-label"><?php echo "Option Concat"; ?></label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control item_comma_separated" placeholder="Comma Separated Value If need" name="item_comma_separated" id="item_comma_separated" style="margin-bottom: 10px;" value="<?php echo @$edit_info->item_comma_separated; ?>">
                            </div>
                        </div>
                        <div class="form-group" >
                            <label for="" class="col-lg-4 control-label"><?php echo "Extra Condition"; ?></label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control dd_extra_condition"  name="dd_extra_condition" id="dd_extra_condition" style="margin-bottom: 10px;" value="<?php echo @$edit_info->dd_extra_condition; ?>">
                            </div>
                        </div>
                        <div class="form-group" >
                            <label for="" class="col-lg-4 control-label"><?php echo "Order By"; ?></label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control dd_order_by"  name="dd_order_by" id="dd_order_by" style="margin-bottom: 10px;" value="<?php echo @$edit_info->dd_order_by; ?>">
                            </div>
                        </div>
                        <div class="form-group" >
                            <label for="" class="col-lg-4 control-label"><?php echo "Option Value"; ?></label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control option_value"  name="option_value" id="option_value" style="margin-bottom: 10px;" value="<?php echo @$edit_info->option_value; ?>">
                            </div>
                        </div>
                        <div class="form-group" >
                            <label for="" class="col-lg-4 control-label"><?php echo "Allow Ajax"; ?></label>
                            <div class="col-lg-8">
                                <input style="margin-left: 5px;" type="checkbox" class="checkbox" id="check_box_click" name="allow_ajax" value="1" <?php echo ((@$edit_info->allow_ajax)== "1" ? "checked" : "");?>>
                               <div class="apw" style="<?php echo ((@$edit_info->allow_ajax)== "1" ? "" : "display: none");?>">
                                    <?php
                                    echo ap_drop_down(4,array('panel_id'=>@$p_id),@$edit_info->ajax_panel_details_id); 
                                    ?>
                               </div>
                            </div>
                        </div>
                        <?php 
                        break;
                    case 1: 
                    case 2:
                    case 3:?>
                        <div class="form-group" >
                            <label for="" class="col-lg-4 control-label"><?php echo "Item Title"; ?></label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control item_title" placeholder="Item Title Name" name="item_title" id="item_title" style="margin-bottom: 10px;" value="<?php echo @$edit_info->item_title; ?>">
                            </div>
                        </div>
                        <div class="form-group" >
                            <label for="" class="col-lg-4 control-label"><?php echo "Field Name"; ?></label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control field_name"  name="field_name" id="field_name" style="margin-bottom: 10px;" value="<?php echo @$edit_info->field_name; ?>">
                            </div>
                        </div>  
                        <div class="form-group" >
                            <label for="" class="col-lg-4 control-label"><?php echo "Field Id"; ?></label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control field_id"  name="field_id" id="field_id" style="margin-bottom: 10px;" value="<?php echo @$edit_info->field_id; ?>">
                            </div>
                        </div>
                        <div class="form-group" >
                            <label for="" class="col-lg-4 control-label"><?php echo "Description"; ?></label>
                            <div class="col-lg-8">
                                <textarea class="form-control description" style="margin-bottom: 10px;" placeholder="Add Description" name="description" id="description" value="<?php echo @$edit_info->description; ?>"></textarea>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label for="" class="col-lg-4 control-label"><?php echo "Placholder"; ?></label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control placholder" placeholder="Add placholder" name="placholder" id="placholder" style="margin-bottom: 10px;" value="<?php echo @$edit_info->placholder; ?>">
                            </div>
                        </div>

                        
                        <div class="form-group" >
                            <label for="" class="col-lg-4 control-label"><?php echo "max Char"; ?></label>
                            <div class="col-lg-8">
                                <input type="number" class="form-control max_char"  name="max_char" id="max_char" style="margin-bottom: 10px;" value="<?php echo @$edit_info->max_char; ?>">
                            </div>
                        </div>
                        <div class="form-group" >
                            <label for="" class="col-lg-4 control-label"><?php echo "Min Char"; ?></label>
                            <div class="col-lg-8">
                                <input type="number" class="form-control min_char"  name="min_char" id="min_char" style="margin-bottom: 10px;" value="<?php echo @$edit_info->min_char; ?>">
                            </div>
                        </div>
                        <div class="form-group" >
                            <label for="" class="col-lg-4 control-label"><?php echo "Regular Expression"; ?></label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control reg_expression" placeholder="" name="reg_expression" id="reg_expression" style="margin-bottom: 10px;" value="<?php echo @$edit_info->reg_expression; ?>">
                            </div>
                        </div>
                        
                        <?php 
                        break;
                    case 10:?>
                        <div class="form-group" >
                            <label for="" class="col-lg-6 control-label"><?php echo "Item Title"; ?></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control item_title" placeholder="Item Title Name" name="item_title" id="item_title" style="margin-bottom: 10px;" value="<?php echo @$edit_info->item_title; ?>">
                            </div>
                        </div>
                        <div class="form-group" >
                            <label for="" class="col-lg-6 control-label"><?php echo "Field Name"; ?></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control field_name"  name="field_name" id="field_name" style="margin-bottom: 10px;" value="<?php echo @$edit_info->field_name; ?>">
                            </div>
                        </div>  
                        <div class="form-group" >
                            <label for="" class="col-lg-6 control-label"><?php echo "Field Id"; ?></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control field_id"  name="field_id" id="field_id" style="margin-bottom: 10px;" value="<?php echo @$edit_info->field_id; ?>">
                            </div>
                        </div>
                        <div class="form-group" >
                            <label for="" class="col-lg-6 control-label"><?php echo "Description"; ?></label>
                            <div class="col-lg-6">
                                <textarea class="form-control description" style="margin-bottom: 10px;" placeholder="Add Description" name="description" id="description" value="<?php echo @$edit_info->description; ?>"></textarea>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label for="" class="col-lg-6 control-label"><?php echo "Is Required Future Date"; ?></label>
                            <div class="col-lg-6">
                            <input style="margin-left: 5px;" type="checkbox" class="checkbox" name="future_date" value="1" <?php echo ((@$edit_info->future_date)== "1" ? "checked" : "");?>>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label for="" class="col-lg-6 control-label"><?php echo "Old Date Max Month"; ?></label>
                            <div class="col-lg-6">
                                <input type="number" class="form-control old_date"  name="old_maximum" id="old_date" style="margin-bottom: 10px;" value="<?php echo @$edit_info->old_maximum; ?>">
                            </div>
                        </div>
                        <div class="form-group" >
                            <label for="" class="col-lg-6 control-label"><?php echo "Maximum Date Range"; ?></label>
                            <div class="col-lg-6">
                                <input type="number" class="form-control max_date_range"  name="max_date_range" id="max_date_range" style="margin-bottom: 10px;" value="<?php echo @$edit_info->max_date_range; ?>">
                            </div>
                        </div>
                        <?php 
                        break;
                    default: ?>
                        
                        <div class="form-group" >
                            <label for="" class="col-lg-4 control-label"><?php echo "Required"; ?></label>
                            <div class="col-lg-8">
                            <input style="margin-left: 5px;" type="checkbox" class="checkbox" name="required" value="1" <?php echo ((@$edit_info->required)== "1" ? "checked" : "");?>>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label for="" class="col-lg-4 control-label"><?php echo "Show Data"; ?></label>
                            <div class="col-lg-8">
                                <input style="margin-left: 5px;" type="checkbox" class="checkbox" name="show" value="1" <?php echo ((@$edit_info->show)== "1" ? "checked" : "");?>>        
                            </div>
                        </div>
                    <?php } 
                    ?>
                
              
                
                
            </div>
            <div class="col-lg-5 pull-right col-lg-offset-1">
            
            </div>
        </form>
   
    <input type="hidden" value="<?php echo @$edit_info->panel_details_id; ?>" id="get_p_d_id" name="panel_details_id">
    <input type="hidden" value="<?php echo @$p_id; ?>" id="panel_id" name="panel_id">
    <div class="col-lg-8 show_details_Data">
        
    </div>
    <div style="margin: 10px;" class="pull-right">
        <?php if(@$edit_info->panel_details_id){?>
        <input type="button" id="update_form"class="btn btn-primary" value="Update"  data-dismiss="modal">
        <?php }else{ ?>
            <input type="button" id="save_form"class="btn btn-primary" value="Save"  data-dismiss="modal">
        <?php } ?>
           
      
   </div>
</div>

<script>
    
   
        $("#check_box_click").click(function () {
            if ($(this).is(":checked")) {
                $(".apw").show();
            } else {
                $(".apw").hide();
            }
        });
   
</script>
