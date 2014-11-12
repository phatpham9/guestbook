<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Common
 *
 * Common functions to use
 *
 * @author		Phat Pham
 */
class Common {
	function __construct(){
        $this->ci =& get_instance();
    }

	/**
	 * Calculate time ago
	 *
	 * @param	datetime	
	 * @param	bool
	 * @return	string
	 */
	function calculate_time_ago($datetime, $full = false) {
	    $now = new DateTime();
	    $ago = new DateTime($datetime);
	    $diff = $now->diff($ago);

	    if ($diff->days > 28) {
	    	return date('j F Y', strtotime($datetime));
	    } else {
		    $diff->w = floor($diff->d / 7);
		    $diff->d -= $diff->w * 7;

		    $string = array(
		        'w' => 'week',
		        'd' => 'day',
		        'h' => 'hour',
		        'i' => 'minute',
		        's' => 'second',
		    );
		    foreach ($string as $k => &$v) {
		        if ($diff->$k) {
		            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
		        } else {
		            unset($string[$k]);
		        }
		    }

		    if (!$full) $string = array_slice($string, 0, 1);
		    return $string ? implode(', ', $string) . ' ago' : 'just now';
	    }
	}

	/**
	 * Create thumb
	 *
	 * @param	string
	 * @param	string
	 * @param	int
	 * @param 	int
	 * @return	string
	 */
	function create_thumb($file_name, $file_path, $width = 40, $height = 40) {
		$config['image_library'] = 'gd2';
		$config['source_image']	= $file_path . $file_name;
		$config['new_image'] = $file_path . 'thumb/' . $file_name;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = $width;
		$config['height'] = $height;

		$this->ci->load->library('image_lib', $config);

		return $this->ci->image_lib->resize() ? TRUE : $this->ci->image_lib->display_errors();
	}

	/**
	 * Create thumb
	 *
	 * @param	string
	 * @return	string
	 */
	function get_thumb_url($user_id) {
		$this->ci->load->model('ava_model');

		if (!is_null($ava = $this->ci->ava_model->get_ava($user_id))) {
			return site_url() . $ava->thumb_path . $ava->file_name . $ava->file_ext;
		} else {
			return site_url() . 'assets/upload/ava/thumb/no_ava.jpg';
		}
	}
}

/* End of file Common.php */
/* Location: ./application/libraries/Common.php */