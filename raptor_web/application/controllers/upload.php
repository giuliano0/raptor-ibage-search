<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('image_upload_model');
	}

	function index()
	{
		$this->load->view('insert_image', array('error' => ' ' ));
	}

	function do_upload()
	{

		$config['upload_path'] = 'assets/images/upload/';
		#$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '2000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload_form', $error);
		}
		else
		{

			$data = array('upload_data' => $this->upload->data());
			$post = $this->input->post();
			print_r($post);
			$data['resultado'] = $this->image_upload_model->manage_image($post['imageName'], $post['description'], $post['albumUrl'], $post['imageUrl']);
			
			$this->load->view('upload_success', $data);
		}
	}
}
?>