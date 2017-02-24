
<div>&nbsp;</div>
<fieldset>
    <legend>
        Existing Settings
        <span class="btn btn-primary create_step">Create Step</span>
    </legend>
    <div class="col-lg-10">
        
            <?php
                foreach ($approval_persons_info as $ik=>$iv)
                { ?>
                <table class="table dtitle">
                    <tr style="background: #ccc">
                        <th>
                            <span class="btn btn-primary edit_step" 
                                  step_number="<?php echo $iv->step_number; ?>">
                                Step <?php echo $iv->step_number; ?>
                            </span>
                            <span class="btn btn-danger stepRemove" 
                               approve_for_id="<?php echo $iv->approve_for_id; ?>" 
                               stepNumber="<?php echo $iv->step_number; ?>">Remove</span>
                        </th>
                        <th>Step name : <?php echo $iv->step_name; ?></th>
                        <th>All In Same Sort : <?php echo $iv->all_in_same_sort; ?></th>
                        <th>Priority : <?php echo $iv->approve_priority; ?></th>
                        <th>Approve By : <?php echo $iv->manage_by; ?></th>
                        
                    </tr>
                </table>
                <table class="table">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Limit</th>
                            <th>Limit Type</th>
                            <th>Sort</th>
                            <th>Must Approve</th>
                            <th>Decline Logic</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php 
                    foreach ($this->deligation_model->get_info_approval_persons($iv->approve_for_id,$iv->step_number) as $lk=>$lv)
                    { ?>
                        <tr>
                            <td><?php echo $lv->username; ?></td>
                            <td><?php echo $lv->max_limit; ?></td>
                            <td><?php echo $lv->limit_type; ?></td>
                            <td><?php echo $lv->sort_number; ?></td>
                            <td><?php echo (($lv->must_approve==0)?"No":"Yes"); ?></td>
                            <td><?php echo $lv->decline_logic; ?></td>
                            <td>
                                <i class="btn btn-danger fa fa-remove UserRemove" 
                               approve_for_id="<?php echo $iv->approve_for_id; ?>" 
                               stepNumber="<?php echo $iv->step_number; ?>" 
                               userId="<?php echo $lv->user_id; ?>"></i>
                            </td>
                        </tr>
                    <?php } ?>
                        </tbody>
                    </table>
                    <?php
                }
            ?>
            
        
        
                
            
    </div>
</fieldset>