
<div style="text-align: right; margin-bottom: 5px; position: absolute; right: 34px; top: 85px;">
<button title="Show/Hide Search Panel" type="button" class="btn btn-default panel-controller"><i class="fa fa-search"></i> Search</button>
</div>

<div class="panel panel-default search_panel_header" style="display: none;">
    <div class="panel-heading">Search By</div>
        <div class="panel-body">

            <?php
                echo custom_search_panel('',array("product_category_id","vehicle_type2","product_id"));
             ?>
   
        </div>
</div>

	<div class="panel panel-default">
            <div class="panel-heading"><?php echo label_html(CURRENT_STOCK, 'CURRENT_STOCK'); ?></div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover dataTable no-footer" id="vendor_list">
                    <thead>
                        <tr>
                            <th><?php echo label_html(SL_NO, 'SL_NO'); ?></th>
                            <th><?php echo label_html(PRODUCT_NAME, 'PRODUCT_NAME'); ?></th> 
                            <th><?php echo label_html(SDATA, 'SDTA'); ?></th> 
                            <th><?php echo label_html(VEHICLE_TYPE_NAME, 'VEHICLE_TYPE_NAME'); ?></th>
                            <th><?php echo label_html(CREATED_BY, 'CREATED_BY'); ?></th>
                            <th><?php echo label_html(CREATED, 'CREATED'); ?></th>
                            <th><?php echo label_html(STATUS, 'STATUS'); ?></th>
                            <th><?php echo label_html(ACTION, 'ACTION'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php $i=1;foreach ($sql as $data){?>
                          <tr>
                            <td><?php echo $i;$i++?> </td>
                            <td><?php echo $data['product_name']?></td>
                            <td><?php echo $data['sdta']?></td>
                            <td><?php echo $data['vehicle_type_name']?></td>
                            <td><?php echo $data['created_by']?></td>
                            <td><?php echo $data['created']?></td>
                            <td><?php echo $data['status']?></td>
                            
                            <td>
                                 <a href="<?php echo base_url().'inventory/add_new_product/?page=product_info&p_id='.$data["id"];?>"><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;&nbsp;
                                 <a  href="<?php echo base_url().'inventory/view/'.$data["id"];?>"><i class="glyphicon glyphicon-eye-open" id="view_spac"></i> </a> &nbsp;&nbsp;
                                 <a href="<?php echo base_url().'inventory/delete/'.$data['id'];?>"><i class="glyphicon glyphicon-remove"></i></a> 
                            </td>
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
        $('.search_panel_header').slideToggle();
    });
</script>