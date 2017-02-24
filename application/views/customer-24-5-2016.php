<h2><?php echo $title; ?></h2>

<div class="scrolltable">
    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="master">
        <thead>
            <tr>
                <th>SL No.</th><th>Name</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1;foreach ($table_data as $data){?>
			<tr>
              <td><?php echo $i;$i++?> </td>
              <td><?php echo $data['customer_name']?></td>
			</tr>  
            <?php }?>
        </tbody>
    </table>

</div>
<div>
	  <a href="<?php echo base_url().'customer/add_customer' ?>"><button class="btn btn-primary" data-toggle="modal" data-target="#add_customer_modal">Add New Customer</button></a>
</div>



