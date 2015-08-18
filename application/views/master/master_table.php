<div class="row" style="height: 30px;">
    <span id="site_url" class="hidden"><?php echo base_url(); ?></span>
</div>
<!-- /.row -->
<div class="row">
    <div class="form-group col-md-6 col-md-offset-3">
<!--        <label for="module">Select a Table for Master Entry</label>-->
        <?php
        echo form_open();
        $options = array(''=>'--Select--');
        //Retive master table array to prepare combobox
        foreach($mask_table_name as $table_name){
            $options[$table_name['master_entry_title']] = $table_name['master_entry_title'];
        }
        echo '<div class="form-group">';
        echo '<label>Select Master Entry by Title</label>';
        echo form_dropdown('master_entry_title', $options, @$selected_title,'class="form-control"');
        echo '</div>';
        echo form_submit('mysubmit', 'Submit','class="btn btn-primary"');
        echo form_close();
        ?>
    </div>
    <?php if(isset($selected_table)){ 
        $input_types = array(
            ''=>"",
            'checkbox'=>"checkbox",
            'color'=>"color",
            'date'=>"date",
            'datetime'=>"datetime",
            'email'=>"email",
            'file'=>"file",
            'hidden'=>"hidden",
            'image'=>"image",
            'month'=>"month",
            'number'=>"number",
            'password'=>"password",
            'radio'=>"radio",
            'range'=>"range",
            'search'=>"search",
            'tel'=>"tel",
            'text'=>"text",
            'time'=>"time",
            'url'=>"url",
            'week'=>"week",
            'select'=>"select",
            'textarea'=>"textarea"
        );
    ?>
    <div class="row"></div>
    <div class="alert alert-success col-md-12">
        <b>Master entry create for <?php echo ucwords(str_replace('_', ' ', $selected_table)) ?></b>
    </div>
    <div class="row"></div>
    <form action="<?=base_url();?>master/create_master" method="post">
        <input id="tbl_name" type="hidden" name="module" value="<?php echo $selected_table; ?>"/>
        <input id="mask_name" type="hidden" name="master_entry_title" value="<?php echo $selected_title; ?>"/>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="width: 3% !important;"></th>
                        <th>Field Name</th>
                        <th>Type</th>
                        <th>Key</th>
                        <th>Label</th>
                        <th>Placeholder</th>
                        <th>Input Type</th>
                        <th>Sql</th>
                        <th>Value</th>
                        <th>Hide From Grid?</th>
                        <th>Enable Filter?</th>
                        <th>Hide From Input?</th>
                        <th>Required</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($record as $list){

                        if($list['Key']!='PRI'){
                        ?>
                    <tr class="odd gradeX">
                        <td class="center">
                                &nbsp;&nbsp;
                            <?php
                            if(array_key_exists($list['Field'], $check_data)){
                                $checked = "checked='checked'";
                            }
                            else {
                                $checked = "";
                            }
                            ?>
                            <input name="fields[]" type="checkbox" value="<?php echo $list['Field'];?>" <?php echo $checked;?>/>
                        </td>
                        <td><?php echo $list['Field'];?></td>
                        <td><?php echo $list['Type'];?></td>
                        <td><?php echo $list['Key'];?></td>
                        <?php 
                            $label_fixed1 = str_replace('_id','',$list['Field']);
                            $label_fixed = str_replace('_',' ',$label_fixed1);
                        ?>
                        <td><input type='text' name="label[<?php echo $list['Field'];?>]" value='<?php echo(array_key_exists($list['Field'], $check_data)?$check_data[$list['Field']]['label_name']:ucwords($label_fixed)) ?>' class='form-control' style="width: 100%;"></td>
                        <td><input type='text' name="placeholder[<?php echo $list['Field'];?>]" value='<?php echo(array_key_exists($list['Field'], $check_data)?$check_data[$list['Field']]['placeholder']:ucwords($label_fixed)) ?>' class='form-control' style="width: 100%;"></td>
                        <td style="width: 120px;"><div><?php echo form_dropdown('input_type['.$list['Field'].']', $input_types, (array_key_exists($list['Field'], $check_data)?$check_data[$list['Field']]['input_type']:''),'class="form-control"'); ?></div></td>
                        <td><textarea name="sql[<?php echo $list['Field'];?>]" class="form-control"><?php echo(array_key_exists($list['Field'], $check_data)?$check_data[$list['Field']]['sql']:'') ?></textarea></td>
                        <td><input type="text" name="comma_separated_value[<?php echo $list['Field'];?>]" class="form-control" value="<?php echo(array_key_exists($list['Field'], $check_data)?$check_data[$list['Field']]['comma_separated_value']:'') ?>" /></td>
                        <td><?php echo form_checkbox('hide_from_grid['.$list['Field'].']', '1',(array_key_exists($list['Field'], $check_data)?($check_data[$list['Field']]['hide_from_grid']==1?TRUE:''):'')); ?></td>
                        <td><?php echo form_checkbox('self_filtering['.$list['Field'].']', '1',(array_key_exists($list['Field'], $check_data)?($check_data[$list['Field']]['self_filtering']==1?TRUE:''):'')); ?></td>
                        <td><?php echo form_checkbox('hide_from_input['.$list['Field'].']', '1',(array_key_exists($list['Field'], $check_data)?($check_data[$list['Field']]['hide_from_input']==1?TRUE:''):'')); ?></td>
                        <td><?php echo form_checkbox('required['.$list['Field'].']', 'required',(array_key_exists($list['Field'], $check_data)?($check_data[$list['Field']]['required_field']=='required'?TRUE:''):'')); ?></td>
                    </tr>
                    <?php } }?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <label><u>Add More Field</u></label>
                
                <table id="more" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Table Name</th>
                            <th>Field</th>
                            <th>Relation With</th>
                            <th>SQL</th>
                            <th>Label</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($extra_data)){
                                $counter = 0;
                                foreach ($extra_data as $value) {
                                    $counter++;
                                    echo $value[0];
                                    master_entry_table('master_entry_table_name['.$counter.']',NULL,$value[1],array('class'=>'extra_table','data-count'=>'1'));
                                    echo $value[2];
                                    table_field($value[1], 'master_entry_table_field_name['.$counter.']', '', $value[4]);
                                    echo $value[3];
                                    table_field($selected_table, 'relational_field['.$counter.']', '', $value[6]);
                                    //table_field($value[1], 'relational_field[]', '', $value[3]);
                                    echo $value[5];
                                }
                            } ?>
