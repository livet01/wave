<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Disque_model extends CI_Model {
	private $table = "Disque";
		
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
	
	public function insert($data)
	{
		if(!empty($data)){
			$last_id = $this->db->count_all_results($this->table);
			return $this->db->set('dis_id', $last_id+1)
					->set('dis_libelle', $data['dis_libelle'])
					->set('dis_format', $data['dis_format'])
					->set('uti_id_ecoute', $data['uti_id_ecoute'])
					->set('dis_date_ajout', 'NOW()',false)
					->set('per_id_artiste', $data['per_id_artiste'])
					->set('dif_id', $data['dif_id'])
					->set('dis_envoi_ok', $data['dis_envoi_ok'])
					->set('emp_id', $data['emp_id'])
					->set('emb_id', (empty($data['emb_id']) ? NULL : $data['emb_id']))
					->insert($this->table);
		}
		else {
			return FALSE;
		}
	}

	public function nombreArtiste ($artiste, $where)
	{
		return $this -> db->select($artiste)
							->from($this->$table)
							->where($where)
							->count_all_results($artiste);
							
	}
	
	public function suppArtiste ($artiste){
		
		return $this -> db ->delete($table, array('dis_id' => $artiste));
	}
	
}