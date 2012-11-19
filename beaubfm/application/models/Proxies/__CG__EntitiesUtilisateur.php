<?php

namespace Proxies\__CG__\Entities;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class Utilisateur extends \Entities\Utilisateur implements \Doctrine\ORM\Proxy\Proxy
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

    
    public function setUtiPrenom($utiPrenom)
    {
        $this->__load();
        return parent::setUtiPrenom($utiPrenom);
    }

    public function getUtiPrenom()
    {
        $this->__load();
        return parent::getUtiPrenom();
    }

    public function setUtiLogin($utiLogin)
    {
        $this->__load();
        return parent::setUtiLogin($utiLogin);
    }

    public function getUtiLogin()
    {
        $this->__load();
        return parent::getUtiLogin();
    }

    public function setUtiMdp($utiMdp)
    {
        $this->__load();
        return parent::setUtiMdp($utiMdp);
    }

    public function getUtiMdp()
    {
        $this->__load();
        return parent::getUtiMdp();
    }

    public function setUtiTutorial($utiTutorial)
    {
        $this->__load();
        return parent::setUtiTutorial($utiTutorial);
    }

    public function getUtiTutorial()
    {
        $this->__load();
        return parent::getUtiTutorial();
    }

    public function setUtiVerrou($utiVerrou)
    {
        $this->__load();
        return parent::setUtiVerrou($utiVerrou);
    }

    public function getUtiVerrou()
    {
        $this->__load();
        return parent::getUtiVerrou();
    }

    public function addDi(\Entities\Disque $dis)
    {
        $this->__load();
        return parent::addDi($dis);
    }

    public function removeDi(\Entities\Disque $dis)
    {
        $this->__load();
        return parent::removeDi($dis);
    }

    public function getDis()
    {
        $this->__load();
        return parent::getDis();
    }

    public function getPerId()
    {
        if ($this->__isInitialized__ === false) {
            return $this->_identifier["perId"];
        }
        $this->__load();
        return parent::getPerId();
    }

    public function setPerNom($perNom)
    {
        $this->__load();
        return parent::setPerNom($perNom);
    }

    public function getPerNom()
    {
        $this->__load();
        return parent::getPerNom();
    }

    public function setCat(\Entities\Categorie $cat = NULL)
    {
        $this->__load();
        return parent::setCat($cat);
    }

    public function getCat()
    {
        $this->__load();
        return parent::getCat();
    }

    public function setRad(\Entities\Radio $rad = NULL)
    {
        $this->__load();
        return parent::setRad($rad);
    }

    public function getRad()
    {
        $this->__load();
        return parent::getRad();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'perId', 'perNom', 'cat', 'rad', 'utiPrenom', 'utiLogin', 'utiMdp', 'utiTutorial', 'utiVerrou', 'dis');
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