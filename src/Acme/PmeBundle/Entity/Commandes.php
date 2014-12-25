<?php

namespace Acme\PmeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Commandes
 */
class Commandes
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $numcommande;

    /**
     * @var string
     */
    private $dossier;

    /**
     * @var string
     */
    private $referenceclient;

    /**
     * @var string
     */
    private $totalht;

    /**
     * @var string
     */
    private $tauxtva;

    /**
     * @var string
     */
    private $totaltva;

    /**
     * @var string
     */
    private $totalttc;

    /**
     * @var string
     */
    private $fraisport;

    /**
     * @var string
     */
    private $observation;

    /**
     * @var boolean
     */
    private $livrermemeadresse;

    /**
     * @var boolean
     */
    private $facturermemeadresse;

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
    private $lignescommandes;

    /**
     * @var \Acme\PmeBundle\Entity\Modesreglement
     */
    private $modereglement;

    /**
     * @var \Acme\PmeBundle\Entity\Adresseslivraisonsfacturations
     */
    private $livraison;

    /**
     * @var \Acme\PmeBundle\Entity\Adresseslivraisonsfacturations
     */
    private $facturation;

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
        $this->lignescommandes = new ArrayCollection();
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
     * Set numcommande
     *
     * @param string $numcommande
     * @return Commandes
     */
    public function setNumcommande($numcommande)
    {
        $this->numcommande = $numcommande;

        return $this;
    }

    /**
     * Get numcommande
     *
     * @return string 
     */
    public function getNumcommande()
    {
        return $this->numcommande;
    }

    /**
     * Set dossier
     *
     * @param string $dossier
     * @return Commandes
     */
    public function setDossier($dossier)
    {
        $this->dossier = $dossier;

        return $this;
    }

    /**
     * Get dossier
     *
     * @return string 
     */
    public function getDossier()
    {
        return $this->dossier;
    }

    /**
     * Set referenceclient
     *
     * @param string $referenceclient
     * @return Commandes
     */
    public function setReferenceclient($referenceclient)
    {
        $this->referenceclient = $referenceclient;

        return $this;
    }

    /**
     * Get referenceclient
     *
     * @return string 
     */
    public function getReferenceclient()
    {
        return $this->referenceclient;
    }

    /**
     * Set totalht
     *
     * @param string $totalht
     * @return Commandes
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
     * Set tauxtva
     *
     * @param string $tauxtva
     * @return Commandes
     */
    public function setTauxtva($tauxtva)
    {
        $this->tauxtva = $tauxtva;

        return $this;
    }

    /**
     * Get tauxtva
     *
     * @return string 
     */
    public function getTauxtva()
    {
        return $this->tauxtva;
    }

    /**
     * Set totaltva
     *
     * @param string $totaltva
     * @return Commandes
     */
    public function setTotaltva($totaltva)
    {
        $this->totaltva = $totaltva;

        return $this;
    }

    /**
     * Get totaltva
     *
     * @return string 
     */
    public function getTotaltva()
    {
        return $this->totaltva;
    }

    /**
     * Set totalttc
     *
     * @param string $totalttc
     * @return Commandes
     */
    public function setTotalttc($totalttc)
    {
        $this->totalttc = $totalttc;

        return $this;
    }

    /**
     * Get totalttc
     *
     * @return string 
     */
    public function getTotalttc()
    {
        return $this->totalttc;
    }

    /**
     * Set fraisport
     *
     * @param string $fraisport
     * @return Commandes
     */
    public function setFraisport($fraisport)
    {
        $this->fraisport = $fraisport;

        return $this;
    }

    /**
     * Get fraisport
     *
     * @return string 
     */
    public function getFraisport()
    {
        return $this->fraisport;
    }

    /**
     * Set observation
     *
     * @param string $observation
     * @return Commandes
     */
    public function setObservation($observation)
    {
        $this->observation = $observation;

        return $this;
    }

    /**
     * Get observation
     *
     * @return string 
     */
    public function getObservation()
    {
        return $this->observation;
    }

    /**
     * Set livrermemeadresse
     *
     * @param boolean $livrermemeadresse
     * @return Commandes
     */
    public function setLivrermemeadresse($livrermemeadresse)
    {
        $this->livrermemeadresse = $livrermemeadresse;

        return $this;
    }

    /**
     * Get livrermemeadresse
     *
     * @return boolean 
     */
    public function getLivrermemeadresse()
    {
        return $this->livrermemeadresse;
    }

    /**
     * Set facturermemeadresse
     *
     * @param boolean $facturermemeadresse
     * @return Commandes
     */
    public function setFacturermemeadresse($facturermemeadresse)
    {
        $this->facturermemeadresse = $facturermemeadresse;

        return $this;
    }

    /**
     * Get facturermemeadresse
     *
     * @return boolean 
     */
    public function getFacturermemeadresse()
    {
        return $this->facturermemeadresse;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Commandes
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
     * @return Commandes
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
     * Add lignescommandes
     *
     * @param \Acme\PmeBundle\Entity\Lignescommandes $lignescommandes
     * @return Commandes
     */
    public function addLignescommande(\Acme\PmeBundle\Entity\Lignescommandes $lignescommandes)
    {
        $this->lignescommandes[] = $lignescommandes;

        return $this;
    }

    /**
     * Remove lignescommandes
     *
     * @param \Acme\PmeBundle\Entity\Lignescommandes $lignescommandes
     */
    public function removeLignescommande(\Acme\PmeBundle\Entity\Lignescommandes $lignescommandes)
    {
        $this->lignescommandes->removeElement($lignescommandes);
    }

    /**
     * Get lignescommandes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLignescommandes()
    {
        return $this->lignescommandes;
    }

    /**
     * Set modereglement
     *
     * @param \Acme\PmeBundle\Entity\Modesreglement $modereglement
     * @return Commandes
     */
    public function setModereglement(\Acme\PmeBundle\Entity\Modesreglement $modereglement = null)
    {
        $this->modereglement = $modereglement;

        return $this;
    }

    /**
     * Get modereglement
     *
     * @return \Acme\PmeBundle\Entity\Modesreglement 
     */
    public function getModereglement()
    {
        return $this->modereglement;
    }

    /**
     * Set livraison
     *
     * @param \Acme\PmeBundle\Entity\Adresseslivraisonsfacturations $livraison
     * @return Commandes
     */
    public function setLivraison(\Acme\PmeBundle\Entity\Adresseslivraisonsfacturations $livraison = null)
    {
        $this->livraison = $livraison;

        return $this;
    }

    /**
     * Get livraison
     *
     * @return \Acme\PmeBundle\Entity\Adresseslivraisonsfacturations 
     */
    public function getLivraison()
    {
        return $this->livraison;
    }

    /**
     * Set facturation
     *
     * @param \Acme\PmeBundle\Entity\Adresseslivraisonsfacturations $facturation
     * @return Commandes
     */
    public function setFacturation(\Acme\PmeBundle\Entity\Adresseslivraisonsfacturations $facturation = null)
    {
        $this->facturation = $facturation;

        return $this;
    }

    /**
     * Get facturation
     *
     * @return \Acme\PmeBundle\Entity\Adresseslivraisonsfacturations 
     */
    public function getFacturation()
    {
        return $this->facturation;
    }

    /**
     * Set referent
     *
     * @param \Acme\PmeBundle\Entity\Referents $referent
     * @return Commandes
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
     * @return Commandes
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
     * @return Commandes
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
    
    public function getListeproduits(){
    	$listeproduits = array();   
        	foreach ($this->lignescommandes as $key => $produit) {
                    $listeproduits[] = array(
                                            'id'=>$key,                      
                                            'ordre'=> $produit->getOrdre(),
                                            'prixht'=> $produit->getPrixht(),
                                            'totalht'=> $produit->getTotalht(),
                                            'quantite'=> $produit->getQuantite(),
                                            'reference'=>  $produit->getReference(),
                                            'remise'=>  $produit->getRemise(),
                                            'description'=>  $produit->getDescription(),
                                            'cat'=>'produit'
                                            );
        	}    	    
    	return $listeproduits;
    } 
    
    public function getArrayCommandes(){
    	$sortie = array('id'=>$this->getId(),
    				'numcommande'=>$this->getNumcommande(),
                                'referenceclient' => $this->getReferenceclient(),
    				'dossier'=>$this->getDossier(),
                                'totalht' => $this->getTotalht(), 
                                'totaltva' => $this->getTotaltva(),   
                                'tauxtva' => $this->getTauxtva(),             
                                'fraisport' => $this->getFraisport(),             
                                'totalttc' => $this->getTotalttc(),             
    				'createdAt' =>  date_format($this->getCreatedAt(), "d-m-Y"),
    				'contact'=>$this->getContact()?$this->getContact()->__toString():null,
                                'referent'=>$this->getReferent()->__toString(),             
    				'listeproduits'=> $this->getListeproduits(),
    				'cat'=>'commande'    				
				);
    	return $sortie;
    }     
}
