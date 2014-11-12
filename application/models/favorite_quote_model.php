<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * favorite_quote_model
 *
 * This model represents favorite quote for user profile. It operates the following tables:
 * - favorite quote
 *
 * @author	Phat Pham
 */
class favorite_quote_model extends CI_Model
{
	private $table_name	= 'favorite_quote';			// favorite quote

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get favorite quote by user id
	 *
	 * @param	int
	 * @return	object
	 */
	function get_favorite_quote($user_id)
	{
		$this->db->where('user_id', $user_id);

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Create favorite quote for user profile
	 *
	 * @param	array
	 * @return	bool
	 */
	function create_favorite_quote($data)
	{
		$data['created'] = date('Y-m-d H:i:s');

		return $this->db->insert($this->table_name, $data) ? array('id' => $this->db->insert_id()) : NULL;
	}

	/**
	 * Update favorite quote
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function update_favorite_quote($data)
	{
		$this->db->where('user_id', $data['user_id']);
		return $this->db->update($this->table_name, $data);
	}

	/**
	 * Delete favorite quote
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_favorite_quote($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->delete($this->table_name);
		return $this->db->affected_rows() > 0 ? TRUE : FALSE;
	}
}

/* End of file favorite_quote_model.php */
/* Location: ./application/models/favorite_quote_model.php */