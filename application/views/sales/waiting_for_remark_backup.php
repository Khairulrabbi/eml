<?php
    echo get_grid_list(
            array(
                'title'=>'Waiting for remark',
                'search_panel'=>FALSE,
                'search_action'=>'',
                'custom_search_column'=>4, 
                'custom_search_panel'=>array(),
                'tboday'=>TRUE,
                'columns'=>$columns,
                'sql'=>$sql,
                'action'=>$action
            )
        );
?>