	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Parametre_model extends CI_Model {
	
	protected $table = 'parametre';
	
	function __construct() {
		parent::__construct();
	}
	
	public function insert($libelle, $valeur)
	{
		return $this->db->set('param_libelle', $libelle)
						->set('param_valeur', $valeur)
						->insert($this->table);
	}
	public function update($libelle, $valeur)
	{
		return $this->db->where('param_libelle', $libelle)
						->update($this->table,array('param_valeur'=> $valeur));
	}
	public function select($libelle)
	{
		return $this->db->select('param_valeur')
						->from($this->table)
						->where('param_libelle', $libelle)
						->get()
						->row_array();	
	}
}