<?php

namespace Acme\PmeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Organisations
 */
class Organisations
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
    private $adresse;

    /**
     * @var string
     */
    private $tel;

    /**
     * @var string
     */
    private $fax;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $web;

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
    private $contact;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $devis;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $commande;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $action;

    /**
     * @var \Acme\PmeBundle\Entity\Villes
     */
    private $ville;

    /**
     * @var \Acme\PmeBundle\Entity\Referents
     */
    private $referent;

    /**
     * @var \Acme\PmeBundle\Entity\Statuts
     */
    private $statut;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $organisationsliees;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $organisationliee;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contact = new ArrayCollection();
        $this->devis = new ArrayCollection();
        $this->commande = new ArrayCollection();
        $this->organisationliee = new ArrayCollection();
        $this->organisationsliees = new ArrayCollection();
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
     * Set nom
     *
     * @param string $nom
     * @return Organisations
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
     * Set adresse
     *
     * @param string $adresse
     * @return Organisations
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
     * Set tel
     *
     * @param string $tel
     * @return Organisations
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return Organisations
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Organisations
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set web
     *
     * @param string $web
     * @return Organisations
     */
    public function setWeb($web)
    {
        $this->web = $web;

        return $this;
    }

    /**
     * Get web
     *
     * @return string 
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Organisations
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
     * @return Organisations
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
     * @return Organisations
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
     * Add contact
     *
     * @param \Acme\PmeBundle\Entity\Contacts $contact
     * @return Organisations
     */
    public function addContact(\Acme\PmeBundle\Entity\Contacts $contact)
    {
        $this->contact[] = $contact;

        return $this;
    }

    /**
     * Remove contact
     *
     * @param \Acme\PmeBundle\Entity\Contacts $contact
     */
    public function removeContact(\Acme\PmeBundle\Entity\Contacts $contact)
    {
        $this->contact->removeElement($contact);
    }

    /**
     * Get contact
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Add devis
     *
     * @param \Acme\PmeBundle\Entity\Devis $devis
     * @return Organisations
     */
    public function addDevi(\Acme\PmeBundle\Entity\Devis $devis)
    {
        $this->devis[] = $devis;

        return $this;
    }

    /**
     * Remove devis
     *
     * @param \Acme\PmeBundle\Entity\Devis $devis
     */
    public function removeDevi(\Acme\PmeBundle\Entity\Devis $devis)
    {
        $this->devis->removeElement($devis);
    }

    /**
     * Get devis
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDevis()
    {
        return $this->devis;
    }

    /**
     * Add commande
     *
     * @param \Acme\PmeBundle\Entity\Commandes $commande
     * @return Organisations
     */
    public function addCommande(\Acme\PmeBundle\Entity\Commandes $commande)
    {
        $this->commande[] = $commande;

        return $this;
    }

    /**
     * Remove commande
     *
     * @param \Acme\PmeBundle\Entity\Commandes $commande
     */
    public function removeCommande(\Acme\PmeBundle\Entity\Commandes $commande)
    {
        $this->commande->removeElement($commande);
    }

    /**
     * Get commande
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Add action
     *
     * @param \Acme\PmeBundle\Entity\Actions $action
     * @return Organisations
     */
    public function addAction(\Acme\PmeBundle\Entity\Actions $action)
    {
        $this->action[] = $action;

        return $this;
    }

    /**
     * Remove action
     *
     * @param \Acme\PmeBundle\Entity\Actions $action
     */
    public function removeAction(\Acme\PmeBundle\Entity\Actions $action)
    {
        $this->action->removeElement($action);
    }

    /**
     * Get action
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set ville
     *
     * @param \Acme\PmeBundle\Entity\Villes $ville
     * @return Organisations
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
     * Set referent
     *
     * @param \Acme\PmeBundle\Entity\Referents $referent
     * @return Organisations
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
     * Set statut
     *
     * @param \Acme\PmeBundle\Entity\Statuts $statut
     * @return Organisations
     */
    public function setStatut(\Acme\PmeBundle\Entity\Statuts $statut = null)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return \Acme\PmeBundle\Entity\Statuts 
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Add organisationsliees
     *
     * @param \Acme\PmeBundle\Entity\Organisations $organisationsliees
     * @return Organisations
     */
    public function addOrganisationsliee(\Acme\PmeBundle\Entity\Organisations $organisationsliees)
    {
        $this->organisationsliees[] = $organisationsliees;

        return $this;
    }

    /**
     * Remove organisationsliees
     *
     * @param \Acme\PmeBundle\Entity\Organisations $organisationsliees
     */
    public function removeOrganisationsliee(\Acme\PmeBundle\Entity\Organisations $organisationsliees)
    {
        $this->organisationsliees->removeElement($organisationsliees);
    }

    /**
     * Get organisationsliees
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrganisationsliees()
    {
        return $this->organisationsliees;
    }

    /**
     * Add organisationliee
     *
     * @param \Acme\PmeBundle\Entity\Organisations $organisationliee
     * @return Organisations
     */
    public function addOrganisationliee(\Acme\PmeBundle\Entity\Organisations $organisationliee)
    {
        $this->organisationliee[] = $organisationliee;

        return $this;
    }

    /**
     * Remove organisationliee
     *
     * @param \Acme\PmeBundle\Entity\Organisations $organisationliee
     */
    public function removeOrganisationliee(\Acme\PmeBundle\Entity\Organisations $organisationliee)
    {
        $this->organisationliee->removeElement($organisationliee);
    }

    /**
     * Get organisationliee
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrganisationliee()
    {
        return $this->organisationliee;
    }
    /**
     * @ORM\PostUpdate
     */
    public function doStuffOnPostUpdate()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function doStuffOnPreUpdate()
    {
        $this->updatedAt = new \DateTime();
    }
    
    public function getDetail(){
    	 
      $detail = array("id"=>$this->getId(),
                        "nom"=>$this->getNom(),
                        "adresse"=>$this->getAdresse()." ".$this->getVille(), 
                        "tel"=>$this->getTel(),  
                        "fax"=>$this->getFax(),   
                        "referent"=>$this->getReferent()->__toString(),         
        );
    	return $detail;
    }     
    public function getListecontacts(){
    	 
    	$listecontacts = array();
    	$contacts = $this->getContact();
    	if (count($contacts)>0){
        	foreach ($contacts as $key => $contact) {
        		$listecontacts[] = $contact->getArrayContacts();
        	}    	    
    	}    	

    	return $listecontacts;
    } 
    public function getListedevis(){
    
    	$listedevis = array();
      $sortie = array();
    	$lesdevis = $this->getDevis();
    	if (count($lesdevis)>0){
        	foreach ($lesdevis as $key => $devis) {
        		$listedevis[$devis->getDossier()][] = $devis->getArrayDevis();
        	}    
                foreach ($listedevis as $key => $value) {
                    $sortie[] = array('id'=>$key,"reference"=>$key,'cat'=>'dossier',"children"=>$value);
                }                
    	}
    	return $sortie;        
    }      
    
    public function getListecommandes(){
    
    	$listecommandes = array();
    	$lescommandes = $this->getCommande();
    	if (count($lescommandes)>0){
        	foreach ($lescommandes as $key => $commande) {
        		$listecommandes[] = $commande->getArrayCommandes();
        	}    	    
    	}
    	return $listecommandes;
    }        

    public function getListeactions(){
    
    	$listeactions = array();
    	$lesactions = $this->getAction();
    	if (count($lesactions)>0){
        	foreach ($lesactions as $key => $action) {
        		$listeactions[] = $action->getArrayActions();
        	}    	    
    	}
    	return $listeactions;
    }      
    
    public function __toString()
    {
        return sprintf('%s',$this->getNom());
    }     
    
}
