<form class="form-horizontal" id="create_deligation_hirarchy" action="" method="post">
                <div class="text-center msg_block"></div>
                <div class="col-lg-12">
                    <div class="col-lg-4 defined_hierarchy_area">
                        <div class="list_parrent main_list">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Approval Persons</h3>
                                </div>
                                <div class="panel-body">
                                <ul id="lots"  style="min-height: 20px; border: 1px solid #ccc;">
                                    <?php                                    
                                            foreach ($approval_persons->result() as $k=>$v)
                                            { ?>
                                                <li id="" class="draggable jak btn-info"><?= $v->username; ?>
                                                    <span class="must_approve pull-right">
                                                        <select class="decline_logic" name="" style="color:#000;">
                                                            <option value="Initiator">Initiator</option>
                                                            <option value="Previous Approval">Previous Approval</option>
                                                        </select>
                                                        Limit&nbsp;<?= number_format($v->max_limit,2); ?>&nbsp;&nbsp;&nbsp;
                                                        <input type="hidden" class="step_value" name="step[<?= $v->userid?>]" value="">
                                                        <input type="hidden" name="user_id" value="<?= $v->userid; ?>">
                                                        <input type="hidden" name="max_limit" value="<?= $v->max_limit; ?>">
                                                        <input type="hidden" name="limit_type" value="<?= $v->limit_type; ?>">
                                                        <input type="checkbox" name="must_approve" value="1">&nbsp;Must Approve
                                                    </span>
                                                </li>
                                            <?php }
                                    ?>
                                </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 defined_hierarchy_area" style="margin-left: 20px;">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Set Hierarchy</h3>
                            </div>
                            <div class="panel-body">
                        
                        <div>&nbsp;</div>
                        <div class="step_box_area">
                            <fieldset>
                                <div class="col-lg-12">
                                    <b style="font-size: 15px; float: left;"><?php echo "Step ".$step_no; ?></b>
                                    <span style="float: left;" class="text-danger">* &nbsp;&nbsp;</span>&nbsp;&nbsp;
                                    <span  style="width: 150px; float: left;"><input type="text" class="step_name form-control" value="<?php echo @$step_info->step_name?>" placeholder="Workflow Name"></span>
                                    <span class="pull-right">
                                        <input <?php echo ((@$step_info->approve_priority != "All")?"checked='checked'":""); ?> style="margin-left: 10px;" type="checkbox" value="1" class="approve_all_for_step1" name="">&nbsp;&nbsp;All in one sort
                                    </span>
                                    
                                    <span class="approve_priority_parrent" style="<?php echo ((@$step_info->approve_priority == "All")?"display:none;":""); ?>;">
                                        <select class="form-control pull-right approve_priority" id="approve_priority" style="padding-bottom:0px;margin-right: 0px; width: 30%;">
                                            <option value="">Select</option>
                                            <option <?php echo ((@$step_info->approve_priority == "Majority")?"selected='selected'":""); ?> value="majority">Majority</option>
                                            <option <?php echo ((@$step_info->approve_priority == "Minority")?"selected='selected'":""); ?> value="minority">Minority</option>
                                            <option <?php echo ((@$step_info->approve_priority == "All")?"selected='selected'":""); ?> value="all">All</option>
                                        </select> 
                                    </span>
                                    <span><input type="hidden" class="approveForId" value="<?php echo @$approve_for_id; ?>"></span>
                                    <span><input type="hidden" class="stepNo" value="<?php echo @$step_no; ?>"></span>
                                    <span><input type="hidden" class="stepAction" value="<?php echo @$action; ?>"></span>
                                </div>
                                <div class="col-lg-12" style="padding:0; margin-top: 5px;">
                                    <label for="" class="col-lg-3 control-label">Approve By</label>
                                    <div class="col-lg-6">
                                        <select class="approve_by form-control">
                                            <option <?php echo ((@$step_info->manage_by == "Sorting")?"selected='selected'":""); ?> value="Sorting">Sorting</option>
                                            <option <?php echo ((@$step_info->manage_by == "Limit")?"selected='selected'":""); ?> value="Limit">Limit</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div>&nbsp;</div>
                                <div  class="list_parrent">
                                    <input type="hidden" class="step_catch" value="1">
                                    <ul id="enough" class="droppable_1" style="min-height: 20px; border: 1px solid #ccc; ">
                                        <?php
                                            if(isset($step_no_persons))
                                            {
                                                 foreach ($step_no_persons->result() as $k=>$v)
                                                { 
                                                     $ca = $this->deligation_model->check_must_approve($approve_for_id,$step_no,$v->userid);
                                                ?>
                                                    <li id="" class="draggable jak btn-info"><?= $v->username; ?>
                                                        <span class="must_approve pull-right">
                                                            <select class="decline_logic" name="" style="color:#000;">
                                                                <option <?php echo ((@$ca->decline_logic == "Initiator")?"selected='selected'":""); ?> value="Initiator">Initiator</option>
                                                                <option <?php echo ((@$ca->decline_logic == "Previous Approval")?"selected='selected'":""); ?> value="Previous Approval">Previous Approval</option>
                                                            </select>
                                                            Limit&nbsp;<?= number_format($v->max_limit,2); ?>&nbsp;&nbsp;&nbsp;
                                                            <input type="hidden" class="step_value" name="step[<?= $v->userid?>]" value="">
                                                            <input type="hidden" name="user_id" value="<?= $v->userid; ?>">
                                                            <input type="hidden" name="max_limit" value="<?= $v->max_limit; ?>">
                                                            <input type="hidden" name="limit_type" value="<?= $v->limit_type; ?>">
                                                            <input <?php echo (($ca->must_approve == 1)?"checked='checked'":""); ?> type="checkbox" name="must_approve" value="1">&nbsp;Must Approve
                                                        </span>
                                                    </li>
                                                <?php }
                                            }
                                               
                                        ?>
                                    </ul>
                                </div>
                            </fieldset>
                        </div>
                        <div>&nbsp;</div>
                        
                            </div>
                            <div style="padding-right: 35px;">
                                <input type="submit" id="save_hirarchy"class="btn btn-primary pull-right" style="margin-top: 10px;margin-right: -15px;" value="Save">
                        </div>
                        </div>
                    </div>
                </div>
            </form>



