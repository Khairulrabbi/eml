<?php
$sql = $this->inventory_model->get_vendor_list();
//$columns = array("#SL_no", "vendor_name", "mobile_number", "phone_number", "email", "web_url");
//$action = array("common"=>"","edit"=>"inventory/add_new_product/?page=product_info&p_id=","view"=>"inventory/view/","delete"=>"inventory/delete/");
//echo get_grid_list(array('title'=>'Vendor List','search_panel'=>TRUE,'search_action'=>'','custom_search_column'=>2,'custom_search_panel'=>array(),'tboday'=>TRUE,'columns'=>$columns,'sql'=>$sql,'action'=>$action));
?>

	<div class="panel panel-default">
            <div class="panel-heading"><?php echo label_html(CURRENT_STOCK, 'CURRENT_STOCK'); ?></div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover dataTable no-footer" id="vendor_list">
                    <thead>
                        <tr>
                            <th><?php echo label_html(SL, 'SL'); ?></th>
                            <th><?php echo label_html(VENDOR_NAME, 'VENDOR_NAME'); ?></th> 
                            <th><?php echo label_html(MOBILE_NUMBER, 'MOBILE_NUMBER'); ?></th> 
                            <th><?php echo label_html(PHONE_NUMBER, 'PHONE_NUMBER'); ?></th>
                            <th><?php echo label_html(EMAIL, 'EMAIL'); ?></th>
                            <th><?php echo label_html(WEB_URL, 'WEB_URL'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php $i=1;foreach ($sql as $data){?>
                          <tr>
                            <td><?php echo $i;$i++?> </td>
                            <td><?php echo $data['vendor_name']?></td>
                            <td><?php echo $data['mobile_number']?></td>
                            <td><?php echo $data['phone_number']?></td>
                            <td><?php echo $data['email']?></td>
                            <td><?php echo $data['web_url']?></td>
                          </tr>    
                        <?php }?>
                    </tbody>
                </table>
            </div> <!--Panel body close -->
	</div> <!--Panel div close -->



<script type="text/javascript">
    $(document).ready(function() {
       $('#vendor_list').DataTable(); 
    });
    $('.panel-controller').click(function(e) {
        $('.search_panel').slideToggle();
    });
</script>
