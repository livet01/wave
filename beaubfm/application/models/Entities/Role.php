<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities\Role
 */
class Role
{
    /**
     * @var integer $rolId
     */
    private $rolId;

    /**
     * @var boolean $rolAjouterDisque
     */
    private $rolAjouterDisque;

    /**
     * @var boolean $rolModifierDisque
     */
    private $rolModifierDisque;

    /**
     * @var boolean $rolSupprimerDisque
     */
    private $rolSupprimerDisque;

    /**
     * @var boolean $rolLireFiche
     */
    private $rolLireFiche;

    /**
     * @var boolean $rolRechercher
     */
    private $rolRechercher;

    /**
     * @var boolean $rolImporter
     */
    private $rolImporter;

    /**
     * @var boolean $rolAjouterPret
     */
    private $rolAjouterPret;

    /**
     * @var boolean $rolModifierPret
     */
    private $rolModifierPret;

    /**
     * @var boolean $rolSupprimerPret
     */
    private $rolSupprimerPret;

    /**
     * @var boolean $rolLirePret
     */
    private $rolLirePret;


    /**
     * Get rolId
     *
     * @return integer 
     */
    public function getRolId()
    {
        return $this->rolId;
    }

    /**
     * Set rolAjouterDisque
     *
     * @param boolean $rolAjouterDisque
     * @return Role
     */
    public function setRolAjouterDisque($rolAjouterDisque)
    {
        $this->rolAjouterDisque = $rolAjouterDisque;
    
        return $this;
    }

    /**
     * Get rolAjouterDisque
     *
     * @return boolean 
     */
    public function getRolAjouterDisque()
    {
        return $this->rolAjouterDisque;
    }

    /**
     * Set rolModifierDisque
     *
     * @param boolean $rolModifierDisque
     * @return Role
     */
    public function setRolModifierDisque($rolModifierDisque)
    {
        $this->rolModifierDisque = $rolModifierDisque;
    
        return $this;
    }

    /**
     * Get rolModifierDisque
     *
     * @return boolean 
     */
    public function getRolModifierDisque()
    {
        return $this->rolModifierDisque;
    }

    /**
     * Set rolSupprimerDisque
     *
     * @param boolean $rolSupprimerDisque
     * @return Role
     */
    public function setRolSupprimerDisque($rolSupprimerDisque)
    {
        $this->rolSupprimerDisque = $rolSupprimerDisque;
    
        return $this;
    }

    /**
     * Get rolSupprimerDisque
     *
     * @return boolean 
     */
    public function getRolSupprimerDisque()
    {
        return $this->rolSupprimerDisque;
    }

    /**
     * Set rolLireFiche
     *
     * @param boolean $rolLireFiche
     * @return Role
     */
    public function setRolLireFiche($rolLireFiche)
    {
        $this->rolLireFiche = $rolLireFiche;
    
        return $this;
    }

    /**
     * Get rolLireFiche
     *
     * @return boolean 
     */
    public function getRolLireFiche()
    {
        return $this->rolLireFiche;
    }

    /**
     * Set rolRechercher
     *
     * @param boolean $rolRechercher
     * @return Role
     */
    public function setRolRechercher($rolRechercher)
    {
        $this->rolRechercher = $rolRechercher;
    
        return $this;
    }

    /**
     * Get rolRechercher
     *
     * @return boolean 
     */
    public function getRolRechercher()
    {
        return $this->rolRechercher;
    }

    /**
     * Set rolImporter
     *
     * @param boolean $rolImporter
     * @return Role
     */
    public function setRolImporter($rolImporter)
    {
        $this->rolImporter = $rolImporter;
    
        return $this;
    }

    /**
     * Get rolImporter
     *
     * @return boolean 
     */
    public function getRolImporter()
    {
        return $this->rolImporter;
    }

    /**
     * Set rolAjouterPret
     *
     * @param boolean $rolAjouterPret
     * @return Role
     */
    public function setRolAjouterPret($rolAjouterPret)
    {
        $this->rolAjouterPret = $rolAjouterPret;
    
        return $this;
    }

    /**
     * Get rolAjouterPret
     *
     * @return boolean 
     */
    public function getRolAjouterPret()
    {
        return $this->rolAjouterPret;
    }

    /**
     * Set rolModifierPret
     *
     * @param boolean $rolModifierPret
     * @return Role
     */
    public function setRolModifierPret($rolModifierPret)
    {
        $this->rolModifierPret = $rolModifierPret;
    
        return $this;
    }

    /**
     * Get rolModifierPret
     *
     * @return boolean 
     */
    public function getRolModifierPret()
    {
        return $this->rolModifierPret;
    }

    /**
     * Set rolSupprimerPret
     *
     * @param boolean $rolSupprimerPret
     * @return Role
     */
    public function setRolSupprimerPret($rolSupprimerPret)
    {
        $this->rolSupprimerPret = $rolSupprimerPret;
    
        return $this;
    }

    /**
     * Get rolSupprimerPret
     *
     * @return boolean 
     */
    public function getRolSupprimerPret()
    {
        return $this->rolSupprimerPret;
    }

    /**
     * Set rolLirePret
     *
     * @param boolean $rolLirePret
     * @return Role
     */
    public function setRolLirePret($rolLirePret)
    {
        $this->rolLirePret = $rolLirePret;
    
        return $this;
    }

    /**
     * Get rolLirePret
     *
     * @return boolean 
     */
    public function getRolLirePret()
    {
        return $this->rolLirePret;
    }
}
