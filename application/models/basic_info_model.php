<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * basic_info_model
 *
 * This model represents user basic information. It operates the following tables:
 * - basic info
 *
 * @author	Phat Pham
 */
class basic_info_model extends CI_Model
{
	private $table_name			= 'basic_info';			// basic information

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get basic info by user id
	 *
	 * @param	int
	 * @return	object
	 */
	function get_basic_info($user_id)
	{
		$this->db->where('user_id', $user_id);

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Create basic info for user profile
	 *
	 * @param	array
	 * @return	bool
	 */
	function create_basic_info($data)
	{
		$data['created'] = date('Y-m-d H:i:s');

		return $this->db->insert($this->table_name, $data) ? array('id' => $this->db->insert_id()) : NULL;
	}

	/**
	 * Update basic info for a new user
	 *
	 * @param	array
	 * @return	bool
	 */
	function update_basic_info($data)
	{
		$this->db->where('user_id', $data['user_id']);
		return $this->db->update($this->table_name, $data);
	}

	/**
	 * Update gender
	 *
	 * @param	int
	 * @param	int
	 * @return	bool
	 */
	function update_gender($user_id, $gender)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('gender', $gender);
		return $this->db->update($this->table_name);
	}

	/**
	 * Update date of birth
	 *
	 * @param	int
	 * @param	date
	 * @return	bool
	 */
	function update_date_of_birth($user_id, $dob)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('date_of_birth', $dob);
		return $this->db->update($this->table_name);
	}

	/**
	 * Update place of birth
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function update_place_of_birth($user_id, $pob)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('place_of_birth', $pob);
		return $this->db->update($this->table_name);
	}

	/**
	 * Update relationship status
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function update_relationship_status($user_id, $relationship_status)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('relationship_status', $relationship_status);
		return $this->db->update($this->table_name);
	}

	/**
	 * Update languages
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function update_language($user_id, $language)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('language', $language);
		return $this->db->update($this->table_name);
	}

	/**
	 * Delete basic info
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_basic_info($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->delete($this->table_name);
		return $this->db->affected_rows() > 0 ? TRUE : FALSE;
	}

	/**
	 * Delete gender
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_gender($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('gender', NULL);
		return $this->db->update($this->table_name);
	}

	/**
	 * Delete date of birth
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_date_of_birth($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('date_of_birth', NULL);
		return $this->db->update($this->table_name);
	}

	/**
	 * Delete place of birth
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_place_of_birth($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('place_of_birth', NULL);
		return $this->db->update($this->table_name);
	}

	/**
	 * Delete relationship status
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_relationship_status($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('relationship_status', NULL);
		return $this->db->update($this->table_name);
	}

	/**
	 * Delete languages
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function delete_language($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('language', NULL);
		return $this->db->update($this->table_name);
	}
}

/* End of file basic_info_model.php */
/* Location: ./application/models/basic_info_model.php */