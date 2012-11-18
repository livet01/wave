<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities\Diffuseur
 */
class Diffuseur extends Utilisateur
{
    /**
     * @var string $difMail
     */
    private $difMail;


    /**
     * Set difMail
     *
     * @param string $difMail
     * @return Diffuseur
     */
    public function setDifMail($difMail)
    {
        $this->difMail = $difMail;
    
        return $this;
    }

    /**
     * Get difMail
     *
     * @return string 
     */
    public function getDifMail()
    {
        return $this->difMail;
    }

}
