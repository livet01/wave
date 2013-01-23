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
		return $this->db->from("disque")
						->where($where)
						->count_all_results();
	}

	
	function delete ($artiste)
	{		
		return $this -> db ->delete($this->table, array('art_id' => $artiste));
	}
}