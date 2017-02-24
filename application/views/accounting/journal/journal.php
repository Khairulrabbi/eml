<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
               Journal Report
            </div>
            <div class="panel-body">
                <div class="col-lg-12">
                    <div class="col-lg-10 text-center">
                        <h3>DISCOVERY TOURS & LOGISTIC</h3>
                        <h3>JOURNAL</h3>
                    </div>
                    <div class="col-lg-2 text-center">
                        <form action="" method="post">
                            <input name="total_debit" id="total_debit" class="" type="hidden" value="" />
                            <input name="total_credit" id="total_credit" class="" type="hidden" value="" />
                            <input name="pdf" class="btn btn-sm btn-info" type="submit" value="Download AS PDF" />
                        </form>
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
                            <tbody class="onclick_body">
                                <?php
//                echo '<pre>';
//                print_r($voucher_info);
                                $n = 0;
                                foreach ($voucher_info as $value) {
                                    $n++;
                                    ?>
                                    <tr class="onclick_journal" id="<?php echo $value['journal_details_id']; ?>">
                                        <td class="text-center"><?php echo $n; ?></td>
                                        <td><?php echo date('jS F Y', strtotime($value['journal_date'])); ?></td>
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
                                    <th class="text-right"><u class="doubleUnderline" id="dr_total"></u></th>
                            <th class="text-right"><u class="doubleUnderline" id="cr_total"></u></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .onclick_body > tr:hover {
        background-color: #eee;
    }
    .onclick_journal {
        cursor: pointer;
    }
</style>
<script>
    $(document).ready(function () {
        var sum = 0;
        $('.dr_amount').each(function () {
            sum = sum + parseInt($(this).text() || 0);
        });
        $('#dr_total').text(parseFloat(sum).toFixed(2)).bdt({bdt_sign: ''});
        $('#total_debit').val(parseFloat(sum).toFixed(2)).bdt({bdt_sign: ''});
        var sum = 0;
        $('.cr_amount').each(function () {
            sum = sum + parseInt($(this).text() || 0);
        });
        $('#cr_total').text(parseFloat(sum).toFixed(2)).bdt({bdt_sign: ''});
        $('#total_credit').val(parseFloat(sum).toFixed(2)).bdt({bdt_sign: ''});
    });

    $('.onclick_journal').on('click', function () {
        var id = $(this).attr('id');
        var url = "<?php echo base_url(); ?>accounts_configuration/journal_voucher_print?journal=" + id;
        window.location = url;
    });


</script>