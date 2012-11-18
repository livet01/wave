<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities\Utilisateur
 */
class Utilisateur extends Personne
{
    /**
     * @var string $utiPrenom
     */
    private $utiPrenom;

    /**
     * @var string $utiLogin
     */
    private $utiLogin;

    /**
     * @var string $utiMdp
     */
    private $utiMdp;

    /**
     * @var boolean $utiTutorial
     */
    private $utiTutorial;

    /**
     * @var boolean $utiVerrou
     */
    private $utiVerrou;


    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $dis;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dis = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set utiPrenom
     *
     * @param string $utiPrenom
     * @return Utilisateur
     */
    public function setUtiPrenom($utiPrenom)
    {
        $this->utiPrenom = $utiPrenom;
    
        return $this;
    }

    /**
     * Get utiPrenom
     *
     * @return string 
     */
    public function getUtiPrenom()
    {
        return $this->utiPrenom;
    }

    /**
     * Set utiLogin
     *
     * @param string $utiLogin
     * @return Utilisateur
     */
    public function setUtiLogin($utiLogin)
    {
        $this->utiLogin = $utiLogin;
    
        return $this;
    }

    /**
     * Get utiLogin
     *
     * @return string 
     */
    public function getUtiLogin()
    {
        return $this->utiLogin;
    }

    /**
     * Set utiMdp
     *
     * @param string $utiMdp
     * @return Utilisateur
     */
    public function setUtiMdp($utiMdp)
    {
        $this->utiMdp = $utiMdp;
    
        return $this;
    }

    /**
     * Get utiMdp
     *
     * @return string 
     */
    public function getUtiMdp()
    {
        return $this->utiMdp;
    }

    /**
     * Set utiTutorial
     *
     * @param boolean $utiTutorial
     * @return Utilisateur
     */
    public function setUtiTutorial($utiTutorial)
    {
        $this->utiTutorial = $utiTutorial;
    
        return $this;
    }

    /**
     * Get utiTutorial
     *
     * @return boolean 
     */
    public function getUtiTutorial()
    {
        return $this->utiTutorial;
    }

    /**
     * Set utiVerrou
     *
     * @param boolean $utiVerrou
     * @return Utilisateur
     */
    public function setUtiVerrou($utiVerrou)
    {
        $this->utiVerrou = $utiVerrou;
    
        return $this;
    }

    /**
     * Get utiVerrou
     *
     * @return boolean 
     */
    public function getUtiVerrou()
    {
        return $this->utiVerrou;
    }


    /**
     * Add dis
     *
     * @param Entities\Disque $dis
     * @return Utilisateur
     */
    public function addDi(\Entities\Disque $dis)
    {
        $this->dis[] = $dis;
    
        return $this;
    }

    /**
     * Remove dis
     *
     * @param Entities\Disque $dis
     */
    public function removeDi(\Entities\Disque $dis)
    {
        $this->dis->removeElement($dis);
    }

    /**
     * Get dis
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getDis()
    {
        return $this->dis;
    }
}
