<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function index()
	{
		$this->load->helper('url');
		
		$data['error'] = $this->input->get('error');
		
		$this->load->view('admin/login', $data);	
	}	
	
	function login() {
		$this->load->library('session');
		$this->load->model('Admin_model');
		$this->load->helper('url');
		$login = $this->input->post('login');
		$password = /*md5*/($this->input->post('password'));
		
		if($this->Admin_model->check_user($login, $password) !== "-1"){
			$this->load->library('session');
			$newdata = array(
                   'login'  => $login,
                   'logged_in' => TRUE,
				   'login_id'  => $this->Admin_model->check_user($login, $password)
               );

			$this->session->set_userdata($newdata);
			$this->output->set_header('Location: '.site_url('admin/main'));
		}
		else{
			$this->output->set_header('Location: '.site_url('admin?error=true'));
		}
	}
	
	function logout() {
		$this->load->library('session');	
		$this->load->helper('url');
		$this->session->unset_userdata('login');
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('login_id');
		$this->session->sess_destroy();

		$this->output->set_header('Location: '.base_url());
	}
	
	
	function main() {
		$this->load->library('session');
		$this->load->helper('url');
		
		if($this->session->userdata('login')) {
			$header_data['menu'] = "main";
			$this->load->view('admin/header',$header_data);	
		} 
		else {
			$this->output->set_header('Location: '.base_url());
		}
	}
	
	function article_list() {
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model("Admin_model");
		
		if($this->session->userdata('login')) {
		
			$data['articles'] = $this->Admin_model->getListOfArticles();
			$header_data['menu'] = "article";
			
			$this->load->view('admin/header',$header_data);	
			$this->load->view('admin/article_list',$data);
		} 
		else {
			$this->output->set_header('Location: '.base_url());
		}

	}
	
	function article_add() {
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model("Admin_model");
		
		if($this->session->userdata('login')) {
		
			$data['error'] = $this->input->get('error');
			$data['categories'] = $this->Admin_model->getListOfCategories();
			$data['action'] = "article_addto"; 
			
			$header_data['menu'] = "article";
			
			$this->load->view('admin/header',$header_data);	
			$this->load->view('admin/article_add',$data);
		} else {
			$this->output->set_header('Location: '.base_url());
		}
	}
	
	function article_addto() {
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model("Admin_model");
		
		if($this->session->userdata('login')) {
			
			$data = NULL;
			
			$name = $this->input->post('name');
			$category_id = $this->input->post('category');
			$definition = $this->input->post('definition');
			$example = $this->input->post('example');
			$task = $this->input->post('task');
			
			$my_order = $this->Admin_model->getAmountOfArticlesInCategory($category_id)+1;
			
			if($name==""){
				$this->output->set_header('Location: '.site_url('admin/article_add?error=name'));
			}
			else if($category_id=="") {
				$this->output->set_header('Location: '.site_url('admin/article_add?error=category'));
			}
			else{
				$this->Admin_model->addArticle($name, $category_id, $definition, $example, $task, $my_order);
				$this->output->set_header('Location: '.site_url('admin/article_list'));
			}
		} 
		else {
			$this->output->set_header('Location: '.base_url());
		}
	}
	
	function article_edit($article_id, $lang) {
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model("Admin_model");
		
		if($this->session->userdata('login')) {
		
			$data['error'] = $this->input->get('error');
			$data['categories'] = $this->Admin_model->getListOfCategories();
			$data['article'] = $this->Admin_model->getArticle($article_id, $lang);
			$data['action'] = "article_editto"; 
			$data['lang'] = $lang; 
			
			$header_data['menu'] = "article";
			
			$this->load->view('admin/header',$header_data);		
			$this->load->view('admin/article_add',$data);
		} 
		else {
			$this->output->set_header('Location: '.base_url());
		}
	}
	
	function article_editto($lang) {
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model("Admin_model");
		
		if($this->session->userdata('login')) {
			// Take new posted information
			$id = $this->input->post('id');
			$name = $this->input->post('name');
			$category_id = $this->input->post('category');
			$definition = $this->input->post('definition');
			$example = $this->input->post('example');
			$task = $this->input->post('task');
			
			$data = NULL;
			
			if($name==""){
				$this->output->set_header('Location: '.site_url('admin/article_edit/'.$id.'/'.$lang.'?error=name'));
			}
			else if($category_id=="") {
				$this->output->set_header('Location: '.site_url('admin/article_edit/'.$id.'/'.$lang.'?error=category'));
			}
			else{
				// Get article information
				$article = $this->Admin_model->getArticle($id, $lang);
				
				// Get order
				$my_order = $article->my_order;

				// Get Category
				$category_id_a = $article->category_id;
				
				// If categories are different 
				if($category_id!=$category_id_a) {
					$my_order = $this->Admin_model->getAmountOfArticlesInCategory($category_id)+1;
					$this->Admin_model->editArticle($id, $name, $category_id, $definition, $example, $task, $my_order, $lang);
					$reorder = $this->Admin_model->sortasc($category_id_a);
				}
				else {
					$this->Admin_model->editArticle($id, $name, $category_id, $definition, $example, $task, $my_order, $lang);	
				}
				
				$this->output->set_header('Location: '.site_url('admin/article_list'));
			}
		} 
		else {
			$this->output->set_header('Location: '.base_url());
		}
	}
	
	function article_delete($article_id) {
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model("Admin_model");
		
		if($this->session->userdata('login')) {
			// Get article information
			$article = $this->Admin_model->getArticle($article_id, "en");
			
			// Get Category
			$category_id = $article->category_id;
			
			$this->Admin_model->deleteArticle($article_id);
			$reorder = $this->Admin_model->sortasc($category_id);
			
			$this->output->set_header('Location: '.site_url('admin/article_list'));
		} 
		else {
			$this->output->set_header('Location: '.base_url());
		}
	}
	
}
