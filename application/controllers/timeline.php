<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author PhatPham
 * @copyright 2013
 */

class timeline extends CI_Controller {
    function __construct(){
        parent::__construct();

        $this->load->library('form_validation','url');
        $this->load->model(array(
        	'user_model', 
        	'favorite_quote_model', 
        	'basic_info_model', 
        	'contact_info_model', 
        	'job_model',
        	'status_model',
        	'like_model',
        	'ava_model',
        	'question_model'));

        if (!$this->tank_auth->is_logged_in())
			redirect('auth/login');
		elseif ($this->tank_auth->is_logged_in(FALSE))						// logged in, not activated
			redirect('/auth/send_again/');
    }

	function index($username){
		if(empty($username))
			show_404();
		
		$data = array();

		//viewing my timeline
		if ($username == $this->tank_auth->get_username()) {
			$data['viewing'] = 'my_timeline';
			$data['statuses'] = $this->status_model->get_statuses($this->tank_auth->get_user_id(), 20, 0);
			$is_liked = array();
			if (!is_null($data['statuses'])) {
				foreach ($data['statuses'] as $status)
				$is_liked[$status->id] = $this->like_model->is_liked($status->id, $this->tank_auth->get_user_id());
			}
			$data['is_liked'] = $is_liked;

		//viewing friend timeline
		} else {
			if(is_null($user = $this->user_model->get_user_by_username($username)))
				show_404();

			$data['viewing'] = 'friend_timeline';
			# Đẩy dữ liệu ra view
			$data['statuses'] = $this->status_model->get_statuses($this->tank_auth->get_user_id(),20,0);

			$is_liked = array();
			if (!is_null($data['statuses'])) {
				foreach ($data['statuses'] as $status)
					$is_liked[$status->id] = $this->like_model->is_liked($status->id, $this->tank_auth->get_user_id());
			}
			$data['is_liked'] = $is_liked;

			$data['username'] = $user->username;
			$data['full_name'] = $user->full_name;
			$data['ava_url'] = !is_null($ava = $this->ava_model->get_ava($user->id)) ? site_url() . $ava->file_path . $ava->file_name . $ava->file_ext : site_url() . 'assets/upload/ava/no_ava.jpg';
		}
	
		$this->load->view('timeline/index', $data);
	}

	function profile($username){
		if(empty($username))
			show_404();

		$data = array();

		if($username == $this->tank_auth->get_username()){		//viewing my profile
			$data['viewing'] = 'my_profile';
			$data['favorite_quote'] = $this->favorite_quote_model->get_favorite_quote($this->tank_auth->get_user_id());
			$data['basic_info'] = $this->basic_info_model->get_basic_info($this->tank_auth->get_user_id());
			$data['contact_info'] = $this->contact_info_model->get_contact_info($this->tank_auth->get_user_id());
			$data['last_jobs'] = $this->job_model->get_last_jobs($this->tank_auth->get_user_id());
			$data['current_jobs'] = $this->job_model->get_current_jobs($this->tank_auth->get_user_id());
			$data['questions'] = $this->question_model->get_questions();
		
		}else{													//viewing friend profile
			if(is_null($user = $this->user_model->get_user_by_username($username)))
				show_404();

			$data['viewing'] = 'friend_profile';
			$data['favorite_quote'] = $this->favorite_quote_model->get_favorite_quote($user->id);
			$data['basic_info'] = $this->basic_info_model->get_basic_info($user->id);
			$data['contact_info'] = $this->contact_info_model->get_contact_info($user->id);
			$data['last_jobs'] = $this->job_model->get_last_jobs($user->id);
			$data['current_jobs'] = $this->job_model->get_current_jobs($user->id);
			$data['questions'] = $this->question_model->get_questions();

			$data['username'] = $user->username;
			$data['full_name'] = $user->full_name;
			$data['ava_url'] = !is_null($ava = $this->ava_model->get_ava($user->id)) ? site_url() . $ava->file_path . $ava->file_name . $ava->file_ext : site_url() . 'assets/upload/ava/no_ava.jpg';
		}
		
		$this->load->view('timeline/profile', $data);
	}

	function account_settings($username){
		if(empty($username))
			show_404();

		$data = array();

		if ($username == $this->tank_auth->get_username()) {
			$data['viewing'] = 'account_settings';
			$data['user'] = $this->user_model->get_user_by_username($username);
		} else {
			show_404();
		}

		$this->load->view('timeline/account_settings', $data);
	}
	/**
    *
    * QUANG NGUYEN PHU
    * Scroll Pagination - Get more timeline
    *
    */
	    
	function get_more_timeline($username){
		if(empty($username))
			show_404();
		
		$data = array();
		$per_page = 20;
		if ($username == $this->tank_auth->get_username()) {
			$data['viewing'] = 'my_timeline';
			$data['statuses'] = $this->status_model->get_statuses($this->tank_auth->get_user_id(), $per_page, $this->input->post('next_page'));
			$is_liked = array();
			if (!is_null($data['statuses'])) {
				foreach ($data['statuses'] as $status)
				$is_liked[$status->id] = $this->like_model->is_liked($status->id, $this->tank_auth->get_user_id());
			}
			$data['is_liked'] = $is_liked;
		}
		$this->load->view('common/ajax_timeline', $data);
	}

    function news_feed(){
        $data = array();

        $data['viewing'] = 'news_feed';
        $data['news_feed'] = $this->status_model->get_news_feed(20,0);
        $is_liked = array();
        if (!is_null($data['news_feed'])) {
            foreach ($data['news_feed'] as $status)
                $is_liked[$status->id] = $this->like_model->is_liked($status->id, $this->tank_auth->get_user_id());
        }
        $data['is_liked'] = $is_liked;

        $this->load->view('timeline/news_feed', $data);
    }
	/*-------------Ajax functions-------------*/

	/*-------------Status functions-------------*/
	function post_status() {
		$this->form_validation->set_rules('status_content', 'Status Content', 'trim|required|xss_clean|max_length[1000]');
		$data = array();

		if ($this->form_validation->run()) {								// validation ok
			$status['user_id'] = $this->tank_auth->get_user_id();
			$status['text'] = $this->form_validation->set_value('status_content');

			if (!is_null($status = $this->status_model->create_status($status))) {
				$status['username'] = $this->tank_auth->get_username();
				$status['full_name'] = $this->tank_auth->get_full_name();
				$status['num_likes'] = 0;
				$status['num_comments'] = 0;

				$this->load->view('timeline/status', array('status' => (object) $status, 'is_liked' => FALSE));
				return;
			} else {
				$data['code'] = 0;
				$data['info'] = 'Post status fail. Please try again.';
			}
		} else {
			$data['code'] = 0;
			$data['info'] = form_error('status_content', '', '');
		}

		echo json_encode($data);
    }

	function delete_status() {
		$this->form_validation->set_rules('status_id', 'Status ID', 'trim|required|xss_clean|integer');
		$data = array();

		// validation ok
		if ($this->form_validation->run()) {
			$status_id = $this->form_validation->set_value('status_id');
			$user_id = $this->tank_auth->get_user_id();

			$status = $this->status_model->get_status($status_id);
			//status owner
			if ($status->user_id == $user_id) {
				if ($this->status_model->delete_status($status_id)) {
					$data['code'] = 1;
					$data['info'] = 'Delete status successfully';
				} else {
					$data['code'] = 0;
					$data['info'] = 'Error happens. Please try again.';
				}
			//not status onwer
			} else {
				$data['code'] = 0;
				$data['info'] = 'You can not delete this status.';
			}
		// validation fail
		} else {
			$data['code'] = 0;
			$data['info'] = form_error('status_id', '', '');
		}

		echo json_encode($data);
	}

	function like_status() {
		$this->form_validation->set_rules('status_id', 'Status ID', 'trim|required|xss_clean|integer');
		$data = array();

		// validation ok
		if ($this->form_validation->run()) {
			$status_id = $this->form_validation->set_value('status_id');
			$user_id = $this->tank_auth->get_user_id();

			if (!$this->like_model->is_liked($status_id, $user_id)) {
				if (!is_null($data = $this->like_model->like($status_id, $user_id))) {
					$data['code'] = 1;
					$data['info'] = 'Like successfully.';
				} else {
					$data['code'] = 0;
					$data['info'] = 'Error happens. Please try again.';
				}
			} else {
				$data['code'] = 0;
				$data['info'] = 'You already liked this status.';
			}
		// validation fail
		} else {
			$data['code'] = 0;
			$data['info'] = form_error('status_id', '', '');
		}

		echo json_encode($data);
	}

