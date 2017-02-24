<!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Route List
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <form action="<?=base_url();?>master/save_upazila" method="post">
                                <?php
                                echo form_hidden('menu_id', $menu_id);
                                if(isset($upazila_details->upazila_id)){
                                    echo form_hidden('upazila_id', $upazila_details->upazila_id);
                                }
                                ?>
                                <div class="form-group">
                                    <label>Division </label>
                                    <?=division(@$upazila_details->division_id, array('id'=>'division'))?>
                                </div>
                                <div class="form-group">
                                    <label>District </label>
                                    <div id="dis"><?=  district(@$upazila_details->district_id, array('id'=>'district'))?></div>
                                </div>
                                <div class="form-group">
                                    <label>Thana / Upazilla </label>
                                    <input class="form-control" name="upazila_name" value="<?php echo @$upazila_details->upazila_name ?>" />
                                </div>
                                <button type="submit" name="command" class="btn btn-primary" value="<?php echo(isset($update_command)?'update':'save')?>"><?php echo(isset($update_command)?'Update':'Save')?></button>
                            </form>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                        <div class="col-lg-9">
                                <?php echo @$msg; ?>
                                <div class="table-responsive">
                                    <?php //print_r($table_data[1]) ?>
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Upazila/Thana Name</th>
                                                <th>District</th>
                                                <th>Division</th>
                                                <th style="width: 10% !important;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //print_r($info);
                                            $n=0;
                                            foreach($info as $data){
                                                $n++;
                                            ?>
                                            <tr>
                                                <td><?php echo $n ?></td>
                                                <td><?php echo $data['upazila_name'] ?></td>
                                                <td><?php echo $data['district_name'] ?></td>
                                                <td><?php echo $data['division_name'] ?></td>
                                                <td class="center" style="white-space: nowrap">
                                                        &nbsp;
                                                        <?php if($edit_privilege){ ?>
                                                        <a href="<?=base_url();?>master/create_upazila/<?php echo $data['upazila_id']; ?>"><i class="glyphicon glyphicon-pencil"></i></a>
                                                        <?php }else{
                                                            echo '<a href="javascript:void(0);" onclick="show_alert();"><i class="glyphicon glyphicon-pencil"></i><a>';
                                                        }
                                                        if($delete_privilege){  ?>
                                                        &nbsp;
                                                    <a href="<?=base_url();?>master/delete_upazila/<?php echo $data['upazila_id']; ?>"><i class="glyphicon glyphicon-remove"></i></a>
                                                        <?php }else{
                                                            echo '&nbsp;<a href="javascript:void(0);" onclick="show_alert();"><i class="glyphicon glyphicon-remove"></i><a>';
                                                        } ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
<script>
    function show_alert(){
        alert("Sorry you are not authorised to do this!");
    }
    $('#division').change(function(){
        var div_id = $(this).val();
        $.ajax({
            url:'./get_district/'+div_id,
            success:function(data){
                $('#dis').html(data);
                $('select').select2();
            }
        })
    });
</script>