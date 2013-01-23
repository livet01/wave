<?php 
class Info_Disque_Model extends CI_Model
{
	public $id;
    function GetArtiste($numArtiste)
    {
    	if (has_permission('Wave.Restriction.Disque'))
		{
			$this->db->where('disque.dif_id',$this->id);
		}
		if(!has_permission('Wave.Recherche.Disque'))
		{
			$this->db	->join('emplacement', 'disque.emp_id=emplacement.emp_id', 'LEFT')
						->where_in('emp_plus',array(1,3));
		}
		return $this->db->select('disque.dis_id')
						->from('disque')
						->join('artiste', 'disque.art_id=artiste.art_id', 'LEFT')
						->where('disque.art_id', $numArtiste)
						->get()
						->result_array();
    }
	

    function GetLabel($numLabel)
    {
    	if (has_permission('Wave.Restriction.Disque'))
		{
			$this->db->where('disque.dif_id',$this->id);
		}
		if(!has_permission('Wave.Recherche.Disque'))
		{
			$this->db	->join('emplacement', 'disque.emp_id=emplacement.emp_id', 'LEFT')
						->where_in('emp_plus',array(1,3));
		}
		return $this->db->select('disque.dis_id')
						->from('disque')
						->join('users', 'disque.dif_id=users.id', 'LEFT')
						->where('disque.dif_id', $numLabel)
						->get()
						->result_array();	
    }

    function GetDisque($numDisque)
    {
    	if (has_permission('Wave.Restriction.Disque'))
		{
			$this->db->where('disque.dif_id',$this->id);
		}
		
		if(!has_permission('Wave.Recherche.Disque'))
		{
			$this->db	->where_in('emp_plus',array(1,3));
		}
		$this->db->select(array('col1','col2','col3','col4','col5','col6','disque.dis_id','dis_envoi_ok','sty_libelle','disque.emp_id','sty_couleur','dis_libelle','dis_format','u2.username as mem_nom','artiste.art_nom','u1.username as per_nom', 'u1.email as mail','emplacement.emp_libelle','embenevole.emb_libelle'))
						->join('artiste', 'disque.art_id=artiste.art_id', 'LEFT')
						->join('emplacement', 'disque.emp_id=emplacement.emp_id', 'LEFT')
						->join('users AS u1', 'disque.dif_id=u1.id', 'LEFT')
						->join('users AS u2','disque.uti_id_ecoute=u2.id', 'LEFT')
						->join('embenevole','disque.emb_id=embenevole.emb_id', 'LEFT')
						->join('style','disque.sty_id=style.sty_id', 'LEFT')
						->where('disque.dis_id', $numDisque);
		$query = $this->db->get('disque');
		return $query->result();
    }

  	function GetAllDisqueId()
    {
    	if (has_permission('Wave.Restriction.Disque'))
		{
			$this->db->where('disque.dif_id',$this->id);
		}
		
		if(!has_permission('Wave.Recherche.Disque'))
		{
			$this->db	->join('emplacement', 'disque.emp_id=emplacement.emp_id', 'LEFT')
						->where_in('emp_plus',array(1,3));
		}
		$this->db->select('dis_id');
		$query = $this->db->get('disque');
		return $query->result_array();
    }

 	function GetArrayDisque($numDisque)
    {
    	if (has_permission('Wave.Restriction.Disque'))
		{
			$this->db->where('disque.dif_id',$this->id);
		}

		if(!has_permission('Wave.Recherche.Disque'))
		{
			$this->db	->where_in('emp_plus',array(1,3));
		}
			$this->db->select(array('disque.dis_id','dis_libelle','sty_couleur','dis_format','u2.username as mem_nom','artiste.art_nom','u1.username as per_nom','emplacement.emp_libelle'))
						->join('artiste', 'disque.art_id=artiste.art_id', 'LEFT')
						->join('emplacement', 'disque.emp_id=emplacement.emp_id', 'LEFT')
						->join('users AS u1', 'disque.dif_id=u1.id', 'LEFT')
						->join('users AS u2','disque.uti_id_ecoute=u2.id', 'LEFT')
						->join('style','disque.sty_id=style.sty_id', 'LEFT')
						->where('disque.dis_id', $numDisque);
		$query = $this->db->get('disque');
		return $query->result_array();
    }
	
	function GetOneDisque($numDisque)
    {
    	if (has_permission('Wave.Restriction.Disque'))
		{
			$this->db->where('disque.dif_id',$this->id);
		}
		
		if(!has_permission('Wave.Recherche.Disque'))
		{
			$this->db	->join('emplacement', 'disque.emp_id=emplacement.emp_id', 'LEFT')
						->where_in('emp_plus',array(1,3));
		}
		
		return $this->db->select('*')
						->from("disque")
						->where('disque.dis_id', $numDisque)
						->get()
						->result_array();
	}
	
	function GetAll()
    {
    	if (has_permission('Wave.Restriction.Disque'))
		{
			$this->db->where('disque.dif_id',$this->id);
		}

		if(!has_permission('Wave.Recherche.Disque'))
		{
			$this->db	->where_in('emp_plus',array(1,3));
		}
			$this->db->select(array('disque.dis_id','dis_libelle','sty_couleur','dis_format','u2.username as mem_nom','artiste.art_nom','u1.username as per_nom','emplacement.emp_libelle'))
						->join('artiste', 'disque.art_id=artiste.art_id', 'LEFT')
						->join('emplacement', 'disque.emp_id=emplacement.emp_id', 'LEFT')
						->join('users AS u1', 'disque.dif_id=u1.id', 'LEFT')
						->join('users AS u2','disque.uti_id_ecoute=u2.id', 'LEFT')
						->join('style','disque.sty_id=style.sty_id', 'LEFT')
						->order_by('dis_libelle', 'asc'); //-> limit($nb, $debut);
		$query = $this->db->get('disque');
		return $query->result();
    }
	
