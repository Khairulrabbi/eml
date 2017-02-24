<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Tagged Account
            </div>
            <div class="panel-body">
                <div class="col-lg-3">
                    <form action="" method="post">
                        <?php isset($tag_details)?'<input type="hidden" name="acc_tag_id" value="'.$tag_details->acc_tag_id.'"/>':''; ?>
                        <div class="form-group">
                            <label for="tag_name">Tag Name</label>
                            <input type="text" class="form-control" name="acc_tag_name" value="<?php echo @$tag_details->acc_tag_name ?>" required=""/>
                        </div>
                        <div class="form-group">
                            <label>Table to Pull Data</label>
                            <select name="table_name" class="form-control" id="table_combo" required="">
                                <option value="">Select</option>
                                <?php foreach ($table_list as $tbl_name){
                                    echo '<option '.($tag_details->table_name==$tbl_name['Tables_in_discovery']?"selected":"").' value="'.$tbl_name['Tables_in_discovery'].'">'.$tbl_name['Tables_in_discovery'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="field_name">Field to Show</label>
                            <div style="padding-left: 5px;" id="field_panel"></div>
                        </div>
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary"/>
                    </form>
                </div>
                <div class="col-lg-9">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tag Name</th>
                                <th>Tagged Table</th>
                                <th>Field to Display</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($tag_list as $tag){
                                $tr = "<tr>";
                                $tr .= "<td>".$tag['acc_tag_name']."</td>";
                                $tr .= "<td>".$tag['table_name']."</td>";
                                $tr .= "<td>".$tag['field_name']."</td>";
                                $tr .= "<td>&nbsp;
                                    <a href='".  base_url()."accounts_configuration/create_tag/".$tag['acc_tag_id']."?m_id=169'><i class='glyphicon glyphicon-pencil'></i></a>
                                    &nbsp;
                                    <a href='delete_tag/".$tag['acc_tag_id']."'><i class='glyphicon glyphicon-remove'></i></a>";
                                $tr .= "</tr>";
                                echo $tr;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        var selected_table = $('#table_combo').val();
        if(selected_table != ""){            
            $.ajax({
                url:'<?php echo base_url() ?>accounts_configuration/get_table_field',
                type:'post',
                data:{tbl_name:selected_table},
                success:function(data){
                    $('#field_panel').html(data);
                    $('#field_panel').css('border','1px solid #ccc');
                    $('#field_panel input[type=radio]').each(function(){
                        if($(this).val() == '<?php echo @$tag_details->field_name; ?>'){
                            $(this).prop('checked',true);
                        }
                    });
                }
            });
        }
    });
    $('#table_combo').change(function(){
        if($(this).val() !== '' && typeof $(this).val() !== 'undefined' && $(this).val()!== null){
            var tbl_name = $(this).val();
            $.ajax({
                url:'<?php echo base_url() ?>accounts_configuration/get_table_field',
                type:'post',
                data:{tbl_name:tbl_name},
                success:function(data){
                    $('#field_panel').html(data);
                    $('#field_panel').css('border','1px solid #ccc');
                }
            });
        }
    });
</script>