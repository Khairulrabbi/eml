<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_cont extends Custom_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('url','html','form');
        $this->load->library('session');
        $this->load->library('user_agent');
        $this->load->model('login_model','','TRUE');
        $this->load->model('user_model','','TRUE');
        $this->load->library('../controllers/home');
    }
    
    function index() {
        if($this->session->userdata('LEVEL_ID') != '' || $this->user_id == 1){
            redirect('home');
        }
        else{
            $redirect_url['re_url'] = $this->input->get('url');
            $this->load->view('login',$redirect_url);
        }
    }
    
    function login() {
        $this->load->library('session');
        // Grab the email and password from the form POST
        $user = $this->input->post('user_name');
        $pass  = md5($this->input->post('password'));
        $redirect_url = $this->input->post('re_url');

        if( $user && $pass && $this->login_model->validate_user($user,$pass)) {
            $user_id = $this->login_model->user_info($user,$pass);
            if(!empty($redirect_url)){
                redirect($redirect_url);
            }
            else{
                $get_url_data = $this->login_model->user_default_url($user_id);
                print_r($user_id);
                redirect($get_url_data->default_url);

            }
        } else {
            $this->session->set_flashdata('recovery_message', '<div class="alert alert-danger alert-dismissable">Your username and password does not match.<br/>Please retry correctly.</div>');
            redirect('/login_cont');
        }
    }
    
    function logout(){
        $this->session->sess_destroy();
        redirect('/login_cont');
    }
    
    function forgot(){
        $this->load->view('forget_login');
    }
    
    
    function gain_pass(){
        $email = $this->input->post('email');
        $password = rand(11111111,99999999);
        
        $rec = $this->login_model->forget_action($email,$password);
        foreach ($rec as $record) {
            $mail_add = $record['email'];
            $first_name = $record['first_name'];
            $last_name = $record['last_name'];
        }
        $subject = "Password recovery of Lafarge";
        $message = "Dear ".$first_name." ".$last_name." your new paswword is ".$password;
        if(!empty($record)){
            $this->send_email('admin.pm@apsissolutions.com', 'Admin', $mail_add, $subject, $message);
            //$this->send_email($mail_add, $subject, $message);
            //mail($mail_add, $subject, $message);
            $this->session->set_flashdata('recovery_message', '<div class="alert alert-success alert-dismissable">Dear '.$first_name.' '.$last_name.' your new paswword has been sent to '.$mail_add.'. </div>');
        }
        else{
            $this->session->set_flashdata('recovery_message', '<div class="alert alert-danger alert-dismissable">Enter a correct email or register for user.</div>');
        }
        redirect('login_cont'); 
    }
}
