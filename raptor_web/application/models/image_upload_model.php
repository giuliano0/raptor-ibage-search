<?php
class Image_upload_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function manage_image($nome, $description, $album_url, $direct_url)
	{

		$resultado = array();
				
		//call scripts python
//		system('python C:\wamp\www\raptor-ibage-search\descriptor\desc-proj-norm\desc-proj-norm\caracterizar.py $upload_data['full_path'] vetor');
//		system('python C:\wamp\www\raptor-ibage-search\descriptor\desc-proj-norm\desc-proj-norm\projeta.py '.$vetor.' C:\wamp\www\raptor-ibage-search\descriptor\desc-proj-norm\desc-proj-norm\dicionario-2000.pal vetorSaida.hist' );
//		system('python C:\wamp\www\raptor-ibage-search\descriptor\desc-proj-norm\desc-proj-norm\normalizar.py '.$vetorSaida.' VetorSaidaTF.nor');
		
		//read NOR file to retrieve data
		$filename = "C:/wamp/www/raptor-ibage-search/NOR/IMG000002.nor";
		$handle = fopen($filename, "r");
		$nor_raw_content = fread($handle, filesize($filename));
		fclose($handle);
		
		//debug variable
		$resultado['NOR'] = $nor_raw_content;
		
		//get descripto. from NOR file?
		$descriptor = '12132131,312,3,13,1,313131313,131435578,5324254668,434,3767857352,525376587235557795,635435768,56';
		
		//calculate md5
		$md5 = 'xs2x3x45dc6avsdbsydtyab78v90cwc';
		
		//insert image reference into table Images
		$query = "INSERT INTO Images (md5, name, description, descriptor, album_url, direct_url) VALUES ('".$md5."', '".$nome."', '".$description."', '".$descriptor."', '".$album_url."', '".$direct_url."');";
		$this->db->query($query);
		
		//debug variable
		$resultado['query1'] = $query;
		
		//the id o the inserted image
		$image_id = mysql_insert_id();
		
		//debug variable
		$resultado['image_id'] = $image_id;
		
		//mount tag insertion query
		$values = array();
		$tags = array('um', 'dois', 'tres', 'quatro');
		foreach ($tags as $item){
			$values[] = "('".$item."', '".$image_id."')";
		}
		$line = implode(",", $values);
		$query = "INSERT INTO Tags (pk_word, fk_image_id) VALUES ".$line." ;";
		
		//run tag insertion query
		mysql_query($query);
		
		//debug variable
		$resultado['query2'] = $query;
		
		
		
		return $resultado;
	}
}