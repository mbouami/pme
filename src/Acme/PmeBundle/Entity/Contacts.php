<?php

namespace Acme\PmeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Contacts
 */
class Contacts
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
    private $prenom;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $fixe;

    /**
     * @var string
     */
    private $fax;

    /**
     * @var string
     */
    private $mobile;

    /**
     * @var string
     */
    private $adresse;

    /**
     * @var string
     */
    private $observation;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \DateTime
     */
    private $connectedAt;

    /**
     * @var \Acme\PmeBundle\Entity\Civilites
     */
    private $civilite;

    /**
     * @var \Acme\PmeBundle\Entity\Villes
     */
    private $ville;

    /**
     * @var \Acme\PmeBundle\Entity\Referents
     */
    private $saisipar;

    /**
     * @var \Acme\PmeBundle\Entity\Organisations
     */
    private $organisation;

    /**
     * @var \Acme\PmeBundle\Entity\Services
     */
    private $service;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $centresinteret;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->centresinteret = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();       
        $this->connectedAt = new \DateTime();         
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
     * @return Contacts
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
     * Set prenom
     *
     * @param string $prenom
     * @return Contacts
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Contacts
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
     * Set fixe
     *
     * @param string $fixe
     * @return Contacts
     */
    public function setFixe($fixe)
    {
        $this->fixe = $fixe;

        return $this;
    }

    /**
     * Get fixe
     *
     * @return string 
     */
    public function getFixe()
    {
        return $this->fixe;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return Contacts
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
     * Set mobile
     *
     * @param string $mobile
     * @return Contacts
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Contacts
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
     * Set observation
     *
     * @param string $observation
     * @return Contacts
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Contacts
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
     * @return Contacts
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
     * Set connectedAt
     *
     * @param \DateTime $connectedAt
     * @return Contacts
     */
    public function setConnectedAt($connectedAt)
    {
        $this->connectedAt = $connectedAt;

        return $this;
    }

    /**
     * Get connectedAt
     *
     * @return \DateTime 
     */
    public function getConnectedAt()
    {
        return $this->connectedAt;
    }

    /**
     * Set civilite
     *
     * @param \Acme\PmeBundle\Entity\Civilites $civilite
     * @return Contacts
     */
    public function setCivilite(\Acme\PmeBundle\Entity\Civilites $civilite = null)
    {
        $this->civilite = $civilite;

        return $this;
    }

    /**
     * Get civilite
     *
     * @return \Acme\PmeBundle\Entity\Civilites 
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * Set ville
     *
     * @param \Acme\PmeBundle\Entity\Villes $ville
     * @return Contacts
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
     * Set saisipar
     *
     * @param \Acme\PmeBundle\Entity\Referents $saisipar
     * @return Contacts
     */
    public function setSaisipar(\Acme\PmeBundle\Entity\Referents $saisipar = null)
    {
        $this->saisipar = $saisipar;

        return $this;
    }

    /**
     * Get saisipar
     *
     * @return \Acme\PmeBundle\Entity\Referents 
     */
    public function getSaisipar()
    {
        return $this->saisipar;
    }

    /**
     * Set organisation
     *
     * @param \Acme\PmeBundle\Entity\Organisations $organisation
     * @return Contacts
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
     * Set service
     *
     * @param \Acme\PmeBundle\Entity\Services $service
     * @return Contacts
     */
    public function setService(\Acme\PmeBundle\Entity\Services $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \Acme\PmeBundle\Entity\Services 
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Add centresinteret
     *
     * @param \Acme\PmeBundle\Entity\Centresinteret $centresinteret
     * @return Contacts
     */
    public function addCentresinteret(\Acme\PmeBundle\Entity\Centresinteret $centresinteret)
    {
        $this->centresinteret[] = $centresinteret;

        return $this;
    }

    /**
     * Remove centresinteret
     *
     * @param \Acme\PmeBundle\Entity\Centresinteret $centresinteret
     */
    public function removeCentresinteret(\Acme\PmeBundle\Entity\Centresinteret $centresinteret)
    {
        $this->centresinteret->removeElement($centresinteret);
    }

    /**
     * Get centresinteret
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCentresinteret()
    {
        return $this->centresinteret;
    }
    
    public function getArrayContacts(){
        $sortie = array('id'=>$this->id,
                        'nom'=>$this->__toString(),
                        'name'=>$this->__toString(),            
                        'tel'=>$this->getFixe(),
                        'mobile'=>$this->getMobile(),
                        'email'=>$this->getEmail(),
                        'centresinteret'=>$this->getListecentresinteret());
        return $sortie;
    }
    
    public function getListecentresinteret(){
    	$listecentresinteret = array();
        if (count($this->getCentresinteret())>0) {
            $centresinterets = $this->getCentresinteret()->getValues();
            foreach ($centresinterets as $key => $centreinteret) {
                    $listecentresinteret[] = $centreinteret->getNom();
            }              
        }
 
    	return $listecentresinteret;
    } 
    
    public function getEmailDestinataire(){
        return sprintf('%s %s %s<%s>',$this->getCivilite(), $this->getNom(),$this->getPrenom(),  $this->getEmail());
        
    }
    public function __toString()
    {
        return sprintf('%s %s %s',$this->getCivilite(), $this->getNom(),$this->getPrenom());
    }      
}
