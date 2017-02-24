<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo label_html(SEGREGATION_LIST, 'SEGREGATION_LIST');?></h3>
            </div>
            <div class="panel-body">
                <div class="panel panel-default">  
                    <div class="panel-heading">
                        <h3 class="panel-title">Search By</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                            echo custom_search_panel('',array("product_category_id","vehicle_type2","product_id"));
                        ?>
                    </div>
                </div>
                <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo label_html(SEGREGATION_LIST, 'SEGREGATION_LIST'); ?></h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover dataTable" id="model_list">
                        <thead>
                            <tr>
                                <th><?php echo label_html(SL_NO, 'SL_NO');?></th>
                                <th><?php echo label_html(PRODUCT_NAME, 'PRODUCT_NAME');?></th>
                                <th><?php echo label_html(VENDOR_NAME, 'VENDOR_NAME');?></th>
                                <th><?php echo label_html(PURCHASE_PRICE_USD, 'PURCHASE_PRICE_USD');?></th>
                                <th><?php echo label_html(PURCHASE_PRICE_BDT, 'PURCHASE_PRICE_BDT');?></th>
                                <th><?php echo label_html(SERIAL_NUMBER, 'SERIAL_NUMBER');?></th>
                                <th><?php echo label_html(ORDER_NUMBER, 'ORDER_NUMBER');?></th>
                                <th><?php echo label_html(WAREHOUSE_NAME, 'WAREHOUSE_NAME');?></th>
                                <th><?php echo label_html(STATUS_NAME, 'STATUS_NAME')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $sl=1;
                            foreach($sql as $key=>$value){?>
                                <tr>
                                  <td><?php echo $sl++;?></td>
                                  <td><?php echo $value['product_name'];?></td>
                                  <td><?php echo $value['vendor_name'];?></td>
                                  <td><?php echo $value['purchase_price_usd'];?></td>
                                  <td><?php echo $value['purchase_price_bdt'];?></td>
                                  <td><?php echo $value['serial_number'];?></td>
                                  <td><?php echo $value['order_number'];?></td>
                                  <td><?php echo $value['warehouse_name']; ?></td>
                                  <td><?php echo $value['status_name'];?></td>                                
                                </tr>
                            <?php } ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
    </div>    
</div>


<script>
$(document).ready(function(){
    $('#model_list').DataTable();
});
</script>
































<?php
//    echo get_grid_list(array('title'=>'Segregation List','search_panel'=>TRUE,'search_action'=>'','custom_search_column'=>4, 'custom_search_panel'=>array( "product_id" => array(0,1,0), "vendor_id" => array(0,1,0), "order_number" => array(0,1,0), "serial_number" => array(0,1,0) ),'tboday'=>TRUE,'columns'=>$columns,'sql'=>$sql,'action'=>$action));
?>


