<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <?php echo isset($msg)?$msg:""; ?>
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>Menu Title</th>
                        <th>Module Name</th>
                        <th>Menu Type</th>
                        <th>URL</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //print_r($menu_list);
                    foreach ($menu_list as $value) {
                        echo '<tr>';
                        echo '<td><i class="'.$value['icon_class'].'"></i> '.$value['menu_name'].'</td>';
                        echo '<td>'.$value['module_name'].'</td>';
                        echo '<td>'.$value['menu_type'].'</td>';
                        echo '<td>'.$value['menu_url'].'</td>';
                        echo '<td>'
                        . '&nbsp;<a title="Edit/View Details" href="'.  base_url().'master/menu_assign/'.$value['menu_id'].'"><i class="glyphicon glyphicon-pencil"></i></a>'
                                . '&nbsp;<a title="Remove Menu" href="'.  base_url().'master/menu_delete/'.$value['menu_id'].'"><i class="glyphicon glyphicon-remove"></i></a></td>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>