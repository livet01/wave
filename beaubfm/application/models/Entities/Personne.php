<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities\Personne
 */
class Personne
{
    /**
     * @var string $perId
     */
    protected $perId;

    /**
     * @var string $perNom
     */
    private $perNom;

    /**
     * @var Entities\Categorie
     */
    private $cat;

    /**
     * @var Entities\Radio
     */
    private $rad;


    /**
     * Get perId
     *
     * @return string 
     */
    public function getPerId()
    {
        return $this->perId;
    }

    /**
     * Set perNom
     *
     * @param string $perNom
     * @return Personne
     */
    public function setPerNom($perNom)
    {
        $this->perNom = $perNom;
    
        return $this;
    }

    /**
     * Get perNom
     *
     * @return string 
     */
    public function getPerNom()
    {
        return $this->perNom;
    }

    /**
     * Set cat
     *
     * @param Entities\Categorie $cat
     * @return Personne
     */
    public function setCat(\Entities\Categorie $cat = null)
    {
        $this->cat = $cat;
    
        return $this;
    }

    /**
     * Get cat
     *
     * @return Entities\Categorie 
     */
    public function getCat()
    {
        return $this->cat;
    }

    /**
     * Set rad
     *
     * @param Entities\Radio $rad
     * @return Personne
     */
    public function setRad(\Entities\Radio $rad = null)
    {
        $this->rad = $rad;
    
        return $this;
    }

    /**
     * Get rad
     *
     * @return Entities\Radio 
     */
    public function getRad()
    {
        return $this->rad;
    }
}
