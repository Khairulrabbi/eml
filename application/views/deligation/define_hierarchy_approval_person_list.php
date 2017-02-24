<?php                                    
    foreach ($approval_persons->result() as $k=>$v)
    { ?>
        <li id="" class="draggable jak btn-info"><?= $v->username; ?>
            <span class="must_approve pull-right">
                Limit&nbsp;<?= number_format($v->max_limit,2); ?>&nbsp;&nbsp;&nbsp;
                <input type="hidden" class="step_value" name="step[<?= $v->userid?>]" value="">
                <input type="hidden" name="user_id" value="<?= $v->userid; ?>">
                <input type="hidden" name="max_limit" value="<?= $v->max_limit; ?>">
                <input type="hidden" name="limit_type" value="<?= $v->limit_type; ?>">
                <input type="checkbox" name="must_approve" value="1">&nbsp;Must Approve
            </span>
        </li>
    <?php }
?>