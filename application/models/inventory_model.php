<?php
//This Model is created by Khairul
class Inventory_Model extends CI_Model {
	public function __construct() {
		$this->load->Database();
	}
        
//Get the product List joining multiple table
	public function get_product_list() {
            $this->db->select("p.product_name,p.sdta,v.vehicle_type_name,u.username AS created_by,p.created,p.status,p.product_id AS id");
            $this->db->from("product p");
            $this->db->join("product_category c","c.product_category_id=p.product_category_id","left");
            $this->db->join("vehicle_type v","v.vehicle_type_id=p.vehicle_type_id","left");
            $this->db->join("user u","u.user_id=p.created_by","left");
            if($_POST)
            {
                $product_category_id = $this->input->post('product_category_id');
                $product_subcategory_id = $this->input->post('product_subcategory_id');
                $product_brand_id = $this->input->post('product_brand_id');
                $product_id = $this->input->post('product_id');
                
                if($product_category_id != "")
                {
                    $this->db->where("p.product_category_id",$product_category_id);
                }
                if($product_subcategory_id != "")
                {
                    $this->db->where("p.product_subcategory_id",$product_subcategory_id);
                }
                if($product_brand_id != "")
                {
                    $this->db->where("p.product_brand_id",$product_brand_id);
                }
                if($product_id != "")
                {
                    $this->db->where("p.product_id",$product_id);
                }
            }
            
            return $this->db->get()->result_array();
	}
        
        
        
      

        public function get_segregation_lists() {
            $this->db->select("p.product_name,v.vendor_name,ps.purchase_price_usd,ps.purchase_price as purchase_price_bdt,ps.good_recieve_date as recieve_date,ps.warranty_start_date as warranty_start,ps.warranty_expired_on as warranty_expire,w.warehouse_name,ps.packing_slip_date,s.status_name,ps.product_code AS id");
            $this->db->from("product_stock_manager ps");
            $this->db->join("product p","p.product_id=ps.product_id","left");
            $this->db->join("vendor v","v.vendor_id=ps.vendor_id","left");
            $this->db->join("warehouse w","w.warehouse_id=ps.current_warehouse_location","left");
            $this->db->join("status s","s.status_id=ps.status_id","left");
            //unnecessary
//            if($_POST)
//            {
//                $product_category_id = $this->input->post('product_category_id');
//                $product_subcategory_id = $this->input->post('product_subcategory_id');
//                $product_brand_id = $this->input->post('product_brand_id');
//                $product_id = $this->input->post('product_id');
//                
//                if($product_category_id != "")
//                {
//                    $this->db->where("p.product_category_id",$product_category_id);
//                }
//                if($product_subcategory_id != "")
//                {
//                    $this->db->where("p.product_subcategory_id",$product_subcategory_id);
//                }
//                if($product_brand_id != "")
//                {
//                    $this->db->where("p.product_brand_id",$product_brand_id);
//                }
//                if($product_id != "")
//                {
//                    $this->db->where("p.product_id",$product_id);
//                }
//            }
            //end unnecessary
            
            $this->db->where("ps.status_id",13);
            return $this->db->get()->result_array();
        }
        
        //added by khairul
        public function get_segregation_list() {
            $this->db->select("p.product_name,v.vendor_name,ps.purchase_price_usd,ps.purchase_price as purchase_price_bdt,ps.serial_number,po.order_number, w.warehouse_name,s.status_name,ps.product_code AS id");
            $this->db->from("product_stock_manager ps");
            $this->db->join("product p","p.product_id=ps.product_id","left");
            $this->db->join("vendor v","v.vendor_id=ps.vendor_id","left");
            $this->db->join("warehouse w","w.warehouse_id=ps.current_warehouse_location","left");
            $this->db->join("status s","s.status_id=ps.status_id","left");  
            $this->db->join("purchase_order po","po.vendor_id=ps.vendor_id","left");     
            
            if($_POST) {
                $product_id = $this->input->post('product_id');
                $vendor_id = $this->input->post('vendor_id');
                $serial_number = $this->input->post('serial_number');
                $purchase_id = $this->input->post('order_number');
//                echo 'hello '. $order_number;
//                exit();
                if($product_id != "") {
                     $this->db->where("p.product_id",$product_id);
                }
                if($vendor_id != "") {
                    $this->db->where("v.vendor_id", $vendor_id);
                }
                if($serial_number != "") {
                    $this->db->where("ps.serial_number", $serial_number);
                }
                if($purchase_id != "") {
                    $this->db->where("po.purchase_id", $purchase_id);
                }
            }
            $this->db->where("ps.status_id",13);

            //to see sql query
            //            $this->db->get();
//            echo $this->db->last_query();
//            exit();
            return $this->db->get()->result_array();
        }

        //Get info for specific product
        public function get_product_info($product_id)
        {
            $this->db->select('*');
            $this->db->where('product_id',$product_id);
            
            return $this->db->get('product')->row();
        }
        
        public function specification_type()
        {
            $this->db->select("*");
            $this->db->from("specification_type");
            $this->db->where("status","Active");
            $this->db->order_by("specification_type_name");
            return $this->db->get()->result_array();
        }
        
