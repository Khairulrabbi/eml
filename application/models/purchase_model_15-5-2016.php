<?php

class Purchase_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_vendor_list() {
        $query = $this->db->get('vendor');
        return $query->result_array();
    }

    public function get_product_list() {
        $query = $this->db->get('product');
        return $query->result_array();
    }

    public function add_summary($array) {
//        echo "<pre>";
//        print_r($array);
//        exit;
        $this->db->insert('purchase_order_summary', $array);
    }

    public function save_data($data, $table) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    public function update_data($data,$table,$where){
        $this->db->where($where);
        $this->db->update($table,$data);
        if(isset($where['purchase_id'])){
            return $where['purchase_id'];
        }
    }
    public function get_order_info($order_id){
            $this->db->select("purchase_order.*,status.status_name,vendor.vendor_name,shipping_method.shipping_method_name,currency.currency_name");
            $this->db->from("purchase_order");
            $this->db->join("status",'purchase_order.status=status.status_id');
            $this->db->join("vendor",'vendor.vendor_id=purchase_order.vendor_id');
            $this->db->join("currency",'currency.currency_id=purchase_order.currency_id','left');
            $this->db->join("shipping_method",'shipping_method.shipping_method_id=purchase_order.shipping_method_id',"left");
            $this->db->where("purchase_id",$order_id);
            $result= $this->db->get();
            //$ret = $query->row();
            return $result->row();
    }
	
	/*
	 *Function to query all details purchase list
     * created by Charlie 03-may-2016	 
     */
	public function get_all_purchase_history(){
		    
			$this->db->select("purchase_order.purchase_id,
			                   purchase_order.purchase_code,
                               vendor.vendor_name,
                               purchase_order.lc_number,
							   purchase_order.order_date,
							   purchase_order.shipping_date,
							   purchase_order.order_value,
							   `status`.status_name");			   
            $this->db->from("purchase_order");
			$this->db->join("vendor",'purchase_order.vendor_id = vendor.vendor_id','left');
            $this->db->join("status",'purchase_order.status=status.status_id','left');          
		    $result= $this->db->get();
            //$ret = $query->row();
            return $result->result_array();
	}
	
	
    public function get_selected_product($order_id){
            $this->db->select("*");
            $this->db->from("purchase_order_details");
            $this->db->join("product",'product.product_id=purchase_order_details.product_id');
            $this->db->where("purchase_order_id",$order_id);
            $result= $this->db->get();
            return $result->result_array();
        
    }
	
	 /*Added By Rokib Hasnat
     * This function get Packing Slip Data
     */
    
    public function get_packing_slip_data($order_id){
        $this->db->select("*,product.product_name");
        $this->db->from("purchase_order_details");
        $this->db->join("product",'product.product_id=purchase_order_details.product_id');
        $this->db->where("purchase_order_id",$order_id);
        $result= $this->db->get();
        return $result->result_array();
    }
    
    public function get_stock_manager_data($product_id){
        $this->db->select("product_stock_manager.product_code,product_stock_manager.serial_number");
        $this->db->from("product_stock_manager");
        $this->db->where("product_id",$product_id);
        $result= $this->db->get();
        return $result->result_array();
    }

}
