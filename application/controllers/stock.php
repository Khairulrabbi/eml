<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stock extends Custom_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url', 'html', 'form');
        $this->load->helper('search_helper');
        $this->load->library('javascript');
        $this->load->library('session');
        $this->load->model('user_model', '', 'TRUE');
        $this->load->model('stock_model');
        $this->load->model('inventory_model');
        $this->load->model('purchase_model');
        $this->load->database();
    }
	
	public function new_stock(){
        $this->render_page('stock/new_stock');
    }
    
   public function current_stock($type){
        $where ='1';  
        $data['type'] = $type;
        $data['sql']=  $this->stock_model->current_stock_data($where,$type);
        $this->render_page('stock/current_stock_view',$data);
    }
    
    
    public function current_stock_search($type)
    {
        //debug($type,1);
        $post = $this->input->post();
        //debug($post,1);
        $where ='1';
        $table = 'product';
        foreach ($post as $k=>$pv)
        {
            if($pv)
            {
                if($k == 'warehouse_id')
                {
                    $table = 'purchase_good_receive';
                }
                $where .= ' AND '.$table.'.'.$k.'="'.$pv.'"';
            }
        }
        $data['type'] = $type;
        $data['sql'] = $this->stock_model->current_stock_data($where,$type);
        $this->load->view("stock/current_stock_view_ajax_list",$data);
    }
    
    
    public function current_stock_details($product_id,$warehouse_id){	  
        $data['product_id'] = $product_id;
        $data['warehouse_id'] = $warehouse_id;
        $data['table_data'] = $this->stock_model->individual_details_stock_view($product_id,$warehouse_id);
        $data['title'] = 'Individual Details Stock View';
        $this->render_page('stock/individual_details_stock_view',$data);
    }
    
    public function current_stock_details_search($product_id,$warehouse_id){
        $post = $this->input->post();
//        print_r($post);
//        exit();
        $where = '1';
        foreach ($post as $k=>$v)
        {
            if ($v){
                if($k == "warehouse_id")
                {
                    $where .=' AND purchase_good_receive.'.$k.'="'.$v.'"';
                }

                else
                {
                    $where .=' AND product.'.$k.'="'.$v.'"';
                } 
            }
        }
        $data['table_data'] = $this->stock_model->individual_details_stock_view($product_id,$warehouse_id,$where);
        $this->load->view('stock/individual_details_stock_view_ajax_list',$data);
    }

    public function current_stock_details_indent_number_wise($product_id,$warehouse_id){
        $data['product_id'] = $product_id;
        $data['warehouse_id'] = $warehouse_id;
        $data['table_data'] = $this->stock_model->individual_details_stock_view_indent_number_wise($product_id,$warehouse_id);
        $data['title'] = 'Individual Details Stock View Indent Number wise';
        $this->render_page('stock/individual_details_stock_view_indent_number_wise',$data);
    }
    
    
    public function individual_details_stock_search_indent_number_wise($product_id,$warehouse_id){
        $post = $this->input->post();
        $where = '1';
        foreach ($post as $k=>$v)
        {
            if ($v){
                if($k == "indent_number")
                {
                    $where .=' AND purchase_good_receive.'.$k.'="'.$v.'"';
                }
                else
                {
                    $where .=' AND product.'.$k.'="'.$v.'"';
                } 
            }
        }
        $data['table_data'] = $this->stock_model->individual_details_stock_view_indent_number_wise($product_id,$warehouse_id,$where);
        $this->load->view("stock/individual_details_stock_view_indent_number_wise_ajax_list",$data);
    }
    
    public function add_item_cart()
    {
        $product_id = $_POST['product_id'];
        $list_type = $_POST['list_type'];
        echo $this->stock_model->insert_cart_back_total($product_id,$list_type);
    }
    
    public function delete_item_cart()
    {
        $product_id = $_POST['product_id'];
        $list_type = $_POST['list_type'];
        echo $this->stock_model->delete_cart_back_total($product_id,$list_type);
    }

    

    public function new_transfer($transfer_requerst_number = NULL){
        if($transfer_requerst_number){
            $data['transfer_data']=$this->stock_model->get_stock_transfer_data($transfer_requerst_number);
            $data['transfer_requerst_number']=$transfer_requerst_number;
        }
        $data['title']="Create Transfer";
        $data['warehouse_list']=  $this->stock_model->get_warehouse_list();
        $data['current_stock']= $this->stock_model->current_stock_data('1 AND ');
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
        $data['title'] = 'LC Product Receive';
        $this->render_page('stock/lc_product_recieve_list',$data);
    }
    
    public function local_product_stock(){
        $data['table_data'] = $this->purchase_model->get_all_purchase_history('local');
        $data['title'] = 'Local Product Receive';
        $this->render_page('stock/local_product_recieve_list',$data);
    }
    
    public function lc_product_receive_confirmation(){
        $purchase_id = $this->input->post('purchase_id');
        $product_id = $this->input->post('product_id');		
        $data['table_data'] = $this->stock_model->lc_product_recieve_confirmation($purchase_id,$product_id);
        $data['title'] = 'Lc Product Receive Confirmation';
        $data['purchase_id'] =$purchase_id;
        $data['warehouse'] = $this->input->post('warehouse');
		$data['warehouse_id'] = $this->input->post('warehouse_id');

        $this->render_page('stock/lc_product_receive_confirmation',$data);
    }
    
    public function change_status_to_good_receive(){
        $post = $this->input->post();
        //debug($post,1);
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
	
	
        
        
	
	public function product_details_information($product_code){
            $data['table_data'] = $this->stock_model->product_details_information($product_code);
            $this->render_page('stock/product_details_information',$data);
       }
	
	
       
}