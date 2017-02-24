<link href="<?=base_url()?>css/bootstrap.css" rel="stylesheet">
<link href="<?=base_url()?>css/apsis_style.css" rel="newest stylesheet">
<link href="<?=base_url()?>css/plugins/dataTables.bootstrap.css" rel="stylesheet">
<link href="<?=base_url()?>css/plugins/dataTables.tableTools.css" rel="stylesheet">
<script src="<?=base_url()?>js/jquery-1.11.0.js"></script>
<script src="<?=base_url()?>js/jquery-ui.min.js"></script>
<style>
    table{
        font-size: 75%;
        width: 100%;
    }
    th, td{
        padding: 2px;
    }
    th{
        font-size: 80%;
    }
</style>
<div class="col-lg-12">
    <div class="col-lg-12 text-center">
        <h4>DISCOVERY TOURS & LOGISTIC</h4>
        <h4>JOURNAL</h4>
    </div>
    <div class="col-lg-12">
        <table class="table table-bordered">
            <thead>
                <tr class="table_head_foot">
                    <th class="text-center" style="width: 1%;">SL</th>
                    <th class="text-center" style="width: 10%;">Date</th>
                    <th class="text-center" style="width: 7%;">ACCOUNT</th>
                    <th class="text-center">PARTICULAR</th>
                    <th class="text-center" style="width: 7%;">DEBIT</th>
                    <th class="text-center" style="width: 7%;">CREDIT</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $n=0;
                    foreach ($voucher_info as $value) {
                        $n++;
                ?>
                <tr>
                    <td class="text-center"><?php echo $n; ?></td>
                    <td><?php echo date('jS F Y',  strtotime($value['journal_date'])); ?></td>
                    <td><?php echo $value['acc_head_number']; ?></td>
                    <td>
                        <b><?php echo $value['acc_head_name']; ?></b><br/>
                        &emsp;<?php echo $value['description']; ?>
                    </td>
                    <td class="text-right dr_amount"><?php echo $value['dr_amount']; ?></td>
                    <td class="text-right cr_amount"><?php echo $value['cr_amount']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr class="table_head_foot">
                    <th class="text-right" colspan="4">Total</th>
                    <th class="text-right"><u class="doubleUnderline"><?php echo $total_debit; ?></u></th>
                    <th class="text-right"><u class="doubleUnderline"><?php echo $total_credit; ?></u></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
