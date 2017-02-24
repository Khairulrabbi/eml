<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchase extends Custom_Controller {
    function __construct() {
    parent::__construct();
    $this->load->helper('url','html','form');
    $this->load->library('javascript');
    $this->load->library('session');
    $this->load->model('user_model','','TRUE');  
    $this->load->model('purchase_model');
    }
/*-----------------------------------------------------------------------------------------*/
  public function add_new(){
       $data['vendor'] = $this->purchase_model->get_vendor_list();
	   $data['product'] = $this->purchase_model->get_product_list();
       $data['title'] = 'Create Purchase Order';
       $this->render_page('purchase_form',$data);
        //$this->load->view('customer', $data);
  } 
  public function purchase_summary(){
	  
	  $vendor=$this->input->post('vendor');
	  $order_no=$this->input->post('order_no');
	  $lc_no=$this->input->post('lc_no');
	  $order_date=$this->input->post('order_date');
	  $shipping_date=$this->input->post('shipping_date');
	  $data=array('vendor'=>$vendor,
	              'order_no'=>$order_no,
				  'lc_no'=>$lc_no,
				  'order_date'=>$order_date,
				  'shipping_date'=>$shipping_date
				  );
	  
	  $this->purchase_model->add_summary($data);
  }  
}