	function unlike_status() {
		$this->form_validation->set_rules('status_id', 'Status ID', 'trim|required|xss_clean|integer');
		$data = array();

		// validation ok
		if ($this->form_validation->run()) {
			$status_id = $this->form_validation->set_value('status_id');
			$user_id = $this->tank_auth->get_user_id();

			if ($this->like_model->is_liked($status_id, $user_id)) {
				if (!is_null($data = $this->like_model->unlike($status_id, $user_id))) {
					$data['code'] = 1;
					$data['info'] = 'Unlike successfully.';
				} else {
					$data['code'] = 0;
					$data['info'] = 'Error happens. Please try again.';
				}
			} else {
				$data['code'] = 0;
				$data['info'] = 'You have not liked this status yet.';
			}
		// validation fail
		} else {
			$data['code'] = 0;
			$data['info'] = form_error('status_id', '', '');
		}

		echo json_encode($data);
	}

	function get_edit_status() {
		$this->form_validation->set_rules('status_id', 'Status ID', 'trim|required|xss_clean|integer');
		$data = array();

		// validation ok
		if ($this->form_validation->run()) {
			$status_id = $this->form_validation->set_value('status_id');
			$user_id = $this->tank_auth->get_user_id();

			$status = $this->status_model->get_status($status_id);
			//status owner
			if ($status->user_id == $user_id) {
				$this->load->view('timeline/edit_status', array('status' => $status, 'status_length' => strlen($status->text)));
				return;
			//not status onwer
			} else {
				$data['code'] = 0;
				$data['info'] = 'You can not edit this status.';
			}
		// validation fail
		} else {
			$data['code'] = 0;
			$data['info'] = form_error('status_id', '', '');
		}

		echo json_encode($data);
	}

	function get_status_content() {
		$this->form_validation->set_rules('status_id', 'Status ID', 'trim|required|xss_clean|integer');
		$data = array();

		// validation ok
		if ($this->form_validation->run()) {
			$status_id = $this->form_validation->set_value('status_id');
			$user_id = $this->tank_auth->get_user_id();

			$status = $this->status_model->get_status($status_id);
			//status owner
			if ($status->user_id == $user_id) {
				$data['code'] = 1;
				$data['info'] = 'Get status content successfully.';
				$data['status_content'] = auto_link(nl2br($status->text), 'both', TRUE);
			//not status onwer
			} else {
				$data['code'] = 0;
				$data['info'] = 'You can not get this status\'s content.';
			}
		// validation fail
		} else {
			$data['code'] = 0;
			$data['info'] = form_error('status_id', '', '');
		}

		echo json_encode($data);
	}

	function edit_status() {
		$this->form_validation->set_rules('status_id', 'Status ID', 'trim|required|xss_clean|integer');
		$this->form_validation->set_rules('status_content', 'Status Content', 'trim|required|xss_clean|max_length[1000]');
		$data = array();

		// validation ok
		if ($this->form_validation->run()) {
			$status_id = $this->form_validation->set_value('status_id');
			$status_content = $this->form_validation->set_value('status_content');
			$user_id = $this->tank_auth->get_user_id();

			$status = $this->status_model->get_status($status_id);
			//status owner
			if ($status->user_id == $user_id) {
				//edit status successfully
				if ($this->status_model->update_status(array('id' => $status_id, 'text' => $status_content))) {
					$data['code'] = 1;
					$data['info'] = 'Edit status successfully.';
					$data['status_content'] = auto_link(nl2br($status_content), 'both', TRUE);
				} else {
					$data['code'] = 0;
					$data['info'] = 'Edit status fail. Please try again.';
				}
			//not status onwer
			} else {
				$data['code'] = 0;
				$data['info'] = 'You can not edit this status.';
			}
		// validation fail
		} else {
			$data['code'] = 0;
			$data['info'] = form_error('status_id', '', '');
		}

		echo json_encode($data);
	}

