<?php 
        $sl=1;
        if(!empty($transfer_data)){
        foreach($transfer_data as $key=>$value){?>
            <tr>
              <td><?php echo $sl++;?></td>
              <td><?php echo $value['product_name'];?></td>
              <td><?php echo $value['product_code'];?></td>
              <td><?php echo $value['serial_no'];?></td>
              <td><?php echo $value['transfromFrom'];?></td>
              <td><?php echo $value['transferTo'];?></td>
              
            </tr>
        <?php }} ?>