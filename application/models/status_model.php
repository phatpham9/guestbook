<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * status_model
 *
 * This model represents status. It operates the following tables:
 * - status
 * - user
 * - ava
 *
 * @author	Phat Pham
 */
class status_model extends CI_Model
{
	private $table_name	= 'status';			// status
	private $user_table_name = 'user';		// user
	private $ava_table_name = 'ava';		// ava

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get recent statuses by user id
	 *
	 * @param	int
	 * @return	array
	 */
	function get_statuses($user_id, $record, $page)
	{
		if($page == 0 || $page == null)
			$page = 1;
        $offset = ($page - 1) * $record;

		$this->db->select($this->user_table_name . '.username');
		$this->db->select($this->user_table_name . '.full_name');
		$this->db->from($this->user_table_name);
		$this->db->join($this->table_name, $this->table_name . '.user_id = ' . $this->user_table_name . '.id');
		$this->db->select($this->table_name . '.*');
		$this->db->where($this->table_name . '.user_id', $user_id);
		$this->db->order_by($this->table_name . '.created', 'desc');
		$this->db->limit($record, $offset);//"Số record trên 1 trang","Vị trí bắt đầu"  

		$query = $this->db->get();
		if ($query->num_rows() > 0) return $query->result();
		return NULL;
	}
	/*=====================================================================================================*/
	/**
	 * Get recent news feed
	 *
	 * @param	int
	 * @param	int
	 * @return	array
	 */
	function get_news_feed($record, $page)
	{
		if($page == 0 || $page == null)
			$page = 1;
        $offset = ($page - 1) * $record;

		$this->db->select($this->user_table_name . '.username');
		$this->db->select($this->user_table_name . '.full_name');
		$this->db->from($this->user_table_name);
		$this->db->join($this->table_name, $this->table_name . '.user_id = ' . $this->user_table_name . '.id');
		$this->db->select($this->table_name . '.*');
		$this->db->order_by($this->table_name . '.created', 'desc');
		$this->db->limit($record, $offset);//"Số record trên 1 trang","Vị trí bắt đầu"  

		$query = $this->db->get();
		return  $query->num_rows() > 0 ? $query->result() : NULL;
	}

	/**
	 * Get 1 status
	 *
	 * @param	int
	 * @return	object
	 */
	function get_status($status_id)
	{
		$this->db->select($this->user_table_name . '.username');
		$this->db->select($this->user_table_name . '.full_name');
		$this->db->from($this->user_table_name);
		$this->db->join($this->table_name, $this->table_name . '.user_id = ' . $this->user_table_name . '.id');
		$this->db->select($this->table_name . '.*');
		$this->db->where($this->table_name . '.id', $status_id);
		$this->db->order_by($this->table_name . '.created', 'desc');
		
		$query = $this->db->get();
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Create 1 status
	 *
	 * @param	array
	 * @return	object
	 */
	function create_status($data)
	{
		$data['created'] = date('Y-m-d H:i:s');

		if ($this->db->insert($this->table_name, $data)) {
			$data['id'] = $this->db->insert_id();
			return $data;
		}
		return NULL;
	}

	/**
	 * Update 1 status
	 *
	 * @param	array
	 * @return	bool
	 */
	function update_status($data)
	{
		$this->db->where('id', $data['id']);
		return $this->db->update($this->table_name, $data);
	}

	/**
	 * Delete 1 status
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_status($status_id)
	{
		$this->db->where('id', $status_id);
		$this->db->delete($this->table_name);
		return $this->db->affected_rows() == 1 ? TRUE : FALSE;
	}
}

/* End of file status_model.php */
/* Location: ./application/models/status_model.php */