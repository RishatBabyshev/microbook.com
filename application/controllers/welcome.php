<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->model("Microbook_model");
		$this->load->helper('url');
		$data['title'] = 'Welcome to C++';
		
		$lang = "en";
		
	
		$a = $this->Microbook_model->getListOfCategories();
		$data_a['lang'] = $lang;
		$data_a['menus'] = $a;
		foreach($a as $b):
			$data_a['article'.$b->id] = $this->Microbook_model->getListOfArticles($b->id, $lang);
		endforeach;

		$data['lang'] = $lang;	

		
		$this->load->view('header',$data);
		
		$this->load->view('welcome_message', $data_a);
		
		$this->load->view('footer');	
	}

	public function lang($lang)
	{
		$this->load->model("Microbook_model");
		$this->load->helper('url');
		$data['title'] = 'Welcome to C++';
		$this->load->view('header',$data);	
	
		$a = $this->Microbook_model->getListOfCategories();
		$data_a['lang'] = $lang;
		$data_a['menus'] = $a;
		foreach($a as $b):
			$data_a['article'.$b->id] = $this->Microbook_model->getListOfArticles($b->id, $lang);
		endforeach;
		
		$this->load->view('welcome_message', $data_a);
		
		$this->load->view('footer');	
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */