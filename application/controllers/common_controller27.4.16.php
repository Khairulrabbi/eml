<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_controller extends Custom_Controller {
    function __construct() {
    parent::__construct();
    $this->load->helper('url','html','form');
    $this->load->library('javascript');
    $this->load->library('session');
    $this->load->model('user_model','','TRUE');  
    $this->load->model('purchase_model');
    $this->load->model('common_model');
    }
/*-----------------------------------------------------------------------------------------*/
 
  public function get_sub_category(){
      $category_id = $this->input->post("category_id");
      echo sub_category_list(null, array('class' => 'sub_category_id', 'required' => 'required'),'product_subcategory_name',array("product_category_id"=>$category_id));
      
  }
   public function get_product_list_combo(){
      $category_id = $this->input->post("category_id");
      $brand_id = $this->input->post("brand_id");
      $sub_category_id = $this->input->post("sub_category_id");
      
      echo  product_list(null, array('class' => 'product_id', 'required' => 'required'),'product_name',array("product_category_id"=>$category_id,"product_subcategory_id"=>$sub_category_id,"product_brand_id"=>$brand_id));
      //echo $this->db->last_query();
  }
   public function get_product_list_view(){
      $category_id = $this->input->post("category_id");
      $brand_id = $this->input->post("brand_id");
      $sub_category_id = $this->input->post("sub_category_id");
      $sub_category_id = $this->input->post("product_id");
      $order_id = $this->input->post("order_id");
      
      $data = array();
      //$data['list']  = $this->common_model->get_product_list($this->input->post());
      $data['selected_product']= $this->get_product_plane_array($this->purchase_model->get_selected_product($order_id));
      //echo $this->db->last_query();
      //exit();
      $data['list']  = $this->common_model->get_product_list($this->input->post());
      echo $this->load->view("product_list",$data);
      
      //echo $this->db->last_query();
  }
  public function get_product_plane_array($array){
        $return_array = array();
         if(!empty($array)){
            foreach($array as $key=>$value){
                $return_array[]=$value['product_id'];
            }
        }
        return $return_array;
  }
}