
<div class="panel panel-default">
    <div class="panel-heading " style="overflow: hidden;">Waiting Approval List</div>
    <div class="panel-body">
        <table class="table table-striped table-bordered table-hover dataTable no-footer" id="approved_list">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select_all">&nbsp;&nbsp;<?php echo label_html(SL, 'SL'); ?></th>
                    <th><?php echo label_html(PL_NUMBER, 'PL_NUMBER'); ?></th>
                    <th><?php echo label_html(CREATED, 'CREATED'); ?></th>
                    <th><?php echo label_html(EFFECTIVE_DATE, 'EFFECTIVE_DATE'); ?></th>
                </tr>
            </thead>
            <tbody class="show_search_data">
                <?php $i = 1;
                foreach ($sql as $key => $value) { ?>
                    <tr>
                        <td>
                            <input class="select_one" type="checkbox" name="" value="">&nbsp;&nbsp;
                            <?php echo $i++;?> 
                        </td>
                        <td>
                            <a href="<?php echo base_url() . 'price_list/price_list_details/' . $value['price_list_id']; ?>"><?php echo $value['price_list_code']; ?></a>
                        </td>
                        <td><?php echo date("Y-m-d",  strtotime($value['created'])); ?></td>
                        <td><?php echo $value['effective_date']; ?></td>
                    </tr>    
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<script>
    $('#select_all').click(function(event) {
  if(this.checked) {
      // Iterate each checkbox
      $(':checkbox').each(function() {
          this.checked = true;
      });
  }
  else {
    $(':checkbox').each(function() {
          this.checked = false;
      });
  }
});



$(document).ready(function(){
    $('#approved_list').DataTable();
});

</script>