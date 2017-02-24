<?php
class Common_grid_Model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        
        
        
        
        public function save_data($data, $table) {
            $this->db->insert($table, $data);
            return $this->db->insert_id();
        }
        
        public function update_data($data,$table,$where){
            $this->db->where($where);
            $this->db->update($table,$data);
            if(isset($where['purchase_id'])){
                return $where['purchase_id'];
            }
        }  
        
        public function single_grid_list_info($grid_list_id)
        {
            $this->db->select("*");
            $this->db->from("grid_list");
            $this->db->where("grid_list_id",$grid_list_id);
            return $this->db->get()->row();
        }
        
        public function search_options($panel_id,$show,$panel_details_id=NULL)
        {
            $this->db->select("*");
            $this->db->from("search_panel_details");
            if($panel_details_id)
            {
                $this->db->where("panel_details_id",$panel_details_id);
            }
            else
            {
                $this->db->where("panel_id",$panel_id);
                $this->db->where("show",$show);
            }
            
            $this->db->order_by("sort");
            return $this->db->get()->result();
        }
        
        public function grid_list_html($query,$post=NULL)
        {
            //debug($post,1);
            $table_string = preg_split('/FROM/',$query);
            
            $table = explode(' ',$table_string[1]);
            //debug($table,1);
            if($post)
            {
                foreach ($post as $k=>$v)
                {
                    if($v != "")
                    {
                        if (preg_match("/^[0-9]{4}\/(0[1-9]|1[0-2])\/(0[1-9]|[1-2][0-9]|3[0-1])[ ]-[ ][0-9]{4}\/(0[1-9]|1[0-2])\/(0[1-9]|[1-2][0-9]|3[0-1])$/",$v))
                        {
                            $d = explode("-", $v);
                            $query .= " and ".$table[1].".".$k." BETWEEN '".$d[0]."' AND '".$d[1]."'";  
                        }else{
                           $query .= " and ".$table[1].".".$k."='".$v."'";  
                        }
                                              
                    }                    
                }
            }
            
            $return_result = $this->db->query($query)->result_array();
            //debug($this->db->last_query(),1);
            return $return_result;
        }
}

