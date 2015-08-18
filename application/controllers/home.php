<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Custom_Controller {
    function __construct() {
    parent::__construct();
    $this->load->helper('url','html','form');
    $this->load->library('javascript');
    $this->load->library('session');
    $this->load->model('user_model','','TRUE');    
    }
/*-----------------------------------------------------------------------------------------*/
    public function index() {
        $level = $this->session->userdata('LEVEL_ID');
        if(empty($level)){
            redirect(base_url('login_cont'));
        }else{
            $this->render_page('index');
        }
        
    }
    
    function install_success(){
        $this->render_page('install_success');
    }
    
    function delete_intallation_directory(){
        echo $path = FCPATH.'install';
        $this->load->helper("file");
        delete_files($path, true);
        rmdir($path);
    }
    /*-----------------------------------------------------------------------------------------*/        
}