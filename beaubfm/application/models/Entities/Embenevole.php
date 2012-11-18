<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities\Embenevole
 */
class Embenevole
{
    /**
     * @var integer $embId
     */
    private $embId;

    /**
     * @var string $embLibelle
     */
    private $embLibelle;

    /**
     * @var Entities\Radio
     */
    private $rad;


    /**
     * Get embId
     *
     * @return integer 
     */
    public function getEmbId()
    {
        return $this->embId;
    }

    /**
     * Set embLibelle
     *
     * @param string $embLibelle
     * @return Embenevole
     */
    public function setEmbLibelle($embLibelle)
    {
        $this->embLibelle = $embLibelle;
    
        return $this;
    }

    /**
     * Get embLibelle
     *
     * @return string 
     */
    public function getEmbLibelle()
    {
        return $this->embLibelle;
    }

    /**
     * Set rad
     *
     * @param Entities\Radio $rad
     * @return Embenevole
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
