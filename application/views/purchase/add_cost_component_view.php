<!--<div class="remove_div">
    <div class="col-lg-5">
        <div class="form-group">
            <label for="" class="col-lg-5 control-label">Cost Component Name</label>
            <div class="col-lg-7">
                <?php echo cost_component('',array('class'=>'cost_component')); ?>
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
</div>-->

<div class="scrolltable">
        <table class="table">
            <thead>
                <tr>
                    <th>#Sl</th>
                    <th>Cost Component</th>
                    <th>Amount(USD)</th>
                    <th>Amount(BDT)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $totalAmountUsd = 0;
                    $totalAmountBdt = 0;
                    $i=1; 
                    foreach ($cost_component_list as $cost_component){
                    $totalAmountUsd += $cost_component['total_cost_usd'];
                    $totalAmountBdt += $cost_component['total_cost'];
                    ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $cost_component['cost_component_name'];?></td>
                        <td><?php echo number_format($cost_component['total_cost_usd'],2);?></td>
                        <td><?php echo number_format($cost_component['total_cost'],2);?></td>
                        <td>
                            <i style=" cursor: pointer;text-align: center;" class="fa fa-pencil edit_cost_component" aria-hidden="true" purchase_cost_component_id="<?php echo $cost_component['purchase_cost_component_id'];?>" cost_total_usd="<?php echo $cost_component['total_cost_usd'];?>" cost_total="<?php echo $cost_component['total_cost'];?>" cost_component_id="<?php echo $cost_component['cost_component_id'];?>" order_details_id="<?php echo $cost_component['purchase_order_id'];?>"></i>
                            <i style=" cursor: pointer;text-align: center;" class="fa fa-times delete_cost_component" aria-hidden="true" purchase_cost_component_id="<?php echo $cost_component['purchase_cost_component_id'];?>" cost_component_id="<?php echo $cost_component['cost_component_id'];?>" order_details_id="<?php echo $cost_component['purchase_order_id'];?>"></i>
                        </td>
                    </tr>
                <?php $i++;} ?>
                    <tr>
                        <th>&nbsp;</th>
                        <th>Total</th>
                        <th><?php echo number_format($totalAmountUsd,2); ?></th>
                        <th><?php echo number_format($totalAmountBdt,2); ?></th>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>
                        <th colspan="5">Total in word(BDT) : <?php echo convert_number_to_words($totalAmountBdt); ?></th>
                    </tr>
            </tbody>
        </table>

    </div>

