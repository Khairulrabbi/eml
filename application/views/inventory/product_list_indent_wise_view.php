<nav class="breadcrumb">
  <a class="breadcrumb-item" href="#">Home</a>
  <a class="breadcrumb-item" href="#">Library</a>
  <a class="breadcrumb-item" href="#">Data</a>
  <span class="breadcrumb-item active">Bootstrap</span>
</nav>        

<div class="panel panel-default">
    <div class="panel-heading"><?php echo "Product List"; ?></div>
    <div class="panel-body">
        <table class="table table-striped table-bordered table-hover dataTable no-footer" id="p_list">
            <thead>
                <tr>
                    <th><?php echo label_html(SL, 'SL'); ?></th>
                    <th><?php echo label_html(INDENT_NO, 'INDENT_NO'); ?></th>
                    <th><?php echo label_html(PRODUCT_NAME, 'PRODUCT_NAME'); ?></th>
                    <th><?php echo label_html(PRODUCT_CODE, 'PRODUCT_CODE'); ?></th>
                    <?php echo get_specification_json_type(array(), "title"); ?>
                    <th><?php echo label_html(PURCHASE_DATE, 'PURCHASE_DATE'); ?></th>
                    <th><?php echo "Receive Date"; ?></th>
                    <th><?php echo label_html(RECEIVED_QUANTITY, 'RECEIVED_QUANTITY'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1;foreach ($p_list_indent_wise as $k=>$v){
                    $ps = json_decode($v['product_details_json'],TRUE);
                        ?>
                  <tr> 
                    <td><?php echo $i;$i++?> </td>
                    <td><?php echo $v['indent_number']?></td>
                    <td><?php echo $v['product_name']; ?></td>
                    <td><?php echo $v['product_code']; ?></td>
                    <?php echo get_specification_json_type($ps, "value"); ?>
                    <td><?php echo date("Y-m-d", strtotime($v['purchase_date']));?></td>
                    <td><?php echo date("Y-m-d", strtotime($v['recieve_ack_date']));?></td>
                    <td><?php echo $v['receive_quantity'];?></td>
                  </tr>    
                <?php }?>
            </tbody>
            
            
        </table>
        
        <div class="row">
            <div class="col-lg-12">
            
                
                <p style="text-align: right; font-size: 18px;"><b>Total :
                    <?php 
                    $total = 0;
                        foreach ($p_list_indent_wise as $key => $value) {
                            $total=$total+$value['receive_quantity'];
                        }
                       echo $total ;
                    ?> 
                </b></p>
            </div>
        </div>
    </div> <!--Panel body close -->
</div> <!--Panel div close -->

<script>

$(document).ready(function(){
    $('#p_list').DataTable();
});


</script>