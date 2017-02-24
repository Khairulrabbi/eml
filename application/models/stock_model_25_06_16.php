<?php

class Stock_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    
     public function current_stock_data($where){
        $sql = $this->db->query("SELECT
            product.product_name,
			product_stock_manager.product_id,
			purchase_order.purchase_type_id,
			product_stock_manager.current_warehouse_location, 
            product_brand.product_brand_name,
            product_category.product_category_name,
            product_subcategory.product_subcategory_name,
            warehouse.warehouse_name,
            COUNT(product_stock_manager.product_id) AS total
            FROM
            product_stock_manager
            LEFT JOIN product ON product_stock_manager.product_id = product.product_id
            LEFT JOIN purchase_order ON product_stock_manager.purchase_id = purchase_order.purchase_id
            LEFT JOIN product_brand ON product.product_brand_id = product_brand.product_brand_id
            LEFT JOIN product_category ON product.product_category_id = product_category.product_category_id
            LEFT JOIN product_subcategory ON product.product_subcategory_id = product_subcategory.product_subcategory_id
            LEFT JOIN warehouse ON product_stock_manager.current_warehouse_location = warehouse.warehouse_id
            WHERE  $where 
	      product_stock_manager.status_id =13
            GROUP BY
            product.product_id,
            warehouse.warehouse_id
            ORDER BY
            product.product_id");
        
        return $sql->result_array();
    }
    
    public function get_warehouse_list(){
        $result = $this->db->query("SELECT
        warehouse.warehouse_id,
        warehouse.warehouse_name
        FROM `warehouse`
        WHERE
        `status`='Active'");
         return $result->result_array();
    }
    
    public function get_product_list_for_transfar($data){
        $this->db->select("product.product_id,product.product_name,product_brand.product_brand_name,product_category.product_category_name,product_subcategory.product_subcategory_name,product_stock_manager.serial_number,product_stock_manager.product_code");
        $this->db->from("product_stock_manager");
        $this->db->join("product",'product_stock_manager.product_id = product.product_id',  'left');
        $this->db->join("product_brand",'product.product_brand_id = product_brand.product_brand_id',  'left');
        $this->db->join("product_category",'product.product_category_id = product_category.product_category_id',  'left');
        $this->db->join("product_subcategory",'product.product_subcategory_id = product_subcategory.product_subcategory_id',  'left');
        $this->db->join("warehouse",'product_stock_manager.current_warehouse_location = warehouse.warehouse_id',  'left');
        if($data['category_id']){
            $this->db->where("product_category.product_category_id",$data['category_id']);
        }
        if($data['brand_id']){
            $this->db->where("product_brand.product_brand_id",$data['brand_id']);
        }
        if($data['sub_category_id']){
            $this->db->where("product_subcategory.product_subcategory_id",$data['sub_category_id']);
        }
        if($data['product_id']){
            $this->db->where("product.product_id",$data['product_id']);
        }
        $this->db->where("warehouse.warehouse_id",$data['transfer_from']);
        $this->db->order_by("product.product_id","ASC");
        $result= $this->db->get();
        return $result->result_array();
    }
    
    public function get_stock_transfer_data($transfer_requerst_number){
        $result = $this->db->query("SELECT
        product.product_name,
        wh_from.warehouse_name AS transfromFrom,
        wh_from.warehouse_id AS transfromFromId,
        wh_to.warehouse_name AS transferTo,
        wh_to.warehouse_id AS transferToId,
        stock_transfer.stock_transfer_id,
        stock_transfer.transfer_request_number,
        stock_transfer.product_code,
        stock_transfer.serial_no,
        stock_transfer.transfer_status_id,
        stock_transfer.product_id,
        `status`.status_name
        FROM
        stock_transfer
        LEFT JOIN product ON stock_transfer.product_id = product.product_id
        LEFT JOIN warehouse AS wh_from ON stock_transfer.transfer_from = wh_from.warehouse_id
        LEFT JOIN warehouse AS wh_to ON stock_transfer.transfer_to = wh_to.warehouse_id
        LEFT JOIN `status` ON stock_transfer.transfer_status_id = `status`.status_id
        WHERE
        stock_transfer.transfer_request_number = $transfer_requerst_number
        ");
        
        return $result->result_array();
    }
	
	
	public function lc_product_recieve_list(){
       $sql = " SELECT
                    product_stock_manager.product_id,
                    count(
                            product_stock_manager.serial_number
                    ) AS `total_recieve_serial`,
                    product.product_name,
                    purchase_order.purchase_code,
                    product_stock_manager.vendor_id,
                    product_stock_manager.purchase_id,
                    product_stock_manager.packing_slip_date
               FROM
                    product_stock_manager
                INNER JOIN product ON product_stock_manager.product_id = product.product_id
                INNER JOIN purchase_order ON product_stock_manager.purchase_id = purchase_order.purchase_id
                WHERE product_stock_manager.status_id=9
               GROUP BY
                    product_stock_manager.purchase_id,
                    product_stock_manager.product_id,
                    product_stock_manager.packing_slip_date";
       
       $data_result = $this->db->query($sql)->result_array();
       return $data_result; 
    }
    
    
        public function lc_product_recieve_confirmation($purchase_id,$product_id){
        $sql= "SELECT
                    product_stock_manager.product_code,
                    product_stock_manager.serial_number
                    FROM
                    product_stock_manager
                    WHERE
                    product_stock_manager.product_id =$product_id AND
                    product_stock_manager.purchase_id =$purchase_id AND product_stock_manager.status_id=9";
       $data_result = $this->db->query($sql)->result_array();
       return $data_result; 
    }
    
    public function change_status_to_good_receive($serial_no,$purchase_id,$warehouse_id){
		
		$today = date('Y-m-d');
        $sql ="UPDATE product_stock_manager
                SET product_stock_manager.status_id = 13,
				    product_stock_manager.current_warehouse_location =$warehouse_id,
					product_stock_manager.good_recieve_date ='$today'
                WHERE product_stock_manager.serial_number IN($serial_no)";
        $this->db->query($sql);
		
        
        /*if all products of a purchase_id are receieved
         *  Change the status of purchase id in purchase_order table
         * status e.g. partial received,Fully received
         */ 
        $sql2="SELECT
                Count(product_stock_manager.serial_number) AS `received`,
                (SELECT
                sum(purchase_order_details.quantity)
                FROM
                purchase_order_details
                WHERE
                purchase_order_details.purchase_order_id =$purchase_id) AS `quantity`
                FROM
                product_stock_manager
                WHERE
                product_stock_manager.purchase_id=$purchase_id
                AND product_stock_manager.status_id=13";
        
           
        $quantity = $this->db->query($sql2)->row()->quantity;
        $recieved= $this->db->query($sql2)->row()->received;
        //echo $sql;exit;
        
        //if any product is receieved
        //If zero recieved no operation is done
        if($recieved){
            if($quantity==$recieved){
                $status=15;// fully receieved
            }
            else{
                $status=14;//partial receieved
            } 
         $sql3 = "UPDATE purchase_order
                        SET purchase_order.`status` =$status
                        WHERE
                        purchase_order.purchase_id =$purchase_id ";
            $check= $this->db->query($sql3);
            
        }
        return $check;
   }
   
   /*
      Individual stock details view
   */
   
   public function individual_details_stock_view($product_id,$warehouse_id){
	   
	    $sql="SELECT
				product_stock_manager.product_code,
				product_stock_manager.serial_number,
				vendor.vendor_name,
				warehouse.warehouse_name
				FROM
				product_stock_manager
				INNER JOIN vendor ON product_stock_manager.vendor_id = vendor.vendor_id
				INNER JOIN warehouse ON product_stock_manager.current_warehouse_location = warehouse.warehouse_id
			WHERE 
			    product_stock_manager.product_id =$product_id AND
                product_stock_manager.current_warehouse_location =$warehouse_id";
	   
		$data_result = $this->db->query($sql)->result_array();
        return $data_result; 
   }
   
   
public function product_details_information($produc_code){
        $sql="SELECT
					product_stock_manager.serial_number,
					product_stock_manager.product_price_code,
					product_stock_manager.purchase_date,
					product_stock_manager.purchase_price,
					product_stock_manager.good_recieve_date,
					product_stock_manager.warranty_start_date,
					product_stock_manager.warranty_period,
					product_stock_manager.manufacture_date,
					product_stock_manager.manufacture_expire_date,
					product_stock_manager.customer_warranty_start_date,
					product_stock_manager.customer_warranty_period,
					product_stock_manager.product_code,
					product.product_name,
					purchase_order.lc_number,
					purchase_order.order_date,
					vendor.vendor_name,
					purchase_order.lc_value,
					warehouse.warehouse_name,
					purchase_order.purchase_code,
					purchase_type.purchase_type_name
					FROM
					product_stock_manager
					LEFT JOIN product ON product_stock_manager.product_id = product.product_id
					LEFT JOIN purchase_order ON product_stock_manager.purchase_id = purchase_order.purchase_id
					LEFT JOIN vendor ON purchase_order.vendor_id = vendor.vendor_id
					LEFT JOIN warehouse ON product_stock_manager.current_warehouse_location = warehouse.warehouse_id
					INNER JOIN purchase_type ON purchase_order.purchase_type_id = purchase_type.purchase_type_id
					WHERE
				product_stock_manager.product_code = '$produc_code' ";
      //echo $sql;exit;
       $data_result = $this->db->query($sql)->result_array();
       return $data_result; 
    }
}