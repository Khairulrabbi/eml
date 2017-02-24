<div style="text-align: right; margin-bottom: 5px;">
    <button title="Show/Hide Search Panel" type="button" class="btn btn-default panel-controller"><i class="fa fa-search"></i> Search</button>
</div>
<div class="panel panel-default " style="display: none;" id="search_by">
    <div class="panel-heading ">
        <?php echo label_html(SEARCH_BY, 'SEARCH_BY'); ?>
    </div>
    <div class="panel-body">
        <?php
        echo custom_search_panel('purchase/current_purchase_search', array("po_number", "status", "purchase_type"), array('2', '3', '5', '6'));
        ?>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"  style="overflow: hidden;">
        <?php echo $title; ?>
        <span class="pull-right">
            <a href="<?php echo base_url() . 'price_list/add_new_price_list/' . $type1; ?>" class="btn btn-danger">Add New</a>

        </span>
    </div>
    <input type="hidden" name="list_type" class="list_type" value="<?php echo $type1; ?>">

    <div class="panel-body show_search_data1">
        <div class="text-center order_block"></div>
        <table class="table table-striped table-bordered table-hover dataTable no-footer" id="purchase_list">
            <thead>
                <tr>
                    <th><?php echo label_html(SL, 'SL'); ?></th>
                    <th><?php echo "price List Name"; ?></th>
                    <th><?php echo "Price List Code"; ?></th> 
                    <th><?php echo "Budget Year"; ?></th>
                    <th><?php echo "Effective Date"; ?></th>
                    <th><?php echo "Created Date"; ?></th>
                    <th><?php echo "Created By"; ?></th>
                    <th><?php echo "Pirice List Status"; ?></th>
                    <th><?php echo "Status"; ?></th>
                    <!--<th><?php //echo label_html(ACTION, 'ACTION'); ?></th>-->
                </tr>
            </thead>
            <tbody class="show_search_data">
                <?php $i = 1;
                foreach ($table_data as $key => $value) {
                    ?>
                    <tr>
                        <td><?php echo $i++; ?> </td>
                        <td><?php echo $value['price_list_name'] ?></td>
                        <td>
                            <a href="<?php echo base_url() . 'price_list/price_list_details/' . $value['price_list_id']; ?>"><?php echo $value['price_list_code'] ?></a>
                        </td>
                        <td><?php echo $value['budget_year'] ?></td>
                        <td><?php echo $value['effective_date'] ?></td>
                        <td><?php echo $value['created'] ?></td>
                        <td><?php echo $value['username'] ?></td>
                        <td><?php echo $value['status_name'] ?></td>
                        <td style="cursor:pointer">
                            <span class="check_active_inactive" status="<?php echo $value['status']; ?>" price_list_id="<?php echo $value['price_list_id']; ?>"><?php echo $value['status'] ?></span>
                        </td>
<!--                        <td>
                            <a href="<?php //echo base_url() . 'price_list/add_new_price_list/' . $type1 . '/' . $value['price_list_id']; ?>"><i class="glyphicon glyphicon-pencil btn edit"></i></a>
                        </td>-->
                    </tr>    
<?php } ?>
            </tbody>
        </table>




    </div> <!--Panel body close -->
</div> <!--Panel div close -->

<script>

    $(document).on("click", '.check_active_inactive', function(e) {
        e.preventDefault();
        var t = $(this);
        var status = $(this).attr('status');
        var type = $('.list_type').val();
        var price_list_id = $(this).attr('price_list_id');
                if (confirm('Are you sure you want to change status?')) {
                   $.ajax({
                       url: '<?php echo base_url(); ?>price_list/change_status',
                       type: 'POST',
                       data: {status:status, price_list_id:price_list_id, type:type},
                       success: function(data) {
                           var cdata = data.replace(/(\r\n|\n|\r)/gm,"");
                           if((cdata == "Active") || (cdata == "Inactive"))
                           {
                                t.text(cdata);
                                t.attr('status', cdata);
                           }
                           else
                           {
                               alert(cdata);
                           }
                       }
                   });
               }
    });




    $('.panel-controller').click(function(e) {
        $('#search_by').slideToggle();
    });
    $(document).ready(function() {
        $('#purchase_list').DataTable();
    });

</script>