<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Exporter_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function select_export($where=array())
	{
			
		if(empty($where)){
			return $this->db->select(array('disque.dis_libelle','Artiste.art_nom','u1.username as per_nom','disque.dis_format','Emplacement.emp_libelle','disque.dis_date_ajout','u2.username as uti_login','u1.email as dif_mail','EmissionBenevole.emb_libelle','Style.sty_libelle'))
						->from('disque')
						->join('Artiste','disque.per_id_artiste = Artiste.art_id')
						->join('Users as u1', 'disque.dif_id = u1.id')
						->join('Users as u2', 'disque.uti_id_ecoute = u2.id')
						->join('Emplacement', 'disque.emp_id = Emplacement.emp_id')
						->join('EmBenevole', 'disque.emb_id = EmBenevole.emb_id','left')
						->join('Style','disque.sty_id = Style.sty_id', 'left')
						->get();
		}
		elseif(!empty($where))
		{
				
			return $this->db->select(array('disque.dis_libelle','Artiste.art_nom','u1.username as per_nom','disque.dis_format','Emplacement.emp_libelle','disque.dis_date_ajout','u2.username as uti_login','u1.email as dif_mail','EmBenevole.emb_libelle','Style.sty_libelle'))
							->from('disque')
							->join('Artiste','disque.per_id_artiste = Artiste.art_id')
							->join('Users as u1', 'disque.dif_id = u1.id')
							->join('Users as u2', 'disque.uti_id_ecoute = u2.id')
							->join('Emplacement', 'disque.emp_id = Emplacement.emp_id')
							->join('EmBenevole', 'disque.emb_id = EmBenevole.emb_id','left')
							->join('Style','disque.sty_id = Style.sty_id', 'left')
							->where_in('dis_id', $where)
							->order_by('dis_libelle', 'asc')
							->get();
		}
	}
}