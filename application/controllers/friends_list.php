<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author PhatPham
 * @copyright 2013
 */

class friends_list extends CI_Controller {
    function __construct(){
        parent::__construct();
         $this->load->model('user_model');

        if (!$this->tank_auth->is_logged_in())
            redirect('auth/login');
        elseif ($this->tank_auth->is_logged_in(FALSE))                      // logged in, not activated
            redirect('/auth/send_again/');
    }

    function index(){
    	$friends_list = $this->user_model->get_users();
    	$data['friends_list'] = $friends_list;
        $this->load->view('friends_list/index', $data);
    }
}

/* End of file gallery.php */
/* Location: ./application/controllers/gallery.php */