<?php
//previous Code 
    $sql = $this->inventory_model->get_current_stock();
//    $columns = array("#SL_no", "product_code", "product_name", "serial_number", "purchase_date", "good_recieve_date", "warranty_expired_on" );
//    $action = array("common"=>"","edit"=>"inventory/add_new_product/?page=product_info&p_id=","view"=>"inventory/view/","delete"=>"inventory/delete/");
//    echo get_grid_list(array('title'=>'Current Stock','search_panel'=>TRUE,'search_action'=>'','custom_search_column'=>2,'custom_search_panel'=>array(),'tboday'=>TRUE,'columns'=>$columns,'sql'=>$sql,'action'=>$action));
//Previous Code End here
 ?>


<div class="panel panel-default">
    <div class="panel-heading"><?php echo label_html(CURRENT_STOCK, 'CURRENT_STOCK'); ?></div>
    <div class="panel-body">
        <table class="table table-striped table-bordered table-hover dataTable no-footer" id="current_list">
            <thead>
                <tr>
                    <th><?php echo label_html(SL, 'SL'); ?></th>
                    <th><?php echo label_html(WAREHOUSE_NAME, 'WAREHOUSE_NAME'); ?></th> 
                    <th><?php echo label_html(LOCATION_NAME, 'LOCATION_NAME'); ?></th> 
                    <th><?php echo label_html(TOTAL, 'TOTAL'); ?></th>

                </tr>
            </thead>
            <tbody>
                <?php $i=1;foreach ($sql1 as $data){?>
                  <tr>
                    <td><?php echo $i;$i++?> </td>
                    <td><?php echo $data['warehouse_name']?></td>
                    <td><?php echo $data['location_name']?></td>
                    <td><?php echo $data['total']?></td>
                  </tr>    
                <?php }?>
            </tbody>
        </table>
    </div> <!--Panel body close -->
</div> <!--Panel div close -->



<script type="text/javascript">
    $(document).ready(function() {
       $('#current_list').DataTable(); 
    });
    $('.panel-controller').click(function(e) {
        $('.search_panel').slideToggle();
    });
</script>

