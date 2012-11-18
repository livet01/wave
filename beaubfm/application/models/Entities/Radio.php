<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities\Radio
 */
class Radio
{
    /**
     * @var integer $radId
     */
    private $radId;

    /**
     * @var string $radLibelle
     */
    private $radLibelle;


    /**
     * Get radId
     *
     * @return integer 
     */
    public function getRadId()
    {
        return $this->radId;
    }

    /**
     * Set radLibelle
     *
     * @param string $radLibelle
     * @return Radio
     */
    public function setRadLibelle($radLibelle)
    {
        $this->radLibelle = $radLibelle;
    
        return $this;
    }

    /**
     * Get radLibelle
     *
     * @return string 
     */
    public function getRadLibelle()
    {
        return $this->radLibelle;
    }
}
