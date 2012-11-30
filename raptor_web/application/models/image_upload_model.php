<?php
class Image_upload_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function manage_image($upload_data, $nome, $description, $album_url, $direct_url, $tags)
	{

		$resultado = array();

		$pythonpath = "c:\Python27\python.exe";

		$command = $pythonpath.' assets\images\upload\caracterizar.py '.$upload_data['full_path'].' insert.key  ';
		system($command);

		$command2 = $pythonpath.' assets\images\upload\projetar.py assets\images\upload\insert.key assets\images\upload\dicionario-2000.pal  assets\images\upload\insertSaida';
		system($command2);

		$command3 = $pythonpath.' assets\images\upload\normalizar.py assets\images\upload\insertSaida.hist assets\images\upload\InsertSaidaTF';
		system($command3);


		
		//TODO: (maybe) call scripts python separately
//		system('python C:\wamp\www\raptor-ibage-search\descriptor\desc-proj-norm\desc-proj-norm\caracterizar.py $upload_data['full_path'] vetor');
//		system('python C:\wamp\www\raptor-ibage-search\descriptor\desc-proj-norm\desc-proj-norm\projeta.py '.$vetor.' C:\wamp\www\raptor-ibage-search\descriptor\desc-proj-norm\desc-proj-norm\dicionario-2000.pal vetorSaida.hist' );
//		system('python C:\wamp\www\raptor-ibage-search\descriptor\desc-proj-norm\desc-proj-norm\normalizar.py '.$vetorSaida.' VetorSaidaTF.nor');
		
		//$python_script_path = "C:\wamp\www\raptor-ibage-search\raptor_web\assets\images\upload\TUDO.py";
		$uploaded_image_path = $upload_data["full_path"];
		//TODO: (maybe) ou se der pra pegar pelo nome do arquivo na mesma pasta sem o caminho
		// $uploaded_image_path = $upload_data["file_path"];
//		$output_file = $upload_data["raw_name"].".nor";
		//TODO: really call python
		// 		system('python '.$python_script_path.' '.$uploaded_image_path.' '.$output_file);
		//echo 'python '.$python_script_path.' '.$uploaded_image_path.' '.$output_file;
		
		//$filename = "C:/wamp/www/raptor-ibage-search/raptor_web/assets/images/upload/".$output_file;
		//TODO: remove MOCK
		$filename = "assets\images\upload\InsertSaidaTF.nor";
		$handle = fopen($filename, "r");
		$descriptor = fread($handle, filesize($filename));
		fclose($handle);

		$arraydesc = explode(" ",($descriptor));

		foreach ($arraydesc as $key => $value) {
			$arraydesc[$key] = number_format(floatval($value), 14, '.', '');
		}

		$arraydesc = array_slice($arraydesc, 0, 2000);

		$descbd = implode("",$arraydesc);

		//debug variable --DELETE OR COMMENT
		//$resultado['NOR'] = $descriptor;
		
		//calculate md5
		$md5 = md5_file($uploaded_image_path);
		//debug variable --DELETE OR COMMENT
		//$resultado['MD5'] = $md5;
		
		//calculate cluster -- TODO: DONE?
		$fk_cluster_id = $this->calculate_cluster($descbd);

		//debug variable --DELETE OR COMMENT
		$resultado['clusters'] = $fk_cluster_id;
		//TODO: REMOVE \/ when it works, when tested if really works
		$fk_cluster_id = 1;
		
		
		//insert image reference into table Images
		$query = "INSERT INTO  `raptorsearch`.`images` (`md5`, `name`, `description`, `descriptor`, `fk_clusterID`, `album_url`, `direct_url`) 
			VALUES ('".$md5."',  '".$nome."',  '".$description."',  '".$descbd."', '".$fk_cluster_id."' ,  '".$album_url."',  '".$direct_url."');";
		
		$this->db->query($query);
		
		//debug variable --DELETE OR COMMENT
		//$resultado['query1'] = $query;
		
		//the id of the inserted image
		$image_id = mysql_insert_id();
		
		//debug variable --DELETE OR COMMENT
		//$resultado['image_id'] = $image_id;
		
		//build tag insertion query
		$values = array();
		$tags = explode(" ", $tags);
		foreach ($tags as $item){
			$values[] = "('".$item."', '".$image_id."')";
		}
		$line = implode(",", $values);
		$query = "INSERT INTO Tags (pk_word, fk_image_id) VALUES ".$line." ;";
		mysql_query($query);
		
		//debug variable --DELETE OR COMMENT
		//$resultado['query2'] = $query;
		
		return $resultado;
	}
	
	
	private function calculate_cluster($originalNOR){
		
// 		$dicionario = 2000;
		$insertedVector = $this->calculateFloatVector($originalNOR);

		$query = "SELECT * FROM  `clusters`";
		$rs = $this->db->query($query);
		$clusters = $rs->result_array();

		//inicializa com os valores do primeiro cluster encontrado: $clusters[0]
		$nexterCluster = $clusters[0]['clusterID'];
		$menorDistancia = $this->euclidean_canonical_very_dumb($this->calculateFloatVector($clusters[0]['centroid']), $insertedVector);
		
		foreach ($clusters as $key => $data){
// 			$data = array contendo um campo centroid e um campo clusterID
			$arrayCandidato = $this->calculateFloatVector($data['centroid']);
			$distancia = $this->euclidean_canonical_very_dumb($arrayCandidato, $insertedVector);
			
			if ($distancia < $menorDistancia){
				$menorDistancia = $distancia;
				$nexterCluster = $data['clusterID'];
			}
		}
		return $nexterCluster;
	}
	
	private function calculateFloatVector($NOR){
		
			$NOR = str_replace(",", ".", $NOR);
			$array = str_split($NOR, 16);
			return $array;
	}
	
	private function euclidean_canonical_very_dumb($u, $v)
	{
		$distance = 0;
		 
		for ($i = 0; $i < 2000; $i++)
			$distance += ($u[$i] - $v[$i]) * ($u[$i] - $v[$i]);
			 
			return $distance;
	}
	
	
}