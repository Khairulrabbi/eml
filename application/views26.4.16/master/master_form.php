<!-- /.row -->
<link href="//cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/4.0.1/ekko-lightbox.min.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/4.0.1/ekko-lightbox.min.js"></script>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo ucfirst(str_replace('_', ' ', $view_name)).' list' ?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <?php
                    $offset='';
                    $cls = 'col-lg-12';
                    if($add_privilege){
                        $cls = 'col-lg-9';
                    if(empty($label_list))
                        $offset = 'col-lg-offset-4';
                    if(!empty($input_html)){
                    ?>
                    
                    <div class="col-lg-3 <?php echo $offset; ?>">
                        <form action="<?=base_url();?>master/form_entry?m_id=<?php echo $menu_id ?>" method="post" enctype="multipart/form-data">
                        <?php
                            //print_r($hdn_array);
                            echo form_hidden('table_name', $table_name);
                            echo form_hidden('view_name', $view_name);
                            if(isset($update_command)){
                                echo form_hidden($table_name.'_id', $update_command);
                            }
                            foreach ($input_html as $input_html1){
                                echo $input_html1;
                            }
                            echo form_hidden('hdn_array', serialize($hdn_array));
                        ?>
                            <button type="submit" name="command" class="btn btn-primary" value="<?php echo(isset($update_command)?'update':'save')?>"><?php echo(isset($update_command)?'Update':'Save')?></button>
<!--                                        <button type="reset" class="btn btn-primary">Reset</button>-->
                            <?php if( $sorting_privilege == 1 ){ ?>
                            <a href="<?php echo base_url().'master/change_order/'.$view_name.'/'.$menu_id; ?>" class="btn btn-primary">Change Order</a>
                            <?php } ?>
                        </form>
                        <?php
                        if($import_excel == 0){
                            echo '<h4>Or</h4>';
                            echo '<a href="../import_excel/'.$view_name.'" class="btn btn-primary">Import From Excel</a>';
                        }
                        ?>
                    </div>
                    <?php
                        }else $cls = 'col-lg-12';  
                    }
                    if(!empty($label_list)){
                    ?>
                    <!-- /.col-lg-6 (nested) -->
                    <div class="<?php echo $cls ?>">
                        <div class="panel-body">
                            <div style="width: 100%; padding-left: -10px; overflow: auto;">
                            <?php 
                            echo @$msg;
                            if(!empty($search_panel) || $search_panel != ''){
                                echo '<div class="col-lg-6" style="padding-left: 0px;">';
                                echo '<form action="'.base_url().'master/form_entry" method="post">';
                                echo $search_panel;
                                echo'<input type="submit" value="search" class="btn btn-primary" />';
                                echo '</form></div><div class="row" style="margin-bottom:10px;"></div>';
                            } ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="master" data-name="<?php echo ucwords(str_replace('_', ' ', $view_name)).' list' ?>"  cellspacing="0" data-pdf="<?php echo $export_pdf ?>" data-xl="<?php echo $export_excel ?>" data-csv="<?php echo $export_csv ?>" data-printing="<?php echo $enable_printing ?>" data-url="<?php echo base_url();?>">
                                    <thead>
                                        <tr style="display:none;">
                                            <th style="width:40px !important">SL</th>
                                            <?php
                                            foreach($label_list as $label){
                                                echo $label;
                                            }
                                            ?>
                                            <th style="width: 10% !important;">Action</th>
                                        </tr>
                                        <tr id="filterrow">
                                            <th style="width:40px !important">SL</th>
                                            <?php
                                            foreach($label_list as $label){
                                                echo $label;
                                            }
                                            ?>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										$supported_image = array(
											'gif',
											'jpg',
											'jpeg',
											'png'
										);
                                        //echo '<pre>';
                                        //print_r($table_data);
                                        $sl = 1;
                                        foreach($table_data[1] as $data){
                                        ?>
                                        <tr>
                                            <?php
                                            echo '<td>'.$sl++.'</td>';
                                            foreach($field_name as $label){
												$ext = strtolower(pathinfo(substr($data[str_replace('_id', '_name', $label)], 0, 90), PATHINFO_EXTENSION));
												if(in_array($ext,$supported_image))
													echo '<td><a href="'.base_url().substr($data[str_replace('_id', '_name', $label)], 0, 90).'" data-toggle="lightbox">'.substr($data[str_replace('_id', '_name', $label)], 0, 90).'</a></td>';
												else
													echo '<td>'.substr($data[str_replace('_id', '_name', $label)], 0, 90).'</td>';
                                            }
                                            ?>
                                            <td class="center" style="white-space: nowrap">
                                                    &nbsp;
                                                    <?php if($edit_privilege){ ?>
                                                    <a href="<?=base_url();?>master/update_content/<?php echo $view_name.'/'.$data[$table_name.'_id'].'?m_id='.$menu_id; ?>"><i class="glyphicon glyphicon-pencil"></i></a>
                                                    <?php }else{
                                                        echo '<a href="javascript:void(0);" onclick="show_alert();"><i class="glyphicon glyphicon-pencil"></i><a>';
                                                    }
                                                    if($enable_details_view->enable_details_view){  ?>
                                                    &nbsp;
                                                <a href="<?=base_url();?>master/view_details/<?php echo $table_name.'/'.$data[$table_name.'_id'].'?template_name='.$enable_details_view->template_details_view; ?>"  data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-eye-open"></i></a>
                                                    <?php }
                                                    if($delete_privilege){  ?>
                                                    &nbsp;
                                                <a href="<?=base_url();?>master/delete_content/<?php echo $view_name.'/'.$data[$table_name.'_id']; ?>"><i class="glyphicon glyphicon-remove"></i></a>
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
                    </div>
                    <?php } ?>
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
<script>
    function show_alert(){
        alert("Sorry you are not authorised to do this!");
    }
</script>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content"> </div>
  </div>
</div>
<script>
$(document).ready(function(){
	$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
	}); 
});


$('body').on('hidden.bs.modal', '.modal', function () {
  $(this).removeData('bs.modal');
});
</script>