<script>

    $(document).ready(function() {
        $('#model_list').DataTable({
                "processing":true
            });
    });

</script>
<table class="table table-striped table-bordered table-hover dataTable" id="model_list">
    <thead>
        <tr>
            <th><?php echo label_html(SL, 'SL');?></th>
            <th><?php echo label_html(PRODUCT_NAME, 'PRODUCT_NAME');?></th>
            <th><?php echo label_html(PRODUCT_CODE, 'PRODUCT_CODE');?></th>
            <?php echo get_specification_json_type(array(), "title"); ?>
            <th><?php echo label_html(AVAILABLE_QTY, 'AVAILABLE_QTY');?></th>
            <th><?php echo label_html(REORDER_QTY, 'REORDER_QTY');?></th>
           
            <th><?php echo label_html(ACTION, 'ACTION')?></th>
        </tr>
    </thead>
    <tbody class="">
        <?php 
             $sl=1;
             //debug($sql,1);
              foreach($sql as $key=>$value){
                  $ps = json_decode($value['product_details_json'],TRUE);
              ?>
        <tr>
            <td>
                <?php echo $sl++;
                if($value['total']< $value['reorder_qty'] ){ 
                ?>
                <span class="glyphicon glyphicon-star" style="color: red;margin-left: 10px;"></span>
                <?php } ?>
            </td>
            <td>
                <a href="<?php echo base_url().'inventory/add_new_product/?page=product_info&p_id='.$value['product_id']; ?>">
                    <?php echo $value['product_name']; ?></td>
                </a>
            <td><?php echo $value['product_code']; ?></td>
            <?php echo get_specification_json_type($ps, "value"); ?>
            <td>
                <a href="<?php echo base_url() . 'stock/current_stock_details/' . $value['id']; ?>">
                    <?php echo $value['total']; ?></td>
                </a>
            <td><?php echo $value['reorder_qty']; ?></td>
           
            <td>
                <span 
                    class="btn btn-primary cart_checkbox" 
                    product_id="<?php echo $value['product_id']; ?>" 
                    list_type="<?php echo $type; ?>"><?= ($value['cart_exist'] != NULL) ?'Added':'Add to Cart'; ?></span>
                
            </td>
        </tr>
        <?php } ?> 
                         
        </tbody>
        <tr>
                                  <th colspan="<?= ccsbsid(NULL, NULL,(get_specification_json_type(array(),NULL,1)+8)); ?>"style="text-align: left;">
                                  N.B : <span class="glyphicon glyphicon-star" style="color: red;margin-left: 10px;"></span> Means Available quantity to lower than reorder quantity
                                  </th>
                              </tr>
                    
                
</table>

    