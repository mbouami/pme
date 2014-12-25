<?php

namespace Acme\PmeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tauxtva
 */
class Tauxtva
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $taux;


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
     * Set taux
     *
     * @param string $taux
     * @return Tauxtva
     */
    public function setTaux($taux)
    {
        $this->taux = $taux;

        return $this;
    }

    /**
     * Get taux
     *
     * @return string 
     */
    public function getTaux()
    {
        return $this->taux;
    }
    
    public function __toString()
    {
        return sprintf('%s',$this->getTaux());
    }      
}
