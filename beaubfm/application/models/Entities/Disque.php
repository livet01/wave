<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities\Disque
 */
class Disque
{
    /**
     * @var string $disId
     */
    private $disId;

    /**
     * @var string $disLibelle
     */
    private $disLibelle;

    /**
     * @var string $disFormat
     */
    private $disFormat;

    /**
     * @var \DateTime $disDateAjout
     */
    private $disDateAjout;

    /**
     * @var boolean $disEnvoiOk
     */
    private $disEnvoiOk;

    /**
     * @var boolean $disDisponible
     */
    private $disDisponible;

    /**
     * @var Entities\Diffuseur
     */
    private $dif;

    /**
     * @var Entities\Embenevole
     */
    private $emb;

    /**
     * @var Entities\Emplacement
     */
    private $emp;

    /**
     * @var Entities\Personne
     */
    private $perArtiste;

    /**
     * @var Entities\Utilisateur
     */
    private $utiEcoute;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $per;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->per = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get disId
     *
     * @return string 
     */
    public function getDisId()
    {
        return $this->disId;
    }

    /**
     * Set disLibelle
     *
     * @param string $disLibelle
     * @return Disque
     */
    public function setDisLibelle($disLibelle)
    {
        $this->disLibelle = $disLibelle;
    
        return $this;
    }

    /**
     * Get disLibelle
     *
     * @return string 
     */
    public function getDisLibelle()
    {
        return $this->disLibelle;
    }

    /**
     * Set disFormat
     *
     * @param string $disFormat
     * @return Disque
     */
    public function setDisFormat($disFormat)
    {
        $this->disFormat = $disFormat;
    
        return $this;
    }

    /**
     * Get disFormat
     *
     * @return string 
     */
    public function getDisFormat()
    {
        return $this->disFormat;
    }

    /**
     * Set disDateAjout
     *
     * @param \DateTime $disDateAjout
     * @return Disque
     */
    public function setDisDateAjout($disDateAjout)
    {
        $this->disDateAjout = $disDateAjout;
    
        return $this;
    }

    /**
     * Get disDateAjout
     *
     * @return \DateTime 
     */
    public function getDisDateAjout()
    {
        return $this->disDateAjout;
    }

    /**
     * Set disEnvoiOk
     *
     * @param boolean $disEnvoiOk
     * @return Disque
     */
    public function setDisEnvoiOk($disEnvoiOk)
    {
        $this->disEnvoiOk = $disEnvoiOk;
    
        return $this;
    }

    /**
     * Get disEnvoiOk
     *
     * @return boolean 
     */
    public function getDisEnvoiOk()
    {
        return $this->disEnvoiOk;
    }

    /**
     * Set disDisponible
     *
     * @param boolean $disDisponible
     * @return Disque
     */
    public function setDisDisponible($disDisponible)
    {
        $this->disDisponible = $disDisponible;
    
        return $this;
    }

    /**
     * Get disDisponible
     *
     * @return boolean 
     */
    public function getDisDisponible()
    {
        return $this->disDisponible;
    }

    /**
     * Set dif
     *
     * @param Entities\Diffuseur $dif
     * @return Disque
     */
    public function setDif(\Entities\Diffuseur $dif = null)
    {
        $this->dif = $dif;
    
        return $this;
    }

    /**
     * Get dif
     *
     * @return Entities\Diffuseur 
     */
    public function getDif()
    {
        return $this->dif;
    }

    /**
     * Set emb
     *
     * @param Entities\Embenevole $emb
     * @return Disque
     */
    public function setEmb(\Entities\Embenevole $emb = null)
    {
        $this->emb = $emb;
    
        return $this;
    }

    /**
     * Get emb
     *
     * @return Entities\Embenevole 
     */
    public function getEmb()
    {
        return $this->emb;
    }

    /**
     * Set emp
     *
     * @param Entities\Emplacement $emp
     * @return Disque
     */
    public function setEmp(\Entities\Emplacement $emp = null)
    {
        $this->emp = $emp;
    
        return $this;
    }

    /**
     * Get emp
     *
     * @return Entities\Emplacement 
     */
    public function getEmp()
    {
        return $this->emp;
    }

    /**
     * Set perArtiste
     *
     * @param Entities\Personne $perArtiste
     * @return Disque
     */
    public function setPerArtiste(\Entities\Personne $perArtiste = null)
    {
        $this->perArtiste = $perArtiste;
    
        return $this;
    }

    /**
     * Get perArtiste
     *
     * @return Entities\Personne 
     */
    public function getPerArtiste()
    {
        return $this->perArtiste;
    }

    /**
     * Set utiEcoute
     *
     * @param Entities\Utilisateur $utiEcoute
     * @return Disque
     */
    public function setUtiEcoute(\Entities\Utilisateur $utiEcoute = null)
    {
        $this->utiEcoute = $utiEcoute;
    
        return $this;
    }

    /**
     * Get utiEcoute
     *
     * @return Entities\Utilisateur 
     */
    public function getUtiEcoute()
    {
        return $this->utiEcoute;
    }

    /**
     * Add per
     *
     * @param Entities\Utilisateur $per
     * @return Disque
     */
    public function addPer(\Entities\Utilisateur $per)
    {
        $this->per[] = $per;
    
        return $this;
    }

    /**
     * Remove per
     *
     * @param Entities\Utilisateur $per
     */
    public function removePer(\Entities\Utilisateur $per)
    {
        $this->per->removeElement($per);
    }

    /**
     * Get per
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPer()
    {
        return $this->per;
    }
}
