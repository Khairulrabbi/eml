        
        
        <div style="text-align: right; margin-bottom: 5px;">
            <button title="Show/Hide Search Panel" type="button" class="btn btn-default panel-controller"><i class="fa fa-search"></i> Search</button>
        </div>


        <div class="panel panel-default search_panel" style="display: none;">
            <div class="panel-heading">Search By</div>
            <div class="panel-body">
                    
                    <form class="form-inline">
                        <div class="form-group">
                          <label for="email">Date Range</label>
                          <input type="date" class="form-control" id="date">
                        </div>
                        <div class="form-group">
                          <label for="pwd">To:</label>
                          <input type="date" class="form-control" id="date2">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                
            </div>
	</div>



	<div class="panel panel-default">
            <div class="panel-heading"><?php echo label_html(RECEIVE_GOODS, 'RECEIVE_GOODS'); ?></div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover dataTable no-footer" id="purchase_list">
                    <thead>
                        <tr>
                            <th><?php echo label_html(PRODUCT, 'PRODUCT'); ?></th>
                            <th><?php echo label_html(PO_NUMBER, 'PO_NUMBER'); ?></th>
                            <th><?php echo label_html(VENDOR, 'VENDOR'); ?></th>
                            <th><?php echo label_html(WAREHOUSE, 'WAREHOUSE'); ?></th> 
                            <th><?php echo label_html(RECEIVE_DATE, 'RECEIVE_DATE'); ?></th>
                            <th><?php echo label_html(QTY, 'QTY'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;foreach ($sql as $data){
                        ?>
                          <tr>
                            <td><?php echo $data['product_name']?></td>
                            <td><?php echo $data['order_number']; ?></td>
                            <td><?php echo $data['vendor_name']; ?></td>
                            <td><?php echo $data['warehouse_name']; ?></td>
                            <td><?php echo $data['good_recieve_date']; ?></td>
                            <td><?php echo $data['quantity']; ?></td>
                          </tr>    
                        <?php }?>
                    </tbody>
                </table>
            </div> <!--Panel body close -->
	</div> <!--Panel div close -->


<script>
    $('.panel-controller').click(function(e){
        $('.search_panel').slideToggle();
    });
    $(document).ready(function() {
        $('#purchase_list').DataTable( {
            dom: 'Bfrtip',
            "paging": false,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    } );
    $(document).ready(function() {
        $('input[name="daterange"]').daterangepicker();
      });
</script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
<!--<script src="//code.jquery.com/jquery-1.12.3.js"></script>-->
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<style>
    button.dt-button, div.dt-button, a.dt-button {
        border: 1px solid #f00;
    }
    table.dataTable thead th, table.dataTable thead td {
        border-bottom: 1px solid #f00;
    }
</style>