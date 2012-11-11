<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CRUD d'une fiche
 */
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
			$this->db->set('dis_id', $this->db->insert_id())
					->set('dis_libelle', $data['titre'])
					->set('dis_format', $data['format'])
					->set('uti_id_ecoute', $data['listenBy'])
					->set('dis_date_ajout', NOW())
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
	
	public function modifierFiche()
	{
		
	}
	
	public function supprimmerFiche()
	{
		
	}
	
	public function readDisque($select = "", $where = "")
	{
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