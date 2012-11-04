<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Personne_model extends CI_Model {
	
	protected $table = 'personne';
	
	function __construct() {
		parent::__construct();
	}
	
	public function ajouterPersonne($data)
	{
		return $this->db->set('per_nom', $data['artiste'])
						->set('cat_id', ($data['autoprod']) ? 5 : 4)
						->set('rad_id', 1)
						->insert($this->table);
	}
	
	public function readPersonne($select = '*', $where = array())
	{
		return $this->db->select($select)
						->from($this->table)
						->where($where);
	}
	
}

