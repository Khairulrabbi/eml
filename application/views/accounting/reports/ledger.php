<div class="row">
    <div class="col-lg-12">      
        <div class="panel panel-default">
            <div class="panel-heading">Ledger Reports</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="<?php echo base_url();?>reports/ledger" method="post">
                            <div class="col-lg-12" style="margin-left: -10px;">
                                <div class="col-lg-2">
                                    <label>Voucher Type</label>
                                    <select name="voucher_type" class="form-control" >
                                        <option value="">Select</option>

                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <label>Account</label>
                                    <select id="acc_head_id" name="acc_head_id" class="form-control" required="">
                                        <option value="">Select</option>
                                        <?php foreach($acc_head_list as $acc_head){
                                           echo '<option value="'.$acc_head['acc_head_id'].'">'.$acc_head['acc_head_name'].'</option>'; 
                                        }?>
                                    </select>
                                </div>
                                <div class="col-lg-2" style="margin-left: -5px;">
                                    <label>Start Date</label>
                                    <input type="text" name="start_date" value="" class="form-control datepicker"  />
                                </div>
                                <div class="col-lg-2">
                                    <label>End Date</label>
                                    <input type="text" name="end_date" value="" class="form-control datepicker"  />
                                </div>
                                <div class="col-lg-6 text-center" >
                                    <br/>
                                    <button type="submit" class="btn btn-success" >Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php if(!empty($get_ledger)){?>
        <div class="panel panel-default">
            <div class="panel-heading"><div class="col-md-5 text-left">Ledger Report</div> <div class='row'></div></div>
            
            <div class="panel-body">
                
                <div class="table-responsive">
                    <table id="tbl_journal" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Particulars</th>
                                <th>Voucher Type</th>
                                <th>Voucher No</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                            
                            
                            <?php foreach($get_ledger as $ledger){?>
                            <tr>
                                <td><?php echo $ledger['journal_date'];?></td>
                                <td><?php echo $ledger['acc_head_name'];?></td>
                                <td><?php echo $ledger['journal_type'];?></td>
                                <td></td>
                                <td><?php echo $ledger['dr_amount'];?></td>
                                <td><?php echo $ledger['cr_amount'];?></td>
                                <td></td>
                                
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="col-lg-2" style="margin-left: -5px;">
                        <div class="form-group dr_cr_show">
                            <div class="input-group">
                              <div class="input-group-addon">Total Dr.</div>
                              <input value="<?php echo $total_dr->Dr; ?>" type="text" class="form-control" id="total_dr" name="total_dr" readonly="">
                            </div>
                        </div>
                        <div class="form-group dr_cr_show">
                            <div class="input-group">
                              <div class="input-group-addon">Total Cr.</div>
                              <input value="<?php echo $total_cr->Cr; ?>" type="text" class="form-control" id="total_cr" name="total_cr" readonly="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }else{ ?>
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

</script>