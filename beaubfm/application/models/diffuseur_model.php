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
	
	public function ajouterDiffuseur($data,$per_id)
	{
		return $this->db->set('dif_mail',$data)
						->insert($this->table)
						->where('per_id',$per_id);
	}
	
	public function readDiffuseur($select = '*', $where = array())
	{
		return $this->db->select($select)
						->from($this->vue)
						->where($where);
	}
	
}