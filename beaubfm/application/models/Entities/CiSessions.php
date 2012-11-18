<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities\CiSessions
 */
class CiSessions
{
    /**
     * @var string $sessionId
     */
    private $sessionId;

    /**
     * @var string $ipAddress
     */
    private $ipAddress;

    /**
     * @var string $userAgent
     */
    private $userAgent;

    /**
     * @var integer $lastActivity
     */
    private $lastActivity;

    /**
     * @var string $userData
     */
    private $userData;


    /**
     * Get sessionId
     *
     * @return string 
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * Set ipAddress
     *
     * @param string $ipAddress
     * @return CiSessions
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
     * @return CiSessions
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
     * Set lastActivity
     *
     * @param integer $lastActivity
     * @return CiSessions
     */
    public function setLastActivity($lastActivity)
    {
        $this->lastActivity = $lastActivity;
    
        return $this;
    }

    /**
     * Get lastActivity
     *
     * @return integer 
     */
    public function getLastActivity()
    {
        return $this->lastActivity;
    }

    /**
     * Set userData
     *
     * @param string $userData
     * @return CiSessions
     */
    public function setUserData($userData)
    {
        $this->userData = $userData;
    
        return $this;
    }

    /**
     * Get userData
     *
     * @return string 
     */
    public function getUserData()
    {
        return $this->userData;
    }
}
