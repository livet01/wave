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
		$resultat = $this->db->set('art_nom', $nom)
							->set('rad_id', 1)
							->insert($this->table);
						
		if($resultat)
			return $this->db->insert_id();
		else
			return false;
	}
	
	function delete ($artiste){		
		return $this -> db ->delete($this->table, array('art_id' => $artiste));
	}
}