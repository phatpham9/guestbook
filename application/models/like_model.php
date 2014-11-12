<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * like_model
 *
 * This model represents status like. It operates the following tables:
 * - like
 *
 * @author	Phat Pham
 */
class like_model extends CI_Model
{
	private $table_name	= 'like';			// like

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get likes of status
	 *
	 * @param	int
	 * @return	array
	 */
	function get_likes($status_id)
	{
		$this->db->where('status_id', $status_id);

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0) return $query->result();
		return NULL;
	}

	/**
	 * Check whether user likes a status or not
	 *
	 * @param	int
	 * @param	int
	 * @return	bool
	 */
	function is_liked($status_id, $user_id)
	{
		$this->db->where(array('status_id' => $status_id, 'user_id' => $user_id));

		$query = $this->db->get($this->table_name);
		return $query->num_rows() == 1;
	}

	/**
	 * Create 1 like
	 *
	 * @param	array
	 * @return	object
	 */
	function like($status_id, $user_id)
	{
		$data = array(
			'status_id'	=> $status_id,
			'user_id'	=> $user_id,
			'created'	=> date('Y-m-d H:i:s')
			);
		if ($this->db->insert($this->table_name, $data)) {
			$status = $this->db->get_where('status', array('id' => $data['status_id']))->row();
			return array('num_likes' => $status->num_likes);
		}
		return NULL;
	}

	/**
	 * Delete 1 like
	 *
	 * @param	int
	 * @param	int
	 * @return	bool
	 */
	function unlike($status_id, $user_id)
	{
		$this->db->where(array('status_id' => $status_id, 'user_id' => $user_id));
		$this->db->delete($this->table_name);
		if ($this->db->affected_rows() == 1) {
			$status = $this->db->get_where('status', array('id' => $status_id))->row();
			return array('num_likes' => $status->num_likes);
		}
		return NULL;
	}
}

/* End of file like_model.php */
/* Location: ./application/models/like_model.php */