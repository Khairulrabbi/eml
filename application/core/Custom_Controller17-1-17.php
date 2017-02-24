<?php
class Custom_Controller extends CI_Controller {

  protected $data = array();
  public $menu_id;
  public $user_id;
  public $new_ref_user;
  public $module_id;
  public $menu_array = array();
  public $permission_deny;
  public $edit_privilege;
  public $add_privilege;
  public $delete_privilege;
  public $view_privilege;
  public $all_privilege;
  public $get_permission_array;

            
  function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
        date_default_timezone_set("Asia/Dacca");
        //define('ENVIRONMENT', 'development');
        $this->load->helper('url','html','form');
        $this->load->helper('apsis_helper');
        $this->load->helper('pool_helper');
        $this->load->helper('req_helper');
        $this->load->helper('shop_helper');
        $this->load->library('javascript');
        $this->load->library('session');
        $this->load->library('user_agent');
        $this->load->model('main_model');
        //$this->menu_id = $this->main_model->get_parent_id($this->uri->uri_string());
        //$this->menu_id = $this->input->get('m_id')?$this->get_menu_parent($child_id):$this->main_model->get_parent_id($this->uri->uri_string());
        $this->user_id = $this->session->userdata('USER_ID');
        $this->get_permission_array = $this->main_model->get_privilege($this->user_id);
  }

  function render_page($view,$data='') {
      $this->menu_id = $this->input->get('m_id')?$this->get_menu_parent($this->input->get('m_id')):$this->main_model->get_parent_id($this->uri->uri_string());
    //do this to don't repeat in all controllers...
    if($this->session->userdata('LEVEL_ID') != '' || $this->user_id == 1){
        $is_permitted_to_view_this_page = $this->check_page_privilege($this->input->get('m_id'));
        if($is_permitted_to_view_this_page){
            $menu_html_array = $this->get_menu();
            $menu_html['menu_list'] = $menu_html_array['menu'];
            $menu_html['new_submenu_list'] = $this->menu_id?$this->display_children($this->menu_id):'';
            $menu_html['d_menu'] = $menu_html_array['all_menu'];
            $menu_html['url_data'] = $this->menu_id;
            $menu_html['module_html'] = $this->get_module_list();
            $menu_html['module_name'] = $this->get_active_module();
            $menu_html['menu_array'] = $this->menu_array;
            //$menu_html['menu_list_array'] = $menu_html_array['menu_list_array'];
            $menu_html['count_new_notification'] = $this->main_model->count_notification($this->user_id);

            //echo '<pre>';
            //print_r($menu_html['menu_list']);
            //exit;
            $this->load->view('template/header', $menu_html);
            //menu_data must contain the structure of the menu...
            //you can populate it from database or helper
            $this->load->view($view,$data);
            $this->load->view('template/footer');
        }else{
            $message_403 = "You don't have access to the url you where trying to reach.";
            show_error($message_403 , 403 ); 
        }
    }else{
        $url = current_url();
        redirect('/login_cont?url='.urlencode($url));
    }
  }
  
  /*==========================================  Get Menu List   ===================================================*/
    public function get_menu(){
        $get_menu_info = $this->main_model->get_menu_model(); // call model for getting menu and sub menu
        //debug($get_menu_info,1);
        $menus = array();
        $all_menu = array();
        foreach ($get_menu_info as $get_menu_info1){
            $menu = '';
            $menu_name = $get_menu_info1['menu_name'];
            $menu_url = $get_menu_info1['menu_url'];
            $icon_class = $get_menu_info1['icon_class'];
            $menu_id = $get_menu_info1['menu_id'];
            /*-----submenus print here----------*/
            if($this->display_children($menu_id) != ''){
                $main_menu_class = "dropdown";
                $down_arrow ="<i class='fa fa-caret-down'></i>";
                $submenu_class = "dropdown-toggle";
                $submenu_attribute = "data-toggle='dropdown'";
                $submenu_html = "<ul class='dropdown-menu'>".$this->display_children($menu_id)."</ul>";
            }
            else{
                $main_menu_class = "";
                $submenu_class = "";
                $submenu_attribute = "";
                $submenu_html = "";
                $down_arrow = "";
            }
            /*-----submenus print here----------*/
            
            $menu .= "<li class='$main_menu_class' style='position:relative'>";
            
            $class_name = '';
            if($this->menu_id == $menu_id){
                $class_name = 'selected';
            }

            $menu .= "<a class='$class_name $submenu_class' $submenu_attribute href='".base_url().$menu_url."?m_id=".$menu_id."'>";
            $menu .= "<i class='".$icon_class."'></i>  ".$menu_name." ".$down_arrow."</a>";

            $menu .= $submenu_html;

            $menu .= "</li>";

            $menus[] = $menu; 
        }
        
        $get_all_menu_info = $this->main_model->get_menu_model('All');
        foreach ($get_all_menu_info as $value) {
            $get_all_menu = '<option value="'.$value['menu_id'].'">'.$value['menu_name'].'</option>'.$this->create_menu($value['menu_id']);
            $all_menu[] = $get_all_menu;
        }
        return array('menu'=>$menus,'all_menu'=>$all_menu);
    }

