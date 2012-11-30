<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Utilisateur_model extends CI_Model {
	private $table1 = "Utilisateur";
	private $table2 = "Personne";
		
	function __construct() {
		parent::__construct();
	}
	
	function select($select,$where) {
		return $this->db->select($select)
							->from($this->table1)
							->join($this->table2, $this->table2.'.per_id = '.$this->table1.'per_id', 'inner')
							->where($where)
							->get()
							->row_array();
	}
	
	function insert($id,$login,$mdp) {
		$resultat = $this->db->set('per_id', $id)
						->set('uti_login', $login)
						->set('uti_mdp', $mdp)
						->insert("Utilisateur");
		if(!$resultat) {
			throw new Exception("L'utilisateur n'a pas été ajouté", 1);
		}
		return $id;
	}
}