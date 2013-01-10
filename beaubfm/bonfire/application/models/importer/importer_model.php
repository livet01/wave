<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Importer_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public $table="importdisque";
	
	public function ajoutDisqueImport($libelle,$format,$ecoute,$dateAjout,$artiste,$diffuseur,$email,$emplacement,$perId,$style,$emBev)
	{
		//$this->db->trans_start();
		return $this->db->set('imp_libelle', (string)$libelle)
				->set('imp_format', $format)
				->set('imp_ecoute', $ecoute)
				->set('imp_date_ajout', $dateAjout)
				->set('imp_artiste', $artiste)
				->set('imp_diffuseur', $diffuseur)
				->set('imp_email_diffuseur', $email)
				->set('imp_emplacement', $emplacement)
				->set('per_id_import', $perId)	
				->set('imp_date_import', 'NOW()',false)
				->set('imp_style', $style)
				->set('imp_em_bev',$emBev)
				->insert($this->table);
				
		/*if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
			return -1;
		}
		else
		{
		    $this->db->trans_commit();
			return TRUE;
		}*/
	}
	
	public function existImport($libelle,$artiste,$diffuseur) {
		return $this->db->select('imp_id')
							->from($this->table)
							->where(array('imp_libelle'=>$libelle,'imp_artiste'=>$artiste,'imp_diffuseur'=>$diffuseur))
							->get()
							->row_array();
	}
	
	public function selectImport()
	{
		return $this->db->select('*')
						->from($this->table)
						->order_by('imp_libelle', 'asc')
						->get()
						->result();
	}
	
	function GetAll_in($iddisque = array())
    {
		if(empty($iddisque))
		{
			return $this->selectImport();
		}
		else {
			return $this->db->select('*')
							->from($this->table)
							->where_in('imp_id', $iddisque)
							->get()
							->result();
		}
    }
	
	function GetDisqueImport($id)
    {
			return $this->db->select('*')
							->from($this->table)
							->where_in('imp_id', $id)
							->get()
							->result();
    }
	
	public function deleteImport($id)
	{
		return $this->db->delete($this->table, array('imp_id' => $id));
	}
	
	public function compteNU($id)
	{
		return $this->db->where('per_id_import !=', $id)
						->from($this->table)
	                    ->count_all_results();
	}
	
	public function compteU($id)
	{
		return $this->db->where('per_id_import', $id)
						->from($this->table)
	                    ->count_all_results();
	}
	
	public function compte()
	{
		return $this->db
						->from($this->table)
	                    ->count_all_results();
	}
}