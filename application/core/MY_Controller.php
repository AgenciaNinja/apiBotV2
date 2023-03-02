<?php

class MY_Controller extends CI_Controller
{
    function  __construct(){
        parent::__construct();
    }

    protected function __vista($view, $data = [], $sidebar = true)
    {
        $this->load->view('base/header', $data);

        if ($sidebar) {
            $this->load->view('base/sidebar', $data);
        }

        $this->load->view($view, $data);
        $this->load->view('base/footer');
    }

    protected function __paginacion($url, $total, $per_page = 10, $uri = 3)
    {

        $config['base_url'] = $url;
        $config['total_rows'] =  $total;
        $config['per_page'] = $per_page;
        $config['use_page_numbers'] = TRUE;


        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['reuse_query_string'] = TRUE;
        $config['anchor_class'] = 'page-link';
        $config['num_links'] = 3;

        $config['uri_segment'] = $uri;


        $config['full_tag_open'] = '<nav style="margin: 0 auto;" aria-label="Page navigation example"><ul class="pagination" style="float: right;margin-right: 10px;">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['attributes'] = array('class' => 'page-link');

        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        return $config;

    }
}