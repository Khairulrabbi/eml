<div style="text-align: right; margin-bottom: 5px;">
    <button 
        type="button" 
        class="btn btn-primary panel-controller" 
        id="<?php echo (($grid_list_info->search_panel_position == "Top")?"top_search":"left_search"); ?>">
            <i class="fa fa-search"></i> Advanced Search
    </button>    
</div>

<?php
    $column = '';
    if($grid_list_info->search_panel_position == "Left")
    {
        $column = 12;
    }
    else if($grid_list_info->search_panel_position == "Top")
    {
        $column = 4;
    }
?>

<?php echo (($grid_list_info->search_panel_position == "Left")?"<div id='sidebar-wrapper'>":""); ?>
    <div class="panel panel-default " id="search_by" <?php echo (($grid_list_info->search_panel_position == "Top")?"style='display:none'":""); ?>>        
        <div class="panel-heading "><?php echo label_html(SEARCH_BY, 'SEARCH_BY'); ?></div>        
        <div class="panel-body">            
            <form id="grid_list_frm" action="" method="post">
                <input type="hidden" name="theads" value="<?php echo $grid_list_info->theads; ?>">
                <input type="hidden" name="data_query" value="<?php echo $grid_list_info->data_query; ?>">
                <div class="col-lg-12 appendSearchPanel">
                    <?php
                        $data['search_options'] = $search_options;
                        $data['column'] = $column;
                        $this->load->view("grid/grid_view_search_options",$data);
                    ?>
                    
                </div>
                <div class="col-lg-12 text-right" style="margin-right: 10px;">
                    <input class="btn btn-primary moresearchfieldpanel" type="button" value="More Search Option">
                    <ul class='moresearchfield'>
                        <?php
                            foreach ($search_options_hide as $sh=>$sh_v)
                            {
                                echo "<li panel_details_id='".$sh_v->panel_details_id."' search_panel_id='".$grid_list_info->panel_id."' column='".$column."' id='' input_name='".$sh_v->field_name."' function_name='' title_id='' title_name='".$sh_v->item_title."'>".$sh_v->item_title."</li>";
                            }
                        ?>
                    </ul>
                    <input class="btn btn-primary search_submit" type="button" value="Search">
                </div>
            </form>
        </div>
    </div>
<?php echo (($grid_list_info->search_panel_position == "Left")?"</div>":""); ?>
