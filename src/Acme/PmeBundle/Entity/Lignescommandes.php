<?php

namespace Acme\PmeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lignescommandes
 */
class Lignescommandes
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $ordre;

    /**
     * @var string
     */
    private $reference;

    /**
     * @var string
     */
    private $prixht;

    /**
     * @var integer
     */
    private $quantite;

    /**
     * @var string
     */
    private $remise;

    /**
     * @var string
     */
    private $totalht;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \Acme\PmeBundle\Entity\Commandes
     */
    private $commande;


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
     * Set ordre
     *
     * @param integer $ordre
     * @return Lignescommandes
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return integer 
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * Set reference
     *
     * @param string $reference
     * @return Lignescommandes
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string 
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set prixht
     *
     * @param string $prixht
     * @return Lignescommandes
     */
    public function setPrixht($prixht)
    {
        $this->prixht = $prixht;

        return $this;
    }

    /**
     * Get prixht
     *
     * @return string 
     */
    public function getPrixht()
    {
        return $this->prixht;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     * @return Lignescommandes
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer 
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set remise
     *
     * @param string $remise
     * @return Lignescommandes
     */
    public function setRemise($remise)
    {
        $this->remise = $remise;

        return $this;
    }

    /**
     * Get remise
     *
     * @return string 
     */
    public function getRemise()
    {
        return $this->remise;
    }

    /**
     * Set totalht
     *
     * @param string $totalht
     * @return Lignescommandes
     */
    public function setTotalht($totalht)
    {
        $this->totalht = $totalht;

        return $this;
    }

    /**
     * Get totalht
     *
     * @return string 
     */
    public function getTotalht()
    {
        return $this->totalht;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Lignescommandes
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
     * Set commande
     *
     * @param \Acme\PmeBundle\Entity\Commandes $commande
     * @return Lignescommandes
     */
    public function setCommande(\Acme\PmeBundle\Entity\Commandes $commande = null)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return \Acme\PmeBundle\Entity\Commandes 
     */
    public function getCommande()
    {
        return $this->commande;
    }
    
    public function __toString()
    {
        return sprintf('%s',$this->getReference());
    }     
}
