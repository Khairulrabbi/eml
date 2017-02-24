<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Module_Switcher extends Custom_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('master_model');
        $this->load->library('session');
    }
    function change_module($id = null){
        if($id!=null){
            $this->session->set_userdata('default_module_id', $id);
            // ® Now get the home url if exist!
            $home_url = $this->master_model->get_module_url($id);
            if($home_url == '' || $home_url == NULL){
                redirect(base_url());
            }else{
                redirect(base_url($home_url));
            }
        }
    }
}