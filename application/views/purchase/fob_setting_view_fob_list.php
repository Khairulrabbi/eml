<?php
    foreach ($fob as $fk=>$fv)
    { ?>
        <tr>
            <td><input <?= (@$fv->cs_fob_id !=NULL)?"checked='checked'":""; ?> class="fob_check" type="checkbox" name="costing_set_id[]" value="<?php echo $fv->fob_id; ?>">&nbsp; <?php echo $fv->fob_name; ?></td>
            <td><input class="form-control value_of" type="text" name="value_of[<?php echo $fv->fob_id; ?>]" value="<?= @$fv->value_of; ?>" /></td>
            <td><input class="form-control formula_of" type="text" name="formula_on[<?php echo $fv->fob_id; ?>]" value="<?= @$fv->formula_on; ?>" /></td>
            <td><input class="form-control row_index" style="width: 50px;" type="text" name="row_index[<?php echo $fv->fob_id; ?>]" value="<?= @$fv->row_index; ?>" readonly=""</td>
        </tr>
    <?php }
?>