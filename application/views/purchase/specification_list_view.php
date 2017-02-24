<style>
    .del {
       margin-bottom: 10px; 
    }
</style>

<div class="row"></div>

<div class="col-lg-6">
    <table class="table">
    <thead>
        <tr>
            <th>Spec Type</th>
            <th>Settings</th>
        </tr>
    </thead>
    <tbody>
<?php
$n = 1;
foreach ($specification_list as $list){?>
    <tr>
        <td>
            <?php 
                echo $list['specification_type_name'];
            ?>
        </td>
        <td>
            <div class="btn-group btn-toggle" specification_type_id="<?php echo $list['specification_type_id'] ?>"> 
                <input type="hidden" name="specification_type_id[]" value="<?php echo (isset($list['specification_details'])?$list['specification_details']:'No'); ?>_<?php echo $list['specification_type_id'] ?>" class="specification_type_id">
                <button value="Yes_<?php echo $list['specification_type_id'] ?>" class="btn btn-xs <?php echo (($list['specification_details'] == "Yes")?"btn-primary":"btn-default"); ?> yesno">Yes</button>
                <button value="No_<?php echo $list['specification_type_id'] ?>" class="btn btn-xs <?php echo (($list['specification_details'] == "No")?"btn-primary":(!isset($list['specification_details'])?"btn-primary":"btn-default")); ?> yesno">No</button>
            </div>
        </td>
    </tr>
<?php  }?>
    </tbody>
    <tfoot>
    <tr>
        <td>&nbsp;</td>
        <td><button type="submit" class="btn btn-primary pull-right sp_submit" >Save</button></td>
    </tr>
    </tfoot>
</table>
</div>

<script>
$('.btn-toggle').click(function(e) {
    e.preventDefault();
    $(this).find('.btn').toggleClass('active');  
    if ($(this).find('.btn-primary').size()>0) {
    	$(this).find('.btn').toggleClass('btn-primary');
    }
    $(this).find('.btn').toggleClass('btn-default');
       
});
</script>


