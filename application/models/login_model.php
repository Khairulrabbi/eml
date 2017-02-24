<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }
    
    function validate_user( $user, $password ) {
        $this->db->from('user');
        $this->db->where('username', $user );
        $this->db->where('password', $password);
        $login = $this->db->get()->result();

        if ( is_array($login) && count($login) == 1 ) {
            return true;
        }
    }
    function user_info($user,$pass) {
        $query = $this->db->query("SELECT u.*, l.location_name FROM user u LEFT JOIN location l ON l.location_id=u.location_id WHERE u.username='$user' AND u.password='$pass'");
        foreach ($query->result_array() as $row)
            {
                $data['USER_ID']=$row['user_id'];
                $data['FIRSTNAME']=$row['first_name'];
                $data['LASTNAME']=$row['last_name'];
                $data['default_module_id'] = $row['default_module_id'];
                $data['LOCATION_ID'] = $row['location_id'];
                $data['LOCATION_NAME'] = $row['location_name'];
                $data['PRIVILEGE_NATION_ACCESS'] = $row['privilege_nation_access'];
                // If user is admin then add all level id into SESSION
                if( $data['USER_ID'] == 1 ){
                    $query = $this->db->query("SELECT user_level_id FROM user_level");
                    $level = array();
                    foreach ($query->result_array() as $value) {
                        $level[] = $value['user_level_id'];
                    }
                    $data['LEVEL_ID'] = $level;
                }else{
                    $query = $this->db->query("SELECT user_level_id FROM privilege_level WHERE user_id = '".$data['USER_ID']."'");
                    $user_level_id = $query->result_array();
                    $id_array = array();
                    foreach ($user_level_id as $level){
                        array_push($id_array, $level['user_level_id']);
                    }
                    $data['LEVEL_ID'] = $id_array;
                    //print_r($id_array);
                    $sql = "SELECT
                    user_level.privilege_edit,
                    user_level.privilege_delete,
                    user_level.privilege_add,
                    user_level.privilege_view_all,
                    user_level.all_privilege
                    FROM
                    user_level
                    WHERE
                    user_level.user_level_id IN (".  implode(',', $id_array).")";
                    $query = $this->db->query($sql)->result_array();
                    //echo '<pre>';
                    //print_r($query);
                    $edit_array = array();
                    $delete_array = array();
                    $view_array = array();
                    $add_array = array();
                    foreach ($query as $value) {
                        $edit_array[] = $value['privilege_edit'];
                        $delete_array[] = $value['privilege_delete'];
                        $view_array[] = $value['privilege_view_all'];
                        $add_array[] = $value['privilege_add'];
                    }
                    if(in_array(1, $edit_array)){
                        $data['p_edit'] = 1;
                    }else{
                        $data['p_edit'] = 0;
                    }
                    if(in_array(1, $delete_array)){
                        $data['p_delete'] = 1;
                    }else{
                        $data['p_delete'] = 0;
                    }
                    if(in_array(1, $view_array)){
                        $data['p_view'] = 1;
                    }else{
                        $data['p_view'] = 0;
                    }
                    if(in_array(1, $add_array)){
                        $data['p_add'] = 1;
                    }else{
                        $data['p_add'] = 0;
                    }
                    $query = $this->db->query("SELECT user_module_id FROM privilege_module WHERE user_id = '".$data['USER_ID']."'");
                    $user_module_id = $query->result_array();
                    $module_id_array = array();
                    foreach ($user_module_id as $level){
                        array_push($module_id_array, $level['user_module_id']);
                    }
                    $data['MODULE_ID'] = $module_id_array;
                    
                    // Now get and set privilege
                }
                //$data['USER_TYPE_ID']=$row['user_type_id'];
                $data['LOGIN_TIME']= date('d-m-Y H:i:s');
                $data['USER_IMAGE']= $row['user_image'];
            }
            //print_r($data);
        $this->session->set_userdata($data);
        return $data['USER_ID'];
        }
        
    function forget_action($email,$password){
        
        $pass = md5($password);
        
        $data = array('password' => $pass);
        $this->db->where('email',$email);
        $this->db->update('user',$data);
        
        $this->db->select('`user`.user_id,
                `user`.first_name,
                `user`.last_name,
                `user`.email');
        $this->db->from('user');
        $this->db->where('email',$email);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function user_default_url($user_id){
        $this->db->select('user.user_id, user.default_url');
        $this->db->from('user');
        $this->db->where('user_id',$user_id);
        $query = $this->db->get();
        return $query->row();
    }
    
//    function set_label_cookie()
//    {
//        $this->db->select("*");
//        $this->db->from("label");
//        $this->db->where("status","Active");
//        $rows = $this->db->get(); 
//        
//        foreach ($rows->result() as $row)
//        {
//            delete_cookie($row->label_slug, ''); 
//        }
//        
//        
//        foreach($rows->result() as $row)
//        {
//            if($row->custom_name != NULL)
//            {
//                $this->input->set_cookie($row->label_slug, $row->custom_name, 0);
//            }
//            else
//            {
//                $this->input->set_cookie($row->label_slug, $row->label_name, 0);
//            }
//        }
//    }
        
}