<!--                        <tr>
                            <td><input type="checkbox" name="count_hidden[]" value="1" class="count_hidden"/></td>
                            <td>
                                <?php master_entry_table('master_entry_table_name[1]',NULL,'',array('class'=>'extra_table','data-count'=>'1')); ?>
                            </td>
                            <td id="table_field_1"></td>
                            <td><?php table_field($selected_table,'relational_field[1]'); ?></td>
                            <td><textarea class="form-control" name="sql_extra[1]" placeholder="SQL query"></textarea></td>
                            <td><input type="text" class="form-control" name="label_name_extra[1]" placeholder="Label Text" /></td>
                        </tr>-->
                    </tbody>
                </table>
                    <button class="btn btn-primary" id="add_more">Add More</button>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="form-group col-md-8">
                <input type="submit" class="btn btn-primary" name="create" value="Create"/>
                <a class="btn btn-primary" href="<?php echo base_url().'master/show_master/'.$selected_table ?>">Show</a>
            </div>
        </div>
    </form>
    <?php } ?>
</div>
<script>
//$('.extra_table').change(function(){
//    var target_id = $(this).data("count");
//    alert(target_id);
//    var url_str = 'http://localhost/cms/master/get_table_field/'+$(this).val();
//    $.ajax({
//        url:url_str,
//        success: function(data){
//            $('#table_field_'+target_id).html(data);
//            $("select").select2();
//        }
//    })
//});
$(document).on('change','.extra_table',function(){
    var target_id = $(this).data("count");
    //alert(target_id);
    var url_str = $('#site_url').text()+'master/get_table_field/'+$(this).val();
    $.ajax({
        url:url_str,
        type:"POST",
        data:{count:target_id},
        success: function(data){
            $('#table_field_'+target_id).html(data);
            $("select").select2();
        }
    })
});
$('#add_more').click(function(e){
    var count = 1;
    $('#more tbody tr').each(function(){
        count++;
    })
    var tbl_name = $('#tbl_name').val();
    var url_str = $('#site_url').text()+'master/add_tr/'+count;
    $.ajax({
        url:url_str,
        type:"POST",
        data:{table_name:tbl_name},
        success: function(data){
            $('#more tbody').append(data);
            $("select").select2();
        }
    })
    e.preventDefault();
})
</script>