<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    function get_table($table_name) {
        if(empty($table_name)){
            return;
        }
        $query = $this->db->query("DESCRIBE $table_name");
        return $query->result_array();
    }
    
    //Function to get table name which table will be used for master entry
    function get_master_table(){
        $query = $this->db->query("SELECT master_entry_table_id,master_entry_table_name FROM master_entry_table");
        return $query->result_array();
    }
            
    function get_previous_table($master_entry_table_name, $mask_title){
        if(empty($master_entry_table_name)){
            return;
        }
        $query = $this->db->query("SELECT field_name,`sql`,comma_separated_value,hide_from_grid,self_filtering,hide_from_input,input_type,required_field,label_name,placeholder,search FROM master_entry WHERE master_entry_table_name = '$master_entry_table_name' AND master_entry_title='$mask_title'");
        return $query->result_array();
    }
    
    function table_content($fields, $lab, $place,$sql,$hide_from_grid,$self_filtering,$hide_from_input,$comma_separated_value,$input_type,$required_type,$master_entry_table_name,$request_for,$master_entry_title,$search){
        //print_r($sql);
        if($request_for != 'show'){
            foreach($fields as $column){  
                $query = $this->db->query("DESCRIBE $master_entry_table_name $column");
                $rec[]=$query->result_array();
            }
            //print_r($fields);
            $this->db->query("DELETE FROM master_entry WHERE master_entry_table_name='$master_entry_table_name' AND master_entry_title='$master_entry_title'");
            foreach($rec as $val){
                
                foreach($val as $val2){
                    
                $label = $lab[$val2['Field']];
                $placeholder = $place[$val2['Field']]; //input type will be var/int/dou/tex/num/........
                $sql_str = $sql[$val2['Field']];
                $comma_val = $comma_separated_value[$val2['Field']];
                $hide_in_grid = isset($hide_from_grid[$val2['Field']])?1:0;
                $active_filter = isset($self_filtering[$val2['Field']])?1:0;
                $hide_in_input = isset($hide_from_input[$val2['Field']])?1:0;
                $inpt_type = $input_type[$val2['Field']];
                $field_name = $val2['Field'];
                $type = empty($inpt_type)?substr($val2['Type'], 0, 3):$inpt_type;
                $null = $val2['Null'];
                $key = $val2['Key'];
                $default = $val2['Default'];
                $extra = $val2['Extra'];
                $include_search = (isset($search[$val2['Field']]) && $search[$val2['Field']]!='')?1:0;
                $validation = isset($required_type[$val2['Field']])?$required_type[$val2['Field']]:'';
                $this->db->query("INSERT INTO master_entry "
                        . "SET "
                        . "master_entry_table_name='$master_entry_table_name', "
                        . "field_name='$field_name', "
                        . "field_key='$key', "
                        . "input_type='$type', "
                        . "required_field='$validation', "
                        . "`sql`='$sql_str',"
                        . "comma_separated_value='$comma_val',"
                        . "hide_from_grid='$hide_in_grid', "
                        . "self_filtering='$active_filter', "
                        . "hide_from_input='$hide_in_input', "
                        . "label_name='$label', "
                        . "placeholder='$placeholder', "
                        . "search='$include_search', "
                        . "created=NOW(),"
                        . "master_entry_title='$master_entry_title'");

                }
              
            }
        }
        $q = $this->db->query("SELECT * FROM master_entry WHERE master_entry_table_name = '$master_entry_table_name' AND master_entry_title='$master_entry_title' ORDER BY sorting");
        return $q->result_array();
    }
    function combo_table($foreign_table){
        $q = $this->db->query("SELECT * FROM $foreign_table ");
        return $q->result_array();
    }
    function array_result($sql){
        $query = $this->db->query($sql);
        return array($query->list_fields(),$query->result_array());
    }
    
    function get_array_result($sql){
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    function get_table_info($table_name){
        $query = $this->db->query("SELECT * FROM master_entry WHERE master_entry_table_name = '$master_entry_table_name' ORDER BY sorting");
        return $query->result_array();
    }
    
    function get_menu_list($parent_id){
        $query = $this->db->query("SELECT menu_id,menu_name,sort_number FROM menu WHERE parent_menu_id='$parent_id' ORDER BY sort_number");
        return $query->result_array();
    }
    
    function reorder_menu_item($data){
        foreach ($data as $value) {
            $split_value = explode("=", $value);
            $menu_id = $split_value[0];
            $sort_number = $split_value[1];
            $this->db->query("UPDATE menu SET sort_number='$sort_number' WHERE menu_id='$menu_id'");
        }
    }
    
    function get_level_menu_list($level_id){
        $query = $this->db->query("SELECT
        privilege_menu.menu_id,
        privilege_menu.user_level_id,
        menu.module_id
        FROM
        privilege_menu
        INNER JOIN menu ON privilege_menu.menu_id = menu.menu_id
        WHERE
        privilege_menu.user_level_id = '$level_id'");
        $data = array();
        foreach($query->result_array() as $item){
            $data[] = $item['menu_id'];
        }
        return $data;
    }
    
    function reorder_entry_element($data){
        foreach ($data as $value) {
            $split_value = explode("=", $value);
            $view_name = $split_value[0];
            $field_name = $split_value[1];
            $sort_number = $split_value[2];
            $this->db->query("UPDATE master_entry SET sorting='$sort_number' WHERE master_entry_title='$view_name' AND field_name='$field_name'");
        }
    }
    
    function get_permitted_level_list($user_id=NULL){
        $condition = $user_id == NULL?"":" WHERE pl.user_id='$user_id' ";
        $sql = "SELECT
        pl.user_id,
        GROUP_CONCAT(pl.user_level_id) AS level_id_list,
        GROUP_CONCAT(user_level.user_level_name) AS level_id_list_name,
        `user`.first_name
        FROM
        privilege_level AS pl
        INNER JOIN `user` ON pl.user_id = `user`.user_id
        INNER JOIN user_level ON pl.user_level_id = user_level.user_level_id
        $condition
        GROUP BY pl.user_id
        ORDER BY pl.user_id";
        
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    function join_insertion($join_count,$join_table_name,$join_field_name,$join_relation_field_name,$join_sql,$join_label,$tbl_name,$master_entry_title){
        foreach ($join_count as $value) {
            $jn_tbl_name = $join_table_name[$value];
            $jn_fld_name = $join_field_name[$value];
            $jn_rln_fld_name = $join_relation_field_name[$value];
            $jn_sql = $join_sql[$value];
            $jn_lbl = $join_label[$value];
            
            $data = array(
                'master_entry_table_name' => $tbl_name ,
                'field_name' => $jn_fld_name ,
                'input_type' => 'select',
                'required_field' => 'required',
                'sql' => $jn_sql,
                'hide_from_grid' => 1,
                'hide_from_input' => 0,
                'label_name' => $jn_lbl,
                'join_with' => $jn_tbl_name,
                'join_with_fk_name' => $jn_rln_fld_name,
                'created_by' => $this->user_id,
                'created' => date('Y-m-d H:i:s'),
                'master_entry_title' => $master_entry_title
             );

            $this->db->insert('master_entry', $data); 
        }
    }
    
    function get_all_menu( $menu_id = NULL ){
        $condition = $menu_id==NULL?"":" WHERE menu_id=$menu_id";
        $query = $this->db->query("SELECT menu.*,module_name FROM menu INNER JOIN module ON module.module_id=menu.module_id $condition");
        return $query->result_array();
    }
    function get_parent($child_id){
        $parent_id = $this->db->select('parent_menu_id')
                  ->get_where('menu', array('menu_id' => $child_id))
                  ->row()
                  ->parent_menu_id;
        return $parent_id;
    }
    
//    function get_user_info_by_userid($id){
//        $query = $this->db->query("");
//        
//    }
            function level_for_menu($menu_id){
        $lebel_list = $this->db->select('GROUP_CONCAT(privilege_menu.user_level_id) AS level_id')
                  ->get_where('privilege_menu', array('menu_id' => $menu_id))
                  ->row()
                  ->level_id;
        return $lebel_list;
    }
    function user_for_menu($menu_id){
        $user_list = $this->db->select('GROUP_CONCAT(privilege_menu.user_id) AS user_id')
                  ->get_where('privilege_menu', array('menu_id' => $menu_id))
                  ->row()
                  ->user_id;
        return $user_list;
    }
    
    function count_children($menu_id){
        $this->db->where('parent_menu_id', $menu_id);
        $this->db->from('menu');
        return $this->db->count_all_results();
    }
    
    /*  Function created by Md Riad Hossain at 16.10.14 And Last Updated By Md Riad Hossain at 16.10.14  */
    function get_extra_relation_with_table($master_table_name,$view_name){
        $sql = "SELECT
        master_entry.master_entry_table_name,
        master_entry.field_name,
        master_entry.input_type,
        master_entry.required_field,
        master_entry.`sql`,
        master_entry.comma_separated_value,
        master_entry.hide_from_grid,
        master_entry.hide_from_input,
        master_entry.sorting,
        master_entry.label_name,
        master_entry.placeholder,
        master_entry.field_key,
        master_entry.created_by,
        master_entry.created,
        master_entry.updated_by,
        master_entry.updated,
        master_entry.`status`,
        master_entry.join_with,
        master_entry.join_with_fk_name
        FROM
        master_entry
        WHERE
        master_entry.join_with IS NOT NULL AND
        master_entry.master_entry_table_name = '$master_table_name' AND master_entry_title = '$view_name'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    /* Function to get sql for details view and then get result */
    function get_details($tbl_name, $id){
        $sql = $this->db->query("SELECT details_view_sql FROM master_entry_table WHERE master_entry_table_name='$tbl_name'")->row()->details_view_sql;
        $full_sql = $sql." WHERE `$tbl_name`.".$tbl_name."_id = '$id'";
        $result = $this->db->query($full_sql)->row();
        return $result;
    }
    function get_all_notification($user_id){
        //$this->db->update('notification', array('status'=>'Read')); 
        $this->db->select('notification.notify_by,
                            notification.notify_to,
                            notification.`subject`,
                            notification.details,
                            notification.`status`,
                            notification.created,
                            CONCAT(user.first_name," ",user.last_name) AS notification_from',FALSE);
        $this->db->join('user','user.user_id=notification.notify_by','LEFT');
        $this->db->where('notify_to',$user_id);
        $query = $this->db->get('notification');
        return $query->result_array();
    }
    function count_notification($user_id){
        $count = $this->db->query("SELECT count(*) AS new_not FROM notification WHERE status='Unread' AND notify_to=$user_id")->row()->new_not;
        return $count;
    }
    function get_contact_details($user_id){
        $query = $this->db->query("SELECT CONCAT(first_name,' ',last_name) AS name,email FROM user WHERE user_id = $user_id")->row();
        return $query;
    }
    function user_information(){
        $user_id = $this->user_id;
        $sql = "SELECT
                religion.religion_id,
                religion.religion_name,
                user.user_id,
                user.first_name,
                user.last_name,
                user.email,
                user.contact_number,
                user.username,
                user.password,
                user.secret_question_1,
                user.secret_question_2,
                user.secret_question_ans_1,
                user.secret_question_ans_2,
                user.identification_number,
                user.date_of_birth,
                user.gender,
                user.father_name,
                user.father_occupation_id,
                user.mother_name,
                user.mother_occupation_id,
                user.bank_account_number,
                user.bank_branch,
                user.bank_id,
                user.last_login_date_time,
                user.default_module_id,
                user.created_by,
                user.created,
                user.updated_by,
                user.updated,
                user.status,
                user.user_image,
                user.address,
                user.is_reliever,
                user.reliever_to,
                user.reliever_start_datetime,
                user.reliever_end_datetime,
                user.line_manager_id,
                user.designation_id,
                user.department_id,
                user.location_id,
                user.default_vehicle_id,
                user.default_url,
                identification_type.identification_type_id,
                identification_type.identification_type_name
                FROM
                user
                LEFT JOIN religion ON user.religion_id = religion.religion_id
                LEFT JOIN identification_type ON user.identification_type_id = identification_type.identification_type_id
                WHERE user.user_id = '$user_id'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    function get_user_history($user_id){
            $this->db->select("rh.reliever_to,rh.reliever_start_datetime,rh.reliever_end_datetime,rh.created,rh.status",false);
            $this->db->select("u.username");
            $this->db->from("reliever_history rh");
            $this->db->join("user u","u.user_id=rh.user_id","left");
            $this->db->where("u.user_id ",$user_id);
            $this->db->order_by("rh.user_id","DESC");
            $result= $this->db->get();
            return $result->result_array();
    }
            
    function set_reliever_model($post){
        extract($post);
        $history_insert = array('user_id'=>  $this->user_id, 
            'reliever_to'=>$user_department_id, 
            'reliever_start_datetime'=>$start_reliever_date,
            'reliever_end_datetime'=>$end_reliever_date,
            'created'=>date('Y-m-d')
            );
        $this->db->insert('reliever_history', $history_insert);
        
        $history_update = array('user_id'=>  $this->user_id, 
            'reliever_to'=>$user_department_id, 
            'reliever_start_datetime'=>$start_reliever_date,
            'reliever_end_datetime'=>$end_reliever_date,
            'created'=>date('Y-m-d h:i:s'),
            'is_reliever'=>1
            );
        $this->db->where('user_id', $this->user_id);
        $this->db->update('user', $history_update);
}
    
    function unset_reliever_model(){
        $history_update = array('user_id'=>  $this->user_id, 
            'reliever_to'=>0, 
            'is_reliever'=>0
            );
        $this->db->where('user_id', $this->user_id);
        $this->db->update('user', $history_update);
    }
    
    function reliever_list_model(){
        $user_id = $this->user_id;
        $query = $this->db->query("SELECT
            reliever_history.user_id,
            reliever_history.reliever_start_datetime,
            reliever_history.reliever_end_datetime,
            reliever_history.created,
            reliever_history.status,
            user.first_name,
            user.last_name,
            concat(user.first_name,' ',user.last_name) as reliever_to_name
            FROM
            reliever_history
            INNER JOIN user ON reliever_history.reliever_to = user.user_id
            WHERE reliever_history.user_id = $user_id");
        return $query->result_array();
    }
    
    function reliever_current_model(){
        $user_id = $this->user_id;
        $query = $this->db->query("SELECT
            user.user_id,
            user.first_name,
            user.last_name,
            CONCAT(user2.first_name,' ',user2.last_name) as reliever_to_name,
            user.reliever_to,
            user.is_reliever,
            user.reliever_start_datetime,
            user.reliever_end_datetime
            FROM
            user
            JOIN user as user2 ON user.reliever_to = user2.user_id
            WHERE user.user_id = $user_id AND user.is_reliever = 1");
        return $query->result_array();
    }
    
    // Function added by Md. Riad Hossain at 21.12.14
    function get_mask_table(){
        $query = $this->db->query("SELECT master_entry_table_id,master_entry_table_name,master_entry_title FROM master_entry_table");
        return $query->result_array();
    }
    
    function get_original_table_name($mask_title){
        $table_name = $this->db->query("SELECT master_entry_table_name FROM master_entry_table WHERE master_entry_title ='$mask_title'")->row()->master_entry_table_name;
        return $table_name;
    }
    
    // Function added by Md. Riad Hossain at 01.04.2015
    function get_upload_directory($view_name){
        $this->db->select('file_upload_path');
        $this->db->where('master_entry_title', $view_name);
        $query = $this->db->get('master_entry_table');
        return $query->row()->file_upload_path;
    }
    
    // ® By Md Riad Hossain at 07.04.2015
    function get_table_field_from_master_entry($view_name){
        $this->db->select('field_name');
        $this->db->where('master_entry_title',$view_name);
        $query = $this->db->get('master_entry');
        return $query->result_array();
    }
    
    function get_module_url($module_id){
        $get_url = $this->db->query("SELECT home_url FROM module WHERE module_id = '$module_id'")->row()->home_url;
        return $get_url;
    }
    
    function create_master_table($table_name){
        $sql = "CREATE TABLE `$table_name` (
        `".$table_name."_id`  int(10) NOT NULL AUTO_INCREMENT ,
        `".$table_name."_name`  varchar(250) NOT NULL ,
        `description`  text NOT NULL ,
        `created_by`  int(10) NULL ,
        `created`  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
        `updated_by`  int(10) NULL ,
        `updated`  TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP ,
        `status`  enum('Active','Inactive') NULL DEFAULT 'Active' ,
        PRIMARY KEY (`".$table_name."_id`)
        )";
        $this->db->query($sql);
    }
    
    // Unique function access by all table
    function insert(){
        
    }
}