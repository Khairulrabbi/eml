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
                    <p class="text-center">Trial Balance</p>
                    <p class="text-center"><?php echo date('M d, Y'); ?></p>
                    <table id="tbl_journal" class="table table-bordered table_report">
                        <thead>
                            <tr>
                                <th style="width:35%">Particulars</th>
                                <th style="width:15%">Debit</th>
                                <th style="width:15%">Credit</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                            <?php
                            //$bal = $opening_balance;
                            $total_dr = 0;
                            $total_cr = 0;
                            foreach($tr_balance as $trb){
                                $total_dr = $total_dr + ($trb['balance'] > 0 || $trb['balance'] == 0 ?$trb['balance']:0);
                                $total_cr = $total_cr + ($trb['balance'] < 0 ?$trb['balance']:0);
                                ?>
                            <tr>
                                <td><?php echo '<a href="acc_ledger_by_trbalance?acc_head_id='.$trb['acc_head_id'].'&start_date='.@$start_date.'&end_date='.@$end_date.'" title="Go to ledger of '.$trb['acc_head_name'].'">'.$trb['acc_head_name'].'</a>';?></td>
                                <td class="text-right"><?php echo ($trb['balance'] > 0 || $trb['balance'] == 0?$trb['balance']:'');?></td>
                                <td class="text-right"><?php echo ($trb['balance'] < 0 ?abs($trb['balance']):'');?></td>
                                
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th class="text-right"><span class="double-line"><?php echo $total_dr;?></span></th>
                                <th class="text-right"><span class="double-line"><?php echo abs($total_cr);?></span></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>  
</div>