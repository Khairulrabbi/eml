<div class="panel-body">                   
<div class="panel panel-default">
      <div class="panel-heading">
      <h5 class="panel-title">Receive History</h5>
      </div>
      <div class="panel-body" id="search_panel">
      <table class="table table-striped table-bordered table-hover dataTable no-footer" id="receive_history">
          <thead>
              <tr>
                  <th>#<?php echo SI; ?></th>
                  <th><?php echo label_html(PRODUCT_NAME,'PRODUCT_NAME'); ?></th>
                  <th><?php echo label_html(RECEIVED_QUANTITY,'RECEIVED_QUANTITY'); ?></th>
                  <th><?php echo label_html(RECEIVE_DATE,'RECEIVE_DATE'); ?></th>
              </tr>
          </thead>
          <tbody>
              <?php $i=1; 
              foreach ($good_receive as $val){
                  ?>
                  <tr>
                      <td><?php echo $i;?></td>
                      <td><?php echo $val['product_name'];?></td>
                      <td><?php echo $val['receive_quantity'];?></td>
                      <td>
                          <?php $actual_Date = $val['created'];
                           echo date("Y/m/d",  strtotime($actual_Date));?>
                      </td>
                  </tr>

              <?php $i++;} ?>
          </tbody>
      </table>
      </div>
</div>
</div>

<script>
$(document).ready(function(){
    $('#receive_history').DataTable();
    });
</script>