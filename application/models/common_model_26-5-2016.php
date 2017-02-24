<?php
class Common_Model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function get_product_list($data){
            $this->db->select("*");
            $this->db->from("product");
            if($data['category_id']){
                $this->db->where("product_category_id",$data['category_id']);
            }
            if($data['brand_id']){
                $this->db->where("product_brand_id",$data['brand_id']);
            }
            if($data['sub_category_id']){
                $this->db->where("product_subcategory_id",$data['sub_category_id']);
            }
            if($data['product_id']){
                $this->db->where("product_id",$data['product_id']);
            }
            $result= $this->db->get();
            return $result->result_array();
            
        }
        
        
}

