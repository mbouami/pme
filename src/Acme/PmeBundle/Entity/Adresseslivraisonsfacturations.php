<?php

namespace Acme\PmeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adresseslivraisonsfacturations
 */
class Adresseslivraisonsfacturations
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $intitule;

    /**
     * @var string
     */
    private $adresse;

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
     * @var \Acme\PmeBundle\Entity\Villes
     */
    private $ville;

    /**
     * @var \Acme\PmeBundle\Entity\Organisations
     */
    private $organisation;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $typesadresse;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->typesadresse = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set intitule
     *
     * @param string $intitule
     * @return Adresseslivraisonsfacturations
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string 
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Adresseslivraisonsfacturations
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Adresseslivraisonsfacturations
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
     * @return Adresseslivraisonsfacturations
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
     * @return Adresseslivraisonsfacturations
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
     * Set ville
     *
     * @param \Acme\PmeBundle\Entity\Villes $ville
     * @return Adresseslivraisonsfacturations
     */
    public function setVille(\Acme\PmeBundle\Entity\Villes $ville = null)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return \Acme\PmeBundle\Entity\Villes 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set organisation
     *
     * @param \Acme\PmeBundle\Entity\Organisations $organisation
     * @return Adresseslivraisonsfacturations
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
     * Add typesadresse
     *
     * @param \Acme\PmeBundle\Entity\Typesadresse $typesadresse
     * @return Adresseslivraisonsfacturations
     */
    public function addTypesadresse(\Acme\PmeBundle\Entity\Typesadresse $typesadresse)
    {
        $this->typesadresse[] = $typesadresse;

        return $this;
    }

    /**
     * Remove typesadresse
     *
     * @param \Acme\PmeBundle\Entity\Typesadresse $typesadresse
     */
    public function removeTypesadresse(\Acme\PmeBundle\Entity\Typesadresse $typesadresse)
    {
        $this->typesadresse->removeElement($typesadresse);
    }

    /**
     * Get typesadresse
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTypesadresse()
    {
        return $this->typesadresse;
    }
    
    public function getAdresseComplete()
    {
        return $this->adresse."<br>".$this->ville->getCp()." ".$this->ville->getNom()." ".$this->ville->getPays();
    }    
    public function __toString()
    {
        return sprintf('%s (%s)',$this->getAdresse(),$this->getTypesadresse());
    }     
}
