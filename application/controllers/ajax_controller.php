<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_controller extends Custom_Controller {
    function __construct() {
    parent::__construct();
    $this->load->helper('url','html','form');
    $this->load->library('javascript');
    $this->load->library('session');
    $this->load->helper('search_helper');
    //$this->load->model('ajax_model','','TRUE');  
    
    }
/*-----------------------------------------------------------------------------------------*/
 
  public function get_sub_category(){
      $product_category_id = $this->input->post("product_category_id");
      echo sub_category_list(null, array('class' => 'product_subcategory_id'),'product_subcategory_id',array("product_category_id"=>$product_category_id));
      
  }
   public function get_product_list_combo(){
      $product_category_id = $this->input->post("product_category_id");
      $product_brand_id = $this->input->post("product_brand_id");
      $product_subcategory_id = $this->input->post("product_subcategory_id");
      $where = array();
      if($product_category_id){
          $where['product_category_id'] =$product_category_id;
      }
      if($product_brand_id){
          $where['product_brand_id'] =$product_brand_id;
      }
      if($product_subcategory_id){
          $where['product_subcategory_id'] =$product_subcategory_id;
      }

      echo  product_list(null, array('class' => 'product_id'),'product_id',$where);
      //echo $this->db->last_query();
  }
  
    public function change_input_html()
    {
        $title_name = $_POST['title_name'];
        $function_name = $_POST['function_name'];
        echo $function_name('', '', $title_name, $where = NULL);
    }
    
    public function appendSearchPanel()
    {
        $title_id = $_POST['title_id'];
        $title_name = $_POST['title_name'];
        $function_name = $_POST['function_name'];
        $input_name = $_POST['input_name'];
        $label_slug = $_POST['label_slug'];
        $search_item = $_POST['search_item'];
        $search_item = json_decode($search_item);
        $input_html='';
        $input_html .= "<div class='form-group ' style='margin-bottom:8px !important'>";
        $input_html .= "<label style='margin-top:4px; cursor:pointer' for='product_id' class='col-lg-5 control-label search_field_name'><span class='label_class' id='".$label_slug."'>$title_name</span> <i class='fa fa-caret-down'></i></label>";
        $input_html .= "<ul class='morefunction'>".search_title($search_item)."</ul>";
        
        $input_html .= "<div class='inputParrent'>";
        $input_html .= "<div class='$function_name col-lg-7'>";
        $input_html.= $function_name('', '', $input_name, $where = NULL);
        $input_html .= "</div>";
        $input_html .= "</div>";
        $input_html .= "</div> ";
        
        $html ="<div class='col-lg-4'>";
        $html .=$input_html;
        $html .="</div>";
        
        echo $html;
    }
  
}