<div class="row">
    <?php if(!isset($menu_id) || isset($open_edit) ){ ?>
    <div class="col-lg-12">
        <form action="<?=base_url();?>master/menu_entry" method="post">
            <?php
            if( isset($open_edit) ){
                echo form_hidden('menu_id', $menu_id);
            }
            ?>
            <div class="form-group">
                <label for="label">Menu Label</label>
                <input type="text" name="menu_name" class="form-control" id="label" placeholder="Menu Name" value="<?php echo @$post_val['menu_name']; ?>">
            </div>
            <div class="form-group">
              <label>Menu Type </label>
              <label class="radio-inline">
                  <input type="radio" name="inlineRadioOptions" id="main_menu" class="child_radio" value="option1"> Main Menu
              </label>
              <label class="radio-inline">
                  <input type="radio" name="inlineRadioOptions" id="root_menu" class="root_radio" value="option2"> Root Menu
              </label>
              <label class="radio-inline">
                  <input type="radio" name="inlineRadioOptions" id="child_menu" class="child_radio" value="option3"> Child Menu
              </label>
            </div>
            <div class="form-group">
                <label for="menu_url">Menu Link</label>
                <input type="text" name="menu_url" class="form-control" id="menu_url" placeholder="Menu Url Without <?php echo base_url(); ?>" value="<?php echo @$post_val['menu_url']; ?>">
            </div>
            <div class="form-group">
                <label>Parent Menu </label>
            <?php
            //echo form_input('menu_name', $value, $extra);
            //echo form_hidden('table_name', $table_name);
            echo '<select name="parent_menu_id" class="form-control selectpicker" id="parent_id">';
            echo '<option value="0">No Parent</option>';
            foreach($d_menu as $menu_item){
                echo $menu_item;
            }
            echo '</select>';
            ?>
            </div>
            <div class="form-group">
                <label for="menu_url">Icon Class <i>(Optional)</i></label>
                <input type="text" name="icon_class" class="form-control" id="menu_url" placeholder="Icon Class Name" value="<?php echo @$post_val['icon_class']; ?>">
            </div>
            <div class="form-group">
                <label for="module_id">Module For</label>
                <?php module(@$post_val['module_id'],array('class'=>'form-control')); ?>
            </div>
            <div class="form-group">
                <label for="user_level_id">Access Privilege User Level</label>
                <?php echo user_level(explode(',',@$level_array),array('multiple'=>'multiple','class'=>'form-control'),'user_level_id[]'); ?>
            </div>
            <div class="form-group">
                <label for="user_level_id">Access Privilege User</label>
                <?php echo user(explode(',',@$user_array),array('multiple'=>'multiple','class'=>'form-control'),'user_id[]'); ?>
            </div>
            <button type="submit" name="command" class="btn btn-primary" value="<?php echo(isset($update_command)?'update':'save')?>"><?php echo(isset($update_command)?'Update':'Save')?></button>
            <button type="reset" class="btn btn-primary">Reset</button>
            
        </form>
        <br>
    </div>
    <?php
        if( isset($open_edit) ){
            //print_r($post_val);
    ?>
    <span class="hidden" id="parent_id_val"><?php echo $post_val['parent_menu_id']; ?></span>
    <span class="hidden" id="menu_url_val"><?php echo $post_val['menu_url']; ?></span>
    <span class="hidden" id="menu_type_val"><?php echo $post_val['menu_type']; ?></span>
            <script>
                $('#parent_id').val($('#parent_id_val').text());
                $(document).ready(function(){
                    var url_str = $('#menu_url_val').text();
                    var menu_type = $('#menu_type_val').text();
                    //alert('menu_type: '+menu_type+' menu_url'+url_str);
                    if( menu_type == 'Main'){
                        $('#main_menu').prop('checked',true);
                    }else if( url_str == '#'){
                        $('#root_menu').prop('checked',true);
                    }else{
                        $('#child_menu').prop('checked',true);
                    }
                });
            </script>
    <?php }
    }else{ 
    ?>
    <div class="col-lg-7">
        <span id="parent_id" style="display:none"><?php echo $post_val['parent_menu_id'] ?></span>
            <div class="form-group">
                <label for="label">Menu Label</label>
                <input readonly="" type="text" name="menu_name" class="form-control" id="label" placeholder="Menu Name" value="<?php echo $post_val['menu_name']; ?>">
            </div>
<!--            <div class="form-group">
              <label>Menu Type </label>
              <label class="radio-inline">
                  <input disabled="" type="radio" name="inlineRadioOptions" id="root_radio" <?php echo($post_val['menu_type']=='Main'?'checked':'') ?> > Main Menu
              </label>
              <label class="radio-inline">
                  <input disabled="" type="radio" name="inlineRadioOptions" id="root_radio" <?php echo($post_val['menu_url']=='#'?'checked':'') ?> > Root Menu
              </label>
              <label class="radio-inline">
                  <input disabled="" type="radio" name="inlineRadioOptions" id="child_radio" <?php echo($post_val['menu_url']!='#' && $post_val['menu_type']=='Sub'?'checked':'') ?> > Child Menu
              </label>
            </div>-->
            <div class="form-group">
                <label for="menu_url">Menu Link</label>
                <input readonly="" type="text" name="menu_url" class="form-control" id="menu_url" placeholder="Menu Url Without <?php echo base_url(); ?>" value="<?php echo $post_val['menu_url']; ?>">
            </div>
            <div class="form-group">
                <label>Parent Menu </label>
        <?php
            echo '<select disabled class="form-control selectpicker" id="parent_selector">';
            echo '<option value="0">No Parent</option>';
            foreach($d_menu as $menu_item){
                echo $menu_item;
            }
            echo '</select>';
        ?></div>
            <div class="form-group">
                <label for="menu_url">Icon Class <i>(Optional)</i></label>
                <input readonly="" type="text" name="icon_class" class="form-control" id="menu_url" placeholder="Icon Class Name" value="">
            </div>
            <div class="form-group">
                <label for="module_id">Module For</label>
                <?php echo($combo); ?>
            </div>
            <div class="form-group">
                <label for="user_level_id">Access Privilege User Level</label>
                <?php echo($level_combo); ?>
            </div>
            <div class="form-group">
                <label for="user_id">Access Privilege User</label>
                <?php echo($user_combo); ?>
            </div>
        <script>
            $('#parent_selector').val($('#parent_id').text());
        </script>
    </div>
    <!-- /.col-lg-6 (nested) -->
    <div class="col-lg-5">
        <div class="panel-body">
            <ul id="sortable" class="ui-sortable list-unstyled" data-url="<?php echo base_url().'master/reorder_menu' ?>">
                <?php
                //print_r($sort_menu_list);
                foreach($sort_menu_list AS $menu_item_list){
                    echo '<div id="'.$menu_item_list['menu_id'].'" class="alert alert-info padded" role="alert">'.$menu_item_list['menu_name'].'</div>';
                }
                ?>
            </ul> 
            <!-- /.table-responsive -->
        </div>
    </div>
    <?php } ?>
    <!-- /.col-lg-6 (nested) -->
</div>
<script>
    $('.root_radio').click(function(){
        $('#menu_url').val('#');
        $('#menu_url').attr('readonly','readonly');
    })
    $('.child_radio').click(function(){
        $('#menu_url').val('');
        $('#menu_url').removeAttr('readonly');
    })
    $("#sortable").sortable({
            stop: function(e, ui) {
                var controller_url = $('#sortable').data('url');
                var p =($.map($(this).find('div'), function(el) {
                    return $(el).attr('id') + '=' + $(el).index();
                }));
                $.ajax({
                    url: controller_url,
                    type: "POST",
                    data: {order:p},
                    // complete: function(){},
                    success: function(feedback){
                         $("#test").html(feedback);
                         //$.jGrowl(feedback, { theme: 'success' });
                    }
                    });
            }
    });
    $("#sortable").disableSelection();
</script>