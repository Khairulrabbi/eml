<table class="table table-striped table-bordered table-hover dataTable no-footer" id="purchase_list">
    <thead>
        <?php
//            unset($post['TransactionDate']);
//            unset($post['acc_head_id']);
//            $thead = "";
//            if(!empty($post))
//            {
//                foreach ($post as $k=>$v)
//                {
//                    $thead .= "<th>".$k."</th>";
//                }
//            }
        ?>
        <tr>
            <th>SL#</th>
            <th>Date</th>
            <th>Account Head</th>
            <?php echo $dynamic_thead; ?>
            <th>Debit</th> 
            <th>Credit</th>
            <th>Balance</th>
        </tr>
    </thead>
    <tbody class="">
        <?php 
            $sl = 1; 
            //$balance = (($opening_balance == "")?$opening_balance:0);
        ?>
        <tr>
            <td><?php echo $sl; ?></td>
            <td><?php echo $opening_balance_date; ?></td>
            <td>Opening Balance</td>
            <?php echo $opening_balance_head; ?>
            <td>0</td>
            <td>0</td>
            <td><?php echo $opening_balance; ?></td>
        </tr>
        <?php 
            $balance = $opening_balance;
            $tag_index = 0;
            foreach ($statement_data as $sd)
            { 
            $sl++;
             $balance = (($balance+$sd['Debit'])-$sd['Credit'])
            
        ?>
                <tr>
                    <td><?php echo $sl; ?></td>
                    <td><?php echo $sd['TransactionDate']; ?></td>
                    <td><?php echo $sd['acc_head_name']; ?></td>
                    <?php echo $opening_balance_head; // ekhane ei variable ta test er jonno print kora hoeche jate column thik thake. pore ekhane tagging id gulo print kora hobe ?>
                    <td><?php echo $sd['Debit']; ?></td>
                    <td><?php echo $sd['Credit']; ?></td>
                    <td><?php echo $balance; ?></td>
                </tr>
            <?php $tag_index++; }
        ?>
    </tbody>
</table>


<script>
    
    $(document).ready(function() {
        $('#purchase_list').DataTable();
    });

</script>



