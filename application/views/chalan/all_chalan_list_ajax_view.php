<table class="table table-striped table-bordered table-hover dataTable no-footer" id="sales_order_list">
    <thead>
            <tr>
                <th>#SL</th> 
                <th>Chalan Code</th> 
                <th>Sales Code</th> 
                <th>Chalan From</th>
                <th>Chalan To</th>
                <th><?php echo label_html(STATUS, 'STATUS'); ?></th><th><?php echo label_html(ACTION, 'ACTION'); ?></th>
            </tr>
            <?php 

            $i=1;foreach ($all_chalan_list as $data){?>
            <tr>
                <td><?php echo $i;$i++?> </sales_codetd>
                <td><?php echo $data['chalan_code']?></td>
                <td><?php echo $data['sales_code']?></td>
                <td><?php echo $data['warehouse_name']?></td>
                <td><?php echo $data['customer_name']?></td>
                <td><?php echo $data['status_name']?></td>
                <td>
                    <?php if($flag =='list'){ ?>
                    <a href="<?php echo base_url().'chalan/chalan_order_detail_list/'.$data['chalan_id']; ?>">
                        <i class="glyphicon glyphicon-eye-open"></i>
                    </a>&nbsp;&nbsp;
                        <a href="<?php echo base_url().'chalan/chalan_order_detail_print/'.$data['chalan_id']; ?>">
                        <i class="glyphicon glyphicon-print"></i>
                    </a>
                    <?php }else if($flag =='modal'){ ?>
                    <input <?php echo (in_array($data['chalan_id'],$chalan_id_array)?'checked="checked"':''); ?> type="checkbox" name="chalan_id[]" value="<?php echo $data['chalan_id']; ?>">
                    <?php } ?>
                </td>
            </tr>    
            <?php }?>
    </thead>
</table>