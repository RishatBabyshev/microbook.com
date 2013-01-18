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
		$this->load->model("User_role_model");
		$this->load->helper('url');
		$login = $this->input->post('login');
		$password = /*md5*/($this->input->post('password'));
		
		if($this->Admin_model->check_user($login, $password) !== "-1"){
			$this->load->library('session');
			
			$user_id = $this->Admin_model->check_user($login, $password);
			$privileges = array();
			foreach($this->User_role_model->getPriveleges($user_id) as $p):
				array_push($privileges, $p->name);
			endforeach;
			
			
			$newdata = array(
                   'login'  => $login,
                   'logged_in' => TRUE,
				   'login_id'  => $user_id,
				   'privileges' => $privileges
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
		$this->session->unset_userdata('privileges');
		$this->session->sess_destroy();

		$this->output->set_header('Location: '.base_url());
	}
	
	/* Main */
	function main() {
		$this->load->library('session');
		$this->load->helper('url');
		
		if($this->session->userdata('login')) {
			$header_data['menu'] = "main";
			$this->load->view('admin/header',$header_data);	
			$this->load->view('admin/main');
		} 
		else {
			$this->output->set_header('Location: '.base_url());
		}
	}
	
	/* Articles */
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
			
			/* Check for privilege */
			$privileges = $this->session->userdata('privileges');
			if(!in_array("ADD_ARTICLE", $privileges)){
				$url;
				if(ISSET($_SERVER['HTTP_REFERER'])){
					$url = $_SERVER['HTTP_REFERER'];
				}
				else {
					$url = site_url('admin/main');
				}
				$this->output->set_header('Location: '.$url);
			}/* End of check */
			else {
				$data['error'] = $this->input->get('error');
				$data['categories'] = $this->Admin_model->getListOfCategories();
				$data['action'] = "article_addto"; 
				
				$header_data['menu'] = "article";
				
				$this->load->view('admin/header',$header_data);	
				$this->load->view('admin/article_add',$data);
			}
			
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
		
			/* Check for privilege */
			$privileges = $this->session->userdata('privileges');
			if(!in_array("EDIT_ARTICLE", $privileges)){
				$url;
				if(ISSET($_SERVER['HTTP_REFERER'])){
					$url = $_SERVER['HTTP_REFERER'];
				}
				else {
					$url = site_url('admin/main');
				}
				$this->output->set_header('Location: '.$url);
			}/* End of check */
			else {				
				$data['error'] = $this->input->get('error');
				$data['categories'] = $this->Admin_model->getListOfCategories();
				$data['article'] = $this->Admin_model->getArticle($article_id, $lang);
				$data['action'] = "article_editto"; 
				$data['lang'] = $lang; 
				
				$header_data['menu'] = "article";
				
				$this->load->view('admin/header',$header_data);		
				$this->load->view('admin/article_add',$data);
			}
			
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
			
			/* Check for privilege */
			$privileges = $this->session->userdata('privileges');
			if(!in_array("DELETE_ARTICLE", $privileges)){
				$url;
				if(ISSET($_SERVER['HTTP_REFERER'])){
					$url = $_SERVER['HTTP_REFERER'];
				}
				else {
					$url = site_url('admin/main');
				}
				$this->output->set_header('Location: '.$url);
			}/* End of check */
			else {
				// Get article information
				$article = $this->Admin_model->getArticle($article_id, "en");
				
				// Get Category
				$category_id = $article->category_id;
				
				$this->Admin_model->deleteArticle($article_id);
				$reorder = $this->Admin_model->sortasc($category_id);
				
				$this->output->set_header('Location: '.site_url('admin/article_list'));
			}
			
		} 
		else {
			$this->output->set_header('Location: '.base_url());
		}
	}
	
	function article_up($article_id) {
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model("Admin_model");
		
		if($this->session->userdata('login')) {
			
			/* Check for privilege */
			$privileges = $this->session->userdata('privileges');
			if(!in_array("EDIT_ARTICLE", $privileges)){
				$url;
				if(ISSET($_SERVER['HTTP_REFERER'])){
					$url = $_SERVER['HTTP_REFERER'];
				}
				else {
					$url = site_url('admin/main');
				}
				$this->output->set_header('Location: '.$url);
			}/* End of check */
			else {	
				// Get article information
				$article = $this->Admin_model->getArticle($article_id, "en");
				
				// Get Category
				$category_id = $article->category_id;
				
				// Get Order
				$my_order = $article->my_order;
				
				// Amount of articles
				$amount_of_articles = $this->Admin_model->getAmountOfArticlesInCategory($category_id);
				
				if($my_order!=$amount_of_articles) {
					// Another Article
					$my_order_up = $article->my_order+1;
					$article_up = $this->Admin_model->getArticleByOrder($my_order_up, $category_id);
					
					$this->Admin_model->changeOrderOfArticles($article->id, $my_order_up, $article_up->id, $my_order);
				}
				
				$this->output->set_header('Location: '.site_url('admin/article_list'));		
			}
			
		} 
		else {
			$this->output->set_header('Location: '.base_url());
		}
	}
	
	function article_down($article_id) {
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model("Admin_model");
		
		if($this->session->userdata('login')) {
			
			/* Check for privilege */
			$privileges = $this->session->userdata('privileges');
			if(!in_array("EDIT_ARTICLE", $privileges)){
				$url;
				if(ISSET($_SERVER['HTTP_REFERER'])){
					$url = $_SERVER['HTTP_REFERER'];
				}
				else {
					$url = site_url('admin/main');
				}
				$this->output->set_header('Location: '.$url);
			}/* End of check */
			else {	
				// Get article information
				$article = $this->Admin_model->getArticle($article_id, "en");
				
				// Get Category
				$category_id = $article->category_id;
				
				// Get Order
				$my_order = $article->my_order;
				
				if($my_order!=1) {			
					// Another Article
					$my_order_down = $article->my_order-1;
					$article_down = $this->Admin_model->getArticleByOrder($my_order_down, $category_id);
					
					$this->Admin_model->changeOrderOfArticles($article->id, $my_order_down, $article_down->id, $my_order);
				}
				
				$this->output->set_header('Location: '.site_url('admin/article_list'));	
			}
			
		} 
		else {
			$this->output->set_header('Location: '.base_url());
		}
	}
	
	/* Categories */
	
	function category_list() {
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model("Admin_model");
		
		if($this->session->userdata('login')) {
		
			$data['categories'] = $this->Admin_model->getListOfCategories();
			$header_data['menu'] = "category";
			
			$this->load->view('admin/header',$header_data);	
			$this->load->view('admin/category_list',$data);
		} 
		else {
			$this->output->set_header('Location: '.base_url());
		}
	}

	function category_add() {
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model("Admin_model");
		
		if($this->session->userdata('login')) {
			
			/* Check for privilege */
			$privileges = $this->session->userdata('privileges');
			if(!in_array("ADD_CATEGORY", $privileges)){
				$url;
				if(ISSET($_SERVER['HTTP_REFERER'])){
					$url = $_SERVER['HTTP_REFERER'];
				}
				else {
					$url = site_url('admin/main');
				}
				$this->output->set_header('Location: '.$url);
			}/* End of check */
			else {
				$data['error'] = $this->input->get('error');
				$data['action'] = "category_addto"; 
				
				$header_data['menu'] = "category";
				
				$this->load->view('admin/header',$header_data);	
				$this->load->view('admin/category_add',$data);
			}
			
		} else {
			$this->output->set_header('Location: '.base_url());
		}
	}
	
	function category_addto() {
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model("Admin_model");
		
		if($this->session->userdata('login')) {
			
			$data = NULL;
			
			$name_en = $this->input->post('name_en');
			$name_ru = $this->input->post('name_ru');
			$name_kz = $this->input->post('name_kz');
			
			$my_order = $this->Admin_model->getAmountOfCategories()+1;
			
			if($name_ru=="")$name_ru = $name_en;
			if($name_kz=="")$name_kz = $name_en;
			
			if($name_en==""){
				$this->output->set_header('Location: '.site_url('admin/category_add?error=name_en'));
			}
			else{
				$this->Admin_model->addCategory($name_en, $name_ru, $name_kz, $my_order);
				$this->output->set_header('Location: '.site_url('admin/category_list'));
			}
		} 
		else {
			$this->output->set_header('Location: '.base_url());
		}
	}
	
	function category_edit($category_id) {
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model("Admin_model");
		
		if($this->session->userdata('login')) {
		
			/* Check for privilege */
			$privileges = $this->session->userdata('privileges');
			if(!in_array("EDIT_CATEGORY", $privileges)){
				$url;
				if(ISSET($_SERVER['HTTP_REFERER'])){
					$url = $_SERVER['HTTP_REFERER'];
				}
				else {
					$url = site_url('admin/main');
				}
				$this->output->set_header('Location: '.$url);
			}/* End of check */
			else {
				$data['error'] = $this->input->get('error');
				$data['category'] = $this->Admin_model->getCategory($category_id);
				$data['action'] = "category_editto"; 
				
				$header_data['menu'] = "category";
				
				$this->load->view('admin/header',$header_data);		
				$this->load->view('admin/category_add',$data);
			}
			
		} 
		else {
			$this->output->set_header('Location: '.base_url());
		}
	}
	
	function category_editto() {
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model("Admin_model");
		
		if($this->session->userdata('login')) {
			// Take new posted information
			$id = $this->input->post('id');
			$name_en = $this->input->post('name_en');
			$name_ru = $this->input->post('name_ru');
			$name_kz = $this->input->post('name_kz');
			
			$data = NULL;
			
			if($name_ru=="")$name_ru = $name_en;
			if($name_kz=="")$name_kz = $name_en;
			
			if($name_en==""){
				$this->output->set_header('Location: '.site_url('admin/category_edit/'.$id.'?error=name_en'));
			}
			else{
				$this->Admin_model->editCategory($id, $name_en, $name_ru, $name_kz);	
				
				$this->output->set_header('Location: '.site_url('admin/category_list'));
			}
		} 
		else {
			$this->output->set_header('Location: '.base_url());
		}
	}
	
	function category_delete($category_id) {
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model("Admin_model");
		
		if($this->session->userdata('login')) {
			
			/* Check for privilege */
			$privileges = $this->session->userdata('privileges');
			if(!in_array("DELETE_CATEGORY", $privileges)){
				$url;
				if(ISSET($_SERVER['HTTP_REFERER'])){
					$url = $_SERVER['HTTP_REFERER'];
				}
				else {
					$url = site_url('admin/main');
				}
				$this->output->set_header('Location: '.$url);
			}/* End of check */
			else {
				$this->Admin_model->deleteCategory($category_id);
				$reorder = $this->Admin_model->sortascCategory();
				
				$this->output->set_header('Location: '.site_url('admin/category_list'));
			}
			
		} 
		else {
			$this->output->set_header('Location: '.base_url());
		}
	}

	function category_up($category_id) {
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model("Admin_model");
		
		if($this->session->userdata('login')) {
			
			/* Check for privilege */
			$privileges = $this->session->userdata('privileges');
			if(!in_array("EDIT_CATEGORY", $privileges)){
				$url;
				if(ISSET($_SERVER['HTTP_REFERER'])){
					$url = $_SERVER['HTTP_REFERER'];
				}
				else {
					$url = site_url('admin/main');
				}
				$this->output->set_header('Location: '.$url);
			}/* End of check */
			else {
				// Get category information
				$category = $this->Admin_model->getCategory($category_id);
				
				// Get Order
				$my_order = $category->my_order;
				
				// Amount of categories
				$amount_of_categories = $this->Admin_model->getAmountOfCategories();
				
				if($my_order!=$amount_of_categories) {
					// Another Category
					$my_order_up = $category->my_order+1;
					$category_up = $this->Admin_model->getCategoryByOrder($my_order_up);
					
					$this->Admin_model->changeOrderOfCategories($category->id, $my_order_up, $category_up->id, $my_order);
				}
				
				$this->output->set_header('Location: '.site_url('admin/category_list'));		
			}
			
		} 
		else {
			$this->output->set_header('Location: '.base_url());
		}
	}
	
	function category_down($category_id) {
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model("Admin_model");
		
		if($this->session->userdata('login')) {
			
			/* Check for privilege */
			$privileges = $this->session->userdata('privileges');
			if(!in_array("EDIT_CATEGORY", $privileges)){
				$url;
				if(ISSET($_SERVER['HTTP_REFERER'])){
					$url = $_SERVER['HTTP_REFERER'];
				}
				else {
					$url = site_url('admin/main');
				}
				$this->output->set_header('Location: '.$url);
			}/* End of check */
			else {
				// Get category information
				$category = $this->Admin_model->getCategory($category_id);
				
				// Get Order
				$my_order = $category->my_order;
				
				if($my_order!=1) {			
					// Another Category
					$my_order_down = $category->my_order-1;
					$category_down = $this->Admin_model->getCategoryByOrder($my_order_down);
					
					$this->Admin_model->changeOrderOfCategories($category->id, $my_order_down, $category_down->id, $my_order);
				}
				
				$this->output->set_header('Location: '.site_url('admin/category_list'));		
			}
			
		} 
		else {
			$this->output->set_header('Location: '.base_url());
		}
	}
	
	/* User */
	
	function user_list() {
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model("User_role_model");
		
		if($this->session->userdata('login')) {
			
			/* Check for privilege */
			$privileges = $this->session->userdata('privileges');
			if(!in_array("ADD_USER", $privileges)){
				$url;
				if(ISSET($_SERVER['HTTP_REFERER'])){
					$url = $_SERVER['HTTP_REFERER'];
				}
				else {
					$url = site_url('admin/main');
				}
				$this->output->set_header('Location: '.$url);
			}/* End of check */
			else {
				$data['users'] = $this->User_role_model->getUsers();
				$header_data['menu'] = "user";
				
				$this->load->view('admin/header',$header_data);	
				$this->load->view('admin/user_list',$data);
			}
			
		}
		else {
			$this->output->set_header('Location: '.base_url());
		}
	}
	
	function user_add() {
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model("User_role_model");
		
		if($this->session->userdata('login')) {
			
			/* Check for privilege */
			$privileges = $this->session->userdata('privileges');
			if(!in_array("ADD_USER", $privileges)){
				$url;
				if(ISSET($_SERVER['HTTP_REFERER'])){
					$url = $_SERVER['HTTP_REFERER'];
				}
				else {
					$url = site_url('admin/main');
				}
				$this->output->set_header('Location: '.$url);
			}/* End of check */
			else {
				$data['error'] = $this->input->get('error');
				$data['action'] = "user_addto"; 
				$data['roles'] = $this->User_role_model->getRoles();
				
				$header_data['menu'] = "user";
				
				$this->load->view('admin/header',$header_data);	
				$this->load->view('admin/user_add',$data);
			}
			
		} else {
			$this->output->set_header('Location: '.base_url());
		}
	}
	
	function user_addto() {
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model("User_role_model");
		$this->load->model("Admin_model");
		
		if($this->session->userdata('login')) {
			
			$data = NULL;
			
			$login = $this->input->post('login');
			$password = $this->input->post('password');
			$password_conf = $this->input->post('password_conf');
			$role = $this->input->post('role');
			$email = $this->input->post('email');
			
			
			if($login=="") {
				$this->output->set_header('Location: '.site_url('admin/user_add?error=login'));
			}
			else if($this->Admin_model->check_for_user($login)!=-1) {
				$this->output->set_header('Location: '.site_url('admin/user_add?error=login'));
			}
			else if($password=="") {
				$this->output->set_header('Location: '.site_url('admin/user_add?error=password'));
			}
			else if($password_conf=="") {
				$this->output->set_header('Location: '.site_url('admin/user_add?error=password_conf'));
			}
			else if($password!=$password_conf) {
				$this->output->set_header('Location: '.site_url('admin/user_add?error=password'));
			}
			else if($role=="") {
				$this->output->set_header('Location: '.site_url('admin/user_add?error=role'));
			}
			else if($email=="") {
				$this->output->set_header('Location: '.site_url('admin/user_add?error=email'));
			}
			else{
				$this->User_role_model->addUser($login, $password, $role, $email);
				$this->output->set_header('Location: '.site_url('admin/user_list'));
			}
		} 
		else {
			$this->output->set_header('Location: '.base_url());
		}
	}
	
	function user_edit($user_id) {
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model("User_role_model");
		
		if($this->session->userdata('login')) {
			
			/* Check for privilege */
			$privileges = $this->session->userdata('privileges');
			if(!in_array("ADD_USER", $privileges)){
				$url;
				if(ISSET($_SERVER['HTTP_REFERER'])){
					$url = $_SERVER['HTTP_REFERER'];
				}
				else {
					$url = site_url('admin/main');
				}
				$this->output->set_header('Location: '.$url);
			}/* End of check */
			else {
				$data['error'] = $this->input->get('error');
				$data['user'] = $this->User_role_model->getUser($user_id);
				$data['action'] = "user_editto"; 
				$data['roles'] = $this->User_role_model->getRoles();
				
				$header_data['menu'] = "user";
				
				$this->load->view('admin/header',$header_data);		
				$this->load->view('admin/user_add',$data);
			}	
				
		} 
		else {
			$this->output->set_header('Location: '.base_url());
		}
	}
	
	function user_editto() {
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model("Admin_model");
		$this->load->model("User_role_model");
		
		if($this->session->userdata('login')) {
		
			$id = $this->input->post('id');
			$login = $this->input->post('login');
			$password = $this->input->post('password');
			$password_conf = $this->input->post('password_conf');
			$role = $this->input->post('role');
			$email = $this->input->post('email');
			
			$user_login = $this->User_role_model->getUser($id)->login;
			
			$data = NULL;
			
			if($login=="") {
				$this->output->set_header('Location: '.site_url('admin/user_edit/'.$id.'?error=login'));
			}
			else if($login!=$user_login && $this->Admin_model->check_for_user($login)!=-1) {
				$this->output->set_header('Location: '.site_url('admin/user_edit/'.$id.'?error=login'));
			}
			else if($password=="") {
				$this->output->set_header('Location: '.site_url('admin/user_edit/'.$id.'?error=password'));
			}
			else if($password_conf=="") {
				$this->output->set_header('Location: '.site_url('admin/user_edit/'.$id.'?error=password_conf'));
			}
			else if($password!=$password_conf) {
				$this->output->set_header('Location: '.site_url('admin/user_edit/'.$id.'?error=password'));
			}
			else if($role=="") {
				$this->output->set_header('Location: '.site_url('admin/user_edit/'.$id.'?error=role'));
			}
			else if($email=="") {
				$this->output->set_header('Location: '.site_url('admin/user_edit/'.$id.'?error=email'));
			}
			else{
				$this->User_role_model->editUser($id, $login, $password, $role, $email);
				$this->output->set_header('Location: '.site_url('admin/user_list'));
			}
		} 
		else {
			$this->output->set_header('Location: '.base_url());
		}
	}
	
	function user_delete($user_id) {
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model("User_role_model");
		
		if($this->session->userdata('login')) {
			
			/* Check for privilege */
			$privileges = $this->session->userdata('privileges');
			if(!in_array("DELETE_USER", $privileges)){
				$url;
				if(ISSET($_SERVER['HTTP_REFERER'])){
					$url = $_SERVER['HTTP_REFERER'];
				}
				else {
					$url = site_url('admin/main');
				}
				$this->output->set_header('Location: '.$url);
			}/* End of check */
			else {
				$this->User_role_model->deleteUser($user_id);
				
				$this->output->set_header('Location: '.site_url('admin/user_list'));
			}
			
		} 
		else {
			$this->output->set_header('Location: '.base_url());
		}
	}
	
	/* Settings */
	
	function settings() {
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model("Admin_model");
		
		if($this->session->userdata('login')) {
			
			/* Check for privilege */
			$privileges = $this->session->userdata('privileges');
			if(!in_array("EDIT_GLOBAL_SETTINGS", $privileges)){
				$url;
				if(ISSET($_SERVER['HTTP_REFERER'])){
					$url = $_SERVER['HTTP_REFERER'];
				}
				else {
					$url = site_url('admin/main');
				}
				$this->output->set_header('Location: '.$url);
			}/* End of check */
			else {
				$data['error'] = $this->input->get('error');
				
				$settings = $this->Admin_model->getSettings();
				$data['site_name'] = $settings[0]->name;
				$data['offline'] = $settings[0]->offline;
				
				$header_data['menu'] = "settings";
				
				$this->load->view('admin/header',$header_data);	
				$this->load->view('admin/settings', $data);
			}
			
		} 
		else {
			$this->output->set_header('Location: '.base_url());
		}
	}
	
	function save_settings() {
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model("Admin_model");
		
		if($this->session->userdata('login')) {
			// Take new posted information
			$site_name = $this->input->post('site_name');
			$offline = $this->input->post('offline');
			
			if($site_name==""){
				$this->output->set_header('Location: '.site_url('admin/settings?error=site_name'));
			}
			else{
				$this->Admin_model->editSettings($site_name, $offline);	
				
				$this->output->set_header('Location: '.site_url('admin/settings'));
			}
		} 
		else {
			$this->output->set_header('Location: '.base_url());
		}
	}
	
}