<script>
    
    $(document).ready(function() {
   
        $("#lots").sortable({
                connectWith: "#enough"
        })

        $("#enough").sortable({
                connectWith: "#lots"
        });
    });
     
     
     $(document).on("click","#save_hirarchy", function (e) {
        e.preventDefault();      
        var obj=[];
        sl=1;
        $('fieldset').each(function(){ 
            var step_name = $(this).find(".step_name").val();
            //alert(step_name);
            var approve_priority = $(this).find(".approve_priority option:selected").val();
            var same_sort = '';
            if ($(this).find(".approve_all_for_step1").is(":checked"))
            {
                same_sort = $(this).find(".approve_all_for_step1").val();
            }
            sort=1;
            $(this).find('.jak').each(function(){
                var userid = $(this).find('input[name=user_id]').val();
                var max_limit = $(this).find('input[name=max_limit]').val();
                var limit_type = $(this).find('input[name=limit_type]').val();
                var must_approve = $(this).find('input:checked').val();
                
                obj.push({'approve_for_id':approve_for_id,'user_id':userid,'max_limit':max_limit,'limit_type':limit_type,'sort_number':sort,'step_number':sl,'must_approve':must_approve,'step_name':step_name,'approve_priority':approve_priority,'same_sort':same_sort});
                sort++;
            });
            sl++;
            
        });
        if(obj.length > 0)
        {
            $.ajax({
                url: '<?php echo base_url(); ?>deligation/save_hirarchy_define',
                type: 'POST',
                data:{obj:obj},
                async: false,
                success: function (data) {
                   if(data == true)
                   {
                        var htm ='<div class="invalid alert alert-success">';
                        htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                        htm += 'Successfully Saved.';
                        htm +='</div>';
                        $('.msg_block').html(htm);
                   }
                }
            });
        }
        else
        {
             var htm ='<div class="invalid alert alert-danger">';
             htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
             htm += 'Star(*) marks field are required.';
             htm +='</div>';
             $('.msg_block').html(htm);
        }
        
    });
    
  </script>
<style>
    .list_parrent ul{
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .list_parrent ul li{
        background: #5bc0de none repeat scroll 0 0;
        cursor: pointer;
        margin: 3px;
        padding: 6px;
    }
    
    .main_list ul li span{
        display: none;
    }
    
    .step_box_area ul li span{
        visibility: visible;
    }
    
    .approval_person{
        text-align: center;
        font-size: 18px;
    }
    .defined_hierarchy_area{
        margin-bottom: 7px;
        padding: 12px 0;
        padding-left: 10px;
        padding-right:10px;
    }
    legend{
        font-size: 12px;
    }
</style>