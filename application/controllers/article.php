<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends CI_Controller {
	public function index() {
		$this->load->helper('url');
	}	
	
	public function id($article_id, $lang) {
		$this->load->model("Microbook_model");
		$this->load->helper('url');
		
		
		/* If Offline */
		$settings = $this->Microbook_model->getSettings();
		$data['title'] = $settings[0]->name;
		$offline = $settings[0]->offline;
		
		if($offline){
			$this->output->set_header('Location: '.site_url('site_offline'));
		}
		/* End If Offline */
		
		$data['article'] = $this->Microbook_model->getArticle($article_id, $lang);
		
		$article_order =  $data['article']->my_order;
		$category_id =  $data['article']->category_id;
		$category = $this->Microbook_model->getCategory($category_id);
		$category_order = $category->my_order;
		$listOfArticles = $this->Microbook_model->getListOfArticles($category_id, $lang);
		$amountOfArticles = sizeOf($listOfArticles);
		$amountOfCategories = $this->Microbook_model->getAmountOfCategories();
		
		$prev = NULL;
		$next = NULL;
		
		//$prev
		if($article_order==1) {
			if($category_order==1) {
				$prev = NULL;
			}
			else {
				$numberOfLast = $this->Microbook_model->getAmountOfArticles($category_id-1);
				$prev = $this->Microbook_model->getArticleByOrder($numberOfLast, $category_id-1)->id;
			}
		}
		else {
			$prev = $this->Microbook_model->getArticleByOrder($article_order-1, $category_id)->id;
		}
		
		//$next
		if($article_order==$amountOfArticles) {
			if($category_order==$amountOfCategories) {
				$next = NULL;
			}
			else {
				$next = NULL;
				$current_category_order = $category_order+1;
				$current_category_id = $this->Microbook_model->getCategoryByOrder($current_category_order)->id;
				while($current_category_order<=$amountOfCategories) {
					
					$cur_amount = $this->Microbook_model->getAmountOfArticles($current_category_id);
					if($cur_amount==0){
						$current_category_order = $current_category_order + 1;
						
						if($current_category_order==$amountOfCategories+1){
							break;
						}
						else 
							$current_category_id = $this->Microbook_model->getCategoryByOrder($current_category_order)->id;
					}
					else {
						$next = $this->Microbook_model->getArticleByOrder(1, $current_category_id)->id;
						break;
					}
				}
				
			}
		}
		else {
			$next = $this->Microbook_model->getArticleByOrder($article_order+1, $category_id)->id;
		}
		
		if($prev!=NULL)
			$data['prev'] =	site_url('article/id/'.$prev.'/'.$lang);
		else
			$data['prev'] = NULL;
		if($next!=NULL)
			$data['next'] = site_url('article/id/'.$next.'/'.$lang);
		else
			$data['next'] = NULL;
			
		$header_data['title'] = $settings[0]->name;
		$menu_data['lang'] = $lang;
		$menu_data['menu_category'] = null;
		
		if($lang=="en") $menu_data['menu_category'] = $category->name_en;
		else if($lang=="ru") $menu_data['menu_category'] = $category->name_ru;
		else if($lang=="kz") $menu_data['menu_category'] = $category->name_kz;
		
		$menu_data['menus'] = $listOfArticles;
		$this->load->view('header', $header_data);
		$this->load->view('left_menu',$menu_data);
		$this->load->view('article',$data);
		$this->load->view('footer');
		
	}	
}
