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
        return $where['purchase_id'];
    }
    public function get_order_info($order_id){
            $this->db->select("purchase_order.*,status.status_name");
            $this->db->from("purchase_order");
            $this->db->join("status",'purchase_order.status=status.status_id');
            $this->db->where("purchase_id",$order_id);
            $result= $this->db->get();
            //$ret = $query->row();
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

}
