<?php

namespace Acme\PmeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Piecesjointes
 */
class Piecesjointes
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $document;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \Acme\PmeBundle\Entity\Actions
     */
    private $action;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set document
     *
     * @param string $document
     * @return Piecesjointes
     */
    public function setDocument($document)
    {
        $this->document = $document;

        return $this;
    }

    /**
     * Get document
     *
     * @return string 
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Piecesjointes
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Piecesjointes
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set action
     *
     * @param \Acme\PmeBundle\Entity\Actions $action
     * @return Piecesjointes
     */
    public function setAction(\Acme\PmeBundle\Entity\Actions $action = null)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return \Acme\PmeBundle\Entity\Actions 
     */
    public function getAction()
    {
        return $this->action;
    }
    
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();        
    }   
    
    public function __toString()
    {
        return sprintf('%s',  $this->getDocument());
    }       
}
