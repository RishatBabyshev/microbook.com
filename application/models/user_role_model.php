<?php
class User_role_model extends CI_Model {

    function __construct()
	{
        parent::__construct();
    }

	function getUser($user_id) {
		$this->load->database();
			
		$sql = "SELECT * ".
				"FROM user ".
				"WHERE id = ".$user_id.";";
		
		$query = $this->db->query( $sql );
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		else {
			return NULL;
		}
	}
	
	function getUsers() {
		$this->load->database();
			
		$sql = "SELECT u.id as id, u.login as login, r.name as role, u.email ".
				"FROM user u, u_role r ". 
				"WHERE u.role_id = r.id; ";
		
		$query = $this->db->query( $sql );
		return $query->result();
	}
	
	function getPriveleges($user_id) {
		$this->load->database();
			
		$sql = "SELECT p.name as name ".
				"FROM user u, u_role r, u_privilege p, u_role_privilege rp ". 
				"WHERE u.role_id = r.id ".
				"AND r.id = rp.role_id ".
				"AND p.id = rp.privilege_id ".
				"AND u.id = ".$user_id.";";
		
		$query = $this->db->query( $sql );
		return $query->result();
	}
	
	function getRoles() {
		$this->load->database();
			
		$sql = "SELECT * ".
				"FROM u_role;";
		$query = $this->db->query( $sql );
		return $query->result();
	}
	
	function addUser($login, $password, $role, $email) {
		$this->load->database();
		
		$sql = "INSERT INTO user( login, password, role_id, email ) 
				VALUES ( ?, ?, ?, ? );";
		
		$query = $this->db->query( $sql, array($login, $password, $role, $email));
		
		return true;
	}
	
	function editUser($id, $login, $password, $role, $email) {
		$this->load->database();
		
		$sql = "UPDATE user  
				SET login = ?, password = ?, role_id = ?, email = ?
				WHERE id = ".$id.";";
		
		$query = $this->db->query( $sql, array($login, $password, $role, $email));
		
		return true;
	}

	function deleteUser($user_id) {
		$this->load->database();
		
		$sql = "DELETE ".
				"FROM user ". 
				"WHERE id=".$user_id.";";
		
		$query = $this->db->query( $sql );
		
		return true;
	}
	
}
?>