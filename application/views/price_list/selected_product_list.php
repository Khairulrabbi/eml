<?php
    if(!empty($selected_product_group))
    {
        $sl=1;
        foreach ($selected_product_group as $k=>$v)
        {?>
            <tr>
                <th colspan="<?= ccsbsid(NULL, NULL,(get_specification_json_type(array(),NULL,1)+5)); ?>"><?php echo (@$table=='region')?$v['region_name']:@$v['product_group_name']; ?></th>
            </tr>
            <?php 
            
            //if(!empty($selected_product)){
            foreach($this->price_list_model->get_selected_product2($v['price_list_id'],(@$table=='region')?$v['region_id']:$v['product_group_id'],@$table) as $key=>$value){
                $ps = json_decode($value['product_details_json'],TRUE);
                ?>
                <tr>
                    <td><?php echo $sl++;?></td>
                    <td>
                        <input type="hidden" name="product_id" class="product_id" value="<?php echo $value['product_id'];?>">
                        <input type="hidden" name="price_list_details_id" class="price_list_details_id" value="<?php echo $value['price_list_details_id'];?>">
                        <a style="text-decoration: underline" target="_blank" href="<?php echo base_url().'inventory/add_new_product/?page=product_info&p_id='.$value['product_id']; ?>"><?php echo $value['product_name'];?>&nbsp;<?php echo @$value['model_name'];?></a>
                    </td>
                    <td><?php echo $value['product_code'];?></td>
                    <?php echo get_specification_json_type($ps, "value"); ?>
                    <td><input class="price form-control updates" field_name="unit_price" price_list_details ="<?php echo $value['price_list_details_id'];?>" type="number" step="any" min="1" name="unit_price[]" value="<?php echo $value['unit_price'];?>"></td>
                    <td>
                     <i  style=" cursor: pointer;text-align: center;" class="btn btn-danger fa fa-times delete_product" aria-hidden="true"  order_details_id="<?php echo $value['price_list_details_id'];?>" title="Delete"></i>
                  </td>
                </tr>
            <?php }

            //} 
            ?>
        <?php }
    }

?>











        
    
