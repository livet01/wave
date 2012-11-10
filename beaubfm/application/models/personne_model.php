<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Personne_model extends CI_Model {
	
	protected $table = 'Personne';
	protected $vueArt = 'Artiste';
	protected $vueAutoProd = 'AutoProduction';
	
	function __construct() {
		parent::__construct();
	}
	public function ajouterPersonne($id,$data,$cat)
	{
		return $this->db->set('per_id', $id)
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
	
	
}
