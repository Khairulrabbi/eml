<!--Previous code-->
<?php
//    echo get_grid_list(
//            array(
//                'title'=>'Waiting for Sales Approval',
//                'search_panel'=>FALSE,
//                'search_action'=>'',
//                'custom_search_column'=>4, 
//                'custom_search_panel'=>array(),
//                'tboday'=>TRUE,
//                'columns'=>$columns,
//                'sql'=>$sql,
//                'action'=>$action
//            )
//        );
?>

<!--//Previous end here-->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo label_html(WAITING_FOR_SALES_APPROVAL, 'WAITING_FOR_SALES_APPROVAL'); ?></h3>
            </div>
            <div class="panel-body">
                <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo label_html(WAITING_FOR_SALES_APPROVAL, 'WAITING_FOR_SALES_APPROVAL'); ?></h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover dataTable" id="model_list">
                        <thead>
                            <tr>
                                <th><?php echo label_html(SL, 'SL');?></th>
                                <th><?php echo label_html(SALES_CODE, 'SALES_CODE'); ?></th>
                                <th><?php echo label_html(CUSTOMER_NAME, 'CUSTOMER_NAME'); ?></th>
                                <th><?php echo label_html(ORDER_DATE, 'ORDER_DATE'); ?></th>
                                <th><?php echo label_html(SALES_PERSON, 'SALES_PERSON'); ?></th>
                                <th><?php echo label_html(ACTION, 'ACTION'); ?></th>                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach($sql as $val){?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $val['sales_code']; ?></td>
                                    <td><?php echo $val['customer_name']; ?></td>
                                    <td><?php echo $val['order_date']; ?></td>
                                    <td><?php echo $val['sales_person']; ?></td>
                                    <td>
                                        <a  href="<?php echo base_url().'sales/sales_order_approve_for_allocate/'.$val['id'];?>"> <i class="glyphicon glyphicon-eye-open" id="view_spac"></i> </a> &nbsp;&nbsp;
                                    </td>
                                </tr>  
                            <?php $i++;}?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
    </div>
    
</div>

<script>

$(document).ready(function(){
    $('#model_list').DataTable();
});

$(document).on('click','#view_spac',function(){
    $("#spac_view_form").submit();
});


</script>
