<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends Custom_Controller {
    function __construct() {
    parent::__construct();
    $this->load->helper('url','html','form');
    $this->load->library('javascript');
    $this->load->library('session');
    $this->load->model('user_model','','TRUE');  
    $this->load->model('customer_model');
    }
/*-----------------------------------------------------------------------------------------*/
  public function get_customer_list(){
       $data['table_data'] = $this->customer_model->get_customer_list();
        $data['title'] = 'Customer List';
        $this->render_page('customer',$data);
        //$this->load->view('customer', $data);
  }
  
   public function add_customer(){
       $data['title'] = "Add a new Customer";
	   $this->render_page('add_customer_form',$data);
   }  
}
