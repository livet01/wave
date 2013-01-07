<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Embenevole_model extends CI_Model {
	
	protected $table = 'EmBenevole';
	
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
	
	function insert($nom,$radio) {
		$last_id = $this->db->count_all_results($this->table) + 1;
		
		$resultat = $this->db->set('emb_id', $last_id)
						->set('emb_libelle', $nom)
						->set('rad_id', $radio)
						->insert($this->table);
		if(!$resultat) {
			throw new Exception("L'emission bénévole n'a pas été ajouté", 1);
		}
		return $last_id;
	}
}

