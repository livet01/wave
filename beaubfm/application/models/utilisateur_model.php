	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Utilisateur_model extends CI_Model {
	
	protected $table = 'utilisateur';
	
	function __construct() {
		parent::__construct();
	}
		
	public function readUtilisateurParLogin($where)
	{
		return $this->db->select('uti_prenom')
						->from($this->table)
						->where($where);
	}

}
	