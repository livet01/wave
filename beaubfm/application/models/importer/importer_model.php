<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Importer_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public $table="importdisque";
	
	public function ajoutDisqueImport($libelle,$format, $ecoute,$dateAjout,$artiste,$diffuseur,$email,$emplacement,$perId,$style,$emBev)
	{
		
		return $this->db->set('imp_libelle', $libelle)
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
	}
}