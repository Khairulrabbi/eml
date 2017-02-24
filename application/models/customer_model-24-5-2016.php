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
}

