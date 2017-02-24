<?php
    foreach ($heirarchy_query->result() as $k=>$v)
    {
        if($v->step_number == 1)
        { ?>
            <fieldset>
                <legend>Step <?= $v->step_number; ?><span class="text-danger">*</span></legend>
                <div  class="list_parrent">
                    <input type="hidden" class="step_catch" value="1">
                    <ul id="enough" class="droppable_1" style="min-height: 20px; border: 1px solid #ccc;">

                    </ul>
                </div>
            </fieldset>
        <?php }
    }
?>