	function upload_ava(){
		$user = $this->user_model->get_user_by_username($this->tank_auth->get_username());
		$data = array();

		$config['upload_path'] = 'assets/upload/ava/';
		$config['allowed_types'] = 'jpg|png';
		$config['file_name'] = md5($user->id . $user->username);
		$config['overwrite'] = TRUE;
		$config['max_size']	= '512';
		$config['max_width']  = '512';
		$config['max_height']  = '512';
		$this->load->library('upload', $config);

		// upload ok
		if ($this->upload->do_upload('ava_file')) {
			$uploaded_file = $this->upload->data();

			//create thumb
			$this->common->create_thumb($uploaded_file['file_name'], $config['upload_path']);

			$ava = array(
				'user_id'	=> $user->id,
				'file_name'	=> $uploaded_file['raw_name'],
				'file_ext'	=> $uploaded_file['file_ext'],
				'file_path' => $config['upload_path'],
				'thumb_path'=> $config['upload_path'] . 'thumb/'
				);

			$old_ava = $this->ava_model->get_ava($user->id);
			//create successfully
			if (is_null($old_ava) && !is_null($this->ava_model->create_ava($ava))) {
				$data['code'] = 1;
				$data['info'] = 'Upload successfully.';
				$data['file_path'] = site_url() . $config['upload_path'] . $uploaded_file['file_name'];

				$this->load->library('session');
				$this->session->set_userdata('ava_url', $data['file_path']);
			//update successfully
			} else if (!is_null($old_ava) && $this->ava_model->update_ava($ava)) {
				//Delete old ava and thumb
				if ($old_ava->file_ext != $ava['file_ext']){
					unlink($old_ava->file_path . $old_ava->file_name . $old_ava->file_ext);
					unlink($old_ava->thumb_path . $old_ava->file_name . $old_ava->file_ext);
				}

				$data['code'] = 1;
				$data['info'] = 'Upload successfully.';
				$data['file_path'] = site_url() . $config['upload_path'] . $uploaded_file['file_name'];

				$this->load->library('session');
				$this->session->set_userdata('ava_url', $data['file_path']);
			// Create ava fail
			} else {
				unlink($config['upload_path'] . $uploaded_file['file_name']);
				unlink($ava['thumb_path'] . $uploaded_file['file_name']);
				$data['code'] = 0;
				$data['info'] = 'Upload fail.';
			}
		// upload fail
		} else {
			$data['code'] = 0;
			$data['info'] = $this->upload->display_errors();
		}

		echo json_encode($data);
	}

	/*=====================================================================================================*/
	/*
	*
	*  Author: QUANG NGUYEN PHU
	*
	*/
	// View full status content
	function see_more_status_content() {
		$this->form_validation->set_rules('status_id', 'Status ID', 'trim|required|xss_clean|integer');
		$data = array();

		// validation ok
		if ($this->form_validation->run()) {
			$status_id = $this->form_validation->set_value('status_id');
			$user_id = $this->tank_auth->get_user_id();

			$status = $this->status_model->get_status($status_id);
			$data['code'] = 1;
			$data['info'] = 'Get status content successfully.';
			$data['status_content'] = nl2br($status->text);
		// validation fail
		} else {
			$data['code'] = 0;
			$data['info'] = 'You cannot access this status';
		}

		echo json_encode($data);
	}


