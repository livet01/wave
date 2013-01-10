<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Personne_model extends CI_Model {
	
	protected $table = 'personne';
	protected $tableUti='utilisateur';
	protected $vueArt = 'artiste';
	protected $vueAutoProd = 'autoproduction';
	
	function __construct() {
		parent::__construct();
	}
	public function ajouterPersonne($id,$data,$cat)
	{
		echo "coucou";
		exit(0);
		$this->db->trans_begin();
		/*$this->db->set('per_nom', $data)
				->set('cat_id', 3)
				->set('rad_id', 1)
				->insert($this->table);*/
		//$this->db->query("INSERT IGNORE INTO $this->table (per_nom, cat_id, rad_id) VALUES ('$data', 3, 1);");
		$data = array('per_id' => NULL, 'per_nom' => $data, 'cat_id' => 3, 'rad_id' => 1);
		$insert_query = $this->db->insert_string($this->table, $data);
		$insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
		$this->db->query($insert_query);
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
			return -1;
		}
		else
		{
		    $this->db->trans_commit();
			return TRUE;
		}
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
			return $this->db->select(array($this->table.'.per_id','per_nom','cat_id','rad_id','uti_login','uti_tutorial','uti_verrou'))
							->from($this->table)
							->join($this->tableUti,$this->table.".per_id=".$this->tableUti.".per_id")
							->where(array($this->table.'.per_id'=>$id))
							->get()
							->result_array();
	}
	
}
