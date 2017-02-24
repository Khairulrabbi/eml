<?php
class Deligation_Model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }
    
    public function get_approval_persons($approve_id=NULL,$step_no=NULL)
    {
        $this->db->select("pfa.userid,pfa.approve_for_id,pfa.max_limit,pfa.limit_type,u.username");
        $this->db->from("privilege_for_approval pfa");
        $this->db->join("user u","u.user_id=pfa.userid","left");
        if($approve_id && $step_no == NULL)
        {
            $this->db->where("pfa.approve_for_id",$approve_id);
            $this->db->where('u.user_id NOT IN (SELECT d.user_id FROM delegation_hierarchy d WHERE d.approve_for_id='.$approve_id.')', NULL, FALSE);
        }else if($step_no)
        {
            $this->db->where("pfa.approve_for_id",$approve_id);
            $this->db->where('u.user_id IN (SELECT d.user_id FROM delegation_hierarchy d WHERE d.approve_for_id='.$approve_id.' AND d.step_number='.$step_no.')', NULL, FALSE);
        }
        $this->db->where_not_in('u.user_id','1');
        
        $this->db->group_by("pfa.userid");
        return $this->db->get();
    }
    
    
    public function get_step_no($approve_id=NULL)
    {
        $row = $this->db->query("SELECT
            Max(delegation_hierarchy.step_number+1) AS max_step
            FROM
            delegation_hierarchy
            WHERE
            delegation_hierarchy.approve_for_id = ".$approve_id)->row();
        return ($row->max_step)?$row->max_step:1;
    }
    
    public function get_step_info($approve_id,$step_no)
    {
        $row = $this->db->query("SELECT * FROM delegation_hierarchy WHERE approve_for_id = ".$approve_id." AND step_number=".$step_no)->row();
        return $row;
    }
    
    public function check_must_approve($approve_for_id,$step_number,$user_id)
    {
        return $this->db->query("SELECT
            delegation_hierarchy.must_approve,
            delegation_hierarchy.decline_logic
            FROM
            delegation_hierarchy
            WHERE
            delegation_hierarchy.approve_for_id = ".$approve_for_id." AND
            delegation_hierarchy.step_number = ".$step_number." AND
            delegation_hierarchy.user_id = ".$user_id)->row();
    }

    public function get_common_info_approval_persons($approve_id)
    {
        return $this->db->query("SELECT
                    delegation_hierarchy.step_number,
                    delegation_hierarchy.step_name,
                    delegation_hierarchy.approve_for_id,
                    delegation_hierarchy.approve_priority,
                    delegation_hierarchy.manage_by,
                    (SELECT CASE WHEN MAX(delegation_hierarchy.sort_number) > 1 THEN 'No' ELSE 'Yes' END) as all_in_same_sort
                    FROM
                    delegation_hierarchy
                    WHERE delegation_hierarchy.approve_for_id=".$approve_id."
                    GROUP BY
                    delegation_hierarchy.step_number
                ")->result();
    }
    
    public function get_info_approval_persons($approve_for_id,$step_no)
    {
        return $this->db->query("
                SELECT
                    delegation_hierarchy.max_limit,
                    delegation_hierarchy.limit_type,
                    delegation_hierarchy.sort_number,
                    delegation_hierarchy.must_approve,
                    delegation_hierarchy.user_id,
                    delegation_hierarchy.decline_logic,
                    `user`.username
                    FROM
                    delegation_hierarchy
                    LEFT JOIN `user` ON delegation_hierarchy.user_id = `user`.user_id
                    WHERE
                    delegation_hierarchy.approve_for_id = ".$approve_for_id." AND
                    delegation_hierarchy.step_number = ".$step_no)->result();
    }

    public function userlist($where)
    {
        $this->db->select("u.*,ul.user_level_name,d.department_name,ds.designation_name");
        $this->db->from("user u");
        $this->db->join("privilege_level pl","pl.user_id=u.user_id","left");
        $this->db->join("user_level ul","ul.user_level_id=pl.user_level_id","left");
        $this->db->join("department d","d.department_id=u.department_id","left");
        $this->db->join("designation ds","ds.designation_id=u.designation_id","left");
        $this->db->group_by("u.user_id");
        $this->db->where($where);
        //debug($result,1);
        $result = $this->db->get();
        return $result;
    }
    
    public function get_check_users($check_users)
    {
        $users = explode(',', $check_users);
        $this->db->select("user_id,username");
        $this->db->from("user");
        $this->db->where_in("user_id",$users);
        return $this->db->get();
    }
    
    public function heirarchy_query($approve_for_id)
    {
        $this->db->select("*");
        $this->db->from("delegation_hierarchy");
        $this->db->where("approve_for_id",$approve_for_id);
        return $this->db->get();
    }
    
    public function get_current_list_by_approve_for_id($af_id){ 
        
        $sql = $this->db->query("SELECT
	`u`.`user_id`,
	`u`.`username`,
	`pfa`.`approve_for_id`,
	`pfa`.`max_limit`,
	`pfa`.`limit_type`
        FROM
	(
		`privilege_for_approval` pfa
	)
        LEFT JOIN `user` u ON `u`.`user_id` = `pfa`.`userid`
        WHERE
	`pfa`.`approve_for_id` = '$af_id'")->result_array();
        return $sql;
    }
    
    
//    public function get_search_information_by_search_id($user_level_id,$user_department_id,$user_designation_id,$user_id){
//        $this->db->select("u.*,ul.user_level_name,d.department_name,ds.designation_name");
//        $this->db->from("user u");
//        $this->db->join("privilege_level pl","pl.user_id=u.user_id","left");
//        $this->db->join("user_level ul","ul.user_level_id=pl.user_level_id");
//        $this->db->join("department d","d.department_id=u.department_id","left");
//        $this->db->join("designation ds","ds.designation_id=u.designation_id","left");
//        $this->db->where("ul.user_level_id=$user_level_id || d.department_id =$user_department_id || ds.designation_id =$user_designation_id
//            ||u.user_id=$user_id");
//        $this->db->group_by("u.user_id");
//        return $this->db->get();
//    }
}