	/*=====================================================================================================*/
	/*-------------Profile functions-------------*/
	function add_favorite_quote() {
		$this->form_validation->set_rules('favorite_quote', 'My Memory', 'trim|xss_clean|max_length[1000]');
		$data = array();

		// validation ok
		if ($this->form_validation->run()) {
			$favorite_quote['user_id'] = $this->tank_auth->get_user_id();
			$favorite_quote['favorite_quote'] = $this->form_validation->set_value('favorite_quote');

			// edit favorite quote
			if (!is_null($this->favorite_quote_model->get_favorite_quote($favorite_quote['user_id']))) {
				// edit if length > 0
				if (strlen($favorite_quote['favorite_quote']) > 0) {
					if ($this->favorite_quote_model->update_favorite_quote($favorite_quote)){
						$data['code'] = 1;
						$data['info'] = 'Edit My memory successfully.';
						$data['favorite_quote'] = $favorite_quote['favorite_quote'];
					} else {
						$data['code'] = 0;
						$data['info'] = 'Error happens. Please try again.';
					}
				// delete if length == 0
				} else {
					if ($this->favorite_quote_model->delete_favorite_quote($favorite_quote['user_id'])){
						$data['code'] = 1;
						$data['info'] = 'Delete My memory successfully.';
					} else {
						$data['code'] = 0;
						$data['info'] = 'Error happens. Please try again.';
					}
				}
			// create favorite quote
			} else {
				if(strlen($favorite_quote['favorite_quote']) > 0) {
					if (!is_null($this->favorite_quote_model->create_favorite_quote($favorite_quote))){
						$data['code'] = 1;
						$data['info'] = 'Add VLU memory successfully.';
						$data['favorite_quote'] = $favorite_quote['favorite_quote'];
					} else {
						$data['code'] = 0;
						$data['info'] = 'Error happens. Please try again.';
					}
				}
			}
		// validation fail
		} else {
			$data['code'] = 0;
			$data['info'] = form_error('favorite_quote', '', '');
		}

		echo json_encode($data);
	}

	function add_basic_info($basic_info_name = '') {
		$data = array();

		if (!empty($basic_info_name)) {
			//set validation rule
			$this->form_validation->set_rules('basic_info', ucfirst($basic_info_name), 'trim|xss_clean|max_length[100]');

			// validation ok
			if ($this->form_validation->run()) {
				$basic_info['user_id'] = $this->tank_auth->get_user_id();
				$basic_info[$basic_info_name] = $this->form_validation->set_value('basic_info');
				if ($basic_info_name == 'date_of_birth')
					$basic_info[$basic_info_name] = date('Y-m-d', strtotime($basic_info[$basic_info_name]));

				// edit
				if (!is_null($this->basic_info_model->get_basic_info($basic_info['user_id']))) {
					// edit if length > 0
					if (strlen($basic_info[$basic_info_name]) > 0) {
						$function_name = 'update_' . $basic_info_name;
						if ($this->basic_info_model->$function_name($basic_info['user_id'], $basic_info[$basic_info_name])){
							$data['code'] = 1;
							$data['info'] = 'Edit ' . $basic_info_name . ' successfully.';
							$data[$basic_info_name] = $basic_info[$basic_info_name];
						} else {
							$data['code'] = 0;
							$data['info'] = 'Error happens. Please try again.';
						}
					// delete if length == 0
					} else {
						$function_name = 'delete_' . $basic_info_name;
						if ($this->basic_info_model->$function_name($basic_info['user_id'])){
							$data['code'] = 1;
							$data['info'] = 'Delete ' . $basic_info_name . ' successfully.';
						} else {
							$data['code'] = 0;
							$data['info'] = 'Error happens. Please try again.';
						}
					}
				// create
				} else {
					if(strlen($basic_info[$basic_info_name]) > 0) {
						if (!is_null($this->basic_info_model->create_basic_info($basic_info))){
							$data['code'] = 1;
							$data['info'] = 'Add ' . $basic_info_name . ' successfully.';
							$data[$basic_info_name] = $basic_info[$basic_info_name];
						} else {
							$data['code'] = 0;
							$data['info'] = 'Error happens. Please try again.';
						}
					}
				}
			// validation fail
			} else {
				$data['code'] = 0;
				$data['info'] = form_error($basic_info_name, '', '');
			}
		} else {
			$data['code'] = 0;
			$data['info'] = 'Invalid parameter(s).';
		}

		echo json_encode($data);
	}

