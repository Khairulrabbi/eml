<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel-body">
            
            <ul id="sortable" class="ui-sortable list-unstyled" data-url="<?php echo base_url().'master/reorder_element' ?>">
                <?php
                //print_r($item_array);
                foreach($item_array AS $element_list){
                    echo '<div id="'.$element_list['field_name'].'" class="alert alert-info padded" role="alert">'.$element_list['label_name'].'</div>';
                }
                ?>
            </ul>
            <a  class="btn btn-primary" href="<?php echo base_url().'master/show_master/'.$view_name.'?m_id='.$menu_id; ?>">Back to View</a>
            <span class="hidden" id="view_name"><?php echo $view_name ?></span>
            <div id="test" class="hidden alert alert-success">Update Successful</div>
            <!-- /.table-responsive -->
        </div>
    </div>
</div>
<script>
    $("#sortable").sortable({
            stop: function(e, ui) {
                var controller_url = $('#sortable').data('url');
                var table_name = $('#view_name').text();
                var p =($.map($(this).find('div'), function(el) {
                    return table_name + '=' + $(el).attr('id') + '=' + $(el).index();
                }));
                $.ajax({
                    url: controller_url,
                    type: "POST",
                    data: {order:p},
                    // complete: function(){},
                    success: function(){
                         $("#test").removeClass('hidden');
                    }
                    });
            }
    });
    $("#sortable").disableSelection();
</script>