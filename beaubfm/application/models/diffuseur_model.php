<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Diffuseur_model extends CI_Model {
	
	protected $table = 'diffuseur';
	protected $vue = 'label';
	
	function __construct() {
		parent::__construct();
	}
	
	public function ajouterDiffuseur()
	{
		$this->load->model('personne_model', 'persManager');
		$result = $this->persManager->ajouterpersonne($data['diffuseur'],($data['autoprod']) ? 5 : 4);
		
		return $this->db->set('per_nom', $data)
						->set('cat_id', $cat)
						->set('rad_id', 1)
						->insert($this->table);
	}
	
	public function readDiffuseur($select = '*', $where = array())
	{
		return $this->db->select($select)
						->from($this->vue)
						->where($where);
	}
	
}

