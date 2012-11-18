<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities\Importdisque
 */
class Importdisque
{
    /**
     * @var integer $impId
     */
    private $impId;

    /**
     * @var string $impLibelle
     */
    private $impLibelle;

    /**
     * @var string $impFormat
     */
    private $impFormat;

    /**
     * @var string $impEcoute
     */
    private $impEcoute;

    /**
     * @var string $impDateAjout
     */
    private $impDateAjout;

    /**
     * @var string $impArtiste
     */
    private $impArtiste;

    /**
     * @var string $impDiffuseur
     */
    private $impDiffuseur;

    /**
     * @var string $impEmailDiffuseur
     */
    private $impEmailDiffuseur;

    /**
     * @var string $impEnvoiOk
     */
    private $impEnvoiOk;

    /**
     * @var string $impEmplacement
     */
    private $impEmplacement;

    /**
     * @var \DateTime $impDateImport
     */
    private $impDateImport;

    /**
     * @var Entities\Utilisateur
     */
    private $perImport;


    /**
     * Get impId
     *
     * @return integer 
     */
    public function getImpId()
    {
        return $this->impId;
    }

    /**
     * Set impLibelle
     *
     * @param string $impLibelle
     * @return Importdisque
     */
    public function setImpLibelle($impLibelle)
    {
        $this->impLibelle = $impLibelle;
    
        return $this;
    }

    /**
     * Get impLibelle
     *
     * @return string 
     */
    public function getImpLibelle()
    {
        return $this->impLibelle;
    }

    /**
     * Set impFormat
     *
     * @param string $impFormat
     * @return Importdisque
     */
    public function setImpFormat($impFormat)
    {
        $this->impFormat = $impFormat;
    
        return $this;
    }

    /**
     * Get impFormat
     *
     * @return string 
     */
    public function getImpFormat()
    {
        return $this->impFormat;
    }

    /**
     * Set impEcoute
     *
     * @param string $impEcoute
     * @return Importdisque
     */
    public function setImpEcoute($impEcoute)
    {
        $this->impEcoute = $impEcoute;
    
        return $this;
    }

    /**
     * Get impEcoute
     *
     * @return string 
     */
    public function getImpEcoute()
    {
        return $this->impEcoute;
    }

    /**
     * Set impDateAjout
     *
     * @param string $impDateAjout
     * @return Importdisque
     */
    public function setImpDateAjout($impDateAjout)
    {
        $this->impDateAjout = $impDateAjout;
    
        return $this;
    }

    /**
     * Get impDateAjout
     *
     * @return string 
     */
    public function getImpDateAjout()
    {
        return $this->impDateAjout;
    }

    /**
     * Set impArtiste
     *
     * @param string $impArtiste
     * @return Importdisque
     */
    public function setImpArtiste($impArtiste)
    {
        $this->impArtiste = $impArtiste;
    
        return $this;
    }

    /**
     * Get impArtiste
     *
     * @return string 
     */
    public function getImpArtiste()
    {
        return $this->impArtiste;
    }

    /**
     * Set impDiffuseur
     *
     * @param string $impDiffuseur
     * @return Importdisque
     */
    public function setImpDiffuseur($impDiffuseur)
    {
        $this->impDiffuseur = $impDiffuseur;
    
        return $this;
    }

    /**
     * Get impDiffuseur
     *
     * @return string 
     */
    public function getImpDiffuseur()
    {
        return $this->impDiffuseur;
    }

    /**
     * Set impEmailDiffuseur
     *
     * @param string $impEmailDiffuseur
     * @return Importdisque
     */
    public function setImpEmailDiffuseur($impEmailDiffuseur)
    {
        $this->impEmailDiffuseur = $impEmailDiffuseur;
    
        return $this;
    }

    /**
     * Get impEmailDiffuseur
     *
     * @return string 
     */
    public function getImpEmailDiffuseur()
    {
        return $this->impEmailDiffuseur;
    }

    /**
     * Set impEnvoiOk
     *
     * @param string $impEnvoiOk
     * @return Importdisque
     */
    public function setImpEnvoiOk($impEnvoiOk)
    {
        $this->impEnvoiOk = $impEnvoiOk;
    
        return $this;
    }

    /**
     * Get impEnvoiOk
     *
     * @return string 
     */
    public function getImpEnvoiOk()
    {
        return $this->impEnvoiOk;
    }

    /**
     * Set impEmplacement
     *
     * @param string $impEmplacement
     * @return Importdisque
     */
    public function setImpEmplacement($impEmplacement)
    {
        $this->impEmplacement = $impEmplacement;
    
        return $this;
    }

    /**
     * Get impEmplacement
     *
     * @return string 
     */
    public function getImpEmplacement()
    {
        return $this->impEmplacement;
    }

    /**
     * Set impDateImport
     *
     * @param \DateTime $impDateImport
     * @return Importdisque
     */
    public function setImpDateImport($impDateImport)
    {
        $this->impDateImport = $impDateImport;
    
        return $this;
    }

    /**
     * Get impDateImport
     *
     * @return \DateTime 
     */
    public function getImpDateImport()
    {
        return $this->impDateImport;
    }

    /**
     * Set perImport
     *
     * @param Entities\Utilisateur $perImport
     * @return Importdisque
     */
    public function setPerImport(\Entities\Utilisateur $perImport = null)
    {
        $this->perImport = $perImport;
    
        return $this;
    }

    /**
     * Get perImport
     *
     * @return Entities\Utilisateur 
     */
    public function getPerImport()
    {
        return $this->perImport;
    }
}
