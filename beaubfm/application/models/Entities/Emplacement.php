<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities\Emplacement
 */
class Emplacement
{
    /**
     * @var integer $empId
     */
    private $empId;

    /**
     * @var string $empLibelle
     */
    private $empLibelle;

    /**
     * @var Entities\Radio
     */
    private $rad;


    /**
     * Get empId
     *
     * @return integer 
     */
    public function getEmpId()
    {
        return $this->empId;
    }

    /**
     * Set empLibelle
     *
     * @param string $empLibelle
     * @return Emplacement
     */
    public function setEmpLibelle($empLibelle)
    {
        $this->empLibelle = $empLibelle;
    
        return $this;
    }

    /**
     * Get empLibelle
     *
     * @return string 
     */
    public function getEmpLibelle()
    {
        return $this->empLibelle;
    }

    /**
     * Set rad
     *
     * @param Entities\Radio $rad
     * @return Emplacement
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
