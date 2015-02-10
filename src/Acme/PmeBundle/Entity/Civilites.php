<?php

namespace Acme\PmeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Civilites
 */
class Civilites
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $libellecourt;

    /**
     * @var string
     */
    private $libellelong;

    /**
     * @var string
     */
    private $libellepolitesse;


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
     * Set libellecourt
     *
     * @param string $libellecourt
     * @return Civilites
     */
    public function setLibellecourt($libellecourt)
    {
        $this->libellecourt = $libellecourt;

        return $this;
    }

    /**
     * Get libellecourt
     *
     * @return string 
     */
    public function getLibellecourt()
    {
        return $this->libellecourt;
    }

    /**
     * Set libellelong
     *
     * @param string $libellelong
     * @return Civilites
     */
    public function setLibellelong($libellelong)
    {
        $this->libellelong = $libellelong;

        return $this;
    }

    /**
     * Get libellelong
     *
     * @return string 
     */
    public function getLibellelong()
    {
        return $this->libellelong;
    }

    /**
     * Set libellepolitesse
     *
     * @param string $libellepolitesse
     * @return Civilites
     */
    public function setLibellepolitesse($libellepolitesse)
    {
        $this->libellepolitesse = $libellepolitesse;

        return $this;
    }

    /**
     * Get libellepolitesse
     *
     * @return string 
     */
    public function getLibellepolitesse()
    {
        return $this->libellepolitesse;
    }
    
    public function __toString()
    {
        return sprintf('%s',$this->getLibellecourt());
    }       
}
