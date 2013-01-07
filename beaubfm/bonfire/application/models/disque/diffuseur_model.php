<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Diffuseur_model extends CI_Model {
	private $table = "Users";
		
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
		return $this->db	->from("Disque")
							->where($where)
							->count_all_results();
	}
	
		
	function delete ($artiste){		
		return $this -> db ->delete("Users", array('id' => $artiste));
	}
	
}