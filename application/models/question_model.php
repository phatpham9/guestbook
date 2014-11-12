<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * question_model
 *
 * This model represents question. It operates the following tables:
 * - question
 *
 * @author	Phat Pham
 */
class question_model extends CI_Model
{
	private $table_name	= 'question';			// question

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get questions list
	 *
	 * @return	array
	 */
	function get_questions()
	{
		$this->db->order_by('order', 'asc');

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0) return $query->result();
		return NULL;
	}

	/**
	 * Get question
	 *
	 * @param	int
	 * @return	object
	 */
	function get_question($question_id)
	{
		$this->db->where('id', $question_id);

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Create 1 question
	 *
	 * @param	array
	 * @return	object
	 */
	function create_question($data)
	{
		$data['created'] = date('Y-m-d H:i:s');

		if ($this->db->insert($this->table_name, $data)) {
			$question_id = $this->db->insert_id();
			return array('question_id' => $question_id);
		}
		return NULL;
	}

	/**
	 * Update 1 question
	 *
	 * @param	array
	 * @return	bool
	 */
	function update_question($data)
	{
		$this->db->where('id', $data['id']);
		return $this->db->update($this->table_name, $data);
	}

	/**
	 * Delete 1 question
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_question($question_id)
	{
		$this->db->where('id', $question_id);
		$this->db->delete($this->table_name);
		return $this->db->affected_rows() == 1 ? TRUE : FALSE;
	}
}

/* End of file question_model.php */
/* Location: ./application/models/question_model.php */