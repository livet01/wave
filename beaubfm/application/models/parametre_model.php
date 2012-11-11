	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Parametre_model extends CI_Model {
	
	protected $table = 'Parametre';
	
	function __construct() {
		parent::__construct();
	}
	
	public function ajouterParam($libelle, $valeur)
	{
		return $this->db->set('param_libelle', $libelle)
						->set('param_valeur', $valeur)
						->insert($this->table);
	}
}