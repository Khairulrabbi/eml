<?php

class Reports_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_purchase_summary()
    {
        return $this->db->query("SELECT p.order_number AS po,p.order_date,v.vendor_name,
            (SELECT SUM(pcc.total_cost) FROM purchase_cost_component pcc WHERE pcc.purchase_order_id=p.purchase_id) AS freight_charge, 
            (SELECT SUM(pd.purchase_price) FROM purchase_order_details pd WHERE pd.purchase_order_id=p.purchase_id) AS amount FROM purchase_order p 
            LEFT JOIN vendor v ON p.vendor_id=v.vendor_id 
            WHERE p.status IN(6,14,15)")->result_array();
    }

    public function get_item_wise_purchase_summary()
    {
        return $this->db->query("SELECT p.product_name,po.order_number,v.vendor_name,w.warehouse_name,pod.quantity,pod.total_received,pod.purchase_price,psm.good_recieve_date FROM purchase_order_details pod             
            LEFT JOIN product p ON p.product_id=pod.product_id 
            LEFT JOIN purchase_order po ON po.purchase_id=pod.purchase_order_id 
            LEFT JOIN vendor v ON po.vendor_id=v.vendor_id 
            LEFT JOIN product_stock_manager psm ON psm.po_details_id=pod.purchase_order_details_id 
            LEFT JOIN warehouse w ON w.warehouse_id=psm.current_warehouse_location 
            WHERE po.status IN(6,14,15)")->result_array();
    }
    
    public function get_re_order_manager()
    {
//        return $this->db->query("SELECT p.product_id,p.product_name,pc.product_category_name,p.reorder_qty,
//        (SELECT SUM(pgr.available_quantity) FROM purchase_good_receive pgr  
//        WHERE pgr.product_id=p.product_id) as total FROM product p  
//        LEFT JOIN product_category pc ON pc.product_category_id=p.product_category_id 
//        WHERE 1 ORDER BY p.product_id ASC")->result_array();  
        
        return $this->db->query("SELECT p.product_id,p.product_name,p.reorder_qty,pc.product_category_name,SUM(pgr.available_quantity) AS total 
                FROM purchase_good_receive pgr 
                LEFT JOIN product p ON p.product_id=pgr.product_id 
                LEFT JOIN product_category pc ON pc.product_category_id=p.product_category_id 
                WHERE 1 GROUP BY pgr.product_id ORDER BY p.product_id ASC")->result_array();
    }
    
    public function get_customer_wise_sales()
    {    
        return $this->db->query("SELECT c.customer_name,
                (SELECT SUM(pc.payment) FROM payment_recieve pc WHERE pc.customer_id=c.customer_id) AS tpayment,
                (SELECT SUM(sod.sales_price) FROM sales_order so LEFT JOIN sales_order_details sod ON sod.sales_order_id=so.sales_id WHERE so.customer_id=c.customer_id AND so.sales_status=27) AS stotal
                FROM customer c")->result_array();
    }
}
