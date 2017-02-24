<div class="panel panel-default">
    <div class="panel-heading" style="overflow: hidden;  ">
        <div class="panel-title pull-left ">
            FOB Cost Setting of <?php echo $p_group_name; ?> Group
        </div>
    </div>
        <div class="panel-body">
            <div class="col-lg-6">
                <div class="order_block_save"></div>
                <table class="table table-bordered" id="">
                    <thead>
                        <tr>
                            <th colspan="3">Size Of Tyre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($sql->result() as $row)
                            { ?>
                                <tr>
                                    <td><?php echo $row->row_index; ?></td>
                                    <td><?php echo str_replace("#", $row->value_of, $row->fob_name).(($row->formula_on != "")?" On (".$row->formula_on.")":""); ?></td>
                                    <td></td>
                                </tr>
                            <?php }
                        ?>                                
                    </tbody>                      
                </table>
                <a 
                    class="btn btn-primary" 
                    href="<?php echo base_url().'purchase/fob_setting/?pg_id='.$p_group_id.'&pi_id='.$p_invoice_id; ?>">
                    Edit
                </a>
                <a 
                    class="btn btn-primary fob_confirm" 
                    p_group="<?php echo $p_group_id; ?>" 
                    p_invoice_id="<?php echo $p_invoice_id; ?>" 
                    href="">
                    Confirm
                </a>
            </div> 


        </div>
    </div>