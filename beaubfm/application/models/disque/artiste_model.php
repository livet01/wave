<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Artiste_model extends CI_Model {
	private $table = "Artiste";
		
	function __construct() {
		parent::__construct();
	}
	
	function select($select,$where) {
		return $this->db->select($select)
							->from($this->table)
							->where($where)
							->get()
							->row_array();
	}
	
	function insert($nom,$radio,$cat) {
		$last_id = $this->db->count_all_results("Personne") + 1;
		
		$resultat = $this->db->set('per_id', $last_id)
						->set('per_nom', $nom)
						->set('cat_id', $cat)
						->set('rad_id', $radio)
						->insert("Personne");
		if(!$resultat) {
			throw new Exception("La personne n'a pas été ajouté", 1);
		}
		return $last_id;
	}
}