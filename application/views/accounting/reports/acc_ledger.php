<div class="row">
    <div class="col-lg-12">      
        <div class="panel panel-default">
            <div class="panel-heading">Ledger Reports</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="<?php echo base_url();?>reports/acc_ledger" method="post">
                                <div class="col-lg-2">
                                    <label>Account</label>
                                    <?php echo acc_head(@$acc_head_id); ?>
                                </div>
                                <div class="col-lg-2">
                                    <label>Start Date</label>
                                    <input type="text" name="start_date" value="<?php echo @$start_date; ?>" class="form-control datepicker" required="" />
                                </div>
                                <div class="col-lg-2">
                                    <label>End Date</label>
                                    <input type="text" name="end_date" value="<?php echo @$end_date; ?>" class="form-control datepicker" required="" />
                                </div>
                                <div class="col-lg-2" >
                                    <br/>
                                    <button type="submit" class="btn btn-success" >Search</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php if(isset($opening_balance)){?>
        <div class="panel panel-default">
            <div class="panel-heading"><div class="col-md-5 text-left">General Ledger</div> <div class='row'></div></div>
            
            <div class="panel-body">
                <h4><?php echo $acc_head_name; ?></h4>
                <div class="table-responsive">
                    <table id="tbl_journal" class="table table-bordered table_report">
                        <thead>
                            <tr>
                                <th style="width:10%">Date</th>
                                <th style="width:35%">Particulars</th>
                                <th style="width:10%">Reference</th>
                                <th style="width:15%">Debit</th>
                                <th style="width:15%">Credit</th>
                                <th style="width:15%">Balance</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                            <tr>
                                <td><?php echo $start_date;?></td>
                                <td>Opening Balance</td>
                                <td></td>
                                <td class="text-right"><?php echo ($opening_balance > 0 || $opening_balance == 0?$opening_balance:'');?></td>
                                <td class="text-right"><?php echo ($opening_balance < 0 ?abs($opening_balance):'');?></td>
                                <td class="text-right"><?php echo $opening_balance;?></td>
                                
                            </tr>
                            
                            <?php
                            $bal = $opening_balance;
                            $total_dr = 0;
                            $total_cr = 0;
                            foreach($get_ledger as $ledger){?>
                            <tr>
                                <td><?php echo $ledger['journal_date'];?></td>
                                <td>-</td>
                                <td>-</td>
                                <td class="text-right"><?php echo $ledger['dr_amount'];$total_dr = $total_dr + $ledger['dr_amount'];?></td>
                                <td class="text-right"><?php echo $ledger['cr_amount'];$total_cr = $total_cr + $ledger['cr_amount'];?></td>
                                <td class="text-right"><?php echo $bal = $bal + $ledger['dr_amount'] - $ledger['cr_amount'];?></td>
                                
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="col-lg-2" style="margin-left: -5px;">
                        <div class="form-group dr_cr_show">
                            <div class="input-group">
                              <div class="input-group-addon">Total Dr.</div>
                              <input value="<?php echo ($opening_balance > 0 || $opening_balance == 0?$opening_balance+$total_dr:$total_dr); ?>" type="text" class="form-control" id="total_dr" name="total_dr" readonly="">
                            </div>
                        </div>
                        <div class="form-group dr_cr_show">
                            <div class="input-group">
                              <div class="input-group-addon">Total Cr.</div>
                              <input value="<?php echo ($opening_balance < 0 ?$opening_balance-$total_cr:$total_cr); ?>" type="text" class="form-control" id="total_cr" name="total_cr" readonly="">
                            </div>
                        </div>
                        <div class="form-group dr_cr_show">
                            <div class="input-group">
                              <div class="input-group-addon">Balance</div>
                              <input value="<?php echo $bal; ?>" type="text" class="form-control" id="total_cr" name="total_cr" readonly="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }else{?>
        <div class="alert alert-warning">
            No result found !!
        </div>
        
        
        <?php } ?>
    </div>  
</div>    
<style>
    .alert {
    padding: 2px;
    margin-bottom: 5px;
}
    .close {
    float: right;
    font-size: 19px;
    font-weight: normal;
    line-height: 12px;
    color: #FFFFFF;
    /* text-shadow: 0 1px 0 #fff; */
    filter: alpha(opacity=20);
    opacity: .8;
    background-color: red;
    border-radius: 5px;
}
</style>
<script>
$(document).ready(function(){
    $('.text-right').each(function(){
        $(this).bdt({bdt_sign:''});
    });
});
</script>