<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Personne_model extends CI_Model {
	
	protected $table = 'Personne';
	protected $tableUti='Utilisateur';
	protected $vueArt = 'Artiste';
	protected $vueAutoProd = 'AutoProduction';
	
	function __construct() {
		parent::__construct();
	}
	public function ajouterPersonne($id,$data,$cat)
	{
		$last_id = $this->db->count_all_results($this->table);
		//$last_id = $this->db->get($this->table);
		//var_dump(1000+$last_id+1);
		return $this->db->set('per_id', $last_id+1+1000 )
						->set('per_nom', $data)
						->set('cat_id', $cat)
						->set('rad_id', 1)
						->insert($this->table);
	}
	
	public function readPersonne($select = '', $where = "")
	{
			return $this->db->select($select)
							->from($this->table)
							->where($where)
							->get()
							->row_array();
	}
	
	public function readArtiste($select = '', $where = "")
	{
		if(!empty($select) && !empty($where))
		{
			return $this->db->select($select)
							->from($this->vueArt)
							->where($where)
							->get()
							->row_array();
		}
		else
			return "";
	}
	
	public function readAutoprod($select = '', $where = '')
	{
		if(!empty($select) && !empty($where))
		{
			return $this->db->select($select)
							->from($this->vueAutoProd)
							->where($where)
							->get()
							->row_array();
		}
		else {
			return "";
		}
	}

	public function countPersonne($champ = array(), $valeur = null) // Si $champ est un array, la variable $valeur sera ignorée par la méthode where()
	{
		return (int) $this->db->where($champ, $valeur)
	                              ->from($this->table)
	                              ->count_all_results();
	}
	
	public function last_id()
	{
		return $this->db->count_all_results($this->table)+1000;
	}
	
	public function getUserInfo($id)
	{
			return $this->db->select(array($this->table.'.per_id','per_nom','cat_id','rad_id','uti_prenom','uti_login','uti_tutorial','uti_verrou'))
							->from($this->table)
							->join($this->tableUti,$this->table.".per_id=".$this->tableUti.".per_id")
							->where(array($this->table.'.per_id'=>$id))
							->get()
							->result_array();
	}
	
}
