<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * contact_info_model
 *
 * This model represents user contact information. It operates the following tables:
 * - contact info
 *
 * @author	Phat Pham
 */
class contact_info_model extends CI_Model
{
	private $table_name	= 'contact_info';			// contact information

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get contact info by user id
	 *
	 * @param	int
	 * @return	object
	 */
	function get_contact_info($user_id)
	{
		$this->db->where('user_id', $user_id);

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Create contact info for user profile
	 *
	 * @param	array
	 * @return	bool
	 */
	function create_contact_info($data)
	{
		$data['created'] = date('Y-m-d H:i:s');

		return $this->db->insert($this->table_name, $data) ? array('id' => $this->db->insert_id()) : NULL;
	}

	/**
	 * Update contact info for a new user
	 *
	 * @param	array
	 * @return	bool
	 */
	function update_contact_info($data)
	{
		$this->db->where('user_id', $data['user_id']);
		return $this->db->update($this->table_name, $data);
	}

	/**
	 * Update address
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function update_address($user_id, $address)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('address', $address);
		return $this->db->update($this->table_name);
	}

	/**
	 * Update phone
	 *
	 * @param	int
	 * @param	array
	 * @return	bool
	 */
	function update_phone($user_id, $phone)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('phone', $phone);
		return $this->db->update($this->table_name);
	}

	/**
	 * Update email
	 *
	 * @param	int
	 * @param	array
	 * @return	bool
	 */
	function update_email($user_id, $email)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('email', $email);
		return $this->db->update($this->table_name);
	}

	/**
	 * Update facebook
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function update_facebook($user_id, $facebook)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('facebook', $facebook);
		return $this->db->update($this->table_name);
	}

	/**
	 * Update skype
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function update_skype($user_id, $skype)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('skype', $skype);
		return $this->db->update($this->table_name);
	}

	/**
	 * Delete contact info
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_contact_info($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->delete($this->table_name);
		return $this->db->affected_rows() > 0 ? TRUE : FALSE;
	}

	/**
	 * Delete address
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_address($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('address', NULL);
		return $this->db->update($this->table_name);
	}

	/**
	 * Delete phone
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_phone($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('phone', NULL);
		return $this->db->update($this->table_name);
	}

	/**
	 * Delete email
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_email($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('email', NULL);
		return $this->db->update($this->table_name);
	}

	/**
	 * Delete facebook
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_facebook($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('facebook', NULL);
		return $this->db->update($this->table_name);
	}

	/**
	 * Delete skype
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function delete_skype($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('skype', NULL);
		return $this->db->update($this->table_name);
	}
}

/* End of file contact_info_model.php */
/* Location: ./application/models/contact_info_model.php */