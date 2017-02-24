<div style="text-align: right; margin-bottom: 5px;">
    <button title="Show/Hide Search Panel" type="button" class="btn btn-default panel-controller"><i class="fa fa-search"></i> Search</button>
</div>
<div class="panel panel-default " style="display: none;" id="search_by">
    <div class="panel-heading "><?php echo label_html(SEARCH_BY, 'SEARCH_BY'); ?></div>
    <div class="panel-body">
        <?php
            echo custom_search_panel('purchase/current_purchase_search',array("po_number","status","purchase_type"));
        ?>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">Stock Receive</div>
    <div class="panel-body show_search_data">
        <table class="table table-striped table-bordered table-hover dataTable no-footer" id="chalan_list">
            <thead>
                <tr>
                    <th><?php echo label_html(SL, 'SL'); ?></th>
                    <th>Chalan Code</th>
                    <th>Delevery From</th> 
                    <th>Delevery Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($chalan_list as $key => $value) { ?>
                    <tr>
                        <td>
                            <?php echo $i;
                                $i++; 
                            ?> 
                        </td>
                        <td><?php echo $value->chalan_code; ?></td>
                        <td><?php echo $value->dfrom; ?></td>
                        <td><?php echo $value->delivery_date ?></td>
                        <td>
                            <a href="<?php echo base_url().'chalan/chalan_details/'.$value->chalan_id; ?>">
                                <input  type="button" id="details_view" class="btn btn-danger" value="Details">
                            </a>
                        </td>                     
                    </tr>    
                <?php } ?>
            </tbody>
        </table>
    </div> <!--Panel body close -->
</div> <!--Panel div close -->

<script>
$('.panel-controller').click(function(e){
$('#search_by').slideToggle();
});
$(document).ready(function(){
    $('#purchase_list').DataTable();
});


 $(document).ready(function() {
        $('#chalan_list').DataTable();
    });

</script>