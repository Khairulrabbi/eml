<?php
    foreach ($search_data->result() as $k=>$v)
    { ?>
        <tr>
            <td><input type="checkbox" value="<?= $v->user_id;?>">&nbsp; <?= $v->username; ?></td>
            <td><?= $v->user_level_name; ?></td>
            <td><?= $v->department_name; ?></td>
            <td><?= $v->designation_name; ?></td>
        </tr>
    <?php }
?>