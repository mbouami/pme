<?php

namespace Acme\PmeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\Role\RoleInterface;

/**
 * Groupes
 */
class Groupes implements RoleInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $role;


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
     * Set nom
     *
     * @param string $nom
     * @return Groupes
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return Groupes
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole()
    {
        return $this->role;
    }
    
    public function __toString()
    {
        return sprintf('%s (%s)',$this->getNom(),  $this->getRole());
    }      
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $referents;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->referents = new ArrayCollection();
    }

    /**
     * Add referents
     *
     * @param \Acme\PmeBundle\Entity\Referents $referents
     * @return Groupes
     */
    public function addReferent(\Acme\PmeBundle\Entity\Referents $referents)
    {
        $this->referents[] = $referents;

        return $this;
    }

    /**
     * Remove referents
     *
     * @param \Acme\PmeBundle\Entity\Referents $referents
     */
    public function removeReferent(\Acme\PmeBundle\Entity\Referents $referents)
    {
        $this->referents->removeElement($referents);
    }

    /**
     * Get referents
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReferents()
    {
        return $this->referents;
    }
}