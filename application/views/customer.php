<div class="panel panel-default">
    <div class="panel-heading"><?php echo label_html(CUSTOMER_LIST, 'CUSTOMER_LIST'); ?></div>
		  <div class="panel-body">
<div class="scrolltable">
    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="master">
        <thead>
            <tr>
                <th><?php echo label_html(SL_NO, 'SL_NO')?></th>
                <th><?php echo label_html(NAME, 'NAME')?></th>
                <th><?php echo label_html(ACTION, 'ACTION')?></th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1;foreach ($table_data as $data){?>
            <tr>
              <td><?php echo $i;$i++?> </td>
              <td><?php echo $data['customer_name']?></td>
              <td>
                  <a href="<?php echo base_url().'customer/add_customer/'.$data['customer_id'];?>"><i class="glyphicon glyphicon-pencil"></i></a>
              </td>
            </tr>  
            <?php }?>
        </tbody>
    </table>

</div>
<div>
	  <a href="<?php echo base_url().'customer/add_customer' ?>"><button class="btn btn-primary" data-toggle="modal" data-target="#add_customer_modal">Add New Customer</button></a>
</div>
<div>
</div>


