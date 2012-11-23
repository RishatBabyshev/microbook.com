<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {
	public function index()
	{
		$this->load->helper('url');
		
		$data['title'] = 'Welcome to C++';
		$this->load->view('header',$data);	
		
		$this->load->view('footer');	
	}	
}
