<?php

class Image_search extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('tag_search_model');
		$this->load->helper('url');
		$this->load->helper(array('form', 'url'));
	}
	
	public function index()
	{
	
			$post = $this->input->post();
	
			$data['images'] = $this->tag_search_model->get_images_by_tag("ferrari");
			$data['tags'] = "ferrari";
	
	
	
			$this->load->view('tag_search/index',$data);
	}

}
?>