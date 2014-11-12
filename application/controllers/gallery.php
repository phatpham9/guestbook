<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author PhatPham
 * @copyright 2013
 */

class gallery extends CI_Controller {
    function __construct(){
        parent::__construct();

        if (!$this->tank_auth->is_logged_in())
            redirect('auth/login');
        elseif ($this->tank_auth->is_logged_in(FALSE))                      // logged in, not activated
            redirect('/auth/send_again/');
    }

    function index(){
        $this->load->view('gallery/index');
    }
}

/* End of file gallery.php */
/* Location: ./application/controllers/gallery.php */