	function GetAllNoAttente()
    {
    	if (has_permission('Wave.Restriction.Disque'))
		{
			$this->db->where('disque.dif_id',$this->id);
		}
		
		if(!has_permission('Wave.Recherche.Disque'))
		{
			$this->db	->where_in('emp_plus',array(1,3));
		}	
			$this->db->select(array('disque.dis_id','dis_libelle','sty_couleur','dis_format','u2.username as mem_nom','artiste.art_nom','u1.username as per_nom','emplacement.emp_libelle'))
						->join('artiste', 'disque.art_id=artiste.art_id', 'LEFT')
						->join('emplacement', 'disque.emp_id=emplacement.emp_id', 'LEFT')
						->join('users AS u1', 'disque.dif_id=u1.id', 'LEFT')
						->join('users AS u2','disque.uti_id_ecoute=u2.id', 'LEFT')
						->join('style','disque.sty_id=style.sty_id', 'LEFT')
						->where('emplacement.emp_id !=',5)
						->order_by('dis_libelle', 'asc'); //-> limit($nb, $debut);
		$query = $this->db->get('disque');
		return $query->result();
    }
	
	function GetAllAttente()
    {
    	if (has_permission('Wave.Restriction.Disque'))
		{
			$this->db->where('disque.dif_id',$this->id);
		}

		if(!has_permission('Wave.Recherche.Disque'))
		{
			$this->db	->where_in('emp_plus',array(1,3));
		}
			$this->db->select(array('disque.dis_id','dis_libelle','sty_couleur','dis_format','u2.username as mem_nom','artiste.art_nom','u1.username as per_nom','emplacement.emp_libelle'))
						->join('artiste', 'disque.art_id=artiste.art_id', 'LEFT')
						->join('emplacement', 'disque.emp_id=emplacement.emp_id', 'LEFT')
						->join('users AS u1', 'disque.dif_id=u1.id', 'LEFT')
						->join('users AS u2','disque.uti_id_ecoute=u2.id', 'LEFT')
						->join('style','disque.sty_id=style.sty_id', 'LEFT')
						->where('emplacement.emp_id',5)
						->order_by('dis_date_ajout', 'asc'); //-> limit($nb, $debut);
		$query = $this->db->get('disque');
		return $query->result();
    }
	
	function GetAllRss()
    {
		if(!has_permission('Wave.Recherche.Disque'))
		{
			$this->db	->where_in('emp_plus',array(1,3));
		}
			$this->db->select(array('dis_libelle','artiste.art_nom','u1.username as per_nom',))
						->join('artiste', 'disque.art_id=artiste.art_id', 'LEFT')
						->join('users AS u1', 'disque.dif_id=u1.id', 'LEFT')
						->join('emplacement', 'disque.emp_id=emplacement.emp_id', 'LEFT')
						->order_by('dis_date_ajout', 'asc')
						->limit('20'); //-> limit($nb, $debut);
		$query = $this->db->get('disque');
		return $query->result();
    }
	
	function GetAll_in($iddisque = array())
    {
    	if (has_permission('Wave.Restriction.Disque'))
		{
			$this->db->where('disque.dif_id',$this->id);
		}
		if(empty($iddisque))
		{
			return $this->GetAll();
		}
		else {
			
			if(!has_permission('Wave.Recherche.Disque'))
			{
				$this->db	->where_in('emp_plus',array(1,3));
			}
			$this->db->select(array('disque.dis_id','dis_libelle','dis_format','u2.username as mem_nom','artiste.art_nom','u1.username as per_nom','emplacement.emp_libelle'))
						->join('artiste', 'disque.art_id=artiste.art_id', 'LEFT')
						->join('emplacement', 'disque.emp_id=emplacement.emp_id', 'LEFT')
						->join('users AS u1', 'disque.dif_id=u1.id', 'LEFT')
						->join('users AS u2','disque.uti_id_ecoute=u2.id', 'LEFT')
							->where_in('dis_id', $iddisque)
							->order_by('dis_libelle', 'asc'); //-> limit($nb, $debut);
			$query = $this->db->get('disque');
			return $query->result();
		}
    }
	
	public function count() {
		if (has_permission('Wave.Restriction.Disque'))
		{
			$this->db->where('disque.dif_id',$this->id);
		}
		if(!has_permission('Wave.Recherche.Disque'))
		{
			$this->db	->join('emplacement', 'disque.emp_id=emplacement.emp_id', 'LEFT')
						->where_in('emp_plus',array(1,3));
		}
		return $this -> db -> count_all('disque');
	}
	
	public function count_enAttente() {
		if (has_permission('Wave.Modifier.Disque'))
		{
		$this->db	->join('emplacement', 'disque.emp_id=emplacement.emp_id', 'LEFT')
					->where('emp_libelle','En attente')
					->from('disque');
		return $this -> db -> count_all_results();
		
		}
		else
			return null;
	}
}