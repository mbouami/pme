<?php

namespace Acme\PmeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Referents
 */
/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Referents implements AdvancedUserInterface, \Serializable
{
    private $temp;    
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;
        
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file1; 
    
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
    private $username;

    /**
     * @var string
     */
    private $salt;

    /**
     * @var string
     */
    private $password;

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
    private $mobile;

    /**
     * @var string
     */
    private $signature;

    /**
     * @var string
     */
    private $signatureweb;

    /**
     * @var boolean
     */
    private $isActive;

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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $groupes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->groupes = new ArrayCollection();
        $this->isActive = true;
        $this->salt = md5(uniqid(null, true));
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
     * @return Referents
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
     * @return Referents
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
     * Set username
     *
     * @param string $username
     * @return Referents
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Referents
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Referents
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Referents
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
     * @return Referents
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
     * Set mobile
     *
     * @param string $mobile
     * @return Referents
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
     * Set signature
     *
     * @param string $signature
     * @return Referents
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * Get signature
     *
     * @return string 
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Set signatureweb
     *
     * @param string $signatureweb
     * @return Referents
     */
    public function setSignatureweb($signatureweb)
    {
        $this->signatureweb = $signatureweb;

        return $this;
    }

    /**
     * Get signatureweb
     *
     * @return string 
     */
    public function getSignatureweb()
    {
        return $this->signatureweb;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Referents
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Referents
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
     * @return Referents
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
     * @return Referents
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
     * @return Referents
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
     * Add groupes
     *
     * @param \Acme\PmeBundle\Entity\Groupes $groupes
     * @return Referents
     */
    public function addGroupe(\Acme\PmeBundle\Entity\Groupes $groupes)
    {
        $this->groupes[] = $groupes;

        return $this;
    }

    /**
     * Remove groupes
     *
     * @param \Acme\PmeBundle\Entity\Groupes $groupes
     */
    public function removeGroupe(\Acme\PmeBundle\Entity\Groupes $groupes)
    {
        $this->groupes->removeElement($groupes);
    }

    /**
     * Get groupes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroupes()
    {
        return $this->groupes;
    }
    /**
     * @ORM\PostUpdate
     */
    public function doStuffOnPostUpdate()
    {
        $this->updatedAt = new \DateTime(); 
    }

    /**
     * @ORM\PostLoad
     */
    public function doStuffOnPostLoad()
    {
        $this->connectedAt = new \DateTime(); 
    }
    
    public function __toString()
    {
        return sprintf('%s %s %s',$this->getCivilite(), $this->getNom(),$this->getPrenom());
    }

    public function serialize() {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,            
        ));           
    }

    public function unserialize($serialized) {
        list (
            $this->id,
            $this->username,
            $this->password,                
        ) = unserialize($serialized);         
    }

    public function eraseCredentials() {
        
    }

    public function getRoles() {
        return $this->groupes->toArray();        
    }

    public function isAccountNonExpired() {
        return true;        
    }

    public function isAccountNonLocked() {
        return true;        
    }

    public function isCredentialsNonExpired() {
        return true;        
    }

    public function isEnabled() {
        return $this->isActive;        
    }

    public function getRefDevis() {
        $date = new \DateTime();
        $refdate = date_format($date, 'dm');
        $refdevis =  substr($this->nom, 0, 1).substr($this->prenom, 0, 1).$refdate; 
        return $refdevis;
    }    
    
    
    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'uploads/documents';
    }   
    
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }        
    }
    

    public function getFile()
    {
        return $this->file;
    } 
    
    public function setFile1(UploadedFile $file = null)
    {
        $this->file1 = $file;
        // check if we have an old image path
        if (isset($this->path1)) {
            // store the old name to delete after the update
            $this->temp = $this->path1;
            $this->path1 = null;
        } else {
            $this->path1 = 'initial';
        }        
    }
    

    public function getFile1()
    {
        return $this->file1;
    } 
    
    public function image_to_base64($path_to_image)
    { 
        $type = pathinfo($path_to_image, PATHINFO_EXTENSION);
        $image = file_get_contents($path_to_image);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($image); 
        return $base64;
    }    

    /**
     * @ORM\PreUpdate
     */
    public function doStuffOnPreUpdate()
    {
        $this->updatedAt = new \DateTime();
        if (null === $this->getFile() && null === $this->getFile1() ) {
            return;
        }

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the
        // target filename to move to
        $filename = sha1(uniqid(mt_rand(), true));
        $this->path = $filename.'.'.$this->getFile()->guessExtension();
//        $this->getFile()->move(
//            $this->getUploadRootDir(),
//            $this->getFile()->getClientOriginalName()
//        );
        $filename1 = sha1(uniqid(mt_rand(), true));
        $this->getFile()->move($this->getUploadRootDir(),$this->path);        
        $this->path1 = $filename1.'.'.$this->getFile1()->guessExtension();
        $this->getFile1()->move($this->getUploadRootDir(),$this->path1);          
        $this->setSignature($this->image_to_base64($this->getUploadRootDir()."/".$this->path));
        $this->setSignatureweb($this->image_to_base64($this->getUploadRootDir()."/".$this->path1));
//        if ($file = $this->getAbsolutePath()) {
            unlink($this->getUploadRootDir()."/".$this->path);
//        }
//        if ($file = $this->getAbsolutePath()) {
            unlink($this->getUploadRootDir()."/".$this->path1);
//        }        
        $this->file = null;
        $this->file1 = null;  
    }
}

