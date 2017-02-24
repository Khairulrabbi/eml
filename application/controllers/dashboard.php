<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Custom_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('url','html','form');
        $this->load->library('javascript');
        $this->load->library('session');
        $this->load->model('user_model','','TRUE');  
        $this->load->model('customer_model');
    }
    
    public function index(){
        $data = array();
        //print_r($data['Total_Retailer_info']);exit();
        $this->render_page('dashboard', $data);
    }
    
    public function purchase(){
        $data = array();
        //print_r($data['Total_Retailer_info']);exit();
        $this->render_page('purchase/dashboard', $data);
    }
    
    public function inventory(){
        $data = array();
        //print_r($data['Total_Retailer_info']);exit();
        $this->render_page('inventory/dashboard', $data);
    }
    
    public function sales(){
        $data = array();
        //print_r($data['Total_Retailer_info']);exit();
        $this->render_page('sales/dashboard', $data);
    }
    
    public function warranty(){
        $data = array();
        //print_r($data['Total_Retailer_info']);exit();
        $this->render_page('warranty/dashboard', $data);
    }
}
