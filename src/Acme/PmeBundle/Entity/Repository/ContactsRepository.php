<?php

namespace Acme\PmeBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ContactsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ContactsRepository extends EntityRepository
{
    public function ListeContacts()
    {    
        $query = $this
            ->createQueryBuilder('u')           
            ->orderBy('u.nom', 'ASC');
        try {
            return $query;
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }         
    } 
       
    public function ListeContactsParOrganisation($idorg)
    {    
        $contacts = array();
        $query = $this
            ->createQueryBuilder('u')           
            ->where('u.organisation=:idorg')
            ->setParameter('idorg', $idorg)
            ->orderBy('u.nom', 'ASC');
        try {
            return $query;
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }         
    }      
}
