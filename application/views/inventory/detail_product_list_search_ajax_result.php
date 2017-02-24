<table class="table table-striped table-bordered table-hover dataTable no-footer" id="current_product_list">
            <thead>
                <tr>
                    <th><?php echo label_html(SL, 'SL'); ?></th>
                    <th><?php echo label_html(PRODUCT_NAME, 'PRODUCT_NAME'); ?></th>  
                    <th><?php echo label_html(PRODUCT_CODE, 'PRODUCT_CODE'); ?></th> 
                    <th><?php echo label_html(REGION, 'REGION'); ?></th> 
                    <th><?php echo label_html(GROUP, 'GROUP'); ?></th>
                    <?php  echo get_specification_json_type(array(), "title")?>
                    <th>Unit Price(BDT)</th>
                    <th>Unit Price(USD)</th>
                </tr>
            </thead>
            
            <tbody>
                <?php 
                    $i=1;
                    foreach ($results as $key=>$data){
                        $decoded_values = json_decode($data['product_details_json'], TRUE);
                     ?>
                      <tr>
                        <td><?php echo $i;$i++?> </td>
                        <td>
                            <a href="<?php echo base_url().'inventory/add_new_product/?page=product_info&p_id='.$data["id"];?>">
                                <?php echo $data['product_name'];?>&nbsp;<?php echo '('.$data['model_name'].')';?>
                            </a>
                        </td>
                        <td><?php echo $data['product_code'];?></td>
                        <td><?php echo $data['region_name'];?></td>
                        <td><?php echo $data['product_group_name'];?></td>
                        <?php echo get_specification_json_type($decoded_values, "value"); ?>
                        <td><?php echo $data['unit_price'];?></td>
                        <td><?php echo $data['unit_price_usd'];?></td>


                      </tr>    
                    <?php 

                    }
                    ?>            
            </tbody>
            
        </table>


<script type="text/javascript">
    $(document).ready(function() {
       $('#current_product_list').DataTable(); 
    });  
</script>



