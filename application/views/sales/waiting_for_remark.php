	<div class="panel panel-default">
            <div class="panel-heading"><?php echo label_html(WAITING_FOR_REMARK, 'WAITING_FOR_REMARK'); ?></div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover dataTable no-footer" id="waiting_list">
                    <thead>
                        <tr>
                            <th><?php echo label_html(SL_NO, 'SL_NO'); ?></th>
                            <th><?php echo label_html(QUOTATION_CODE, 'QUOTATION_CODE'); ?></th>
                            <th><?php echo label_html(CUSTOMER_NAME, 'CUSTOMER_NAME'); ?></th> 
                            <th><?php echo label_html(SALES_PERSON, 'SALES_PERSON'); ?></th>                    
                            <th><?php echo label_html(ACTION, 'ACTION'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;foreach ($sql as $data){?>
                          <tr>
                            <td><?php echo $i;$i++?> </td>
                            <td><?php echo $data['quotation_code']?></td>
                            <td><?php echo $data['customer_name']?></td>       
                            <td><?php echo $data['sales_person']?></td>                       
                            <td>
                            <a href="<?php echo base_url().'sales/view_single_waiting_for_remark/'.$data['id'];?>"><i class="glyphicon glyphicon-eye-open"></i></a> &nbsp; &nbsp;    
                            </td>
                          </tr>    
                        <?php }?>
                    </tbody>
                </table>
            </div> <!--Panel body close -->
	</div> <!--Panel div close -->

<script>

$(document).ready(function(){
    $('#waiting_list').DataTable();
});
$('.panel-controller').click(function(e){
    $('.search_panel').slideToggle();
});

</script>