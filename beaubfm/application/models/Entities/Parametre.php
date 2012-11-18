<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities\Parametre
 */
class Parametre
{
    /**
     * @var integer $paramId
     */
    private $paramId;

    /**
     * @var string $paramLibelle
     */
    private $paramLibelle;

    /**
     * @var string $paramValeur
     */
    private $paramValeur;


    /**
     * Get paramId
     *
     * @return integer 
     */
    public function getParamId()
    {
        return $this->paramId;
    }

    /**
     * Set paramLibelle
     *
     * @param string $paramLibelle
     * @return Parametre
     */
    public function setParamLibelle($paramLibelle)
    {
        $this->paramLibelle = $paramLibelle;
    
        return $this;
    }

    /**
     * Get paramLibelle
     *
     * @return string 
     */
    public function getParamLibelle()
    {
        return $this->paramLibelle;
    }

    /**
     * Set paramValeur
     *
     * @param string $paramValeur
     * @return Parametre
     */
    public function setParamValeur($paramValeur)
    {
        $this->paramValeur = $paramValeur;
    
        return $this;
    }

    /**
     * Get paramValeur
     *
     * @return string 
     */
    public function getParamValeur()
    {
        return $this->paramValeur;
    }
}
