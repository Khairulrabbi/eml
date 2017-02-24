<?php
class Customer_Model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get_customer_list() {
        $query = $this->db->get('customer');
        return $query->result_array();
    }
    
    public function get_customer_info($customer_id){
        $this->db->select("*");
        $this->db->from("customer");
        $this->db->where("customer_id",$customer_id);
        $result= $this->db->get();
        return $result->row();
    }
    
    public function get_address($customer_id){
        $this->db->select("*");
        $this->db->from("customer_address");
        $this->db->where("customer_id",$customer_id);
        $result= $this->db->get();
        return $result->result_array();
    }
    
    public function get_edit_address($address_table_id){
        $this->db->select("*");
        $this->db->from("customer_address");
        $this->db->where("customer_address_id",$address_table_id);
        $result= $this->db->get();
        return $result->row();
    }

    public function save_data($data, $table) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    
    public function update_data($data,$table,$where){
        $this->db->where($where);
        $this->db->update($table,$data);
         
        
    }
}

