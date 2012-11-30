<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Diffuseur_model extends CI_Model {
	private $table = "Diffuseur";
	private $table1 = "Utilisateur";
	private $table2 = "Personne";
		
	function __construct() {
		parent::__construct();
	}
	
	function select($select,$where) {
		return $this->db->select($select)
							->from($this->table)
							->join($this->table1, $this->table.'.per_id = '.$this->table1.'.per_id', 'inner')
							->join($this->table2, $this->table2.'.per_id = '.$this->table1.'.per_id', 'inner')
							->where($where)
							->get()
							->row_array();
	}
	
	function insert($id,$mail) {
		
		$resultat = $this->db->set('per_id', $id)
						->set('dif_mail', $mail)
						->insert("Diffuseur");
		if(!$resultat) {
			throw new Exception("La personne n'a pas été ajouté", 1);
		}
		return $id;
	}
	
	function compte($where) {
		return $this->db	->from("Disque")
							->where($where)
							->count_all_results();
	}
	
		
	function delete ($artiste){
		
		return $this -> db ->delete("Personne", array('per_id' => $artiste));
	}
	
}