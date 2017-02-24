<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_grid extends Custom_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url', 'html', 'form');
        $this->load->helper('common_grid_helper');
        $this->load->helper('search_helper');
        $this->load->library('javascript');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('common_grid_model');
        $this->load->model('user_model', '', 'TRUE');
        $this->load->model('common_model');
    }
    public function grid_list($grid_list_id=NULL)
    {        
        $data['title'] = 'This is grid list test title';
        $data['grid_list_info'] = $this->common_grid_model->single_grid_list_info($grid_list_id);
        $data['search_options'] = $this->common_grid_model->search_options($data['grid_list_info']->panel_id,1);
        $data['search_options_hide'] = $this->common_grid_model->search_options($data['grid_list_info']->panel_id,0); 
        $data['grid_list_theads'] = explode(",",$data['grid_list_info']->theads);
        $data['grid_list_tbody'] = $this->common_grid_model->grid_list_html($data['grid_list_info']->data_query);
        $data['export_name'] = $data['grid_list_info']->grid_title;
        $data['grid_title'] = $data['grid_list_info']->grid_title;
        $this->render_page('grid/grid_view',$data);
    }
    
    public function grid_list_search()
    {
        $post = $this->input->post();
        $theads = $post['theads'];
        $data_query = $post['data_query'];
        unset($post['theads']);
        unset($post['data_query']);
        $data['grid_list_theads'] = explode(",",$theads);
        $data['grid_list_tbody'] = $this->common_grid_model->grid_list_html($data_query,$post);
        $this->load->view("grid/grid_view_tboday",$data);
    }

    public function more_search_panel()
    {
        $panel_id = $this->input->post("panel_id");
        $column = $this->input->post("column");
        $panel_details_id = $this->input->post("panel_details_id");
        $data['search_options'] = $this->common_grid_model->search_options($panel_id,0,$panel_details_id);
        //debug($this->db->last_query(),1);
        $data['column'] = $column;
        $this->load->view("grid/grid_view_search_options",$data);
    } 
}
