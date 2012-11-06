<?php 
class Info_Disque_Model extends CI_Model
{
    function GetArtiste($numArtiste)
    {
		$this->db->select(array('Disque.dis_id','dis_libelle','dis_format','Membre.mem_nom','Artiste.art_nom','Personne.per_nom','Emplacement.emp_libelle'))
						->join('Artiste', 'Disque.per_id_artiste=Artiste.art_id', 'LEFT')
						->join('Emplacement', 'Disque.emp_id=Emplacement.emp_id', 'LEFT')
						->join('Personne', 'Disque.dif_id=Personne.per_id', 'LEFT')
						->join('Membre','Disque.uti_id_ecoute=Membre.mem_id', 'LEFT')
						->where('Disque.per_id_artiste', $numArtiste);
		$query = $this->db->get('Disque');
		return $query->result();
    }
	

    function GetLabel($numLabel)
    {
		$this->db->select(array('Disque.dis_id','dis_libelle','dis_format','Membre.mem_nom','Artiste.art_nom','Personne.per_nom','Emplacement.emp_libelle'))
						->join('Artiste', 'Disque.per_id_artiste=Artiste.art_id', 'LEFT')
						->join('Emplacement', 'Disque.emp_id=Emplacement.emp_id', 'LEFT')
						->join('Personne', 'Disque.dif_id=Personne.per_id', 'LEFT')
						->join('Membre','Disque.uti_id_ecoute=Membre.mem_id', 'LEFT')
						->where('Disque.dif_id', $numLabel);
		$query = $this->db->get('Disque');
		return $query->result();
    }

    function GetDisque($numDisque)
    {
		$this->db->select(array('Disque.dis_id','dis_libelle','dis_format','Membre.mem_nom','Artiste.art_nom','Personne.per_nom','Emplacement.emp_libelle'))
						->join('Artiste', 'Disque.per_id_artiste=Artiste.art_id', 'LEFT')
						->join('Emplacement', 'Disque.emp_id=Emplacement.emp_id', 'LEFT')
						->join('Personne', 'Disque.dif_id=Personne.per_id', 'LEFT')
						->join('Membre','Disque.uti_id_ecoute=Membre.mem_id', 'LEFT')
						->where('Disque.dis_id', $numDisque);
		$query = $this->db->get('Disque');
		return $query->result();
    }
}