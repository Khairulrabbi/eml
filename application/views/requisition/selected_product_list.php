<?php
    if(!empty($selected_product_group))
    {
        $sl=1;
        foreach ($selected_product_group as $k=>$v)
        {?>
            <tr>
                <th colspan="11"><?php echo ($table=='region')?$v['region_name']:$v['product_group_name']; ?></th>
            </tr>
            <?php 
            //if(!empty($selected_product)){
            foreach($this->requisition_model->get_selected_product2($v['stock_requisition_id'],($table=='region')?$v['region_id']:$v['product_group_id'],$table) as $key=>$value){
                $ps = json_decode($value['product_details_json'],TRUE);
                ?>
                <tr>
                  <td><?php echo $sl++;?></td>
                    <td>
                        <input type="hidden" name="product_id" class="product_id" value="<?php echo $value['product_id'];?>">
                        <input type="hidden" name="stock_requisition_details_id" class="stock_requisition_details_id" value="<?php echo $value['stock_requisition_details_id'];?>">
                        <a style="text-decoration: underline" target="_blank" href="<?php echo base_url().'inventory/add_new_product/?page=product_info&p_id='.$value['product_id']; ?>"><?php echo $value['product_name'];?>&nbsp;<?php echo @$value['model_name'];?></a>
                    </td>
                    <td><?php echo $value['product_code'];?></td>
                    <?php echo get_specification_json_type($ps, "value"); ?>
                    <td>
                        <input 
                            class="quantity form-control updates" 
                            field_name="request_quantity" 
                            order_details_id ="<?php echo $value['stock_requisition_details_id'];?>" 
                            type="number" min="1" 
                            name="quantity[]" 
                            value="<?php echo $value['request_quantity'];?>">
                    </td>
                    <td>
                      <i  style=" cursor: pointer;text-align: center;" class="btn btn-danger fa fa-times delete_product" aria-hidden="true"  order_details_id="<?php echo $value['stock_requisition_details_id'];?>" title="Delete"></i>
                    </td>
                </tr>
            <?php }
            //} 
            ?>
        <?php }
    }
?>
