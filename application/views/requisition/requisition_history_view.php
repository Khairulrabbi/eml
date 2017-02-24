<div class="panel-body">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5 class="panel-title"><?php echo label_html(SEARCH_BY, 'SEARCH_BY'); ?></h5>
            </div>
            <div class="panel-body">
                <?php
                   echo custom_search_panel('requisition/requisition_history_search',array("requisition_code","status","warehouse_list"),array('2','3','5','6'));
                ?>
            </div>
        </div>
	<div class="panel panel-default">
            <div class="panel-heading">
                <h5 class="panel-title"><?php echo label_html(REQUISITION_HISTORY, 'REQUISITION_HISTORY'); ?></h5>
            </div>
            <div class="panel-body show_search_data">
               <?php $this->load->view("requisition/requisition_history_ajax_view",$table_data); ?>      
            </div> <!--Panel body close -->
	</div> <!--Panel div close -->
</div>
