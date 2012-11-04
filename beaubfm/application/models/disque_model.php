<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CRUD d'une fiche
 */
class Disque_model extends CI_Model {
	
	protected $table = 'disque';
	
	function __construct() {
		parent::__construct();
	}
	
	/**
	 *  Ajoute une fiche à la BD
	 *  @param tableau contenant tous les données à ajouter
	 * 
	 */
	public function ajouterFiche($data)
	{
		if(!empty($data)){
			$data['autoprod'] = ((!$data['autoprod']) ? "0" : "1");
			$data['envoiMail'] = (($data['envoiMail'] === "0") ? "1" : "0");
			
			if($data['autoprod'])
			{
				
			}
			
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
	
	public function listerFiche()
	{
		
	}
}
/* End of file disque_model.php */
/* Location: ./application/models/disque_model.php */