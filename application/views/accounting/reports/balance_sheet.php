<div class="row">
    <div class="col-lg-12">      
        <div class="panel panel-default">
            <div class="panel-heading">Trial Balance</div>
            <div class="panel-body">
                <div class="col-lg-3">
                    <form action="" method="post">
                            <div class="form-group">
                                <label>Start Date</label>
                                <input type="text" name="start_date" value="<?php echo @$start_date; ?>" class="form-control datepicker" required="" />
                            </div>
                            <div class="form-group">
                                <label>End Date</label>
                                <input type="text" name="end_date" value="<?php echo @$end_date; ?>" class="form-control datepicker"  required=""/>
                            </div>
                            <button type="submit" class="btn btn-success" >Search</button>
                    </form>
                </div>
                <div class="table-responsive col-lg-8 col-lg-offset-1">
                    <h3 class="text-center">Discovery Tours & Travels</h3>
                    <p class="text-center">Balance Sheet</p>
                    <p class="text-center"><?php echo (isset($start_date)?date('M d, Y',  strtotime($start_date)).' to '.date('M d, Y',  strtotime($end_date)):date('M d, Y')); ?></p>
                    <h4 class="alert alert-info padded-sm">Assets</h4>
                    <table class="table table-bordered table_report">
                    <?php
                    $total = 0;
                    foreach ($asset_array as $value) {
                        $total = $total + $value['balance'];
                        echo '<tr><td>'.$value['acc_head_name'].'</td><td class="text-right">'.$value['balance'].'</td></tr>';
                    }
                    ?>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th class="text-right"><span class="double-line"><?php echo abs($total);?></span></th>
                        </tr>
                    </tfoot>
                    </table>
                    <h4 class="alert alert-info padded-sm">Liabilities and Owner’s Equity</h4>
                    <table class="table table-bordered table_report">
                    <?php
                    $total = 0;
                    foreach ($lab_owe_array as $value) {
                        $total = $total + $value['balance'];
                        echo '<tr><td>'.$value['acc_head_name'].'</td><td class="text-right">'.$value['balance'].'</td></tr>';
                    }
                    ?>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th class="text-right"><span class="double-line"><?php echo abs($total);?></span></th>
                        </tr>
                    </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>  
</div>
<script>
$(document).ready(function(){
    $('.text-right').each(function(){
        $(this).bdt({bdt_sign:''});
    });
});
</script>