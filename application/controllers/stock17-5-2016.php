<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stock extends Custom_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url', 'html', 'form');
        $this->load->library('javascript');
        $this->load->library('session');
        $this->load->model('user_model', '', 'TRUE');
        $this->load->model('stock_model');
        $this->load->database();
    }
	
	public function new_stock(){
        $this->render_page('stock/new_stock');
    }
    
   public function current_stock(){
        $post = $this->input->post();
        $where ='';
        if(!empty($post)){
            unset($post['search_panel']);
            foreach ($post as $key=>$val){
                $where .='product_stock_manager.'.$key .'='.$val.' AND ';
        }
    }
        
        $data['title']="Current Stock";
        $data['products']=  $this->stock_model->current_stock_data($where);
        $this->render_page('stock/current_stock_view',$data);
    }
    
    public function new_transfer($transfer_requerst_number = NULL){
        if($transfer_requerst_number){
            $data['transfer_data']=$this->stock_model->get_stock_transfer_data($transfer_requerst_number);
            $data['transfer_requerst_number']=$transfer_requerst_number;
        }
        $data['title']="Create Transfer";
        $data['warehouse_list']=  $this->stock_model->get_warehouse_list();
        $data['current_stock']= $this->stock_model->current_stock_data();
        $this->render_page('stock/new_stock_transfer_view',$data);
        
    }
    
    public function save_transfer(){
        
    }
    
    public function get_product_list_view_for_transfer(){
        
        $data = array();
        $data['list']  = $this->stock_model->get_product_list_for_transfar($this->input->post());
        echo $this->load->view("stock/product_list_for_transfer",$data);
    }
    
    public function save_transfer_products(){
        
        $transfer_requerst = $this->input->post("transfer_requerst");
        
        if(empty($transfer_requerst)){
            $transfer_request_number = $this->generate_random_string(5);
        }else{
            $transfer_request_number = $transfer_requerst;
        }
        
        $transfer_from= $this->input->post("transfer_from");
        $transfer_to = $this->input->post("transfer_to");
        $product_code=$this->input->post("product_code");
        foreach ($product_code as $key => $values) {
            $sql = $this->db->query("INSERT INTO stock_transfer (
                transfer_request_number,
                transfer_from,
                transfer_to,
                product_id,
                product_code,
                serial_no,
                created_by,
                transfer_status_id
                )
                (
                        SELECT
                                '$transfer_request_number',
                                '$transfer_from',
                                '$transfer_to',
                                product_id,
                                product_code,
                                serial_number,
                                '$this->user_id',
                                11
                        FROM
                                product_stock_manager
                        WHERE
        product_stock_manager.product_code = '$values'

                )");
        }
        redirect("stock/new_transfer/$transfer_request_number");
    }
    
    public function generate_random_string($length) {
        $str = "";
	$characters = array_merge(range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
    }
	
	
	/* A function To recieve product
     * 
     */
    
    public function lc_product_recieve_list(){
        
        $data['table_data'] = $this->stock_model->lc_product_recieve_list();
        $data['title'] = 'Lc Product Recieve';
        $this->render_page('stock/lc_product_recieve_list',$data);
    }
    
    public function lc_product_receive_confirmation($purchase_id,$product_id){
        $data['table_data'] = $this->stock_model->lc_product_recieve_confirmation($purchase_id,$product_id);
        $data['title'] = 'Lc Product Receive Confirmation';
        $data['purchase_id'] =$purchase_id;
        $this->render_page('stock/lc_product_receive_confirmation',$data);
    }
    
    public function change_status_to_good_receive(){
        $post = $this->input->post();
        $purchase_id =$post['purchase_id'];
		
		 foreach($post['data'] as $val){
			 
			 $serial_no = $val['serial_no'];
			 $warehouse_id = $val['warehouse_id']; 
			 $this->stock_model->change_status_to_good_receive($serial_no,$purchase_id,$warehouse_id);
			 
		 }
        
       
        
    }
	
	
	/*Current stock details view with serial no,product code
	*
	*created by charlie 17 may,16
	*/
	
	public function current_stock_details($product_id,$warehouse_id){
		
		$data['table_data'] = $this->stock_model->individual_details_stock_view($product_id,$warehouse_id);
        $data['title'] = 'Individual Details Stock View';
        $this->render_page('stock/individual_details_stock_view',$data);
	}
	
	public function product_details_information($product_code){
            $data['table_data'] = $this->stock_model->product_details_information($product_code);
            $this->render_page('stock/product_details_information',$data);
       }
	
	
}