<?php
    if(!empty($selected_product_group))
    {
        $sl=1;
        foreach ($selected_product_group as $k=>$v)
        {?>
            <tr>
                <th colspan="<?= ccsbsid(NULL, NULL,(get_specification_json_type(array(),NULL,1)+8)); ?>"><?php echo ($table=='region')?$v['region_name']:$v['product_group_name']; ?></th>
            </tr>
            <?php 
            //if(!empty($selected_product)){
            foreach($this->sales_model->get_selected_product2($v['sales_order_id'],($table=='region')?$v['region_id']:$v['product_group_id'],$table) as $key=>$value){
                $ps = json_decode($value['product_details_json'],TRUE);
                ?>
                <tr>
                    <td><?php echo $sl++;?></td>
                    <td>
                        <input type="hidden" name="product_id" class="product_id" value="<?php echo $value['product_id'];?>">
                        <?php echo $value['product_name'];?>
                    </td>
                    <?php echo get_specification_json_type($ps, "value"); ?>
                    <td><input class="quantity form-control updates" field_name="quantity" order_details_id ="<?php echo $value['sales_order_details_id'];?>" type="number" min="1" name="quantity[]" value="<?php echo $value['quantity'];?>"></td>
                    <td><input class="price_usd form-control updates" field_name="sales_price_usd" order_details_id ="<?php echo $value['sales_order_details_id'];?>" type="number" step="any" min="1" name="unit_price_usd[]" value="<?php echo $value['sales_price_usd'];?>"></td>
                    <td><input class="price form-control updates" field_name="sales_price" order_details_id ="<?php echo $value['sales_order_details_id'];?>" type="number" step="any" min="1" name="unit_price[]" value="<?php echo $value['sales_price'];?>"></td>
                    <td><input class="warranty_period form-control updates" field_name="warranty_period" order_details_id ="<?php echo $value['sales_order_details_id'];?>" type="number" step="any" min="1" name="warranty_period[]" value="<?php echo $value['warranty_period'];?>"></td>
                    <td class="sub_total"><?php echo number_format($value['quantity']*$value['sales_price'],2); ?></td>
                    <td>
                        <i  style=" cursor: pointer;text-align: center;" class="fa fa-times delete_product" aria-hidden="true"  order_details_id="<?php echo $value['sales_order_details_id'];?>"></i>
                    </td>
                </tr>
            <?php }
            //} 
            ?>
        <?php }
    }
?>
