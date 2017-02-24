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
            foreach($this->purchase_model->get_selected_product2($v['purchase_order_id'],($table=='region')?$v['region_id']:$v['product_group_id'],$table) as $key=>$value){
                $ps = json_decode($value['product_details_json'],TRUE);
                ?>
                <tr>
                    <td><?php echo $sl++;?></td>
                    <td>
                        <input type="hidden" name="product_id" class="product_id" value="<?php echo $value['product_id'];?>">
                        <input type="hidden" name="purchase_order_details_id" class="purchase_order_details_id" value="<?php echo $value['purchase_order_details_id'];?>">
                        <a style="text-decoration: underline" target="_blank" href="<?php echo base_url().'inventory/add_new_product/?page=product_info&p_id='.$value['product_id']; ?>"><?php echo $value['product_name'];?>&nbsp;<?php echo @$value['model_name'];?></a>
                    </td>
                    <td><?php echo $value['product_code'];?></td>
<!--                    <td><?php //echo @$ps[1];?></td>
                    <td><?php //echo @$ps[5];?></td>
                    <td><?php //echo @$ps[12];?></td>
                    <td><?php //echo @$ps[13];?></td>
                    <td><?php //echo @$ps[14];?></td>-->
                    <?php echo get_specification_json_type($ps, "value"); ?>
                    <td><input class="quantity form-control updates" field_name="quantity" order_details_id ="<?php echo $value['purchase_order_details_id'];?>" type="number" min="1" name="quantity[]" value="<?php echo $value['quantity'];?>"></td>
                    <td><input class="price_usd form-control updates_usd" field_name="purchase_price_usd" order_details_id ="<?php echo $value['purchase_order_details_id'];?>" type="number" step="any" min="1" name="unit_price_usd[]" value="<?php echo $value['purchase_price_usd'];?>"></td>
                    <td><input class="price form-control updates" field_name="purchase_price" order_details_id ="<?php echo $value['purchase_order_details_id'];?>" type="number" step="any" min="1" name="unit_price[]" value="<?php echo $value['purchase_price'];?>"></td>
                    <td class="sub_total"><?php echo number_format($value['quantity']*$value['purchase_price'],2); ?></td>
                    <td>
    <!--                  <i  style=" cursor: pointer;text-align: center;" class="btn btn-info fa fa-pencil update_product" aria-hidden="true"  order_details_id="<?php echo $value['purchase_order_details_id'];?>" title="Update"></i>-->
                      <i  style=" cursor: pointer;text-align: center;" class="btn btn-danger fa fa-times delete_product" aria-hidden="true"  order_details_id="<?php echo $value['purchase_order_details_id'];?>" title="Delete"></i>
                  </td>
                </tr>
            <?php }

            //} 
            ?>
        <?php }
    }

?>











        
    
