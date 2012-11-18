<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Diffuseur_model extends CI_Model {
	
	protected $table = 'Diffuseur';
	protected $vue = 'Label';
	
	function __construct() {
		parent::__construct();
	}
	
	public function ajouterDiffuseur($data, $per_id)
	{
		//$last_id = $this->db->count_all_results($this->table);
		
		return $this->db->set('per_id', $data)
						->set('dif_mail', "h23j2@gmail.com")
						->insert($this->table);
	}
	
	public function readDiffuseur($select = '*', $where = array())
	{
		return $this->db->select($select)
						->from($this->vue)
						->where($where)
						->get()
						->row_array();
	}
	
}