/*==========================================  Get SubMenu List   ===================================================*/
    function display_children($parent) {
        $result = $this->main_model->get_menu($parent);
        $p =  "";
        
        foreach($result as $item){
            $class_name = '';
            if($this->input->get('m_id') == $item['menu_id']){
                $class_name = 'selected';
            }
            if ($item['Count'] > 0) {
                
                $p .= "<li>";
                $p .= "<a class='$class_name trigger right-caret' data-toggle='' href='#'></i> " . $item['menu_name'] . "</a>";
                $p .= "<ul class='dropdown-menu sub-menu'>";
                $p .= $this->display_children($item['menu_id']);
                $p .= "</ul>";
                $p .="</li>";
            } elseif ($item['Count']==0) {
                $p .= "<li><a class='$class_name' data-toggle='' href='" . base_url().$item['menu_url'] . "?m_id=".$item['menu_id']."'><i class='".$item['icon_class']."'></i> " . $item['menu_name'] . "</a></li>";
            } else;
        }
        //$this->menu_array = $p;
        return $p;
    }
    
    // Function for creating menu combobox
    function create_menu($parent) {
        static $str = 0;
        $str ++;
        $result = $this->main_model->get_menu($parent);
        $p =  "";
        $option_str = '';
                for($i=0;$i<$str;$i++)
                    $option_str .= '&nbsp;&nbsp; ';
        foreach($result as $item){
            if ($item['Count'] > 0) {
                $this->menu_array[$parent]['submenu'][$item['menu_id']] = array('menu_name'=>$item['menu_name'],'submenu'=>$this->create_menu($item['menu_id']));
                $p .= "<option value='".$item['menu_id']."'>$option_str&clubs; ".$item['menu_name']."</option>";
                $p .= $this->create_menu($item['menu_id']);
            } elseif ($item['Count']==0) {
                $this->menu_array[$parent]['submenu'][$item['menu_id']] = array('menu_name'=>$item['menu_name']);
                $p .= "<option value='".$item['menu_id']."'>$option_str&clubs; ".$item['menu_name']."</option>";
            }
        }
        //$p .= "</ul>";
        $str--;
        return $p;
    }
    
    //Function for creating module item
    function get_module_list(){
        if($this->user_id == 1){
            $query = $this->db->query("SELECT * FROM module");
        }
        else{
            $query = $this->db->query("SELECT
                    module.module_id as module_id,
                    module.module_name as module_name,
                    module.module_icon
                    FROM
                    privilege_module
                    INNER JOIN module ON privilege_module.user_module_id = module.module_id
                    WHERE
                    privilege_module.user_id = '$this->user_id'");
        }
        $module_html = '';
        foreach ($query->result_array() as $value) {
            $module_html.= "<li><a href='".  base_url()."module_switcher/change_module/".$value['module_id']."'><i class='".$value['module_icon']."'></i> ".$value['module_name']."</a></li>";
        }
        return $module_html;
    }
    
    function get_active_module(){
        $module_id = $this->session->userdata('default_module_id');
        $module_name = $this->db->query("SELECT module_name,module_icon FROM module WHERE module_id=$module_id")->row();
        return $module_name;
    }
    
    function dynamic_combo($name,$table_name,$id_field,$value_field,$where='',$class='',$selected_value = '',$required=False,$readonly=false,$ajax_target=null,$multiple=FALSE,$blank=FALSE){
        $sql = "SELECT $id_field,$value_field FROM $table_name $where";
        $query = $this->db->query($sql);
        $data  = array(''=>'--Select--');
        foreach($query->result_array() as $value){
            $data[$value[$id_field]] = $value[$value_field];
        }
        $combo = form_dropdown($name, $data, $selected_value,"class='$class' ".($required?'reqiured':'')."  ".($readonly?'disabled':'')." ".($multiple?'multiple':'')."");
        return $combo;
    }
    
    function create_menu_list_all($menu_id,$permitted_array){
        $result = $this->main_model->get_menu($menu_id);
        $p =  "<ul>";
        foreach($result as $item){
            if ($item['Count'] > 0) {              
                $p .= "<li><span>";
                $p .= "<input name='menu_id[]' type='checkbox' value='".$item['menu_id']."' ".(in_array($item['menu_id'], $permitted_array)?'checked':'')." />" . $item['menu_name'] ."</span>";
                $p .= "<ul>";
                $p .= $this->create_menu_list_all($item['menu_id'],$permitted_array);
                $p .= "</ul></li>";
            } elseif ($item['Count']==0) {              
                $p .= "<li><span><input name='menu_id[]' type='checkbox' value='".$item['menu_id']."' ".(in_array($item['menu_id'], $permitted_array)?'checked':'')." />" . $item['menu_name']."</span></li>";
            } else;
        }
        $p .= "</ul>";
        return $p;
    }
	
    function file_upload($config){
        foreach($_FILES as $key => $inf){
                $get_file = $key;
        }
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($get_file)){
            return $this->upload->display_errors();
        }
        else{
            return $this->upload->data();
        }
    }

    function check_privilege($menu_id, $privilege_index){
        //echo '<pre>';
        //print_r($this->get_permission_array);
        if( $this->user_id == 1 ){
            return TRUE;
        }else{
        //Check wherether the manu id exist in the array otherwise no nedd to check privilege
        if(array_key_exists($menu_id, $this->get_permission_array)){
            //echo '<pre>';
            
            $array_val = $this->get_permission_array;
            //print_r($array_val);
            //echo $array_val[$menu_id][$privilege_index];
            //exit;
            if( $array_val[$menu_id][$privilege_index] > 0 ){
                //echo 'I m here';
                //exit;
                return TRUE;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }
	
 }
 function check_page_privilege($menu_id){
    if( $this->user_id == 1 ){
        return TRUE;
    }elseif ($menu_id == '') {
            return TRUE;
    }else{
        if(array_key_exists($menu_id, $this->get_permission_array)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
 }
 // Created by Md. Riad Hossain
	// Detect and get whether a details view will be eanble for any master entry table
 function check_enable_view($table_name){
     $get_val = $this->db->query("SELECT enable_details_view,template_details_view FROM master_entry_table WHERE master_entry_table_name='$table_name'")->row();
     return $get_val;
 }
 
  function auto_cancel_poolcar_requisition(){
        $date = date('Y-m-d');
        $time = date('h:i:s');
        $this->db->query("UPDATE poolcar_requisition SET requisition_status = 4 
                            WHERE
                            requisition_date_to < '$date' AND requisition_time_to <'$time' AND (current_status_id = 11 OR current_status_id = 16)");      
 }
 
 function send_email($from_mail,$from_name,$to,$subject,$message,$attachment = array(),$cc = '',$bcc = ''){
        //$this->load->library('email');

        $this->email->from($from_mail, $from_name);
        $this->email->to($to); 
        $this->email->cc($cc); 
        $this->email->bcc($bcc);
        if(!empty($attachment)){
            if(is_array($attachment)){
                foreach($attachment as $file_path){
                    $this->email->attach($file_path);
                }
            }else{
                $this->email->attach($attachment);
            }
        }
        $this->email->subject($subject);
        $this->email->message($message);	

        $this->email->send();
    }
 //Detect Post from form
 function is_post() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
  }
  function get_menu_parent($child_id){
        $parent_id = NULL;
        do{
            $parent_id = $this->db->query("SELECT parent_menu_id FROM menu WHERE menu_id='$child_id'")->row()->parent_menu_id;
            //echo $this->db->last_query();
            $menu_id = $child_id;
            $child_id = $parent_id;
        }while($parent_id > 0);
        return $menu_id;
    }
/*==========================================   End  ===============================================================*/

}