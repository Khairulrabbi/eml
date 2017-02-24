<?php

class Ticket_Model extends CI_Model {

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
        return $where['ticket_id'];
    }
    public function get_ticket_info($ticket_id){
            $this->db->select("t.*");
            $this->db->select("so.sales_code");
            $this->db->select("s.status_name");
            $this->db->select("u.username");
            $this->db->from("ticket t");
            $this->db->join("product_stock_manager psm","psm.product_code=t.product_code","left");
            $this->db->join("sales_order so","so.sales_id=psm.sale_order_id","left");
            $this->db->join("status s","s.status_id=t.service_status","left");
            $this->db->join("user u","u.user_id=t.assign","left");
            $this->db->where("t.ticket_id",$ticket_id);
            $result= $this->db->get();
            //debug($this->db->last_query(),1);
            return $result->row();
    }
    
    public function get_primary_observation_info($ticket_id){
            $this->db->select("*");
            $this->db->from("primary_observation");
            $this->db->where("ticket_id",$ticket_id);
            $this->db->limit(1);
            $this->db->order_by("primary_observation_id", "desc"); 
            $result= $this->db->get();
            return $result->row();
    }
    public function get_selected_product($order_id){
            $this->db->select("*");
            $this->db->from("purchase_order_details");
            $this->db->join("product",'product.product_id=purchase_order_details.product_id');
            $this->db->where("purchase_order_id",$order_id);
            $result= $this->db->get();
            return $result->result_array();
        
    }
	
		/*
	 *Function to query all details ticket list
     * created by Charlie 03-may-2016	 
     */
	 
	 public function get_all_ticket_history(){
            $this->db->select("t.*");
            $this->db->select("s.status_name");
            $this->db->select("u.user_id,u.username");
            
            $this->db->from("ticket t");
            $this->db->join("status s",'t.service_status=s.status_id','left');
            $this->db->join("user u",'u.user_id=t.assign','left');
            $result= $this->db->get();
            return $result->result_array();
        }
	 
	public function get_all_sales_product() 
        {   
        $this->db->select("product_stock_manager.product_code,
                            product_stock_manager.serial_number,
                            sales_order.sales_code,
                            customer.customer_name,
                            product.product_name,
                            customer.mobile_number,
                            `user`.first_name,
                            sales_order.delivery_date");
        $this->db->from("product_stock_manager");
        $this->db->join("sales_order","product_stock_manager.sale_order_id = sales_order.sales_id","left");
        $this->db->join("customer","sales_order.customer_id = customer.customer_id","left");
        $this->db->join("product","product_stock_manager.product_id = product.product_id","left");
        $this->db->join("user","sales_order.sales_person_id = user.user_id","left");
        
        $result= $this->db->get();
            //$ret = $query->row();
        return $result->result_array();
             
    }
	
	public function fetch_product_info($p_code){
		$sql = "SELECT
				product_subcategory.product_subcategory_name,
				product_category.product_category_name,
				product_brand.product_brand_name,
				product.product_name,
				product_stock_manager.serial_number
				FROM
				product_stock_manager
				INNER JOIN product ON product_stock_manager.product_id = product.product_id
				INNER JOIN product_brand ON product.product_brand_id = product_brand.product_brand_id
				INNER JOIN product_category ON product.product_category_id = product_category.product_category_id
				INNER JOIN product_subcategory ON product.product_subcategory_id = product_subcategory.product_subcategory_id
				WHERE
				product_stock_manager.product_code ='$p_code'";
				
		$result= $this->db->query($sql);
            //$ret = $query->row();
        return $result->row();
		
	}

        public function sales_code_for_autocomplete_token()
        {
            $this->db->select("sales_code");
            $this->db->from("sales_order");
            $this->db->where("sales_status",27);
            $rows = $this->db->get()->result();
            $data_array = array();
            foreach ($rows as $val)
            {
                $data_array[] = $val->sales_code;
            }
            return json_encode($data_array);
        }
        
        public function product_info_for_autocomplete_token()
        {
            $this->db->select("p.product_name");
            $this->db->from("product_stock_manager ps");
            $this->db->join("product p","p.product_id=ps.product_id","left");
            $this->db->group_by("p.product_id");
            //$this->db->where("sales_status",27);
            $rows = $this->db->get()->result();
            
            $product_name = array();
            foreach ($rows as $val)
            {
                $product_name[] = $val->product_name;
            }
            
            return json_encode($product_name);            
        }
        
    public function get_token_list()
    {       
        return $this->db->query("SELECT 
                t.token_code,
                t.datetime as date,
                so.sales_code,
                u.username as sales_person,
                t.customer_name,
                t.customer_mobile,
                t.product_name,
                t.product_stock_id as product_code,
                CASE WHEN t.token_status = 0 THEN 'Token Draft' ELSE 'Ticket Created' END as token_status, 
                t.token_id as id, 
                t.token_status as ts 
                FROM token t 
                LEFT JOIN sales_order so ON so.sales_id=t.sales_id 
                LEFT JOIN user u ON u.user_id=so.sales_person_id 
                ")->result_array();
    }
    
    public function token_info($token_id)
    {
        $this->db->select("t.token_id,ps.product_code,t.token_code,t.customer_name,t.sales_id,t.customer_mobile,t.product_name,t.customer_address,t.problem_details");
        $this->db->from("token t");
        $this->db->join("product_stock_manager ps","ps.product_code=t.product_stock_id","left");
        $this->db->where("t.token_id",$token_id);
        return $this->db->get()->row();
    }
    
    public function token_info_for_token_to_ticket($token_id)
    {
        return $this->db->query("SELECT t.token_id,
                                t.customer_name,
                                t.customer_mobile,
                                t.product_name,
                                t.customer_address,
                                t.problem_details,
                                ps.product_id,
                                ps.product_code,
                                ps.warranty_start_date as warranty_start,
                                ps.warranty_expired_on as warranty_end,
                                ps.customer_warranty_start_date as customer_warranty_start,
                                ps.customer_warranty_end_date as customer_warranty_end,
                                so.sales_code,
                                (SELECT case when d.customer_warranty_end_date is null then 0 else case when DATEDIFF(d.customer_warranty_end_date,now())>=0 then DATEDIFF(d.customer_warranty_end_date,now()) else 0 end end FROM product_stock_manager d LEFT JOIN token dt ON dt.product_stock_id=d.product_code WHERE dt.token_id=$token_id) as customer_warranty_left,
                                (SELECT case when d2.warranty_expired_on is null then 0 else case when DATEDIFF(d2.warranty_expired_on,now())>=0 then DATEDIFF(d2.warranty_expired_on,now()) else 0 end end FROM product_stock_manager d2 LEFT JOIN token dt2 ON dt2.product_stock_id=d2.product_code WHERE dt2.token_id=$token_id) as warranty_left
                FROM token t 
                LEFT JOIN product_stock_manager ps ON ps.product_code=t.product_stock_id 
                LEFT JOIN sales_order so ON so.sales_id=ps.sale_order_id 
                WHERE t.token_id=".$token_id)->row();
//        $this->db->select("t.token_id,t.customer_name,t.customer_mobile,t.product_name,t.customer_address,t.problem_details");
//        $this->db->select("ps.product_id,ps.product_code,ps.warranty_start_date as warranty_start,ps.warranty_expired_on as warranty_end,ps.customer_warranty_start_date as customer_warranty_start,ps.customer_warranty_end_date as customer_warranty_end");
//        $this->db->select("so.sales_code");
//        $this->db->from("token t");
//        $this->db->join("product_stock_manager ps","ps.product_code=t.product_stock_id","left");
//        $this->db->join("sales_order so","so.sales_id=ps.sale_order_id","left");
//        $this->db->where("t.token_id",$token_id);
//        return $this->db->get()->row();
    }
    
    public function get_ordered_product_info($order_id,$product_code=NULL)
    {
        $this->db->select("p.product_id,p.product_name,psm.product_code,psm.warranty_start_date,psm.warranty_period,psm.warranty_expired_on,psm.customer_warranty_start_date,psm.customer_warranty_end_date,psm.customer_warranty_period");
        $this->db->select("c.customer_name,c.mobile_number,c.address");
        $this->db->from("product_stock_manager psm");
        $this->db->join("sales_order so","so.sales_id=psm.sale_order_id","left");
        $this->db->join("customer c","c.customer_id=so.customer_id","left");
        $this->db->join("product p","p.product_id=psm.product_id","left");
        $this->db->where("psm.sale_order_id",$order_id);
        if($product_code)
        {
            $this->db->where("psm.product_code",$product_code);
        }
        $result = $this->db->get();
        return $result;
    }  
}
