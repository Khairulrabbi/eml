<table class="table table-striped table-bordered table-hover dataTable no-footer dropdown_tb">
                <thead>
                    <tr>
                        <th><?php echo label_html(SL, 'SL'); ?></th>
                        <th><?php echo "Dropdown Name"; ?></th>
                        <th><?php echo "Details"; ?></th>
                        <th><?php echo "Query"; ?></th>
                        <th><?php echo "Feild-Id"; ?></th>
                        <th><?php echo "Feild-Name"; ?></th>
                        <th><?php echo "Option Id"; ?></th>
                        <th><?php echo "option Value"; ?></th>
                        <th><?php echo "Concat Item"; ?></th>
                        <th><?php echo "Created Date"; ?></th>
                        <th><?php echo "Created By"; ?></th>
                        <th><?php echo "Status"; ?></th>
                        <th><?php echo "Action"; ?></th>
                    </tr>
                </thead>
                <tbody class="dropdown_info">
                    <?php $i = 1;
                        foreach ($drop_info as $key => $value) { ?>
                            <tr>
                                <td><?php echo $i++; ?> </td>
                                <td><?php echo $value['dd_name'].' ('.$value['dd_id'].')'; ?></td>
                                <td><?php echo $value['details']; ?></td>
                                <td>
                                   <?php
                                        $val = $value['query'];
                                        if(strlen($val)>30){
                                           $data = substr($val,0,30)."........";
                                           echo $data ;
                                          } 
                                          else {
                                              echo  $val; 
                                              
                                          } 
                                     ?>
                                </td>
                                <td><?php echo $value['field_id']; ?></td>
                                <td><?php echo $value['field_name']; ?></td>
                                <td><?php echo $value['option_id']; ?></td>
                                <td><?php echo $value['option_value']; ?></td>
                                <td><?php echo $value['concat_item']; ?></td>
                                <td><?php echo date("Y-m-d",strtotime($value['created']));?></td>
                                <td><?php echo $value['username']; ?></td>
                                <td><?php echo $value['status']; ?></td>
                                <td>
                                    <a  href="<?php echo base_url() ?>common_controller/add_dropdownmenu/<?php echo $value['dd_id']; ?>" class="glyphicon glyphicon-pencil"></a>
                                </td>
                            </tr>    
                        <?php } ?>
                </tbody>
            </table>




<script>
$(document).ready(function(){
    var $datatable = $('.dropdown_tb').DataTable();
});   
</script>