<?php

namespace Acme\PmeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Modesreglement
 */
class Modesreglement
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $type;


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
     * Set type
     *
     * @param string $type
     * @return Modesreglement
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }
    
    public function __toString()
    {
        return sprintf('%s',$this->getType());
    }       
}
