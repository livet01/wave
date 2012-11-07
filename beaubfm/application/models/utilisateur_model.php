	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Utilisateur_model extends CI_Model {
	
	protected $table = 'Utilisateur';
	
	function __construct() {
		parent::__construct();
	}
		
	public function loginExist($login){
		return $this->db->select('uti_login')
						->from($this->table)
						->where(array('uti_login'=>$login))
						->get()
						->row_array();
		
	}
	public function getPasswordByLogin($login){
		return $this->db->select('uti_mdp')
						->from($this->table)
						->where(array('uti_login'=>$login))
						->get()
						->row_array();
		
	}
	public function getPrenomByLogin($login){
		return $this->db->select('uti_prenom')
						->from($this->table)
						->where(array('uti_login'=>$login))
						->get()
						->row_array();
		
	}	
}
	