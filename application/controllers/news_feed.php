<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author PhatPham
 * @copyright 2013
 */

class news_feed extends CI_Controller {
    function __construct(){
        parent::__construct();
        
        $this->load->library('form_validation','url');
        $this->load->model(array('user_model', 'status_model', 'like_model'));

        if (!$this->tank_auth->is_logged_in())
            redirect('auth/login');
        elseif ($this->tank_auth->is_logged_in(FALSE))                      // logged in, not activated
            redirect('/auth/send_again/');
    }

    function index(){
        $data = array();
        $data['viewing'] = 'news_feed';
        $data['news_feed'] = $this->status_model->get_news_feed(20,0);
        $is_liked = array();
        if (!is_null($data['news_feed'])) {
            foreach ($data['news_feed'] as $status)
                $is_liked[$status->id] = $this->like_model->is_liked($status->id, $this->tank_auth->get_user_id());
        }
        $data['is_liked'] = $is_liked;
        // echo json_encode($data);
        $this->load->view('news_feed/index', $data);
    }
    
    /**
    *
    * QUANG NGUYEN PHU
    * Scroll Pagination - Get more status
    */
    
    function get_more_news_feed(){
        $data = array();
        $per_page = 20;
        
        $data['viewing'] = 'news_feed';
        $data['news_feed'] = $this->status_model->get_news_feed($per_page, $this->input->post('next_page'));
        $is_liked = array();
        if (!is_null($data['news_feed'])) {
            foreach ($data['news_feed'] as $status)
                $is_liked[$status->id] = $this->like_model->is_liked($status->id, $this->tank_auth->get_user_id());
        }
        $data['is_liked'] = $is_liked;
        $this->load->view('common/ajax_news_feed', $data);
    }
}

/* End of file news_feed.php */
/* Location: ./application/controllers/news_feed.php */