<?php

class Cheque_management extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    
    public function get_cheque_head_html($ChequeReferenceType)
    {
        $this->db->select("payment_approval_note_details.payment_approval_note_id, payment_approval_note_details.payment_approval_note_details_id, payment_approval_note_details.amount, payment_approval_note_details.cost_component_id, payment_approval_note.payment_approval_code, payment_approval_note.ref_name_id, cost_component.cost_component_name");
        $this->db->from("payment_approval_note_details");
        $this->db->join("payment_approval_note","payment_approval_note_details.payment_approval_note_id = payment_approval_note.payment_approval_note_id AND payment_approval_note.ref_name = '".$ChequeReferenceType."' AND payment_approval_note.payment_approval_note_status = 63","inner");
        $this->db->join("cost_component","payment_approval_note_details.cost_component_id = cost_component.cost_component_id","left");
        $this->db->where("payment_approval_note_details.payment_approval_note_details_status",63);
        $this->db->order_by("payment_approval_note_details.payment_approval_note_id ASC");
        $rows = $this->db->get()->result();
        $html = "<table class='table cheque_head_html'>";
        $html .= "<tr><th>Payable Approval Code</th><th>Account Head</th><th>Amount</th></tr>";
        foreach ($rows as $row)
        {
            $html .= "<tr class='cheque_value_html' pan_code='".$row->payment_approval_code."' pand_id='".$row->payment_approval_note_details_id."' cc_name='".$row->cost_component_name."' cc_amount='".$row->amount."'><td>".$row->payment_approval_code."</td><td>".$row->cost_component_name."</td><td>".$row->amount."</td></tr>";
        }
        $html .= "</table>";
        return $html;
    }
}
