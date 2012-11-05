<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Membre_model extends CI_Model {
	
	protected $vue = 'membre';
	
	function __construct() {
		parent::__construct();
	}
		
	public function readMembre($mem_nom)
	{
		return $this->db->select('mem_id')
						->from($this->vue)
						->where('mem_nom',$mem_nom);
	}

}