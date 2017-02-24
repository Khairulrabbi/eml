<table class="table table-striped table-bordered table-hover dataTable" id="selected_product_for_sale">
    <thead>
        <tr>
            <th><?php echo label_html(SL, 'SL'); ?></th>
            <th><?php echo label_html(PRODUCT_NAME, 'PRODUCT_NAME'); ?></th>
            <th>P.CODE</th>
            <th>Rim Size</th>
            <th>PR</th>
            <th>PATT</th>
            <th>UNIT</th>
            <th>H.S CODE</th>
            <th><?php echo label_html(AVAILABLE_QTY, 'AVAILABLE_QTY'); ?></th>
            <th><?php echo label_html(REORDER_QTY, 'REORDER_QTY'); ?></th>
            <th><?php echo label_html(PRICE_BDT, 'PRICE_BDT'); ?></th>
            <th><?php echo label_html(ACTION, 'ACTION') ?></th>
        </tr>
    </thead>
    <tbody class="show_search_data">  

        <?php
        $sl = 1;
        $count = 0;
        foreach ($sql as $key => $value) {
            $ps = json_decode($value['product_details_json'], TRUE);
            if ($value['cart_exist'] != NULL) {
                $count++;
                ?>
                <tr>
                    <td><?php echo $sl++; ?></td>
                    <td><?php echo $value['product_name']; ?></td>
                    <td><?php echo $value['product_code']; ?></td>
                    <td><?php echo @$ps[1]; ?></td>
                    <td><?php echo @$ps[5]; ?></td>
                    <td><?php echo @$ps[12]; ?></td>
                    <td><?php echo @$ps[13]; ?></td>
                    <td><?php echo @$ps[14]; ?></td>
                    <td><?php echo $value['total']; ?></td>
                    <td><?php echo $value['reorder_qty']; ?></td>
                    <td><?php echo $value['price_bdt']; ?></td>
                    <td>
                        <a 
                            id="delete_from_transaction_list"
                            href="<?php echo base_url() . 'stock/current_stock_details/' . $value['id']; ?>"
                            product_id="<?php echo $value['product_id']; ?>" 
                            list_type="<?= $type; ?>">
                            <i class="glyphicon glyphicon-remove"></i>
                        </a>
                    </td>
                </tr>
            <?php }
        }
        ?>
    </tbody>
</table>
<a list_type="<?php echo $type; ?>"  href="<?php echo $url; ?>" class="btn btn-primary pull-right <?= ($count < 1)?'disabled':''; ?>"><?php echo $url_name; ?></a>