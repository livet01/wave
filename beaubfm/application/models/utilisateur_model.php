	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Utilisateur_model extends CI_Model {
	
	protected $table = 'utilisateur';
	
	function __construct() {
		parent::__construct();
	}
		
	public function readUtilisateurParLogin($login)
	{
		$this->query = $this->db->select('*')->from('utilisateur')->where(array('uti_login'=>$login))->get();
		return $this->query->row_array();
	}

}
	