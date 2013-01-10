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
		
		//$query = $this->db->query("INSERT INTO $this->table (per_nom, cat_id, rad_id) VALUES ('$nom', 3, 1);");
		$resultat = $this->db->set('per_nom', $nom)
							->set('cat_id', 3)
							->set('rad_id', 1)
							->insert("personne");
						
		if($resultat)
			return $this->db->insert_id();
		else
			return false;
		/*if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
			return -1;
		}
		else
		{
		    $this->db->trans_commit();
			return 
		}*/
	}
	
	function delete ($artiste){
		
		return $this -> db ->delete("personne", array('per_id' => $artiste));
	}
}