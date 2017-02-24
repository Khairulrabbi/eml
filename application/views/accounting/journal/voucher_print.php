<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<style>
    table{
        border-collapse: collapse;
    }
</style>
<?php echo $address; ?>
<table border="1" width="100%">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>ACCOUNT</th>
                    <th>PARTICULAR</th>
                    <th>DEBIT</th>
                    <th>CREDIT</th>
                    <th>GROUP</th>
                    <th>COST</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $n=0;
                    $t_dbt = 0;
                    $t_cdt = 0;
                    foreach ($voucher_info as $value) {
                        $n++;
                ?>
                <tr>
                    <td class="text-center"><?php echo $n; ?></td>
                    <td><?php echo $value['acc_head_number']; ?></td>
                    <td>
                        <b><?php echo $value['acc_head_name']; ?></b><br/>
                        &emsp;<?php echo $value['description']; ?>
                    </td>
                    <td class="text-right dr_amount"><?php echo $value['dr_amount'];$t_dbt = $t_dbt+$value['dr_amount']; ?></td>
                    <td class="text-right cr_amount"><?php echo $value['cr_amount'];$t_cdt = $t_cdt+$value['cr_amount']; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-right" colspan="3">Total</th>
                    <th class="text-right"><?php echo $t_dbt ?></th>
                    <th class="text-right"><?php echo $t_dbt ?></th>
                    <th colspan="2"></th>
                </tr>
            </tfoot>
        </table>