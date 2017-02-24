<?php
class Purchase_Model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function get_vendor_list() {
            $query = $this->db->get('vendor');
             return $query->result_array();
        }
		public function get_product_list(){
			$query = $this->db->get('product');
			return $query->result_array();
		}
		public function add_summary($array){
			echo "<pre>";
			print_r($array);
			exit;
			$this->db->insert('purchase_order_summary', $array); 
		}
}

