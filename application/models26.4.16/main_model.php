<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model {
    private $user_id;
    private $active_module_id;
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->user_id = $this->session->userdata('USER_ID');
    }
    
/*==========================================  From Home / get_menu()   ===================================================*/
    
    public function get_menu_model($command = NULL,$modl_id = NULL) {
        $user_level_id = $this->session->userdata('LEVEL_ID');
        $module_id = $modl_id==NULL?$this->session->userdata('default_module_id'):$modl_id;
        
        $this->db->select('*,module.module_name');
        $this->db->from('menu');
        $this->db->group_by('menu.menu_id'); 
        /*
         * If an admin logged in to the system he is able to access all apsis developer module menu.
         *No privilege is required.
         */ 
        $this->db->join('module', 'module.module_id = menu.module_id');
        if( $this->user_id != 1 ){
            $this->db->join('privilege_menu', 'privilege_menu.menu_id = menu.menu_id');
            $this->db->where_in('privilege_menu.user_level_id', $user_level_id);
        }
        if( $command == NULL ){
        $this->db->where('menu.module_id', $module_id);
        }
        $this->db->where('menu.status', 'Active');  
        $this->db->where('menu.menu_type', 'Main');  
        $this->db->order_by('menu.sort_number', 'asc'); 
        $query = $this->db->get();
        return $query->result_array();
    }
    
    
    
/*==========================================  From Home / get_submenu()   ===================================================*/
    
    function get_submenu_model($menu_id) {

        $this->db->select('*');
        $this->db->group_by('menu.menu_id');
        $this->db->from('menu');
        $this->db->where('parent_menu_id', $menu_id);         
        $this->db->where('status', 'Active');  
        $this->db->where('menu_type', 'Sub');  
        $this->db->order_by('sort_number', 'asc'); 
        
        
        $query = $this->db->get();
        return $query->result_array(); 
        
        //print $this->db->last_query();
    }
    
    function get_parent_id($url_str){
        // While the url string is empty. This occur when we are in home page
        if($url_str == ''){
            return;
        }
        $query = $this->db->query("SELECT menu_id,menu_type,parent_menu_id FROM menu WHERE menu_url='$url_str' LIMIT 0,1");
        $res = $query->result();
        // If the url is not found in database ex: no update page is exist in menu table
        if(empty($res)){
            if(!null==($this->session->userdata('menu_id'))){
                return $this->session->userdata('menu_id');
            }else{
                return;
            }
        }
        if($res[0]->menu_type == 'Main'){
            $parent_menu_id = $res[0]->menu_id;
            $this->session->set_userdata('menu_id', $parent_menu_id);
            return $parent_menu_id;
        }else{
            return $this->session->userdata('menu_id');
        }
    }
    
    function get_menu($parent_id){
        $join_str = '';
        $user_level_id = $this->session->userdata('LEVEL_ID');
        if( $this->user_id != 1 ){
            $join_str = "INNER JOIN privilege_menu ON privilege_menu.menu_id = a.menu_id AND privilege_menu.user_level_id IN (".implode(",", $user_level_id).")";
        }
        $sql = "SELECT
        a.menu_id,
        a.menu_name,
        a.menu_url,
        a.icon_class,
        Deriv1.Count,
        module.module_name
        FROM `menu` a
        LEFT OUTER JOIN (SELECT parent_menu_id, COUNT(*) AS Count FROM `menu` GROUP BY parent_menu_id) Deriv1 ON a.menu_id = Deriv1.parent_menu_id
        JOIN module ON module.module_id = a.module_id
        $join_str
        WHERE a.parent_menu_id=$parent_id GROUP BY a.menu_id ORDER BY sort_number
        ";
        //echo $sql;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    function count_new_referraled_user(){
        $this->db->where('prospect_customer_status_id', NULL);
        $this->db->from('d360_referraled_user');
        return $this->db->count_all_results();
    }
    
    function get_privilege($id = NULL){
        if($id != NULL){
            $sql = "SELECT
             menu.menu_name,
             Sum(user_level.privilege_edit) AS edit,
             Sum(user_level.privilege_delete) AS del,
             Sum(user_level.privilege_add) AS `add`,
             Sum(user_level.privilege_view_all) AS view_all,
             Sum(user_level.all_privilege) AS super,
             menu.menu_id,
             user_level.user_level_id
             FROM
             `user`
             INNER JOIN privilege_level ON `user`.user_id = privilege_level.user_id
             INNER JOIN user_level ON privilege_level.user_level_id = user_level.user_level_id
             INNER JOIN privilege_menu ON user_level.user_level_id = privilege_menu.user_level_id
             INNER JOIN menu ON privilege_menu.menu_id = menu.menu_id AND privilege_menu.menu_id = menu.menu_id
             WHERE
             `user`.user_id = ".$id."
             GROUP BY
             menu.menu_id";
            $query = $this->db->query($sql);
            $p = array();
            foreach ($query->result_array() as $value) {
                $p[$value['menu_id']] = array($value['edit'],$value['del'],$value['add'],$value['view_all'],$value['super']);
            }
            return $p;
        }
    }
    function get_module_id($user_id){
        $module_id = $this->db->query("SELECT default_module_id FROM user WHERE user_id=$user_id")->row()->default_module_id;
        return $module_id;
    }
    
    function count_notification($user_id){
        $count = $this->db->query("SELECT count(*) AS new_not FROM notification WHERE status='Unread' AND notify_to=$user_id")->row()->new_not;
        return $count;
    }
    /*==========================================     ===================================================*/
}
