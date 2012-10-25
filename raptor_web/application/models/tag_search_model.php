<?php
class Tag_search_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_images_by_tag($tags = FALSE)
	{

		$pieces = explode(" ", $tags);

		$n_tags = count($pieces);

		$query_string = "SELECT * FROM tags";

		$sql = "SELECT fk_image_id,fk_id,count(fk_image_id) as cnt FROM tags WHERE pk_word = ? "; 

		if ($n_tags > 1) {
			for ($i=1; $i<$n_tags; $i++){
				$sql .= "OR pk_word = ? ";
			}	
		}

		$sql .= "GROUP BY fk_image_id ORDER BY cnt DESC";
		printf($sql);

		$query = $this->db->query($sql, $pieces); 
		//return;
		//$query = $this->db->query($query_string);
		return $query->result_array();

	}
}