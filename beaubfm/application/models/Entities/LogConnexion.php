<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities\LogConnexion
 */
class LogConnexion
{
    /**
     * @var \DateTime $date
     */
    private $date;

    /**
     * @var string $ipAddress
     */
    private $ipAddress;

    /**
     * @var string $userAgent
     */
    private $userAgent;

    /**
     * @var string $login
     */
    private $login;

    /**
     * @var boolean $reussi
     */
    private $reussi;

    /**
     * @var Entities\Utilisateur
     */
    private $per;


    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set ipAddress
     *
     * @param string $ipAddress
     * @return LogConnexion
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;
    
        return $this;
    }

    /**
     * Get ipAddress
     *
     * @return string 
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * Set userAgent
     *
     * @param string $userAgent
     * @return LogConnexion
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
    
        return $this;
    }

    /**
     * Get userAgent
     *
     * @return string 
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * Set login
     *
     * @param string $login
     * @return LogConnexion
     */
    public function setLogin($login)
    {
        $this->login = $login;
    
        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set reussi
     *
     * @param boolean $reussi
     * @return LogConnexion
     */
    public function setReussi($reussi)
    {
        $this->reussi = $reussi;
    
        return $this;
    }

    /**
     * Get reussi
     *
     * @return boolean 
     */
    public function getReussi()
    {
        return $this->reussi;
    }

    /**
     * Set per
     *
     * @param Entities\Utilisateur $per
     * @return LogConnexion
     */
    public function setPer(\Entities\Utilisateur $per = null)
    {
        $this->per = $per;
    
        return $this;
    }

    /**
     * Get per
     *
     * @return Entities\Utilisateur 
     */
    public function getPer()
    {
        return $this->per;
    }
}
