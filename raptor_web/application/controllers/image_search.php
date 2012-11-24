<?php

class Image_search extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('tag_search_model');
		$this->load->helper('url');
		$this->load->helper(array('form', 'url'));
		$this->load->helper('path');
	}
	
	public function index()
	{
			$config['upload_path'] = 'assets/images/upload/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '2000';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload())
			{
				$error = array('error' => $this->upload->display_errors());

				print_r ($error);

				//$this->load->view('upload_form', $error);
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());

				//calcula md5 e retorna se tiver imagem igual
				$md5 = md5_file($data['upload_data']['full_path']);
				$sql = "SELECT i.name FROM images as i WHERE i.md5 ='".$md5."'";
				$query = $this->db->query($sql);

				if ($query->num_rows() > 0) {
					$data['images'] = $query->result_array();
					$this->load->view('tag_search/index',$data);
				}

				//busca por similaridade
				else{

					$pythonpath = "c:\Python27\python.exe";

					#$command = 'c:\Python27\python.exe  ..\descriptor\desc-proj-norm\desc-proj-norm\caracterizar.py '.$data['upload_data']['full_path'].' vetor  ';
					$command = $pythonpath.' assets\images\upload\caracterizar.py '.$data['upload_data']['full_path'].' vetor.key  ';
					system($command);

					$command2 = $pythonpath.' assets\images\upload\projetar.py assets\images\upload\vetor.key assets\images\upload\dicionario-2000.pal  assets\images\upload\vetorSaida';
					system($command2);

					$command3 = $pythonpath.' assets\images\upload\normalizar.py assets\images\upload\vetorSaida.hist assets\images\upload\VetorSaidaTF';
					system($command3);

					$filename = "assets\images\upload\VetorSaidaTF.nor";
					$handle = fopen($filename, "r");
					$descriptor = fread($handle, filesize($filename));
					fclose($handle);

						

				}

				

				//$sql = "SELECT t.fk_image_id,t.fk_id,i.name FROM tags as t, images as i WHERE t.fk_image_id = i.pk_id AND i.md5 ='".$md5."'";
				



				//call scripts python
				/*
				$handle = popen($command, 'r');
				echo "'$handle'; " . gettype($handle) . "\n";
				$read = fread($handle, 2096);
				echo $read;
				pclose($handle);
				*/

				//system('python C:\wamp\www\raptor-ibage-search\descriptor\desc-proj-norm\desc-proj-norm\projeta.py '.$vetor.' C:\wamp\www\raptor-ibage-search\descriptor\desc-proj-norm\desc-proj-norm\dicionario-2000.pal vetorSaida.hist' );
				//system('python C:\wamp\www\raptor-ibage-search\descriptor\desc-proj-norm\desc-proj-norm\normalizar.py '.$vetorSaida.' VetorSaidaTF.nor');

				//$data['resultado'] = $this->image_upload_model->manage_image($post['imageName'], $post['description'], $post['albumUrl'], $post['imageUrl']);
				
				//$this->load->view('upload_success', $data);
			}

			/*
			$data['images'] = $this->tag_search_model->get_images_by_tag("ferrari");
			$data['tags'] = "ferrari";	
			$this->load->view('tag_search/index',$data);
			*/
	}

}
?>