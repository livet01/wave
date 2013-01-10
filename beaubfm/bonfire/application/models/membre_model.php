<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Membre_model extends CI_Model {
	
	protected $vue = 'membre';
	
	function __construct() {
		parent::__construct();
	}
	
	// Retourne l'id du memnbre
	public function getIdByLogin($login){
		return $this->db->select('mem_id')
						->from($this->vue)
						->where(array('mem_login'=>$login))
						->get()
						->row_array();	
	}
	
	// Retourne les infos du membres
	public function getMembreById($id){
		return $this->db->select(array('mem_mdp','mem_login','mem_id','mem_nom','mem_verrou'))
						->from($this->vue)
						->where(array('mem_id'=>$id))
						->get()
						->row_array();
		
	}	
	// Modifie le verrou du login
	public function setVerrouByLogin($login,$verrou){
		return $this->db->where(array('mem_login'=>$login))
						->update($this->vue,array('mem_verrou' => $verrou));	
	}
		
	public function readMembre($mem_nom)
	{
		return $this->db->select('mem_id')
						->from($this->vue)
						->where('mem_nom',$mem_nom);
	}
	

}