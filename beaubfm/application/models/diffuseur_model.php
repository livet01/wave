<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Diffuseur_model extends CI_Model {
	
	protected $table = 'diffuseur';
	
	function __construct() {
		parent::__construct();
	}
	
	public function ajouterDiffuseur()
	{
		$this->load->model('personne_model', 'persManager');
		
		return $this->db->set('per_nom', $data)
						->set('cat_id', $cat)
						->set('rad_id', 1)
						->insert($this->table);
	}
	
	public function readDiffuseur($select = '*', $where = array())
	{
		return $this->db->select($select)
						->from($this->table)
						->where($where);
	}
	
}

