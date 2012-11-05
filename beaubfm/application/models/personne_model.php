<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Personne_model extends CI_Model {
	
	protected $table = 'personne';
	
	function __construct() {
		parent::__construct();
	}
	
	public function ajouterPersonne($data,$cat)
	{
		return $this->db->set('per_nom', $data)
						->set('cat_id', $cat)
						->set('rad_id', 1)
						->insert($this->table);
	}
	
	public function readPersonne($select = '*', $where = array())
	{
		return $this->db->select($select)
						->from($this->table)
						->where($where);
	}

	public function countPersonne($champ = array(), $valeur = null) // Si $champ est un array, la variable $valeur sera ignorée par la méthode where()
	{
		return (int) $this->db->where($champ, $valeur)
	                              ->from($this->table)
	                              ->count_all_results();
	}
	
	
}
