<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Emplacement_model extends CI_Model {
	
	protected $table = 'Emplacement';
	
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
	
}

