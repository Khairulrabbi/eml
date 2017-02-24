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
  public function add_new($order_id=NULL){
       $data['selected_product']= $this->purchase_model->get_selected_product($order_id);
       $data['order_id'] =$order_id;
       $order_info = $this->purchase_model->get_order_info($order_id);
       //echo $this->db->last_query();
       //exit();
       $data['order_info'] = $order_info;
       $data['selected_product_list'] = $this->load->view("selected_product_list",$data,true);
       $data['vendor'] = $this->purchase_model->get_vendor_list();
       if($order_id){
           $data['purchase_code'] = $order_info->purchase_code;
           $data['status'] = $order_info->status_name;
           $data['vendor_id'] = $order_info->vendor_id;
           $data['lc_number'] = $order_info->lc_number;
           $data['order_date'] = $order_info->order_date;
           $data['due_date'] = $order_info->due_date;
           $data['currency_id'] = $order_info->currency_id;
           $data['request_ship_date'] = $order_info->request_ship_date;
           $data['taxing_scheme'] = $order_info->taxing_scheme;
           $data['remarks'] = $order_info->remarks;
           $data['exchange_rate'] = $order_info->exchange_rate;
           $data['shipping_advice'] = $order_info->shipping_advice;
           $data['shipping_method_id'] = $order_info->shipping_method_id;
           $data['lc_value'] = $order_info->lc_value;
           $data['lc_value'] = $order_info->lc_value;
           $data['bill_of_entry'] = $order_info->bill_of_entry;
           $data['bill_of_leading'] = $order_info->bill_of_leading;
           
       }  else {
           $data['purchase_code'] = $this->get_code();
           $data['status'] ='Draft';
           $data['vendor_id'] = '';
           $data['lc_number'] = '';
           $data['order_date'] = '';
           $data['due_date'] = '';
           $data['currency_id'] = '';
           $data['request_ship_date'] = '';
           $data['taxing_scheme'] = '';
           $data['remarks'] = '';
           $data['exchange_rate'] = '1.00';
           $data['shipping_advice'] = '';
           $data['shipping_method_id'] = '';
           $data['lc_value'] = '0.00';
           $data['bill_of_entry'] = '0.00';
           $data['bill_of_leading'] = '0.00';
       }
       
       $data['product'] = $this->purchase_model->get_product_list();
       $data['title'] = 'Create Purchase Order';
       $this->render_page('purchase_form',$data);
        //$this->load->view('customer', $data);
  } 
  public function get_code(){
      return rand();
  }
  public function save_order_details(){
      $purchase_order_id = $this->input->post("order_id");
      $product_id = $this->input->post("product_id");
      $purchase_price = $this->input->post("purchase_price");
      foreach ($product_id as $key=>$values){
          $data=array();
          $data['product_id']=$values;
          $data['purchase_price']=($purchase_price[$key])? $purchase_price[$key]:0;
          $data['purchase_order_id']=$purchase_order_id;
          $data['quantity']=1;
          $return_id = $this->purchase_model->save_data($data,'purchase_order_details');
      //echo $this->db->last_query()."<br>";
     
      }
       //exit();
      redirect("purchase/add_new/$purchase_order_id");
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
  public function get_sub_category(){
      $category_id = $this->input->post("category_id");
      echo sub_category_list(null, array('class' => 'sub_category_id', 'required' => 'required'),'product_subcategory_name',array("product_category_id"=>$category_id));
      
  }
  public function save_purchase_order(){
      $data=array();
      $order_id=$this->input->post('main_order_id');
      //echo $order_id;
      //exit();
      $data['vendor_id'] = $this->input->post('vendor_id');
      $data['purchase_code'] = $this->input->post('purchase_code');
      $data['lc_number'] = $this->input->post('lc_number');
      $data['order_date'] = $this->input->post('order_date');
      $data=  $this->input->post();
      $data['status']=5;
      unset($data['main_order_id']);
      if($order_id){
          //echo "h";
          $where = array("purchase_id"=>$order_id);
          $return_id = $this->purchase_model->update_data($data,'purchase_order',$where);
      }  else {
          //echo "he";
          $return_id = $this->purchase_model->save_data($data,'purchase_order');
      }
      //exit();
      echo $return_id;
  }
  public function delete_product(){
      $order_details_id = $this->input->post('order_details_id');
      $this->db->where("purchase_order_details_id",$order_details_id);
      $this->db->delete("purchase_order_details");
      echo 1;
  }
  public function update_product_details(){
      $order_details_id = $this->input->post('order_details_id');
      $where = array("purchase_order_details_id"=>$order_details_id);
      $data = $this->input->post();
      unset($data['order_details_id']);
      $this->purchase_model->update_data($data,"purchase_order_details",$where);
  }
  public function update_order(){
      $order_details_id = $this->input->post('order_id');
      $where = array("purchase_id"=>$order_details_id);
      $data = $this->input->post();
      $data['status']=6;
      unset($data['order_id']);
      unset($data['update_order']);
      unset($data['order_details_id']);
      $this->purchase_model->update_data($data,"purchase_order",$where);
      redirect("purchase/add_new");
  }
  public function check_order_details(){
      $order_id = $this->input->post("order_id");
      $query = $this->db->query("SELECT * FROM purchase_order_details where purchase_order_id= $order_id");
        echo $query->num_rows();
  }
}