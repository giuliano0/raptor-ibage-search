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

				#$command = 'c:\Python27\python.exe  ..\descriptor\desc-proj-norm\desc-proj-norm\caracterizar.py '.$data['upload_data']['full_path'].' vetor  ';
				$command = 'c:\Python27\python.exe assets\images\upload\caracterizar.py '.$data['upload_data']['full_path'].' vetor.key  ';
				system($command);
				//print $command;

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

			$data['images'] = $this->tag_search_model->get_images_by_tag("ferrari");
			$data['tags'] = "ferrari";
	
	
	
			$this->load->view('tag_search/index',$data);
	}

}
?>