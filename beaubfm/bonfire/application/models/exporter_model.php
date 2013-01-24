<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Exporter_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function select_export($where=array())
	{
			
		if(empty($where)){
			return $this->db->select(array('disque.dis_libelle','artiste.art_nom','u1.username as per_nom','disque.dis_format','emplacement.emp_libelle','disque.dis_date_ajout','u2.username as uti_login','u1.email as dif_mail','embenevole.emb_libelle','style.sty_libelle', 'col1', 'col2', 'col3', 'col4', 'col5', 'col6'))
						->from('disque')
						->join('artiste','disque.art_id = artiste.art_id')
						->join('users as u1', 'disque.dif_id = u1.id')
						->join('users as u2', 'disque.uti_id_ecoute = u2.id')
						->join('emplacement', 'disque.emp_id = emplacement.emp_id')
						->join('embenevole', 'disque.emb_id = embenevole.emb_id','left')
						->join('style','disque.sty_id = style.sty_id', 'left')
						->get()
						->result();
		}
		elseif(!empty($where))
		{
				
			return $this->db->select(array('disque.dis_libelle','artiste.art_nom','u1.username as per_nom','disque.dis_format','emplacement.emp_libelle','disque.dis_date_ajout','u2.username as uti_login','u1.email as dif_mail','embenevole.emb_libelle','style.sty_libelle', 'col1', 'col2', 'col3', 'col4', 'col5', 'col6'))
							->from('disque')
							->join('artiste','disque.art_id = artiste.art_id')
							->join('users as u1', 'disque.dif_id = u1.id')
							->join('users as u2', 'disque.uti_id_ecoute = u2.id')
							->join('emplacement', 'disque.emp_id = emplacement.emp_id')
							->join('embenevole', 'disque.emb_id = embenevole.emb_id','left')
							->join('style','disque.sty_id = style.sty_id', 'left')
							->where_in('dis_id', $where)
							->order_by('dis_libelle', 'asc')
							->get()
							->result();
		}
	}

	public function select_param()
	{
		return $this->db->select('param_valeur')
						->from('parametre')
						->where('param_libelle', 'colonnes')
						->get()
						->row_array();	
	}
}