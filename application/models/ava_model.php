<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ava_model
 *
 * This model represents avatar. It operates the following tables:
 * - ava
 *
 * @author	Phat Pham
 */
class ava_model extends CI_Model
{
	private $table_name	= 'ava';			// avatar

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get ava
	 *
	 * @param	bool
	 * @return	object
	 */
	function get_ava($user_id)
	{
		$this->db->where('user_id', $user_id);

		$query = $this->db->get($this->table_name);
		return $query->num_rows() == 1 ? $query->row() : NULL;
	}

	/**
	 * Check ava available
	 *
	 * @param	bool
	 * @return	bool
	 */
	function is_ava_existed($user_id)
	{
		$this->db->select('1', FALSE);
		$this->db->where('user_id', $user_id);

		$query = $this->db->get($this->table_name);
		return $query->num_rows() == 1;
	}

	/**
	 * Create ava
	 *
	 * @param	array
	 * @return	object
	 */
	function create_ava($data)
	{
		$data['created'] = date('Y-m-d H:i:s');

		if ($this->db->insert($this->table_name, $data)) {
			return array('id' => $this->db->insert_id());
		}
		return NULL;
	}

	/**
	 * Update ava
	 *
	 * @param	array
	 * @return	bool
	 */
	function update_ava($data)
	{
		$this->db->where('user_id', $data['user_id']);
		return $this->db->update($this->table_name, $data);
	}

	/**
	 * Delete ava
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete($user_id)
	{
		$this->db->where(array('user_id' => $user_id));
		$this->db->delete($this->table_name);
		return $this->db->affected_rows() == 1 ? TRUE : FALSE;
	}
}

/* End of file ava_model.php */
/* Location: ./application/models/ava_model.php */