<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * job_model
 *
 * This model represents user current and last job. It operates the following tables:
 * - job
 *
 * @author	Phat Pham
 */
class job_model extends CI_Model
{
	private $table_name	= 'job';			// job

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get many current jobs by user id
	 *
	 * @param	int
	 * @return	array
	 */
	function get_current_jobs($user_id)
	{
		$this->db->where(array('user_id' => $user_id, 'type' => 'current_job'));
		$this->db->order_by('created', 'desc');

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0) return $query->result();
		return NULL;
	}

	/**
	 * Get many last jobs by user id
	 *
	 * @param	int
	 * @return	array
	 */
	function get_last_jobs($user_id)
	{
		$this->db->where(array('user_id' => $user_id, 'type' => 'last_job'));
		$this->db->order_by('created', 'desc');

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0) return $query->result();
		return NULL;
	}

	/**
	 * Get job
	 *
	 * @param	int
	 * @return	object
	 */
	function get_job($job_id)
	{
		$this->db->where('id', $job_id);

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Create 1 job
	 *
	 * @param	array
	 * @return	object
	 */
	function create_job($data)
	{
		$data['created'] = date('Y-m-d H:i:s');

		if ($this->db->insert($this->table_name, $data)) {
			$job_id = $this->db->insert_id();
			return array('job_id' => $job_id);
		}
		return NULL;
	}

	/**
	 * Update 1 job
	 *
	 * @param	array
	 * @return	bool
	 */
	function update_job($data)
	{
		$this->db->where('id', $data['id']);
		return $this->db->update($this->table_name, $data);
	}

	/**
	 * Delete 1 job
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_job($job_id)
	{
		$this->db->where('id', $job_id);
		$this->db->delete($this->table_name);
		return $this->db->affected_rows() == 1 ? TRUE : FALSE;
	}
}

/* End of file job_model.php */
/* Location: ./application/models/job_model.php */