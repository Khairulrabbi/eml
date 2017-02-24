<div class="panel panel-default " id="search_by">
    <div class="panel-heading "><?php echo label_html(SEARCH_BY, 'SEARCH_BY'); ?></div>
    <div class="panel-body">
        <form class="form-horizontal" id="search_option" action="" method="post">
            <div class="search_option_html">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="col-lg-3 control-label">Date Range</label>
                        <div class="col-lg-9">
                            <input type="text" name="TransactionDate" value="" class="form-control user-error date_range" aria-invalid="true">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="col-lg-3 control-label">Account Head</label>
                        <div class="col-lg-9">
                            <?php echo ap_drop_down(34,NULL,array("selected_value"=>"")); ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row "></div>
            <div style="padding-right: 15px;">
                <input <?= bpa('save_purchase_order')?'':'disabled="disabled"'; ?> type="button" id="search_account_statement"class="btn btn-danger pull-right" value="Search">
            </div>
        </form>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">Account Statement</div>
    <div class="panel-body show_search_data">
        <?php //$this->load->view("purchase/current_purchase_view_ajax_list",$table_data); ?>      
    </div> <!--Panel body close -->
</div> <!--Panel div close -->

<script>
//$('.panel-controller').click(function(e){
//    $('#search_by').slideToggle();
//});

//$(document).ready(function(){
//    $('#purchase_list').DataTable();
//});
$(document).on("click",'#search_account_statement', function () {
    $.ajax({
        url: '<?php echo base_url(); ?>accounts_reports/get_account_statement',
        type: 'POST',
        data: $('#search_option').serialize(),
        success: function (data) {   
            $('.show_search_data').html(data);
        }
    });
});
$(document).on("change",'select[name="acc_head_id"]', function () {
    var acc_head_id = $(this).val();    
    $.ajax({
        url: '<?php echo base_url(); ?>accounts_reports/get_taging_by_acc_head',
        type: 'POST',
        data: {acc_head_id:acc_head_id},
        success: function (data) {   
            $('.remobable').remove();
            $('.search_option_html').append(data);
            $('select').select2();
        }
    });
});

$(document).ready(function () {
    $(".date_range").daterangepicker({
        "locale":{
            format:"YYYY/MM/DD"
        },
        "autoApply": true,
        "showDropdowns": true,
        "alwaysShowCalendars": true
    });
});
</script>