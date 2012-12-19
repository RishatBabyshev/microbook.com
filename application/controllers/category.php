<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {
	public function index()
	{
		$this->load->helper('url');
		
		/* If Offline */
		$settings = $this->Microbook_model->getSettings();
		$data['title'] = $settings[0]->name;
		$offline = $settings[0]->offline;
		
		if($offline){
			$this->output->set_header('Location: '.site_url('site_offline'));
		}
		/* End If Offline */
		
		$this->load->view('header',$data);	
		
		$this->load->view('footer');	
	}	
}