	function add_contact_info($contact_info_name = '') {
		$data = array();

		if (!empty($contact_info_name)) {
			//set validation rule
			$this->form_validation->set_rules('contact_info', ucfirst($contact_info_name), 'trim|xss_clean|max_length[100]');

			// validation ok
			if ($this->form_validation->run()) {
				$contact_info['user_id'] = $this->tank_auth->get_user_id();
				$contact_info[$contact_info_name] = $this->form_validation->set_value('contact_info');

				// edit
				if (!is_null($this->contact_info_model->get_contact_info($contact_info['user_id']))) {
					// edit if length > 0
					if (strlen($contact_info[$contact_info_name]) > 0) {
						$function_name = 'update_' . $contact_info_name;
						if ($this->contact_info_model->$function_name($contact_info['user_id'], $contact_info[$contact_info_name])){
							$data['code'] = 1;
							$data['info'] = 'Edit ' . $contact_info_name . ' successfully.';
							$data[$contact_info_name] = $contact_info[$contact_info_name];
						} else {
							$data['code'] = 0;
							$data['info'] = 'Error happens. Please try again.';
						}
					// delete if length == 0
					} else {
						$function_name = 'delete_' . $contact_info_name;
						if ($this->contact_info_model->$function_name($contact_info['user_id'])){
							$data['code'] = 1;
							$data['info'] = 'Delete ' . $contact_info_name . ' successfully.';
						} else {
							$data['code'] = 0;
							$data['info'] = 'Error happens. Please try again.';
						}
					}
				// create
				} else {
					if(strlen($contact_info[$contact_info_name]) > 0) {
						if (!is_null($this->contact_info_model->create_contact_info($contact_info))){
							$data['code'] = 1;
							$data['info'] = 'Add ' . $contact_info_name . ' successfully.';
							$data[$contact_info_name] = $contact_info[$contact_info_name];
						} else {
							$data['code'] = 0;
							$data['info'] = 'Error happens. Please try again.';
						}
					}
				}
			// validation fail
			} else {
				$data['code'] = 0;
				$data['info'] = form_error($contact_info_name, '', '');
			}
		} else {
			$data['code'] = 0;
			$data['info'] = 'Invalid parameter(s).';
		}

		echo json_encode($data);
	}

	function get_add_job_form($type) {
		if (empty($type))
			show_404();

		$this->load->view('timeline/add_job', array('type' => $type));
	}

	function add_job($type) {
		if (empty($type))
			show_404();

		$this->form_validation->set_rules('company', 'Company name', 'trim|required|xss_clean|max_length[100]');
		$this->form_validation->set_rules('company_website', 'Company website', 'trim|required|xss_clean|max_length[100]');
		$this->form_validation->set_rules('position', 'Position', 'trim|required|xss_clean|max_length[100]');
		$data = array();

		if ($this->form_validation->run()) {								// validation ok
			$job['user_id'] = $this->tank_auth->get_user_id();
			$job['company'] = $this->form_validation->set_value('company');
			$job['company_website'] = $this->form_validation->set_value('company_website');
			$job['title'] = $this->form_validation->set_value('position');
			$job['type'] = $type;

			if (!is_null($new_job = $this->job_model->create_job($job))) {
				$job['id'] = $new_job['job_id'];
				$this->load->view('timeline/job', array('job' => (object) $job, 'viewing' => 'my_profile'));
				return;
			} else {
				$data['code'] = 0;
				$data['info'] = 'Add job fail. Please try again.';
			}
		} else {
			$data['code'] = 0;
			$data['info'] = validation_errors('', '');
		}

		echo json_encode($data);
	}

	function delete_job() {
		$this->form_validation->set_rules('job_id', 'Job ID', 'trim|required|xss_clean|integer');
		$data = array();

		// validation ok
		if ($this->form_validation->run()) {
			$job_id = $this->form_validation->set_value('job_id');
			$user_id = $this->tank_auth->get_user_id();

			$job = $this->job_model->get_job($job_id);
			//job owner
			if ($job->user_id == $user_id) {
				if ($this->job_model->delete_job($job_id)) {
					$data['code'] = 1;
					$data['info'] = 'Delete job successfully';
				} else {
					$data['code'] = 0;
					$data['info'] = 'Delete job fail. Please try again.';
				}
			//not job onwer
			} else {
				$data['code'] = 0;
				$data['info'] = 'You can not delete this job.';
			}
		// validation fail
		} else {
			$data['code'] = 0;
			$data['info'] = form_error('job_id', '', '');
		}

		echo json_encode($data);
	}
	function test(){
		echo $this->common->create_thumb('no_ava.jpg', 'assets/upload/ava/');
	}
}

/* End of file timeline.php */
/* Location: ./application/controllers/timeline.php */
