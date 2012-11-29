<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Style_model extends CI_Model {
	
	protected $table = 'Style';
	
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
	
	function select_all($select) {
		return $this->db->select($select)
							->from($this->table)
							->get()
							->result();
	}
	
}

