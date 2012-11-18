<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities\Categorie
 */
class Categorie
{
    /**
     * @var integer $catId
     */
    private $catId;

    /**
     * @var string $catLibelle
     */
    private $catLibelle;

    /**
     * @var Entities\Radio
     */
    private $rad;

    /**
     * @var Entities\Role
     */
    private $rol;


    /**
     * Get catId
     *
     * @return integer 
     */
    public function getCatId()
    {
        return $this->catId;
    }

    /**
     * Set catLibelle
     *
     * @param string $catLibelle
     * @return Categorie
     */
    public function setCatLibelle($catLibelle)
    {
        $this->catLibelle = $catLibelle;
    
        return $this;
    }

    /**
     * Get catLibelle
     *
     * @return string 
     */
    public function getCatLibelle()
    {
        return $this->catLibelle;
    }

    /**
     * Set rad
     *
     * @param Entities\Radio $rad
     * @return Categorie
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

    /**
     * Set rol
     *
     * @param Entities\Role $rol
     * @return Categorie
     */
    public function setRol(\Entities\Role $rol = null)
    {
        $this->rol = $rol;
    
        return $this;
    }

    /**
     * Get rol
     *
     * @return Entities\Role 
     */
    public function getRol()
    {
        return $this->rol;
    }
}