        public function product_suggest($field_name)
        {
            $this->db->select($field_name);
            $this->db->from("product");
            $this->db->group_by($field_name);
            $rows = $this->db->get();
            $html = '[';
            foreach ($rows->result() as $row)
            {
                $html .= '"'.$row->$field_name.'",';
            }
            $html .= ']';
            return $html;
        }

        //Get Purchase History
        public function get_purchase_history() {
            $p_id = $_GET['p_id'];
            $this->db->select("product.product_name,product.product_id,product.product_details_json,purchase_good_receive.recieve_ack_date,
                purchase_good_receive.purchase_date,sum(purchase_good_receive.receive_quantity) as receive_quantity,proforma_invoice.indent_number,
                proforma_invoice.lc_number,proforma_invoice.lc_value_usd,proforma_invoice.lc_value_bdt "  );
            $this->db->from("purchase_good_receive");
            $this->db->join("product",'purchase_good_receive.product_id = product.product_id', 'left');
            $this->db->join("proforma_invoice", 'purchase_good_receive.indent_number = proforma_invoice.indent_number','left');
            $this->db->where('purchase_good_receive.product_id',$p_id );
            $this->db->group_by("purchase_good_receive.indent_number");
            $result= $this->db->get();
              //To see the sql in normal format
            return $result->result_array();   
        }
        
        
        public function get_p_list_indent_wise($indent,$product_id){
           $this->db->select("product.product_name,product.product_code,product.product_id,product.product_details_json,purchase_good_receive.recieve_ack_date,
                            proforma_invoice.indent_number,purchase_good_receive.purchase_date,purchase_good_receive.receive_quantity"); 
           $this->db->from("purchase_good_receive");
           $this->db->join("product",'product.product_id=purchase_good_receive.product_id','left');
           $this->db->join("proforma_invoice",'proforma_invoice.indent_number=purchase_good_receive.indent_number','left');
           $this->db->where('purchase_good_receive.product_id',$product_id );
           $this->db->where('purchase_good_receive.indent_number',$indent );
           $result= $this->db->get();
           //debug($this->db->last_query(),1);
           return $result->result_array(); 
        }
        
        
        
        //Get Current Stock
//        public function get_product_stock() {
//            $p_id = $_GET['p_id'];
//            $sql = " SELECT
//                            product_stock_manager.product_code,
//                            product.product_name,
//                            product_stock_manager.serial_number,
//                            product_stock_manager.purchase_date,
//                            product_stock_manager.good_recieve_date,
//                            product_stock_manager.warranty_expired_on
//                    FROM
//                            product_stock_manager
//                    LEFT JOIN purchase_order ON product_stock_manager.product_code = purchase_order.purchase_code
//                    LEFT JOIN product ON product_stock_manager.product_id = product.product_id
//                    WHERE
//                            product_stock_manager.product_id = $p_id ";
//            $query = $this->db->query($sql);
//            
//            return $query->result_array();
//        }
//        
        //Get Current Stock
        public function get_current_stock() {
            $p_id = $_GET['p_id'];
            $this->db->select("warehouse.warehouse_name,location.location_name,
                Sum(
                    purchase_good_receive.available_quantity
                ) AS total");
            $this->db->from("purchase_good_receive");
            $this->db->join("warehouse",'purchase_good_receive.warehouse_id = warehouse.warehouse_id', 'left' );
            $this->db->join("location", 'warehouse.location_id = location.location_id', 'left');
            $this->db->where('purchase_good_receive.product_id', $p_id);
            $this->db->group_by("purchase_good_receive.warehouse_id");
            $result = $this->db->get();
            return $result->result_array();
//            echo $this->db->last_query();
            
        }


        //Get the vendor List
        public function get_vendor_list() {
            $p_id = $_GET['p_id'];
            $this->db->select("vendor.vendor_name, vendor.mobile_number,vendor.phone_number,vendor.email,vendor.web_url,vendor.vendor_id AS id");
            $this->db->from("purchase_order_details");
            $this->db->join("purchase_order",'purchase_order_details.purchase_order_id = purchase_order.purchase_id' );
            $this->db->join("vendor", 'purchase_order.vendor_id = vendor.vendor_id');
            $this->db->where("purchase_order_details.product_id",$p_id);
            $this->db->group_by("vendor.vendor_name");
            $result= $this->db->get();
            
            return $result->result_array();
        }
        
   //Added By Khairul 17.10.16
        
        public function get_product_lists($where) {
           $results= $this->db->query("SELECT p.product_id as id, p.product_name, p.model_name, p.product_code, r.region_name, pg.product_group_name,p.unit_price,p.unit_price_usd, p.product_details_json from product p
                 LEFT JOIN region r ON  p.region_id=r.region_id 
                 LEFT JOIN product_group pg ON p.product_group_id=pg.product_group_id 
                 $where
                ")->result_array();
//           echo $this->db->last_query();
//           exit();
           
           return $results;
           
           
//           print_r($results);
//            exit();
          
            
        }
      
}