<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_reports_model extends CI_Model {
    public function save_data($data, $table) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    public function update_data($data,$table,$where){
        $this->db->where($where);
        $this->db->update($table,$data);
    }
    
    public function get_taging_by_acc_head_html($acc_head_id)
    {
        $this->db->select("*");
        $this->db->from("acc_tag");
        $this->db->where("acc_tag_id IN (SELECT acc_tag_id FROM acc_head_tag_details WHERE acc_head_id=".$acc_head_id.")",NULL,FALSE);
        $result = $this->db->get()->result();
         $html = "";
        foreach ($result as $v)
        {
            $this->db->select($v->id_field.",".$v->field_name);
            $this->db->from($v->table_name);
            $v_result = $this->db->get()->result_array();
           
            $html .= '<div class="col-lg-4 remobable">';
            $html .= '<div class="form-group">';
            $html .= '<label for="" class="col-lg-3 control-label">'.$v->acc_tag_name.'</label>';
            $html .= '<div class="col-lg-9">';
            $html .= '<select id="'.$v->id_field.'" name="'.$v->ref_field.'">';
            foreach ($v_result as $vv)
            {
                $html .= '<option value="'.$vv[$v->id_field].'">'.$vv[$v->field_name].'</option>';
            }
            $html .= '</select>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        }
        return $html;
    }
    
    public function dynamic_thead($post,$type)
    {
        $html = "";
        unset($post['TransactionDate']);
        unset($post['acc_head_id']);
        if(!empty($post))
        {
            $ref_field = array();
            $ref_field_value = array();
            foreach ($post as $k=>$v)
            {
                $ref_field[] = $k;
                $ref_field_value[] = $v;
            }
            
            $this->db->select("*");
            $this->db->from("acc_tag");
            $this->db->where_in("ref_field",$ref_field);
            $rows = $this->db->get()->result();
            $html = "";
            foreach ($rows as $r=>$v)
            {
                if($type == "thead")
                {
                    $html .= "<th>".$v->acc_tag_name."</th>";
                }
                else if($type == "opening_balance_head")
                {
                    $html .= "<td>&nbsp;</td>";
                }                
            }
        }
        if(($type == "tag_value") && (!empty($post)))
        {
            return $ref_field_value;
        }
        else
        {
            return $html;
        }        
    }

    

    public function get_opening_balance($fromdate,$acc_head_id,$post)
    {
        unset($post['TransactionDate']);
        unset($post['acc_head_id']);
        $this->db->select("(Sum(voucherdetails.Debit)-Sum(voucherdetails.Credit)) AS balance");
        $this->db->from("voucherdetails");
        $this->db->where('VoucherNo IN (SELECT VoucherNo FROM vouchermain)',NULL,FALSE);   
        $this->db->where("TransactionDate < ",$fromdate);
        if($acc_head_id)
        {
            $this->db->where("AccountName",$acc_head_id);
        }
        $this->db->where($post);
        $result = $this->db->get()->row();
        //debug($this->db->last_query(),1);
        return ($result->balance)?$result->balance:0;
    }
    
    public function get_statement_data($fromdate,$todate,$acc_head_id,$post)
    {
        unset($post['TransactionDate']);
        unset($post['acc_head_id']);
        $this->db->select("*,acc_head_name");
        $this->db->from("voucherdetails");
        $this->db->join("acc_head","acc_head.acc_head_id=voucherdetails.AccountName","left");
        $this->db->where('VoucherNo IN (SELECT VoucherNo FROM vouchermain)',NULL,FALSE);   
        $this->db->where('TransactionDate BETWEEN "'. date('Y-m-d', strtotime($fromdate)). '" and "'. date('Y-m-d', strtotime($todate)).'"');
        if($acc_head_id)
        {
            $this->db->where("AccountName",$acc_head_id);
        }
        $this->db->where($post);
        $result = $this->db->get()->result_array();
        return $result;
    }
    
    
    public function get_trial_balance_data($fromdate,$todate)
    {
        $this->db->select("acc_head.acc_head_name,Sum(voucherdetails.Debit) AS totalDebit,Sum(voucherdetails.Credit) AS totalCredit");
        $this->db->from("voucherdetails");
        $this->db->join("acc_head","acc_head.acc_head_id=voucherdetails.AccountName","left");
        $this->db->where('TransactionDate BETWEEN "'. date('Y-m-d', strtotime($fromdate)). '" and "'. date('Y-m-d', strtotime($todate)).'"');
        $this->db->where('VoucherNo IN (SELECT VoucherNo FROM vouchermain)',NULL,FALSE);   
        $this->db->group_by("voucherdetails.AccountName");
        $result = $this->db->get()->result();
        return $result;
    }
    
    
    public function get_end_account_head($acc_head_number)
    {
        $rows = $this->db->query("SELECT * FROM acc_head WHERE parent_id=".$acc_head_number)->result();
        $id = "";
        foreach ($rows as $row)
        {
            if($row->is_group == 0)
            {
                $id .= $row->acc_head_id.",";
            }
            $id .= $this->get_end_account_head($row->acc_head_number);
        }
        //debug($this->db->last_query(),1);
        return $id;    
    }
    
    public function root_head_total1($acc_head_id,$fromdate,$todate)
    {
        return $this->db->query("SELECT SUM(Debit) as d, SUM(Credit) as c FROM voucherdetails WHERE AccountName = ".$acc_head_id." AND TransactionDate BETWEEN '". date('Y-m-d', strtotime($fromdate)). "' AND '". date('Y-m-d', strtotime($todate))."' AND VoucherNo IN (SELECT VoucherNo FROM vouchermain) GROUP BY AccountName")->row();
    }
    
    public function root_head_total($acc_head_number,$fromdate,$todate)
    {
        $id = substr($this->get_end_account_head($acc_head_number),0,-1);
        $result = $this->db->query("SELECT SUM(Debit) as d, SUM(Credit) as c FROM voucherdetails WHERE AccountName IN ($id) AND TransactionDate BETWEEN '". date('Y-m-d', strtotime($fromdate)). "' AND '". date('Y-m-d', strtotime($todate))."'  AND VoucherNo IN (SELECT VoucherNo FROM vouchermain)")->row();
        //debug($this->db->last_query(),1);
        return $result;
    }
    
    public function trial_balance($parent_id,$fromdate,$todate)
    {
        $this->db->select("*");
        $this->db->from("acc_head");
        $this->db->where("parent_id",$parent_id);
        $rows = $this->db->get()->result();
        $html = "";
        $debit = 0;
        $credit = 0;
        $headdebit = 0;
        $headcredit = 0;
        $title = "";
        foreach ($rows as $row)
        {            
            if($row->parent_id == 0)
            {
                $title = "<h3>".$row->acc_head_name."</h3>";
                $rht = $this->root_head_total($row->acc_head_number,$fromdate,$todate);
                $headdebit = @$rht->d;
                $headcredit = @$rht->c;
            }
            else if(($row->parent_id != 0) && ($row->is_group == 1))
            {
                $title = "<h4>".$row->acc_head_name."</h4>";
                $rht = $this->root_head_total($row->acc_head_number,$fromdate,$todate);
                $headdebit = @$rht->d;
                $headcredit = @$rht->c;
            }
            else if(($row->parent_id != 0) && ($row->is_group == 0))
            {
                $title = $row->acc_head_name;
                $rht = $this->root_head_total1($row->acc_head_id,$fromdate,$todate);
                $debit = @$rht->d;
                $credit = @$rht->c;
            }
            $html .="<tr>";
            $html .="<td>".$title."</td>";
            $html .="<td>".((($row->parent_id != 0) && ($row->is_group == 0))?$debit:"0")."</td>";
            $html .="<td>".((($row->parent_id != 0) && ($row->is_group == 0))?$credit:"0")."</td>";
            $html .="<td>".(($row->is_group == 1)?$headdebit:0)."</td>";
            $html .="<td>".(($row->is_group == 1)?$headcredit:0)."</td>";
            $html .="</tr>";
            $html .= $this->trial_balance($row->acc_head_number,$fromdate,$todate);
        }
        return $html;
    }
}