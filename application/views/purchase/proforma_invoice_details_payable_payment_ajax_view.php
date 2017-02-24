<?php $i = 1;
foreach ($payable_list as $key => $value) { ?>
    <tr>
        <td>
            <input class="select_one" type="checkbox" name="" value="">&nbsp;&nbsp;
            <?php echo $i++;?> 
        </td>
        <td>
            <a href=""><?php echo $value['payment_approval_code'] ?></a>
        </td>
        <td><?php echo $value['cost_component_name'] ?></td>
        <td><?php echo $value['amount'] ?></td>
        <td><?php echo $value['status_name'] ?></td>
    </tr>    
<?php } ?>
