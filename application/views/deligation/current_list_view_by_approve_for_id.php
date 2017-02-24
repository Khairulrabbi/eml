<?php
$sl = 1;
    $existing_user_list = '';
    foreach ($approve_for as $k=>$v)
    { 
        $existing_user_list .= $v['user_id'].',';
    ?>
        <tr>
            <td class="cl_serial"><?php echo $sl; ?></td>
            <td><?php echo $v['username']; ?></td>
            <td><?php echo $v['max_limit']; ?></td>
            <td><?php echo $v['limit_type']; ?></td>
            <td>
                <a 
                    class="ex_u_remove" 
                    flag="existing" 
                    user_id="<?php echo $v['user_id']; ?>"
                    href="<?php echo base_url().'deligation/remove_existing_user/'.$v['user_id']; ?>">
                    <i class="fa fa-remove btn btn-danger"></i></td>
                </a>
                
        </tr>
       <?php $sl++;
     }
     $existing_user_list = rtrim($existing_user_list,",");
?>
        <input type="hidden" class="existing_user_list_hidden" value="<?php echo @$existing_user_list; ?>">