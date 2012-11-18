<?php

namespace Proxies\__CG__\Entities;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class LogConnexion extends \Entities\LogConnexion implements \Doctrine\ORM\Proxy\Proxy
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

    
    public function getDate()
    {
        $this->__load();
        return parent::getDate();
    }

    public function setIpAddress($ipAddress)
    {
        $this->__load();
        return parent::setIpAddress($ipAddress);
    }

    public function getIpAddress()
    {
        $this->__load();
        return parent::getIpAddress();
    }

    public function setUserAgent($userAgent)
    {
        $this->__load();
        return parent::setUserAgent($userAgent);
    }

    public function getUserAgent()
    {
        $this->__load();
        return parent::getUserAgent();
    }

    public function setLogin($login)
    {
        $this->__load();
        return parent::setLogin($login);
    }

    public function getLogin()
    {
        $this->__load();
        return parent::getLogin();
    }

    public function setReussi($reussi)
    {
        $this->__load();
        return parent::setReussi($reussi);
    }

    public function getReussi()
    {
        $this->__load();
        return parent::getReussi();
    }

    public function setPer(\Entities\Utilisateur $per = NULL)
    {
        $this->__load();
        return parent::setPer($per);
    }

    public function getPer()
    {
        $this->__load();
        return parent::getPer();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'date', 'ipAddress', 'userAgent', 'login', 'reussi', 'per');
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