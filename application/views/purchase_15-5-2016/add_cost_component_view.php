<div class="remove_div">
    <div class="col-lg-5">
        <div class="form-group">
            <label for="" class="col-lg-5 control-label">Cost Component Name</label>
            <div class="col-lg-7">
                <?php echo cost_component('',array('class'=>'cost_component'),'',array('cost_component.cost_for'=>'Purchase')); ?>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="form-group">
            <label for="" class="col-lg-3 control-label">Total Cost</label>
            <div class="col-lg-7">
                <input type="number" class="form-control" name="cost_value[]" placeholder="Cost">
            </div>
        </div>
    </div>
    <div class="col-lg-2" style="padding-right: 30px;">
        <div class="form-group">
            <a href="javascript:void(0);" class="btn btn-sm btn-danger pull-right remove_btn"><span class="glyphicon glyphicon-minus"></span> Remove</a>
        </div>
    </div>
</div>

