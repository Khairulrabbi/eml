<div class="row">
    <div class="col-lg-4">
        <?php
        $p = NULL;
        if(isset($user_details)){
            $p= explode(',',$user_details[0]['level_id_list']);
        }
        echo form_open(base_url().'master/save_level_access_for_user');
        echo '<div class="form-group"><label>Select User</label>';
        user(isset($selected_user_id)?$selected_user_id:NULL);
        //user($name, $where, $selected_value, $extra_attr)
        echo '</div>';
        echo '<div class="form-group"><label>Select Level</label>';
        user_level($p,array('multiple'=>'multiple'),'user_level_id[]' );
        echo '</div>';
        echo form_submit('save', 'Save', 'class="btn btn-primary"');
        echo form_close();
        ?>
    </div>
    <div class="col-lg-8">
        <div class="table-responsive">
            <?php //print_r($table_data[1]) ?>
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Permitted Level Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($permitted_level as $value) {
                        echo '<tr>';
                        echo '<td>'.$value['first_name'].'</td>';
                        echo '<td>'.$value['level_id_list_name'].'</td>';
                        echo '<td><a title="Edit/View Details" href="'.  base_url().'master/user_level_assign/'.$value['user_id'].'"><i class="glyphicon glyphicon-pencil"></i></a></td>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>