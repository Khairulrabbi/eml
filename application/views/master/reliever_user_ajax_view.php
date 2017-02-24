<?php 
$i = 1;
foreach ($user_history as $k=>$v) { ?>
<tr>
    <td><?php echo $i++; ?></td>
    <td><?php echo date("Y-m-d",strtotime($v['reliever_start_datetime'])); ?></td>
    <td><?php echo date("Y-m-d",strtotime($v['reliever_end_datetime'])); ?></td>
    
    
    <td><?php echo $v['username']; ?></td>
    <td><?php echo date("Y-m-d",strtotime($v['created'])); ?></td>
    <td>
       <?php if($v['status'] == "Active"){ ?>
        <a class="status_change" status="<?php  echo $v['status'];?>">
       <i class="fa fa-eye"></i></a>
       <?php }
       
       else{
           echo $v['status'];
       }
       ?>
    </td>
</tr>
<?php  } ?>



<script>
    $(document).on("click",'.status_change', function () {
       var status = $(this).attr('status');
    
        if(confirm('Are you sure you want to delete this?')){
            
    $.ajax({
           url: '<?php echo base_url(); ?>master/change_user_status',
            type: 'POST',
            data: {status:status },
            success: function (data) {
                $("#reliever_ajax_view").html(data);
            } 
    });
    }
    });
</script>