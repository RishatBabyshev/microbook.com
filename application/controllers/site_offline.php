<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_offline extends CI_Controller {
	public function index()
	{
		$this->load->model("Microbook_model");
		$this->load->helper('url');
		
		$settings = $this->Microbook_model->getSettings();
		$offline = $settings[0]->offline;
		
		if($offline){
		$this->load->view('offline');	
		
		} else {
			$this->output->set_header('Location: '.base_url());
		}
	}	
}
