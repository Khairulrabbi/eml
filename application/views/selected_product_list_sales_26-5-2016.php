
    
        <?php 
        $sl=1;
        if(!empty($selected_product)){
        foreach($selected_product as $key=>$value){?>
            <tr>
              <td><?php echo $sl++;?></td>
              <td><?php echo $value['product_name'];?></td>
              <td><input class="quantity" order_details_id ="<?php echo $value['sales_order_details_id'];?>" type="number" min="1" name="quantity[]" value="<?php echo $value['quantity'];?>"></td>
              <td><input class="price" order_details_id ="<?php echo $value['sales_order_details_id'];?>" type="number" step="any" min="1" name="unit_price[]" value="<?php echo $value['sales_price'];?>"></td>
              <td class="sub_total"><?php echo number_format($value['quantity']*$value['sales_price'],2); ?></td>
              <td>
                  <i  style=" cursor: pointer;text-align: center;" class="fa fa-times delete_product" aria-hidden="true"  order_details_id="<?php echo $value['sales_order_details_id'];?>"></i>
              </td>
            </tr>
        <?php }} ?>
    
    </tbody>
  </table>
