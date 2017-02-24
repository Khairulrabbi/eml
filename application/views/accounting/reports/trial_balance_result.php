<table class="table table-striped table-bordered table-hover no-footer" id="purchase_list">
    <thead>
        <tr> 
            <th colspan="3">&nbsp;</th>
            <th colspan="2">Group Total</th> 
        </tr>
        <tr>
            <th>Account Head</th>
            <th>Debit</th> 
            <th>Credit</th>
            <th>Debit</th> 
            <th>Credit</th>
        </tr>
    </thead>
    <tbody class="">
        <?php
        echo $statement_data;
        ?>
        
        
        
        
        
        <?php 
//            $sl = 1; 
//            $debit_total = 0;
//            $credit_total = 0;
//            foreach ($statement_data as $sd)
//            {
//                $debit_total = $debit_total+$sd->totalDebit;
//                $credit_total = $credit_total+$sd->totalCredit;
//        ?>
<!--                <tr>
                    <td>//<?php // echo $sl; ?></td>
                    <td>//<?php // echo $sd->acc_head_name; ?></td>
                    <td>//<?php // echo $sd->totalDebit; ?></td>
                    <td>//<?php // echo $sd->totalCredit; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>-->
            <?php // $sl++; }
//        ?>
<!--                <tr>
                    <td colspan="2" style="text-align: right;"><strong>Total</strong></td>
                    <td><strong>//<?php // echo $debit_total; ?></strong></td>
                    <td><strong>//<?php // echo $credit_total; ?></strong></td>
                </tr>-->
    </tbody>
</table>






