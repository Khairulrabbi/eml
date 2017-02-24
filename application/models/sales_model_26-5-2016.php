<?php

class Sales_Model extends CI_Model {

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
        $this->db->insert('sales_order_summary', $array);
    }

    public function save_data($data, $table) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    public function update_data($data,$table,$where){
        $this->db->where($where);
        $this->db->update($table,$data);
        return $where['sales_id'];
    }
    public function get_order_info($order_id){
            $this->db->select("sales_order.*,status.status_name,customer.customer_name, 
                    shipping_method.shipping_method_name,
                    currency.currency_name,
                    payment_type_name,
                    CONCAT(user.first_name,' ',user.last_name) AS sales_person_name,
                    delivery_mode_name
                    ",false);
            $this->db->from("sales_order");
            $this->db->join("status",'sales_order.sales_status=status.status_id');
            $this->db->join("customer",'customer.customer_id=sales_order.customer_id');
            $this->db->join("currency",'currency.currency_id=sales_order.currency_id','left');
            $this->db->join("shipping_method",'shipping_method.shipping_method_id=sales_order.shipping_method_id',"left");
            $this->db->join("payment_type",'payment_type.payment_type_id=sales_order.payment_type_id',"left");
            $this->db->join("delivery_mode",'delivery_mode.delivery_mode_id=sales_order.delivery_mode_id',"left");
            $this->db->join("user",'user.user_id=sales_order.sales_person_id',"left");
            $this->db->where("sales_id",$order_id);
            $result= $this->db->get();
            //$ret = $query->row();
            return $result->row();
    }
	
		/*
	 *Function to query all details sales order list
     * created by Charlie 04-may-2016	 
     */
	 public function get_all_sales_order_history(){
            $this->db->select("sales_order.*,status.status_name,customer.customer_name, 
                    shipping_method.shipping_method_name,
                    currency.currency_name,
                    payment_type_name,
                    CONCAT(user.first_name,' ',user.last_name) AS sales_person_name,
					product.product_name,
                    delivery_mode_name,sales_order_details.*
                    ",false);
            $this->db->from("sales_order");
			$this->db->join("sales_order_details",'sales_order.sales_id=sales_order_details.sales_order_id','left');
            $this->db->join("status",'sales_order.sales_status=status.status_id');
            $this->db->join("customer",'customer.customer_id=sales_order.customer_id');
            $this->db->join("currency",'currency.currency_id=sales_order.currency_id','left');
            $this->db->join("shipping_method",'shipping_method.shipping_method_id=sales_order.shipping_method_id',"left");
            $this->db->join("payment_type",'payment_type.payment_type_id=sales_order.payment_type_id',"left");
            $this->db->join("delivery_mode",'delivery_mode.delivery_mode_id=sales_order.delivery_mode_id',"left");
            $this->db->join("user",'user.user_id=sales_order.sales_person_id',"left");
			$this->db->join("product",'sales_order_details.product_id=product.product_id','left');
            
            $result= $this->db->get();
            //$ret = $query->row();
            return $result->result_array();
    }
	 
	
    public function get_selected_product($order_id){
            $this->db->select("*");
            $this->db->from("sales_order_details");
            $this->db->join("product",'product.product_id=sales_order_details.product_id');
            $this->db->where("sales_order_id",$order_id);
            $result= $this->db->get();
            //echo $this->db->last_query();
            //exit();
            return $result->result_array();
        
    }

}
