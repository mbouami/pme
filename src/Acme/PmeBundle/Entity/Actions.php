<?php

namespace Acme\PmeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Actions
 */
class Actions
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $sujet;

    /**
     * @var string
     */
    private $a;

    /**
     * @var string
     */
    private $cci;

    /**
     * @var boolean
     */
    private $pj;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $piecejointe;

    /**
     * @var \Acme\PmeBundle\Entity\Typesaction
     */
    private $typeaction;

    /**
     * @var \Acme\PmeBundle\Entity\Referents
     */
    private $referent;

    /**
     * @var \Acme\PmeBundle\Entity\Organisations
     */
    private $organisation;

    /**
     * @var \Acme\PmeBundle\Entity\Contacts
     */
    private $contact;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->piecejointe = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();  
    }

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
     * Set sujet
     *
     * @param string $sujet
     * @return Actions
     */
    public function setSujet($sujet)
    {
        $this->sujet = $sujet;

        return $this;
    }

    /**
     * Get sujet
     *
     * @return string 
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * Set a
     *
     * @param string $a
     * @return Actions
     */
    public function setA($a)
    {
        $this->a = $a;

        return $this;
    }

    /**
     * Get a
     *
     * @return string 
     */
    public function getA()
    {
        return $this->a;
    }

    /**
     * Set cci
     *
     * @param string $cci
     * @return Actions
     */
    public function setCci($cci)
    {
        $this->cci = $cci;

        return $this;
    }

    /**
     * Get cci
     *
     * @return string 
     */
    public function getCci()
    {
        return $this->cci;
    }

    /**
     * Set pj
     *
     * @param boolean $pj
     * @return Actions
     */
    public function setPj($pj)
    {
        $this->pj = $pj;

        return $this;
    }

    /**
     * Get pj
     *
     * @return boolean 
     */
    public function getPj()
    {
        return $this->pj;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Actions
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Actions
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
     * @return Actions
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
     * Add piecejointe
     *
     * @param \Acme\PmeBundle\Entity\Piecesjointes $piecejointe
     * @return Actions
     */
    public function addPiecejointe(\Acme\PmeBundle\Entity\Piecesjointes $piecejointe)
    {
        $this->piecejointe[] = $piecejointe;

        return $this;
    }

    /**
     * Remove piecejointe
     *
     * @param \Acme\PmeBundle\Entity\Piecesjointes $piecejointe
     */
    public function removePiecejointe(\Acme\PmeBundle\Entity\Piecesjointes $piecejointe)
    {
        $this->piecejointe->removeElement($piecejointe);
    }

    /**
     * Get piecejointe
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPiecejointe()
    {
        return $this->piecejointe;
    }

    /**
     * Set typeaction
     *
     * @param \Acme\PmeBundle\Entity\Typesaction $typeaction
     * @return Actions
     */
    public function setTypeaction(\Acme\PmeBundle\Entity\Typesaction $typeaction = null)
    {
        $this->typeaction = $typeaction;

        return $this;
    }

    /**
     * Get typeaction
     *
     * @return \Acme\PmeBundle\Entity\Typesaction 
     */
    public function getTypeaction()
    {
        return $this->typeaction;
    }

    /**
     * Set referent
     *
     * @param \Acme\PmeBundle\Entity\Referents $referent
     * @return Actions
     */
    public function setReferent(\Acme\PmeBundle\Entity\Referents $referent = null)
    {
        $this->referent = $referent;

        return $this;
    }

    /**
     * Get referent
     *
     * @return \Acme\PmeBundle\Entity\Referents 
     */
    public function getReferent()
    {
        return $this->referent;
    }

    /**
     * Set organisation
     *
     * @param \Acme\PmeBundle\Entity\Organisations $organisation
     * @return Actions
     */
    public function setOrganisation(\Acme\PmeBundle\Entity\Organisations $organisation = null)
    {
        $this->organisation = $organisation;

        return $this;
    }

    /**
     * Get organisation
     *
     * @return \Acme\PmeBundle\Entity\Organisations 
     */
    public function getOrganisation()
    {
        return $this->organisation;
    }

    /**
     * Set contact
     *
     * @param \Acme\PmeBundle\Entity\Contacts $contact
     * @return Actions
     */
    public function setContact(\Acme\PmeBundle\Entity\Contacts $contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return \Acme\PmeBundle\Entity\Contacts 
     */
    public function getContact()
    {
        return $this->contact;
    }
    
    public function getArrayActions(){
    	$sortie = array('id'=>$this->getId(),     
                        'sujet'=>$this->getSujet(),                        
                        'createdAt' =>  date_format($this->getCreatedAt(), "d-m-Y à H:i"),
                        'contact'=>$this->getContact()?$this->getContact()->__toString():null,
                        'cat'=>'action'    				
                        );
    	return $sortie;
    }    
    
    public function __toString()
    {
        return sprintf('%s',$this->getSujet());
    }        
}
