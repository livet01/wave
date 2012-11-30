<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Exporter_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function select_export($where=array())
	{
			
		if(empty($where)){
			return $this->db->select('*')
						->from('Disque')
						->join('Artiste','Disque.per_id_artiste = Artiste.art_id')
						->join('Label', 'Disque.dif_id = Label.lab_id')
						->join('Utilisateur', 'Disque.uti_id_ecoute = Utilisateur.per_id')
						->join('Emplacement', 'Disque.emp_id = Emplacement.emp_id')
						->join('EmBenevole', 'Disque.emb_id = EmBenevole.emb_id','left')
						->get();
		}
		elseif(!empty($where))
		{
				
			return $this->db->select('*')
							->from('Disque')
							->join('Artiste','Disque.per_id_artiste = Artiste.art_id')
							->join('Label', 'Disque.dif_id = Label.lab_id')
							->join('Utilisateur', 'Disque.uti_id_ecoute = Utilisateur.per_id')
							->join('Emplacement', 'Disque.emp_id = Emplacement.emp_id')
							->join('EmBenevole', 'Disque.emb_id = EmBenevole.emb_id','left')
							->join('Style','Disque.sty_id = Style.sty_id', 'left')
							->where_in('dis_id', $where)
							->order_by('dis_libelle', 'asc')
							->get();
		}
	}
}