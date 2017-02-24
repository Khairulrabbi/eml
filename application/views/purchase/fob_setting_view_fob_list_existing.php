        
<thead>     
    <tr>
        <th colspan="2" style="text-align:left;border:none !important;" class=""><?= $product_group->product_group_name; ?></th>
    </tr>
    <tr>
        <th scope="row" colspan="2" style="border-left-style: hidden; text-align: left">Size of Tyres</th>
    </tr>
</thead>
<tbody id="dhy_existing_list">
    <?php
    foreach ($fob_existing as $fe) {
        ?>
        <tr>
            <td><?= $fe->row_index; ?></td>
            <td>
                <?php
                echo str_replace("#", $fe->value_of, $fe->fob_name);
                echo ($fe->formula_on != NULL) ? " on (" . $fe->formula_on . ")" : "";
                ?>
            </td>
        </tr>
    <?php }
    ?>
</tbody>