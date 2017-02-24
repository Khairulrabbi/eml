<div class="scrolltable">
        <table class="table">
            <thead>
                <tr>
                    <th>#Sl</th>
                    <th>Address Title</th>
                    <th>Details</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; foreach ($address_value as $value){?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $value['customer_address_title'];?></td>
                        <td><?php echo $value['address_details'];?></td>
                        <td>
                            <i style=" cursor: pointer;text-align: center;" class="fa fa-pencil edit_address" aria-hidden="true"  address_table_id="<?php echo $value['customer_address_id'];?>" ></i>
                            <i style=" cursor: pointer;text-align: center;" class="fa fa-times delete_address" aria-hidden="true" address_table_id="<?php echo $value['customer_address_id'];?>"></i>
                        </td>
                    </tr>
                <?php $i++;} ?>
            </tbody>
        </table>

    </div>