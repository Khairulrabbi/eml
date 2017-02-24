<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends Custom_Controller {
        public $all_child_array;
    
        function __construct() {
        parent::__construct();
        $this->load->helper('url','form');
        $this->load->model('master_model','','TRUE');
        $this->load->library('session');
    }
    
    function index() {
        //Get the post value(selected table name) from form
        if($this->is_post()){
            $data['selected_title'] = $this->input->post('master_entry_title', TRUE);
            $data['selected_table'] = $this->master_model->get_original_table_name($data['selected_title']);
            
            $data['record'] = $this->master_model->get_table($data['selected_table']);
            //print_r($data);
            $master_entry_table_name = $data['selected_table'];
            $record_previous = $this->master_model->get_previous_table($master_entry_table_name, $data['selected_title']);
            $check_data = array();
            $extra_data = array();
            $extra_table = array();
            if(!empty($record_previous)){
                foreach ($record_previous as $r_p){
                        $check_data[$r_p['field_name']] = $r_p;

                }
                $get_data = $this->master_model->get_extra_relation_with_table($data['selected_table'],$data['selected_title']);
                //print_r($get_data);
                $counter = 0;
                foreach ($get_data as $value){
                    $counter++;
                    $extra_data[] = array(0=>'<tr>
                                <td><input type="checkbox" name="count_hidden[]" value="'.$counter.'" class="count_hidden" checked /></td>
                                <td>
                                    ',1=>$value['join_with'],2=>'</td>
                                <td id="table_field_'.$counter.'">',3=>'</td>
                                <td>',4=>$value['field_name'],
                        //table_field($data['selected_table'],"relational_field[$counter]").
                        5=>'</td>
                                <td><textarea class="form-control" name="sql_extra['.$counter.']" placeholder="SQL query">'.$value['sql'].'</textarea></td>
                                <td><input type="text" class="form-control" name="label_name_extra['.$counter.']" placeholder="Label Text" value="'.$value['label_name'].'" /></td>
                            </tr>',6=>$value['join_with_fk_name']);
                }
            }
            $data['extra_data'] = $extra_data;
            $data['check_data'] = $check_data;

            // Get the list of master entry table name
            $data['master_table'] = $this->master_model->get_master_table();
            $search = $this->db->query("SELECT include_search_panel FROM master_entry_table WHERE master_entry_title='".$data['selected_title']."'")->row();
            if($search->include_search_panel == 1){
                $data['search'] = 'search';
            }
        }
        // Get duplicate master entry title
        $data['mask_table_name'] = $this->master_model->get_mask_table();
        
        $this->render_page('master/master_table', $data );
    }
    
    function create_master(){
        $fields = $this->input->post('fields');
        $lab = $this->input->post('label');
        $place = $this->input->post('placeholder');
        $master_entry_table_name = $this->input->post('module');
        $master_entry_title = $this->input->post('master_entry_title');
        $sql = $this->input->post('sql');
        $hide_from_grid = $this->input->post('hide_from_grid');
        $self_filtering = $this->input->post('self_filtering');
        $hide_from_input = $this->input->post('hide_from_input');
        $comma_separated_value = $this->input->post('comma_separated_value');
        $input_type = $this->input->post('input_type');
        $required_type = $this->input->post('required');
        $search = $this->input->post('search');
        $request_for = $this->input->post('show')?'show':'create';

        /*
         * table_content() function perform the insertion the details of requested table for creating master entry
         * And return all value into array from master_entry taable to create view of the requested table
         */
        
        $data_master_form = $this->master_model->table_content($fields,$lab,$place,$sql,$hide_from_grid,$self_filtering,$hide_from_input,$comma_separated_value,$input_type,$required_type,$master_entry_table_name,$request_for,$master_entry_title,$search);
        
        //Get the data for additional table to join
        if(!null==($this->input->post('count_hidden'))){
        $join_count = $this->input->post('count_hidden');
        $join_table_name = $this->input->post('master_entry_table_name');
        $join_field_name = $this->input->post('master_entry_table_field_name');
        $join_relation_field_name = $this->input->post('relational_field');
        $join_sql = $this->input->post('sql_extra');
        $join_label = $this->input->post('label_name_extra');
        
        // Perform insertion to master_entry
        $this->master_model->join_insertion($join_count,$join_table_name,$join_field_name,$join_relation_field_name,$join_sql,$join_label,$master_entry_table_name,$master_entry_title);
        }
        
        $this->get_html($data_master_form, $master_entry_title);
    }
    
    function show_master($mask_name=NULL, $msg = NULL){
        /*
         * This section is added by Md Riad Hossain at 02/05/2016
         * This section is the action point of search panel
         * This part is actually build a sql conditional part
         * We also need to send the post inorder to keep the selected value in the search form
         */
        $p = $this->input->post();
        $builder = '';
        if(isset($p) && !empty($p)){
            foreach ($p as $key => $value) {
                if($value!='')$builder .=" AND ".$key."= '".$value."'";
            }
        }
        /* End of the newly added part */
        
        // If requested for any table that is not exist in the database server.
        if(!$mask_name){
            show_404 ();
        }else{
            $query = $this->db->query("SELECT * FROM master_entry WHERE master_entry_title = '$mask_name' ORDER BY sorting");
            $data_master_form = $query->result_array();
            //echo '<pre>';
            //print_r($data_master_form);
            //exit;
            //echo '</pre>';
            $menu_id = $this->input->get('m_id');
            $this->get_html($data_master_form, $mask_name, NULL,$menu_id, $msg, $builder,$p);
        }
    }
    
    //Function to update the master entry
    function update_content($view_name,$id){
        $data_master_form = $this->master_model->get_array_result("SELECT * FROM master_entry WHERE master_entry_title = '$view_name' ORDER BY sorting");
        $this->get_html($data_master_form, $view_name, $id, $this->input->get('m_id'));
    }
    
    function delete_content($view_name,$id){
        // Check privilege for update master table content (Not applicable for Admin user_id=1)
       $table_name = $this->db->query("SELECT master_entry_table_name FROM master_entry_table WHERE master_entry_title = '$view_name'")->row()->master_entry_table_name;
       $msg = '';
       $get_menu_id = $this->db->query("SELECT menu_id FROM menu WHERE menu_url='master/show_master/".$view_name."'")->row()->menu_id;
        if( $this->user_id != 1 ){
            $this->db->select('GROUP_CONCAT(privilege_delete) AS level');
            $this->db->where_in('user_level_id',  $this->session->userdata('LEVEL_ID'));
            $get_permission = $this->db->get('user_level')->row()->level;
            $permission_array = explode(',', $get_permission);
            // If found any edit permission among all of his level
            if(!in_array('1', $permission_array)){
                $msg = $this->permission_deny;
                $this->show_master($view_name, $msg);
            }
            else{
                $id_field = $table_name.'_id';
                $this->db->delete($table_name, array($id_field => $id));
                //$this->show_master($view_name);
                redirect(base_url().'master/show_master/'.$view_name.'?m_id='.$get_menu_id);
            }
        }else{
            $id_field = $table_name.'_id';
            $ret = $this->db->delete($table_name, array($id_field => $id));

            //$this->show_master($view_name);
            redirect(base_url().'master/show_master/'.$view_name.'?m_id='.$get_menu_id);
        }  
    }
    
    function get_html($data_master_form, $master_entry_table_title, $id = NULL,$menu_id=null, $msg = NULL, $builder = NULL, $post_value = NULL){
        //print_r($data_master_form);
        // Now get the original table name
        $master_entry_table_name = $this->master_model->get_original_table_name($master_entry_table_title);
        $hdn_arr = array();
        $unique_exception = '';
        if($id != NULL){
            $id_field = $master_entry_table_name.'_id';
            $get_data_from_table = $this->master_model->get_array_result("SELECT * FROM $master_entry_table_name WHERE $id_field='$id'");
            $data_to_pass['update_command'] = $id;
            $unique_exception = ' entry_id="'.$id.'" ';
            //print_r($get_data_from_table);
        }
        // Now read the query and where filter for requested table inorder to generate grid data
        $get_sql_and_where_filter = $this->db->query("SELECT table_sql,where_clause_filter,export_pdf,export_excel,export_csv,enable_printing,import_excel,disable_grid_view,disable_form_view,form_column,disable_action,disable_edit_icon,disable_delete_icon FROM master_entry_table WHERE master_entry_title='$master_entry_table_title'")->row();
        $form = array();
        $table_field = array();
        $label_list = array();
        $search_param = array();
        $search_html = '';
        foreach ($data_master_form as $rec2){
            //echo '<pre>';
            //print_r($rec2);
            //echo '</pre>';
            //echo $rec2['search'];
            /* Now check for search panel */
            
            if($get_sql_and_where_filter->disable_grid_view != 1 && $rec2['search'] == 1){
                //$search_param[$rec2['field_name']][] = $rec2['search'];
                //$search_html .= $rec2['field_name'].'<input type="" />';
            }
            
            if($rec2['hide_from_input'] !=1 ){
                $input='';
                $filter_class = $rec2['self_filtering'] == 1 ? ' class="search"':'';
                $field_name = $rec2['field_name'];
                $field_key = $rec2['field_key'];
                // When field is unique then add some validation content
                $unique = $field_key == 'UNI'?' field_type="unique" data-table_name="'.$master_entry_table_name.'"':'';
                $draw_message = $field_key == 'UNI'?'<div class="draw_msg"></div>':'';
                $label = $rec2['label_name'];       
                $type = $rec2['input_type'];
                $sql_str = $rec2['sql'];
                $comma_separated_val = $rec2['comma_separated_value'];
                $placeholder = $rec2['placeholder'];
                $validation = $rec2['required_field'];
                //$selected_value = '';
                $required_str = ($validation == 'required')?'<span style="color:#f00">*</span>':'';
                $label_name = "<div class='form-group'><label>$label</label> $required_str";
                $slabel_name = "<div class='form-group'><label>$label</label>";
                $is_join = $rec2['join_with'];
                // Here it will check the join field and submitted id to retrive value from related joined table
                //echo $type.' -- ';
                if( $is_join != NULL && $id !=NULL ){
                    $selected_value = array();
                    $sql = "SELECT $field_name FROM $is_join WHERE ".$rec2['join_with_fk_name']."=$id";
                    $query = $this->db->query($sql);
                    $data = $query->result_array();
                    foreach ($data as $value) {
                        $selected_value[] = $value[$field_name];
                    }
                    //print_r($data);
                }else{
                     $selected_value = isset($get_data_from_table)?$get_data_from_table[0][$field_name]:'';
                     $selected_value_search = ($post_value != NULL && isset($post_value[$field_name]))?$post_value[$field_name]:'';
                }
                //echo $field_name.'-'.$value.'<br>';
                switch ($type){
                    case 'select':
                        $options = $is_join==NULL?array(''=>'Select'):array();
                        $input = $label_name;
                        if($sql_str!=''){
                            $res = $this->master_model->array_result($sql_str);
                            foreach ($res[1] as $value) {
                                $options[$value[$res[0][0]]] = $value[$res[0][1]];
                            }
                        }else{
                            $opt = explode(',', $comma_separated_val);
                            foreach ($opt as $value) {
                                $options[$value] = $value;
                            }
                        }
                        $input .= form_dropdown($field_name.($is_join==NULL?"":"[]"), $options,$selected_value,'class="form-control"'.$validation.($is_join==NULL?"":" multiple")).'</div>';
                        $search_html .= ($rec2['search'] == 1?$slabel_name.form_dropdown($field_name.($is_join==NULL?"":"[]"), $options,$selected_value_search,'class="form-control"'.($is_join==NULL?"":" multiple")).'</div>':'');
                        break;
                    case 'var':
                        $input = "$label_name<input $validation $unique $unique_exception type='text' name='$field_name' placeholder='$placeholder' value='$selected_value' class='form-control'/>$draw_message</div>";
                        $search_html .= ($rec2['search'] == 1?"$slabel_name<input type='text' name='$field_name' placeholder='$placeholder' value='$selected_value_search' class='form-control'/></div>":'');
                        break;
                    case 'int':
                        if($field_key == 'MUL'){
                            $foreign_table = substr($rec2['field_name'], 0, -3);
                            $foreign_id = $foreign_table.'_id';
                            $foreign_name = $foreign_table.'_name';
                            $foreing_info = $this->master_model->combo_table($foreign_table); //model call
                            $input .= "$label_name<select class='form-control' name='$field_name'>";
                            $input .= "<option value=''>Select</option>";
                            foreach ($foreing_info as $foreing_info1){
                                $input .= "<option value='$foreing_info1[$foreign_id]'>$foreing_info1[$foreign_name]</option>";
                            }
                            $input .= "</select></div>";
                            if($rec2['search'] == 1){
                                $search_html .= "$slabel_name<select class='form-control' name='$field_name'>";
                                $search_html .= "<option value=''>Select</option>";
                                foreach ($foreing_info as $foreing_info1){
                                    $search_html .= "<option value='$foreing_info1[$foreign_id]'>$foreing_info1[$foreign_name]</option>";
                                }
                                $search_html .= "</select></div>";
                            }
                        }
                        break;
                    case 'dat':
                        $input = "$label_name<input $validation type='date' name='$field_name' placeholder='$placeholder' value='$selected_value' class='form-control'/></div>";
                        break;
                    case 'tex':        
                        $input = "$label_name<textarea $validation name='$field_name' class='form-control'>$selected_value</textarea></div>";
                        $search_html .= ($rec2['search'] == 1?"$slabel_name<input type='text' name='$field_name' placeholder='$placeholder' value='$selected_value_search' class='form-control'/></div>":'');
                        break;
                    case 'hidden':        
                        $input = "<div class='form-group'><input type='$type' name='$field_name' placeholder='$placeholder' value='".$this->session->userdata($field_name)."' class='form-control'/></div>";
                        break;
                    case 'textarea':        
                        $input = "$label_name<textarea $validation name='$field_name' class='form-control'>$selected_value</textarea></div>";
                        $search_html .= ($rec2['search'] == 1?"$slabel_name<textarea $validation name='$field_name' class='form-control'>$selected_value_search</textarea></div>":'');
                        break;
                    case 'checkbox':
                        $input = " $label_name <input $validation type='hidden' name='$field_name' placeholder='$placeholder' value='0' />"
                                            . "<input $validation type='$type' name='$field_name' placeholder='$placeholder' value='1' ".($selected_value == 1?'checked':'')."/></div>";
                        break;
                    default :
                        $input = "$label_name<input step='any' $unique $unique_exception  $validation type='$type' name='$field_name' placeholder='$placeholder' value='$selected_value' class='form-control'/>$draw_message</div>";
                        $search_html .= ($rec2['search'] == 1?"$slabel_name<input type='text' name='$field_name' placeholder='$placeholder' value='$selected_value_search' class='form-control'/>":'');
                        break;
                }

                if( $is_join != NULL){
                    $hdn_arr[$is_join] = $field_name;
                }
                // When form view is not disable need to draw the form otherwise not
                if($get_sql_and_where_filter->disable_form_view == 1) $input = '';
                else $form[] = $input;
            }
            //When hide_from_grid is true then add lebel and field into array for generating view of master entry 
            //Otherwise the field will not show in the table view of master entry
            if($rec2['hide_from_grid'] != 1){
                if($get_sql_and_where_filter->disable_grid_view != 1){
                    $label_list[] = "<th $filter_class>".$rec2['label_name']."</th>";
                    $table_field[] = $rec2['field_name'];
                }
            }   
        }
        
        //echo $search_html;
        //exit;
        
        $get_sql = $get_sql_and_where_filter->table_sql;
        $filter = $get_sql_and_where_filter->where_clause_filter;
        $export_pdf = $get_sql_and_where_filter->export_pdf;
        $export_excel = $get_sql_and_where_filter->export_excel;
        $export_csv = $get_sql_and_where_filter->export_csv;
        $enable_printing = $get_sql_and_where_filter->enable_printing;
        $import_excel = $get_sql_and_where_filter->export_excel;
        $form_column = $get_sql_and_where_filter->form_column;
        $action_column = $get_sql_and_where_filter->disable_action;
        $edit_icon = $get_sql_and_where_filter->disable_edit_icon;
        $delete_icon = $get_sql_and_where_filter->disable_delete_icon;
        //$get_sql = str_replace ('WHERE 1', "", $get_sql);
        $full_sql = explode("GROUP BY", $get_sql);
        $get_sql = $full_sql[0];
        $remain_part = @$full_sql[1];
        if (strpos($get_sql,'WHERE') == false) {
            $get_sql .= " WHERE 1 ";
        }
        $view_all_privilege = $this->check_privilege($menu_id,3);
        if(!$view_all_privilege){
            $get_sql = str_replace ('WHERE 1', "WHERE created_by='".$this->user_id."'", $get_sql);
        }
        //$get_sql .= " AND $master_entry_table_name.view_name='$master_entry_table_title'";
        if($filter != '' && $filter != NULL && $this->user_id != 1){
            $arr = explode(',',$filter);
            foreach($arr as $val){
                $val = explode(':', $val);
                $get_sql .= " AND $val[0]='". $this->session->userdata($val[1]) ."'";
            }
        }
        if($builder != NULL)$get_sql = $get_sql.$builder;
        $remain_part = $remain_part == ''?$remain_part:" GROUP BY ".$remain_part;
        $get_sql = $get_sql.$remain_part;
        $table_data = $this->master_model->array_result($get_sql);
        
        //$data_to_pass['post_value'] = $post_value;
        $data_to_pass['hdn_array'] = $hdn_arr;
        $data_to_pass['input_html'] = $form;
        $data_to_pass['table_data'] = $table_data;
        $data_to_pass['label_list'] = $label_list;
        $data_to_pass['field_name'] = $table_field;
        $data_to_pass['table_name'] = $master_entry_table_name;
        $data_to_pass['view_name'] = $master_entry_table_title;
        $data_to_pass['sorting_privilege'] = 0;
        // If admin or user of current module then get the sorting privilege
        if( $this->user_id == 1 || in_array(1, $this->session->userdata('MODULE_ID'))){
            $data_to_pass['sorting_privilege'] = 1;
        }
        if( $msg != NULL){
            $data_to_pass['msg'] = $msg;
        }
        //$menu_id = $menu==NULL?$this->
        // Now get the permission for doing things i.e. Add/Edit/Delete/View All
        $data_to_pass['edit_privilege'] = $this->check_privilege($menu_id,0);
        $data_to_pass['delete_privilege'] = $this->check_privilege($menu_id,1);
        $data_to_pass['add_privilege'] = $this->check_privilege($menu_id,2);
        $data_to_pass['enable_details_view'] = $this->check_enable_view($master_entry_table_name);
        //echo '<pre>';
        //print_r($data_to_pass);
        //exit;
        $data_to_pass['disable_action_column'] = $action_column;
        $data_to_pass['disable_edit_icon'] = $edit_icon;
        $data_to_pass['disable_delete_icon'] = $delete_icon;
        $data_to_pass['form_column'] = $form_column;
        $data_to_pass['search_panel'] = $search_html;
        $data_to_pass['export_pdf'] = $export_pdf;
        $data_to_pass['export_excel'] = $export_excel;
        $data_to_pass['export_csv'] = $export_csv;
        $data_to_pass['import_excel'] = $import_excel;
        $data_to_pass['enable_printing'] = $enable_printing;
        $data_to_pass['menu_id'] = $this->input->get('m_id');
        $this->render_page('master/master_form', $data_to_pass);
    }   
    
    function form_entry(){
        $get_entry = $this->input->post();
        $table_name = $get_entry['table_name'];
        $view_name = $get_entry['view_name'];
        $id_field = $get_entry['table_name'].'_id';
        // Get the selected upload directory
        $directory = $this->master_model->get_upload_directory($view_name);
        
        $config['upload_path'] = $directory;
        $config['allowed_types'] = 'gif|jpg|png|pdf|xlsx|docx';
        foreach ($_FILES as $fieldname => $fileObject){
            if (!empty($fileObject['name'])){
                $this->upload->initialize($config);
                if (!$this->upload->do_upload($fieldname)){
                    $error = array('error' => $this->upload->display_errors());
                    $this->render_page('upload_form', $error);
                    //print_r($error);
                }else{
                     $reruned_data = $this->upload->data();
                     $get_entry[$fieldname] = $directory.$reruned_data['file_name'];
                }
            }
        }
        //Check wheather an ID is submitted for update other consider it as insert command
        $id = isset($get_entry[$get_entry['table_name'].'_id'])?$get_entry[$get_entry['table_name'].'_id']:NULL;
        
        //Remove unnecessary array item from post array
        unset($get_entry[$get_entry['table_name'].'_id']);
        unset($get_entry['table_name']);
        unset($get_entry['command']);
        unset($get_entry['view_name']);
        
        // We take $insert_val as array because we dont know the number table to join
        $insrt_val = array();
        $hdn_array = unserialize($get_entry['hdn_array']);
        // Now unset the hidden aarray from post
        unset($get_entry['hdn_array']);
        
        foreach ($hdn_array as $key => $value) {
            // Here key is the table name and $value is an array which contain post value and field name
            $insrt_val[$key] = array($get_entry[$value],$value);
            // Unset submitted value of join table from post array
            unset($get_entry[$value]);
        }
        //debug($get_entry,1);
        // If no id submit then insert otherwise update
        if($id==NULL){
            $get_entry['created_by'] = $this->user_id;
            $get_entry['created'] = date('Y-m-d H:i:s');
            
            $this->db->insert($table_name, $get_entry);
            
            $id = $this->db->insert_id();
            
        }
        else{
            //$this->db->delete('privilege_level', array('user_id' => $user_id));
            $get_entry['updated_by'] = $this->user_id;
            //print_r($get_entry);
            $this->db->where($id_field, $id);
            $p = $this->db->update($table_name, $get_entry);
        }
        
        // Now fetch the value from the array which contain table name as $key
        foreach ($insrt_val as $key => $value) {
            $tbl_name = $key;
            $field_name = $value[1];
            $post_value = $value[0];
            // Now get the other relational field name form table
            $query = $this->db->query("SELECT * FROM master_entry WHERE master_entry_table_name='$table_name' AND field_name='$field_name' AND master_entry_title='$view_name'");
            $data_array = $query->result_array();
            //print_r($data_array);
            // Now get the field name of the parent table
            $relationa_field_name = $data_array[0]['join_with_fk_name'];
            
            // Now delete old data from joined table if exist
            $this->db->delete($tbl_name, array($relationa_field_name=>$id));
            
            // As we always use multiple dropdown it will always be an array where number of item can be one or more
            $data = array();
            foreach ($post_value as $item) {
                $data[] = array($relationa_field_name=>$id,$field_name=>$item);
            }
            
            //print_r($data);
            $this->db->insert_batch($tbl_name, $data);
        }
        $menu_id = $this->input->get('m_id');
        redirect(base_url().'master/show_master/'.$view_name.'?m_id='.$menu_id,'refresh');
        //$this->show_master($table_name);
    }
    
    function change_order($view_name,$menu_id){
        $this->db->select('label_name,field_name,master_entry_table_name');
        $this->db->where('master_entry_title',$view_name);
        $this->db->order_by('sorting'); 
        $query = $this->db->get('master_entry');
        $data['item_array'] = $query->result_array();
        $data['view_name'] = $view_name;
        $data['menu_id'] = $menu_id;
        $this->render_page('master/master_rearrange_element', $data);
    }
    
    // This function is being called from ajax to change the sorting order of master entry element 
    function reorder_element(){
        $data = $this->input->post('order');
        $this->master_model->reorder_entry_element($data);
    }
    
    //Create table for master entry with standard settings
    function create_master_table(){
        if($this->is_post()){
            $table_name = $this->input->post('table_name');
            $data['msg'] = '<div class="alert alert-success">Table created successfully.</div>';
            $this->master_model->create_master_table($table_name);
            $this->render_page('master/create_master_table',$data);
        }else{            
            $this->render_page('master/create_master_table');
        }
    }
    
    function insert($table_name,$data,$url = NULL){
        $this->db->insert($table_name,$data);
        if($url!=NULL){
            redirect($url);
        }
    }
    function delete($table_name,$id,$url = NULL){
        $this->db->delete($table_name, array($table_name.'_id' => $id)); 
        if($url!=NULL){
            redirect($url);
        }
    }
    function update($table_name,$id,$data,$url = NULL){
        $this->db->where($table_name.'_id', $id);
        $this->db->update($table_name,$data); 
        if($url!=NULL){
            redirect($url);
        }
    }
    function get_details_by_id($table_name,$id){
        $query = $this->db->get_where($table_name, array($table_name.'_id' => $id));
        return $query->result_array();
    }
    function get_value_by_id($table_name,$id,$field_name){
        $this->db->select($field_name);
        $this->db->where($table_name.'_id', $id);
        $this->db->from($table_name);
        $query = $this->db->get();
        return $query->row()->$field_name;
    }


    //____________________________________________________________________________________________________________________________
    //#######################################|   Menu Related Function Start     |################################################
    //
    //
    // Function to insert menu item and set privilege
    function menu_entry(){
        $get_entry = $this->input->post();
        $level_array = isset($get_entry['user_level_id'])?$get_entry['user_level_id']:array();
        $id_array = isset($get_entry['user_id'])?$get_entry['user_id']:array();
        //echo '<pre>';
        //print_r($get_entry);
        //exit;
        // Now unset unnecessary item from post array in-order to produce insert array for menu table 
        unset($get_entry['user_level_id']);
        unset($get_entry['user_type_id']);
        unset($get_entry['user_id']);
        unset($get_entry['command']);
        unset($get_entry['inlineRadioOptions']);
        
        $menu_type = "Sub";
        //When no parent is selected then treat it as a Main menu item 
        if($this->input->post('parent_menu_id')==0){
            $menu_type = "Main";
        }
        $get_entry['menu_type'] = $menu_type;
        if(isset($get_entry['menu_id'])){
            $insert_id = $get_entry['menu_id'];
            unset($get_entry['menu_id']);
            $this->db->where('menu_id', $insert_id);
            $this->db->update('menu', $get_entry); 
            // Now change module for its child menu
            //$menu_id = $this->main_model->get_menu($insert_id);
            $this->all_child_array = array();
            $all_child_menu = $this->get_all_child($insert_id);
            if(!empty($all_child_menu)){
                /*$menu_array = array();
                foreach ($menu_id as $item) {
                    $menu_array[] = $item['menu_id'];
                }*/
                $this->db->where_in('menu_id', $all_child_menu);
                $this->db->update('menu', array('module_id'=>$get_entry['module_id']));
            }
            
            $this->db->delete('privilege_menu', array('menu_id' => $insert_id)); 
        }else{
			$get_entry['created_by'] = $this->session->userdata('USER_ID');
            $get_entry['created'] = date('Y-m-d H:i:s');
            $this->db->insert('menu', $get_entry);
            $insert_id = $this->db->insert_id();
        }
        
        // If request for update then delete old data and insert new
        
        
        // Now insert item to menu privilege table
        if(!empty($level_array)){
            $insert_array = array();
            foreach ($level_array as $value) {
                $insert_array[]=array('menu_id'=>$insert_id,'user_level_id'=>$value);
            }
            $this->db->insert_batch('privilege_menu', $insert_array);
        }
        
        if(!empty($id_array)){
            $insert_array = array();
            foreach ($id_array as $value) {
                $insert_array[]=array('menu_id'=>$insert_id,'user_id'=>$value);
            }
            $this->db->insert_batch('privilege_menu', $insert_array);
        }
        
        $this->menu_assign($insert_id);
    }
    
    /*  Function for creating and assigning menu  */
    
    function menu_assign($menu_insert_id = NULL){
        $module_id = NULL;
        $user_level_id = NULL;
        $user_type_id = NULL;
        $user_id = NULL;
        if($menu_insert_id != NULL){
            if(!$this->input->post()){
                $data['menu_id'] = $menu_insert_id;
                $parent_menu_id = $this->master_model->get_parent($menu_insert_id);
                $get_value = $this->master_model->get_all_menu($menu_insert_id);
                $data['post_val'] = $get_value[0];
                $data['open_edit'] = 1;
                $data['level_array'] = $this->master_model->level_for_menu($menu_insert_id);
                //debug($data['level_array'],1);
                $data['user_array'] = $this->master_model->user_for_menu($menu_insert_id);
                $data['sort_menu_list'] = $this->master_model->get_menu_list($parent_menu_id);
            }else{
                $data['menu_id'] = $menu_insert_id;
                $data['post_val'] = $this->input->post();
                $module_id = $this->input->post('module_id');
                $user_level_id = $this->input->post('user_level_id');
                //$user_type_id = $this->input->post('user_type_id');
                $user_id = $this->input->post('user_id');
                $data['sort_menu_list'] = $this->master_model->get_menu_list($this->input->post('parent_menu_id'));
            }
            
        }
        $data['combo'] = $this->dynamic_combo('module_id','module','module_id','module_name','','form-control',$module_id?$module_id:'',FALSE,$module_id?TRUE:FALSE);
        $data['level_combo'] = $this->dynamic_combo('user_level_id[]','user_level','user_level_id','user_level_name','','form-control multiple',$user_level_id?$user_level_id:'',FALSE,$module_id?TRUE:FALSE,'',TRUE);
        //$data['type_combo'] = $this->dynamic_combo('user_type_id[]','user_type','user_type_id','user_type_name','','form-control multiple',$user_type_id?$user_type_id:'',FALSE,$module_id?TRUE:FALSE,'',TRUE);
        $data['user_combo'] = $this->dynamic_combo('user_id[]','user','user_id','first_name','','form-control multiple',$user_id?$user_id:'',FALSE,$module_id?TRUE:FALSE,'',TRUE);
        $this->render_page('master/master_menu_create',$data);
    }
    
    function menu_list(){
        $data['menu_list'] = $this->master_model->get_all_menu();
        $this->render_page('master/menu_list', $data);
    }
    
    // This function is being called from ajax to change the sorting order of created menu 
    function reorder_menu(){
        $data = $this->input->post('order');
        $this->master_model->reorder_menu_item($data);
    }
    
    //Function to apply level on specific user
    function user_level_assign($user_id=NULL){
        $get_level = $this->master_model->get_permitted_level_list();
        if($user_id != NULL){
            $get_user_data = $this->master_model->get_permitted_level_list($user_id);
            $data['user_details'] = $get_user_data;
            $data['selected_user_id'] = $user_id;
        }
        $data['permitted_level'] = $get_level;
        $this->render_page('master/master_set_level_for_user',$data);
    }
    
    // Function to save applied level for user
    function save_level_access_for_user(){
        $user_id = $this->input->post('user_id');
        $level_array = $this->input->post('user_level_id');
        //At first delete user data if exist in the privilege_level and then insert
        $this->db->delete('privilege_level', array('user_id' => $user_id));
        $data = array();
        foreach ($level_array as $level_id){
            $data[] = array('user_id'=>$user_id,'user_level_id'=>$level_id);
        }
        $this->db->insert_batch('privilege_level', $data);
        
        redirect(base_url().'master/user_level_assign');
    }
            
    function get_menu_for_level(){
        $level_id = $this->input->post('user_level_id');
        $module_id = $this->input->post('module_id');
        //echo 'dfdf'.$level_id.'sdsdsdsdsd';
        $data = array();
        if($level_id != ''){
        $current_permitted_menu = $this->master_model->get_level_menu_list($level_id);
        $get_menu_info = $this->main_model->get_menu_model(NULL,$module_id); // call model for getting menu and sub menu

        $array_str = '<ul>';
        
        foreach ($get_menu_info as $menu_item){
            $array_str .= "<li><span><i class='icon-leaf'></i><input name='menu_id[]' type='checkbox' value='".$menu_item['menu_id']."' ".(in_array($menu_item['menu_id'], $current_permitted_menu)?'checked':'')." />" . $menu_item['menu_name']."</span></li>".$this->create_menu_list_all($menu_item['menu_id'],$current_permitted_menu);
        }
        $array_str .= '</ul>';
        $data['menu_list_array'] = $array_str;
        $data['selected_level'] = $level_id;
        $data['selected_module'] = $module_id;
        }
        $this->render_page('master/set_level_access',$data);
    }
    
    function set_menu_access_for_level(){
        $selected_menu_array = $this->input->post('menu_id');
        $level_id = $this->input->post('level_id');
	$module_id = $this->input->post('module_id');
        $this->db->query("DELETE FROM privilege_menu WHERE user_level_id='$level_id' AND privilege_menu.menu_id IN (SELECT menu.menu_id FROM menu WHERE menu.module_id = $module_id)");
        foreach ($selected_menu_array as $menu_id) {
            $data = array(
                'menu_id' => $menu_id ,
                'user_level_id' => $level_id
             );

             $this->db->insert('privilege_menu', $data); 
        }
        $current_permitted_menu = $this->master_model->get_level_menu_list($level_id);
        $get_menu_info = $this->main_model->get_menu_model(NULL,$module_id); // call model for getting menu and sub menu

        $array_str = '<ul>';
        foreach ($get_menu_info as $menu_item){
            $array_str .= "<li><span><i class='icon-leaf'></i><input name='menu_id[]' type='checkbox' value='".$menu_item['menu_id']."' ".(in_array($menu_item['menu_id'], $current_permitted_menu)?'checked':'')." />" . $menu_item['menu_name']."</span></li>".$this->create_menu_list_all($menu_item['menu_id'],$current_permitted_menu);
        }
        $array_str .= '</ul>';
        $data['menu_list_array'] = $array_str;
        $data['selected_level'] = $level_id;
        $data['selected_module'] = $module_id;
        $this->render_page('master/set_level_access',$data);
    }
    
    function get_table_field($table_name){
        $count = $this->input->post('count');
        table_field($table_name,'master_entry_table_field_name['.$count.']');
    }
    
    function add_tr($count_val){
        $selected_table = $this->input->post('table_name');
        echo '<tr>
            <td><input type="checkbox" name="count_hidden[]" value="'.$count_val.'" class="count_hidden" checked /></td>
                  <td>';
        master_entry_table('master_entry_table_name['.$count_val.']',NULL,'',array('class'=>'extra_table','data-count'=>$count_val));
        echo'</td>
             <td id="table_field_'.$count_val.'"></td>
             <td>';
        table_field($selected_table,'relational_field['.$count_val.']');
        echo'</td>
            <td><textarea class="form-control" name="sql_extra['.$count_val.']" placeholder="SQL query"></textarea></td>
            <td><input type="text" class="form-control" name="label_name_extra['.$count_val.']" placeholder="Label Text" /></td>
        </tr>';
    }
    
    function menu_delete($menu_id){
        $no_of_children = $this->master_model->count_children($menu_id);
        if($no_of_children>0){
            $data['menu_list'] = $this->master_model->get_all_menu();
            $data['msg'] = '<div class="alert alert-danger">Selected menu has '.$no_of_children.' child menu. Please delete them first!</div>';
            $this->render_page('master/menu_list', $data);
        }else{
            $this->db->delete('menu',array('menu_id'=>$menu_id)); // Delete from menu table
            $this->db->delete('privilege_menu',array('menu_id'=>$menu_id)); // Delete from privilege menu table
            $data['menu_list'] = $this->master_model->get_all_menu();
            $data['msg'] = '<div class="alert alert-success">Selected menu has been deleted successfully!</div>';
            $this->render_page('master/menu_list', $data);
        }
    }
    /* Function Created By Md Riad Hossain at 22.11.14
     * This fuction is used to load a popup with details view of master entry for every single entity
     * Developer/Admin must enable details view while prepare master entry at master entry manager
     */
    function view_details($table_name,$id){
        $template_name  = $this->input->get('template_name');
        // Now get sql for details view and execute
        $get_result = $this->master_model->get_details($table_name,$id);
        $data['info'] = $get_result;
        $data['heading'] = $table_name.' Details';
        $this->load->view('poolcar/'.$template_name, $data);
    }
    
    function generate_combo_by_ajax_call(){
        $function_name = $this->input->post('function_name');
        $field_name = $this->input->post('field_name');
        $id = $this->input->post('id');
        $value = $this->input->post('val');
        $onchange = $this->input->post('on_change')== 'TRUE'?TRUE:FALSE;
        $function_name(NULL,NULL,$field_name,array($id=>$value),$onchange);
    }
    
    function create_upazila($upazilla_id = NULL){
        $data = array();
        $menu_id = $this->input->get('m_id');
        if($upazilla_id != NULL){
            $data['upazila_details'] = $this->db->query("SELECT
            upazila.upazila_id,
            upazila.upazila_name,
            district.district_id,
            division.division_id
            FROM
            upazila
            INNER JOIN district ON upazila.district_id = district.district_id
            INNER JOIN division ON district.division_id = division.division_id
            WHERE upazila.upazila_id = $upazilla_id
            ")->row();
        }
        $query = $this->db->query("SELECT
            upazila.upazila_id,
            upazila.upazila_name,
            district.district_name,
            division.division_name
            FROM
            upazila
            INNER JOIN district ON upazila.district_id = district.district_id
            INNER JOIN division ON district.division_id = division.division_id
            ");
        $data['info'] = $query->result_array();
        $data['edit_privilege'] = $this->check_privilege($menu_id,0);
        $data['delete_privilege'] = $this->check_privilege($menu_id,1);
        $data['add_privilege'] = $this->check_privilege($menu_id,2);
        $data['menu_id'] = $menu_id;
        $this->render_page('master/create_upazila',$data);
    }
    function save_upazila(){
        $data = array();
        $upazila_id = $this->input->post('upazila_id');
        if(isset($upazila_id)){
            $this->db->delete('upazila', array('upazila_id' => $upazila_id)); 
        }
        $data['upazila_name'] = $this->input->post('upazila_name');
        $data['district_id'] = $this->input->post('district_id');
        $data['created_by'] = $this->user_id;
        $data['created'] = date('Y-m-d H:i:s');
        $this->db->insert('upazila',$data);
        $menu_id = $this->input->post('menu_id');
        redirect('master/create_upazila');
    }
    function delete_upazila($upazila_id){
        $this->db->delete('upazila', array('upazila_id' => $upazila_id));
        redirect('master/create_upazila');
    }
    
    function notification(){
        $data['notification_list'] = $this->master_model->get_all_notification($this->user_id);
        $this->render_page('master/notification', $data);
    }
    function update_notification(){
        $notify_to = $this->input->post('user_id');
        $date_time = $this->input->post('date_time');
        $this->db->where('notify_to', $notify_to);
        $this->db->where('created', $date_time);
        $this->db->update('notification', array('status'=>'Read')); 
        
        echo $this->master_model->count_notification($this->user_id);
    }
    
    function send_email($from_mail,$from_name,$to,$subject,$message,$attachment = array(),$cc = '',$bcc = ''){
        //$path_to_the_file = realpath(__DIR__.'/../../img/404.jpg');
        //echo 'sdsd'.$path_to_the_file;
        //echo $message;
        //exit();
        $this->load->library('email');

        $this->email->from($from_mail, $from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->cc($cc); 
        $this->email->bcc($bcc);
        //$this->email->attach($attachment);
        if(!empty($attachment)){
            if(is_array($attachment)){
                foreach($attachment as $file_path){
                    $this->email->attach($file_path);
                }
            }else{
                $this->email->attach($attachment);
            }
        }
        $this->email->send();
    }
    /*============================= Privilege Checking Function ==============================================*/

    function edit_profile(){
     
        $post = $this->input->post();
        //debug($post,1);
        if(empty($post)){
            $data['user_record'] = $this->master_model->user_information();
            $current_user_id=  $this->session->userdata("USER_ID");
        $data['user_history'] = $this->master_model->get_user_history($current_user_id);
//            echo $this->db->last_query();
//            exit();
            //debug($this->get_menu(),1);
            //$this->get_menu();
            $this->render_page('master/edit_user', $data);
        }
        else{
            if($this->input->post('user_submit')){
                extract($post);
                if(!empty($password)){
                    $data_info = array(
                        'username' => @$username,
                        'password' => md5($password),
                        'default_url' => @$default_url,
                        'secret_question_1' => @$secret_question_1,
                        'secret_question_2' => @$secret_question_2,
                        'secret_question_ans_1' => @$secret_question_ans_1,
                        'secret_question_ans_2' => @$secret_question_ans_2
                    );
                }
                else{
                    $data_info = array(
                        'username' => @$username,
                        'default_url' => @$default_url,
                        'secret_question_1' => @$secret_question_1,
                        'secret_question_2' => @$secret_question_2,
                        'secret_question_ans_1' => @$secret_question_ans_1,
                        'secret_question_ans_2' => @$secret_question_ans_2
                    );
                }
                $this->db->WHERE('user_id', $this->user_id);
                $this->db->UPDATE('user',$data_info);
                $data['user_record'] = $this->master_model->user_information();
                $this->render_page('master/edit_user', $data);
            }
     
            if($this->input->post('personal_submit')){
                extract($post);                
//		$image_name = $this->user_id.'_'.$first_name;
//		$upload_path = 'images/user/';
//		$image_field = $this->image_upload($image_name, $upload_path);
//                echo $image_field.'+++';
//                echo $image_up.'____';
//                exit();
                $data_info = array(
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'date_of_birth' => $date_of_birth,
                    'email' => $email,
                    'contact_number' => $contact_number,
                    'gender' => $gender,
                    'father_name' => $father_name,
                    'mother_name' => $mother_name,
                    'religion_id' => $religion_id,
                    'identification_type_id' => $identification_type_id,
                    'identification_number' => $identification_number
                );
                $this->db->WHERE('user_id', $this->user_id);
                $this->db->UPDATE('user',$data_info);
                $data['user_record'] = $this->master_model->user_information();
                $this->render_page('master/edit_user', $data);
            }
            
            if($this->input->post('bank_submit')){
                extract($post);
                $data_info = array(
                    'bank_id' => $bank_id,
                    'bank_branch' => $bank_branch,
                    'bank_account_number' => $bank_account_number
                );
                $this->db->WHERE('user_id', $this->user_id);
                $this->db->UPDATE('user',$data_info);
                $data['user_record'] = $this->master_model->user_information();
                $this->render_page('master/edit_user', $data);
            }
        }
        
        
    }
    function change_user_status(){
        $data = $this->input->post();
        $current_user_id=  $this->session->userdata("USER_ID");
        $data['user_history'] = $this->master_model->get_user_history($current_user_id);
        if($data != ""){
            $info = array(
                    'status' => "Cancelled"
                );
        }
        
        $this->db->WHERE('user_id', $current_user_id);
        $this->db->UPDATE('reliever_history',$info);
        $this->load->view('master/reliever_user_ajax_view',$data);
    }
    
    function reliever_information(){
        $data = $this->input->post();
//        echo '<pre>';
//        print_r($data);
//        exit();
        $current_user_id=  $this->session->userdata("USER_ID");
        if(!empty($data)){
            $info = array(
                    'is_reliever' => "1",
                    'reliever_to' => $data['user_id'],
                    'reliever_start_datetime' => $data['start_date'],
                    'reliever_end_datetime' => $data['end_date']  
                );
            $this->db->WHERE('user_id', $current_user_id);
            $this->db->UPDATE('user',$info);
        }
        $data['user_history'] = $this->master_model->get_user_history($current_user_id);
        $this->load->view('master/reliever_user_ajax_view',$data);
    }
    
    function submit_support(){
        $data = $this->input->post();
        if(!empty($data)){
            //echo '<pre>';
        //print_r($_FILES);
        //exit();
            $contact_details = $this->master_model->get_contact_details($this->user_id);
            $from_mail = $contact_details->email;
            $from_name = $contact_details->name;
            $subject = $data['email_subject'];
            $message = $data['message'];
            //$attachment = @$data["mail_attachment"];
            //echo $attachment;
            //exit;
            $to = 'riad.hossain@apsissolutions.com';
            $cc = 'riadcsepstu@gmail.com';
            $this->send_email($from_mail, $from_name, $to, $subject, $message, $attachment = array(), $cc);
            $msg['msg'] = 'Successfully Submitted';
            $this->render_page('master/submit_support_ticket',$msg);
        }else{
            $this->render_page('master/submit_support_ticket');
        }
    }
        
    function set_reliever(){
        if($this->input->post('rev') == 'Set'){
            $post = $this->input->post();
            $this->master_model->set_reliever_model($post);
            $data['current_reliever'] = $this->master_model->reliever_current_model();
            $data['reliever'] = $this->master_model->reliever_list_model();
            $this->render_page('master/set_reliever', $data);
    }
        else if($this->input->post('rev') == 'Unset'){
            $this->master_model->unset_reliever_model();
            $data['current_reliever'] = $this->master_model->reliever_current_model();
            $data['reliever'] = $this->master_model->reliever_list_model();
            $this->render_page('master/set_reliever', $data);
        }
        else{
            $data['current_reliever'] = $this->master_model->reliever_current_model();
            $data['reliever'] = $this->master_model->reliever_list_model();
            $this->render_page('master/set_reliever', $data);
        }
    }
    function get_all_child($parent_id){
        //echo '<pre>';
        $menu_id = $this->main_model->get_menu($parent_id);
        //$menu_array = array();
                foreach ($menu_id as $item) {
                    $this->all_child_array[] = $item['menu_id'];
                    if($item['Count'] > 0 ){
                        $this->get_all_child($item['menu_id']);
                    }
                }
        return $this->all_child_array;
    }
    function edit_reliever(){
        $data['current_reliever'] = $this->master_model->reliever_current_model();
        $data['reliever'] = $this->master_model->reliever_list_model();
        $data['my_reliever'] = $this->master_model->reliever_current_model();
        $this->render_page('master/set_reliever', $data);
    }
    function check_uniqueness(){
        $table_name = $this->input->post('table_name');
        $field_name = $this->input->post('field_name');
        $value = $this->input->post('field_value');
        $entry_id = $this->input->post('entry_id');
        $condition = $entry_id == 0? "":" AND ".$table_name."_id <> $entry_id";
        $count_duplicate = $this->db->query("SELECT count($field_name) AS duplicate FROM $table_name WHERE $field_name='$value' $condition")->row()->duplicate;
        if($count_duplicate > 0){
            $p = array('msg'=>'<div style="margin-top:3px;display:block;" class="label label-danger">Duplicate entry. Try another</div>','enable'=>'0');
            echo json_encode($p);
            //echo '<div style="margin-top:3px;display:block;" class="label label-danger">Duplicate entry. Try another</div>';
        }else{
            $p = array('msg'=>'<div style="margin-top:3px;display:block;" class="label label-success">I am safe.</div>','enable'=>'1');
            echo json_encode($p);
        }
    }
    function import_excel($view_name = ''){
        if($this->is_post()){
            //echo '<pre>';
            //print_r($_FILES);
            //exit;
            $file = $_FILES['file']['tmp_name'];
 
            //load the excel library
            $this->load->library('excel');

            //read file from path
            $objPHPExcel = PHPExcel_IOFactory::load($file);
            
            $objPHPExcel->setActiveSheetIndex(0);
            echo '<pre>';

            //get only the Cell Collection
            $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();

            //extract to a PHP readable array format
            $number = 1;
            $arr_data = array();
            foreach ($cell_collection as $cell) {
                $index = 0;
                $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                $colIndex = PHPExcel_Cell::columnIndexFromString($column);
                $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
                
                //header will/should be in row 1 only. of course this can be modified to suit your need.
                if ($row == 1) {
                    $header[$number++] = $data_value;
                } else {
                    $arr_data[$row][$header[$colIndex]] = $data_value;
                }
            }

            //send the data in an array format
            $data['header'] = $header;
            $data['values'] = $arr_data;
            $this->db->insert_batch('nationality',$arr_data);
            print_r($data['values']);
        }else{
            $data['view_name'] = $view_name;
            $this->render_page('master/import_excel',$data);
        }
    }
    
    function download_sample(){
        $view_name = $this->input->post('view_name');
        $get_table_field = $this->master_model->get_table_field_from_master_entry($view_name);
        //echo '<pre>';
        //print_r($get_table_field);
        //echo $this->get_letter(2);
        //exit;
        //https://degreedocumentation.wordpress.com/2012/08/17/how-to-format-a-number-cell-in-phpexcel/
        //
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle($view_name);
        //Now set title with field name
        $number = 0;
        foreach($get_table_field as $field){
            $this->excel->getActiveSheet()->setCellValue($this->get_letter($number++).'1', $field['field_name']);
            //$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
            //$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            //$this->excel->getActiveSheet()->mergeCells('A1:D1');
            //$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }
        $filename=$view_name.'_sample.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
        
    }
    
    private function get_letter($numeric_value){
        $letter = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
        return $letter[$numeric_value];
    }


    /*----------------------------------------------------class end-------------------------------------------------*/
}
