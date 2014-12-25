<?php

namespace Acme\PmeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Villes
 */
class Villes
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
    private $cp;

    /**
     * @var \Acme\PmeBundle\Entity\Pays
     */
    private $pays;


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
     * @return Villes
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
     * Set cp
     *
     * @param string $cp
     * @return Villes
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string 
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set pays
     *
     * @param \Acme\PmeBundle\Entity\Pays $pays
     * @return Villes
     */
    public function setPays(\Acme\PmeBundle\Entity\Pays $pays = null)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return \Acme\PmeBundle\Entity\Pays 
     */
    public function getPays()
    {
        return $this->pays;
    }
    
    public function __toString()
    {
        return sprintf('%s (%s-%s)',$this->getNom(),$this->getCp(),$this->getPays()->getNom());
    }      
}
