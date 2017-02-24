<div class="scrolltable">
        <table class="table">
            <thead>
                <tr>
                    <th>#Sl</th>
                    <th>Cost Component</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; 
                $total = 0;
                foreach ($cost_component_list as $cost_component){
                    
                    $total = $total+$cost_component['amount'];
                    ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $cost_component['cost_component_name'];?></td>
                        <td class="cost_amount"><?php echo number_format($cost_component['amount'],2);?></td>
                        <td>
                            <i style=" cursor: pointer;text-align: center;" class="fa fa-pencil edit_cost_component" aria-hidden="true" cost_total="<?php echo $cost_component['amount'];?>" cost_component_id="<?php echo $cost_component['cost_component_id'];?>" quotation_cost_component_id="<?php echo $cost_component['quotation_cost_component_id'];?>"></i>
                            <i style=" cursor: pointer;text-align: center;" class="fa fa-times delete_cost_component" aria-hidden="true" cost_component_id="<?php echo $cost_component['cost_component_id'];?>" quotation_cost_component_id="<?php echo $cost_component['quotation_cost_component_id'];?>"></i>
                        </td>
                    </tr>
                    
                <?php $i++;} ?>
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Total</th>
                    <th class="total_cost"><?php echo number_format($total,2);?></th>
                    <th></th>
                </tr>
                <tr>
                    <th></th>
                    <th>Total In Word : </th>
                    <th colspan="2" class="totalInWord"><?php echo ucwords(convert_number_to_words($total))." Taka (Only)";?></th>
                </tr>
            </tfoot>
        </table>

    </div>

