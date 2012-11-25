<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utilisateur_model extends CI_Model {
	
	protected $table = 'Utilisateur';
	
	function __construct() {
		parent::__construct();
	}
	
	public function ajouterUtil($id, $prenom, $log, $mdp)
	{
		//$last_id = $this->db->count_all_results($this->table);
		return $this->db->set('per_id', $id)
						->set('uti_prenom', $prenom)
						->set('uti_login', $log)
						->set('uti_mdp', md5($mdp))
						->insert($this->table);
	}
	
	public function readUtilisateur($select = '', $where = "")
	{
		if(!empty($select) && !empty($where)){	
			return $this->db->select($select)
							->from($this->table)
							->where($where)
							->get()
							->row_array();
		}
		else return "";
	}
}	

	