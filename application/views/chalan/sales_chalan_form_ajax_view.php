<?php
    $sl = 1;
    foreach ($sales_details as $k=>$v)
    { 
        $ps = json_decode($v['product_details_json'],TRUE);
        ?>
        <tr>
        <td><?= $sl; ?></td>
        <td>
            <input <?= ($v['approve_quantity'] == $v['chalan_quantity'])?"disabled":""; ?> type="hidden" name="approve_quantity[<?= $v['product_id']; ?>]" value="<?= $v['approve_quantity']; ?>">
            <input <?= ($v['approve_quantity'] == $v['chalan_quantity'])?"disabled":""; ?> type="hidden" name="product_id[]" value="<?= $v['product_id']; ?>">
            <input class="sales_order_details_id" type="hidden" value="<?= $v['sales_order_details_id']; ?>">
            <?= $v['product_name']; ?>
        </td>
        <td class="taproduct"><?= $v['product_code']; ?></td>
        <?php echo get_specification_json_type($ps, "value"); ?>
        <td class="availableProduct"><?= $v['available_product']; ?></td>
        <td class="rquest_quantity"><?= $v['quantity']; ?></td>
        <td class="approve_quantity"><?= $v['approve_quantity']; ?></td>
        <td class="chalan_quantity"><?= ($v['chalan_quantity'])?$v['chalan_quantity']:0; ?></td>
        <td><input <?= ($v['approve_quantity'] == $v['chalan_quantity'])?"disabled":""; ?> style="width:100px;" type="number" class="confirm_quantity form-control"name="cnfrm_quantity[<?= $v['product_id']; ?>]" value="0"></td>
    </tr>
    <?php $sl++; }
?>