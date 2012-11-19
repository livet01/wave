<?php

namespace Proxies\__CG__\Entities;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class Importdisque extends \Entities\Importdisque implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    
    public function getImpId()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["impId"];
        }
        $this->__load();
        return parent::getImpId();
    }

    public function setImpLibelle($impLibelle)
    {
        $this->__load();
        return parent::setImpLibelle($impLibelle);
    }

    public function getImpLibelle()
    {
        $this->__load();
        return parent::getImpLibelle();
    }

    public function setImpFormat($impFormat)
    {
        $this->__load();
        return parent::setImpFormat($impFormat);
    }

    public function getImpFormat()
    {
        $this->__load();
        return parent::getImpFormat();
    }

    public function setImpEcoute($impEcoute)
    {
        $this->__load();
        return parent::setImpEcoute($impEcoute);
    }

    public function getImpEcoute()
    {
        $this->__load();
        return parent::getImpEcoute();
    }

    public function setImpDateAjout($impDateAjout)
    {
        $this->__load();
        return parent::setImpDateAjout($impDateAjout);
    }

    public function getImpDateAjout()
    {
        $this->__load();
        return parent::getImpDateAjout();
    }

    public function setImpArtiste($impArtiste)
    {
        $this->__load();
        return parent::setImpArtiste($impArtiste);
    }

    public function getImpArtiste()
    {
        $this->__load();
        return parent::getImpArtiste();
    }

    public function setImpDiffuseur($impDiffuseur)
    {
        $this->__load();
        return parent::setImpDiffuseur($impDiffuseur);
    }

    public function getImpDiffuseur()
    {
        $this->__load();
        return parent::getImpDiffuseur();
    }

    public function setImpEmailDiffuseur($impEmailDiffuseur)
    {
        $this->__load();
        return parent::setImpEmailDiffuseur($impEmailDiffuseur);
    }

    public function getImpEmailDiffuseur()
    {
        $this->__load();
        return parent::getImpEmailDiffuseur();
    }

    public function setImpEnvoiOk($impEnvoiOk)
    {
        $this->__load();
        return parent::setImpEnvoiOk($impEnvoiOk);
    }

    public function getImpEnvoiOk()
    {
        $this->__load();
        return parent::getImpEnvoiOk();
    }

    public function setImpEmplacement($impEmplacement)
    {
        $this->__load();
        return parent::setImpEmplacement($impEmplacement);
    }

    public function getImpEmplacement()
    {
        $this->__load();
        return parent::getImpEmplacement();
    }

    public function setImpDateImport($impDateImport)
    {
        $this->__load();
        return parent::setImpDateImport($impDateImport);
    }

    public function getImpDateImport()
    {
        $this->__load();
        return parent::getImpDateImport();
    }

    public function setPerImport(\Entities\Utilisateur $perImport = NULL)
    {
        $this->__load();
        return parent::setPerImport($perImport);
    }

    public function getPerImport()
    {
        $this->__load();
        return parent::getPerImport();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'impId', 'impLibelle', 'impFormat', 'impEcoute', 'impDateAjout', 'impArtiste', 'impDiffuseur', 'impEmailDiffuseur', 'impEnvoiOk', 'impEmplacement', 'impDateImport', 'perImport');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields as $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}