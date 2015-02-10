<?php

namespace Acme\PmeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{   
    public function indexAction()
    {
        return $this->render('AcmePmeBundle:Default:index.html.twig', array());
    }     
          
    
     
           
}
