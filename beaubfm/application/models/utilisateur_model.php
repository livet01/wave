	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Utilisateur_model extends CI_Model {
	
	protected $table = 'utilisateur';
	
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
	public function getPasswordByLogin($mdp){
		return $this->db->select('uti_mdp')
						->from($this->table)
						->where(array('uti_mdp'=>$mdp))
						->get()
						->row_array();
		
	}
}
	