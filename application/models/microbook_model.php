<?php
class Microbook_model extends CI_Model {

    function __construct()
	{
        parent::__construct();
    }

	function getArticle($id, $lang){
		$this->load->database();
		
		$table = "";
		
		if($lang=="en"){
			$table = "article_en";
		}
		else if($lang=="ru"){
			$table = "article_ru";
		}
		else if($lang=="kz"){
			$table = "article_kz";
		}
		else {
			return NULL;
		}
		
		$sql = "SELECT * ".
				"FROM ".$table." ". 
				"WHERE id=".$id.";";
		
		$query = $this->db->query( $sql );
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		else {
			return NULL;
		}
	}
	
	function getCategory($id){
		$this->load->database();
			
		$sql = "SELECT * ".
				"FROM category ". 
				"WHERE id=".$id.";";
		
		$query = $this->db->query( $sql );
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		else {
			return NULL;
		}
	}
	
	function getAmountOfArticles($category_id){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM article_en WHERE category_id=".$category_id.";");
		return $query->num_rows();
	}
	
	function getAmountOfCategories(){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM category;");
		return $query->num_rows();
	}
	
	function getArticleByOrder($order, $category_id) {
		$this->load->database();
		
		$sql = "SELECT * ".
				"FROM article_en ". 
				"WHERE my_order=".$order." ".
				"AND category_id=".$category_id.";";
		
		$query = $this->db->query( $sql );
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		else {
			return NULL;
		}
	}
	
	function getCategoryByOrder($order) {
		$this->load->database();
		
		$sql = "SELECT * ".
				"FROM category ". 
				"WHERE my_order=".$order.";";
		
		$query = $this->db->query( $sql );
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		else {
			return NULL;
		}
	}
	
	function getListOfArticles($category_id, $lang) {
		$this->load->database();
		$table = "";
		
		if($lang=="en"){
			$table = "article_en";
		}
		else if($lang=="ru"){
			$table = "article_ru";
		}
		else if($lang=="kz"){
			$table = "article_kz";
		}
		else {
			return NULL;
		}
		
		$sql = "SELECT * ".
				"FROM ".$table." ". 
				"WHERE category_id=".$category_id.";";
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function getListOfCategories() {
		$this->load->database();
		
		$sql = "SELECT * ".
				"FROM category;";
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function getSettings() {
		$this->load->database();
		
		$sql = "SELECT * ".
				"FROM settings";
		
		$query = $this->db->query( $sql );
		return $query->result();
	}
	
}
?>