<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Artiste_model extends CI_Model {
	private $table = "artiste";
		
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
	
	function compte($where) {
		return $this->db	->from("disque")
							->where($where)
							->count_all_results();
	}
	
	function insert($nom,$radio,$cat) {
		$resultat = $this->db->set('per_nom', $nom)
						->set('cat_id', $cat)
						->set('rad_id', $radio)
						->insert("personne");
		if(!$resultat) {
			throw new Exception("La personne n'a pas été ajouté", 1);
		}
		return $this->db->insert_id();
	}
	
	function delete ($artiste){
		
		return $this -> db ->delete("personne", array('per_id' => $artiste));
	}
}