        
        
        <div style="text-align: right; margin-bottom: 5px;">
            <button title="Show/Hide Search Panel" type="button" class="btn btn-default panel-controller"><i class="fa fa-search"></i> Search</button>
        </div>


        <div class="panel panel-default search_panel" style="display: none;">
            <div class="panel-heading">Search By</div>
            <div class="panel-body">
                    
                    <form class="form-inline">
                        <div class="form-group">
                          <label for="email">Category</label>
                          <?php echo category_list(@$order_info->customer_id, array('class' => 'customer_id', 'required' => 'required')); ?>
                        </div>
                        <div class="form-group">
                          <label for="pwd">Sub Category</label>
                          <?php echo sub_category_list(@$order_info->customer_id, array('class' => 'customer_id', 'required' => 'required')); ?>
                        </div>
                        <div class="form-group">
                          <label for="pwd">Product</label>
                          <?php echo product_list(@$order_info->customer_id, array('class' => 'customer_id', 'required' => 'required')); ?>
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                
            </div>
	</div>



	<div class="panel panel-default">
            <div class="panel-heading"><?php echo label_html(RE_ORDER_MANAGER, 'RE_ORDER_MANAGER'); ?></div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover dataTable no-footer" id="purchase_list">
                    <thead>
                        <tr>
                            <th><?php echo label_html(SL, 'SL'); ?></th>
                            <th><?php echo label_html(PRODUCT, 'PRODUCT'); ?></th>
                            <th><?php echo label_html(CATEGORY, 'CATEGORY'); ?></th>
                            <th><?php echo label_html(AVAILABLE_QTY, 'AVAILABLE_QTY'); ?></th>
                            <th><?php echo label_html(REORDER_LEVEL, 'REORDER_LEVEL'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $alertreorder = '';
                            $i=1;
                            foreach ($sql as $data){
                            if($data['total'] <= $data['reorder_qty'])
                            {
                                $alertreorder = '#FCD613';
                            }
                        ?>
                        <tr style="background:<?php echo $alertreorder; ?>">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $data['product_name']; ?></td>
                            <td><?php echo $data['product_category_name']; ?></td>
                            <td><?php echo $data['total']; ?></td>
                            <td>
                                <input product_id="<?php echo $data['product_id']; ?>" class="reordermanager" type="text" value="<?php echo $data['reorder_qty']; ?>">
                            </td>
                          </tr>    
                        <?php 
                        $i++;
                        
                        $alertreorder = '';
                            }?>
                    </tbody>
                </table>
            </div> <!--Panel body close -->
	</div> <!--Panel div close -->


<script>
    $('.reordermanager').keyup(function(){
        var product_id = $(this).attr('product_id');
        var reorderquantity = $(this).val();
        $.ajax({
            url: '<?php echo base_url(); ?>reports/update_re_order_manager',
            type: 'POST',
            data: {product_id:product_id,reorderquantity:reorderquantity},
            success: function (data) {
//                if(data == true)
//                {
//                   window.location.reload();
//                }
            }
        });
    });
    
    
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