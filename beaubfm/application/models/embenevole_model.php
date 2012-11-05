<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Embenevole_model extends CI_Model {
	
	protected $table = 'emBenevole';
	
	function __construct() {
		parent::__construct();
	}
	
	public function ajouterEmission($data)
	{
		return $this->db->set('emb_libelle', $data)
						->set('rad_id', 1)
						->insert($this->table);
	}
	
	public function readEmission($select = '*', $where = array())
	{
		return $this->db->select($select)
						->from($this->table)
						->where($where);
	}
	
}

