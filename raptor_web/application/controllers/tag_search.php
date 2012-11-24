<?php
class Tag_search extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('tag_search_model');
		$this->load->helper('url');
	}

	public function index()
	{

		$this->load->helper('form');
		$this->load->library('form_validation');
				
		$this->form_validation->set_rules('tags', 'Tags', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('tag_search/index');
		}
		else {
			$post = $this->input->post();

			$data['images'] = $this->tag_search_model->get_images_by_tag($post['tags']);
			$data['tags'] = $post['tags'];

			print_r($data['images']);



			$this->load->view('tag_search/index',$data);
		}
	}

}