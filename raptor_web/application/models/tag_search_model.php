<?php
class Tag_search_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_images_by_tag($tags = FALSE)
	{
		$query_string = "SELECT * FROM tags WHERE pk_word =".$this->db->escape($tags)." LIMIT 0,10";

		$query = $this->db->query($query_string);
		return $query->result_array();

	}
}