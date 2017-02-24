<?php     
    foreach($search_options as $k=>$kv)
    {
        switch ($kv->field_type_id) 
        {
            case 1:
                echo get_text_field(array("column"=>$column,"title_name"=>$kv->item_title,"fild_name"=>$kv->field_name,"placeholder"=>$kv->placholder));
                break;
            case 6:
                echo get_drop_down_list(array("column"=>$column,"drop_down_id"=>$kv->dd_id,"title_name"=>$kv->item_title));
                break;
            case 8:
                echo get_date_time_field(array("column"=>$column,"title_name"=>$kv->item_title,"field_name"=>$kv->field_name,"placeholder"=>$kv->placholder,"min_date"=>"12/01/2016","max_date"=>"01/14/2017","single_date_picker"=>"true"));
                break;
            case 10:
                echo get_date_time_field(array("column"=>$column,"title_name"=>$kv->item_title,"field_name"=>$kv->field_name,"placeholder"=>$kv->placholder,"min_date"=>"12/01/2016","max_date"=>"01/14/2017","single_date_picker"=>"false"));
                break;
            case 11:
                echo get_time_field(array("column"=>$column,"title_name"=>$kv->item_title,"field_name"=>$kv->field_name,"placeholder"=>$kv->placholder,"min_time"=>"08:00:00","max_time"=>"20:00:00"));
                break;
        }
    }
?>