<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Disque_model extends CI_Model {
	
	protected $table = 'Disque';
	
	function __construct() {
		parent::__construct();
	}
	
	/**
	 *  Ajoute une fiche à la BD
	 *  @param tableau contenant tous les données à ajouter
	 * 
	 */
	public function ajouterDisque($data)
	{
		if(!empty($data)){
			$last_id = $this->db->count_all_results($this->table);
			return $this->db->set('dis_id', $last_id+1+1000 )
					->set('dis_libelle', $data['titre'])
					->set('dis_format', $data['format'])
					->set('uti_id_ecoute', $data['listenBy'])
					->set('dis_date_ajout', 'NOW()',false)
					->set('per_id_artiste', $data['artiste'])
					->set('dif_id', $data['diffuseur'])
					->set('dis_envoi_ok', $data['envoiMail'])
					->set('emp_id', $data['emplacement'])
					->set('emb_id', (empty($data['emBev']) ? NULL : $data['emBev']))
					->insert($this->table);
		}
		else {
			return FALSE;
		}
	}
	
	public function modifierFiche(){
		
	}
	
	public function supprimmerFiche(){
		
	}
	
	public function readDisque($select = "", $where = ""){
		if(!empty($select) && !empty($where))
		{
			return $this->db->select($select)
							->from($this->table)
							->where($where)
							->get()
							->row_array();
		}
		else
			return "";
	}
}
/* End of file disque_model.php */
/* Location: ./application/models/disque_model.php */