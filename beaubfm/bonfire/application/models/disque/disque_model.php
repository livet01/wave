<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Disque_model extends CI_Model {
	private $table = "disque";
		
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
			if(isset($data['dis_id']))
				$id = $data['dis_id'];
			else {
				$id = $this->db->insert_id();
			}
			$this->db->set('dis_id', $id)
					->set('dis_libelle', $data['dis_libelle'])
					->set('dis_format', $data['dis_format'])
					->set('uti_id_ecoute', $data['uti_id_ecoute'])
					->set('dis_date_ajout', 'NOW()',false)
					->set('art_id', $data['art_id'])
					->set('dif_id', $data['dif_id'])
					->set('sty_id', $data['sty_id'])
					->set('dis_envoi_ok', $data['dis_envoi_ok'])
					->set('emp_id', $data['emp_id'])
					->set('emb_id', (empty($data['emb_id']) ? NULL : $data['emb_id']))
					->set('col1', (empty($data['col1']) ? NULL : $data['col1']))
					->set('col2', (empty($data['col2']) ? NULL : $data['col2']))
					->set('col3', (empty($data['col3']) ? NULL : $data['col3']))
					->set('col4', (empty($data['col4']) ? NULL : $data['col4']))
					->set('col5', (empty($data['col5']) ? NULL : $data['col5']))
					->set('col6', (empty($data['col6']) ? NULL : $data['col6']))
					->insert($this->table);
			return $id;
		}
		else {
			return FALSE;
		}
	}

	public function nombreArtiste ($artiste, $where)
	{
		return $this -> db->select($artiste)
							->from($this->table)
							->where($where)
							->count_all_results();
							
	}
	
	public function delete ($artiste){
		
		return $this -> db ->delete($this->table, array('dis_id' => $artiste));
	}
	
	public function update ($data){
		if(!empty($data))
		{
			return $this -> db 
					->set('dis_libelle', $data['dis_libelle'])
					->set('dis_format', $data['dis_format'])
					->set('uti_id_ecoute', $data['uti_id_ecoute'])
					->set('dis_date_ajout', 'NOW()',false)
					->set('art_id', $data['art_id'])
					->set('dif_id', $data['dif_id'])
					->set('sty_id', $data['sty_id'])
					->set('dis_envoi_ok', $data['dis_envoi_ok'])
					->set('emp_id', $data['emp_id'])
					->set('emb_id', (empty($data['emb_id']) ? NULL : $data['emb_id']))
					->set('col1', (empty($data['col1']) ? NULL : $data['col1']))
					->set('col2', (empty($data['col2']) ? NULL : $data['col2']))
					->set('col3', (empty($data['col3']) ? NULL : $data['col3']))
					->set('col4', (empty($data['col4']) ? NULL : $data['col4']))
					->set('col5', (empty($data['col5']) ? NULL : $data['col5']))
					->set('col6', (empty($data['col6']) ? NULL : $data['col6']))
					->where('dis_id',$data['dis_id'])
					->update($this->table);
		}
		else
			return false;
	}
	
}