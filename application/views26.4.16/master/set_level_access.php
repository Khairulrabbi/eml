<?php //print_r($packege_details); ?>
<!-- /.row -->
<div class="row">
    <div class="form-group col-md-4 col-md-offset-4">
        <?php
        echo form_open('master/get_menu_for_level','');
        echo '<div class="form-group">';
        echo '<label>Menu from which Module</label>';
        module(isset($selected_module)?$selected_module:'');
        echo '</div>';
        echo '<div class="form-group">';
        echo '<label>Privilege for which Level</label>';
        user_level(isset($selected_level)?$selected_level:'');
        echo '</div>';
        echo form_submit('mysubmit', 'Submit','class="btn btn-primary"');
        echo form_close();
        ?>
    </div>
    <div class="col-lg-12">
        <?php
        if(isset($menu_list_array) && !empty($menu_list_array)){
        echo form_open('master/set_menu_access_for_level');
        echo form_hidden('module_id', $selected_module);
        echo form_hidden('level_id', $selected_level);
        echo '<div class="tree well">';
        echo($menu_list_array);
        echo '</div>';
        echo form_submit('mysubmit', 'Submit','class="btn btn-primary"');
        echo form_close();
        }
        ?>
        <br />
<!-- /.col-lg-12 -->
    </div>
<!-- /.row -->
</div>
<!-- /#page-wrapper -->