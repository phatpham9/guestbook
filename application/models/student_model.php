<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * student_model
 *
 * This model represents student info. It operates the following tables:
 * - student
 *
 * @author	Phat Pham
 */
class student_model extends CI_Model
{
	private $table_name	= 'student';			// student

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get students list
	 *
	 * @param	bool
	 * @return	object
	 */
	function get_students()
	{
		$this->db->order_by('id', 'asc');

		$query = $this->db->get($this->table_name);
		return $query->num_rows() > 0 ? $query->result() : NULL;
	}

	/**
	 * Get student
	 *
	 * @param	bool
	 * @return	object
	 */
	function get_student($student_id)
	{
		$this->db->where('student_id', $student_id);

		$query = $this->db->get($this->table_name);
		return $query->num_rows() == 1 ? $query->row() : NULL;
	}

	/**
	 * Check valid student id
	 *
	 * @param	bool
	 * @return	bool
	 */
	function is_student_valid($student_id)
	{
		$this->db->where('student_id', $student_id);

		$query = $this->db->get($this->table_name);
		return $query->num_rows() == 1;
	}
}

/* End of file student_model.php */
/* Location: ./application/models/student_model.php */