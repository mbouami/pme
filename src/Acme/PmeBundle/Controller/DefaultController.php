<?php

namespace Acme\PmeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
//    public function indexAction($name)
//    {
//        return $this->render('AcmePmeBundle:Default:index.html.twig', array('name' => $name));
//    }
    public function indexAction()
    {
        return $this->render('AcmePmeBundle:Default:index.html.twig', array());
    }  
    
    public function listeproduitsAction()
    {
        $listeproduits = array();
        $em = $this->getDoctrine()->getManager();        
        $produits = $em->getRepository('AcmePmeBundle:Produits')->findAll();
        foreach ($produits as $key => $produit) {
            $listeproduits[] = array(
                                    'id'=>$produit->getId(),   
                                    'reference'=>$produit->getReference(),                
                                    'libelle'=>$produit->getLibelle(),
                                    'prixht'=>$produit->getPrixht(),                
                                    'cat'=>'produit'
                            );            
        } 
        $response = new JsonResponse();
        $response->setData($listeproduits);
        return $response;        
    }            
         
    public function listetauxtvaAction()
    {
        $em = $this->getDoctrine()->getManager();
        $listetauxtva = array();        
        $tauxtva = $em->getRepository('AcmePmeBundle:Tauxtva')->findAll();
        if (!$tauxtva) {
            throw $this->createNotFoundException('Impossible de trouver des Taux de TVA.');
        }            
        foreach ($tauxtva as $key => $tva) {
            $listetauxtva[] = array('id' => $tva->getId(),'taux' => $tva->getTaux());
        }  
        $response = new JsonResponse();
        $response->setData($listetauxtva);
        return $response;                
    }
    
    public function listeservicesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $listeservices = array();             
        $services = $em->getRepository('AcmePmeBundle:Services')->findAll();
        if (!$services) {
            throw $this->createNotFoundException('Impossible de trouver des services.');
        }            
        foreach ($services as $key => $service) {
            $listeservices[] = array(
                                    'id' => $service->getId(),
                                    'service' => $service->getNom()

            );
        }  
        $response = new JsonResponse();
        $response->setData($listeservices);
        return $response;                  
    }     
    
    public function listestatutsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $listestatuts = array();            
        $statuts = $em->getRepository('AcmePmeBundle:Statuts')->findAll();
        if (!$statuts) {
            throw $this->createNotFoundException('Impossible de trouver des statuts.');
        }            
        foreach ($statuts as $key => $statut) {
            $listestatuts[] = array(
                                    'id' => $statut->getId(),
                                    'statut' => $statut->getNom()

            );
        }   
        $response = new JsonResponse();
        $response->setData($listestatuts);
        return $response;                  
    } 
    
    public function listecentresinteretsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $listecentresinterets = array();            
        $centresinterets = $em->getRepository('AcmePmeBundle:Centresinteret')->findAll();
        if (!$centresinterets) {
            throw $this->createNotFoundException('Impossible de trouver des statuts.');
        }            
        foreach ($centresinterets as $key => $centreinteret) {
            $listecentresinterets[] = array(
                                    'id' => $centreinteret->getId(),
                                    'centreinteret' => $centreinteret->getNom()

            );
        }   
        $response = new JsonResponse();
        $response->setData($listecentresinterets);
        return $response;                  
    }   
    
    public function listevillesAction()
    {
              $request = $this->getRequest();
              $id = $request->get("id");  
              $listevilles = array();
              $em = $this->getDoctrine()->getManager();
              $sortie = array("erreur"=>true,
                              "action" => "liste",
                              "type"=>"villes",              
                              "message"=>"Liste des villes"); 
              if ($id>0) {
                  $villes = $em->getRepository('AcmePmeBundle:Villes')->findBy(array('pays'=>$id),array('nom'=>'ASC'));                                   
              } else {
                  $villes = $em->getRepository('AcmePmeBundle:Villes')->findAll();                         
              }              
              foreach ($villes as $key => $ville) {                   
                      $listevilles[] = array(
                                      'id'=>$ville->getId(),
                                      'name'=>$ville->getNom(), 
                                      'idpays'=>$ville->getPays()->getId(),
                                      'cat'=>'ville'
                      );
              }       
              $sortie["erreur"] = false;         
              $sortie["resultat"] = $listevilles;                          
              $response = new JsonResponse();
              $response->setData($sortie);
              return $response;                
    }        
    
    public function AfficherTauxAction()
    {
        $taux = new Tauxtva();
        $form = $this->createFormBuilder($taux)
            ->add('listetauxtva',null,array(
                                        'mapped' => false,
                                         'attr'=> array(
                                                        'data-dojo-id'=> 'grilletauxtva',                                                
                                                        'data-dojo-type' =>'GrilleTauxtva',
                                                        'data-dojo-props'=> "id:'grilletauxtva',store:StoreTauxTva",
                                                        'onClick' =>"deletetauxtva.set('disabled', false);"
                                                    )) ) 
            ->add('nouveautaux', 'text',array('label'=>'saisir un taux : ',
                                        'mapped' => false,                    
                                        'required'=>false,                    
                                        'attr'=> array(
                                                        'data-dojo-id'=> 'nouveauxtauxtva',                                                 
                                                        'data-dojo-type' =>'dijit/form/TextBox',
                                                        'data-dojo-props' =>"id:'nouveauxtauxtva'",                                                 
//                                                            'placeHolder' => 'saiir un taux',
                                                        'style'=>"width:50px;",
                                                        'onFocus' =>"savetauxtva.setDisabled(false);" 
                                                    )) )                    
            ->add('delete', 'button',array('label'=>'Supprimer',
//                                        'mapped' => false,
                                         'disabled'=>true,                    
                                         'attr'=> array(
                                                        'data-dojo-id'=> 'deletetauxtva',                                                
                                                        'data-dojo-type' =>'dijit/form/Button',
                                                        'data-dojo-props'=> "id:'deletetauxtva'",
//                                                            'onClick' =>"SupprimerTauxTva(grilletauxtva);"
                                                        'onClick' =>"Execute_href('post',grilletauxtva.select.row.getSelected()[0]+'/deletetaux',grilletauxtva);"                                                 
                                                    )) )                 
            ->add('save', 'button',array('label'=>'Sauvegarder',
//                                        'mapped' => false,
                                         'disabled'=>true,
                                         'attr'=> array(
                                                        'data-dojo-id'=> 'savetauxtva',                                                
                                                        'data-dojo-type' =>'dijit/form/Button',
                                                        'data-dojo-props'=> "id:'savetauxtva'",
                                                        'onClick' =>"Execute_href('post',nouveauxtauxtva.value+'/savetaux',grilletauxtva);"                                                 
                                                    )) )                 
//            ->add('save', 'submit',array('label'=>'Sauvegarder'))
            ->getForm();        
        return $this->render('AcmePmeBundle:Parametres:tauxtva.html.twig', array(
            'form' => $form->createView(),
        ));
    }          

    public function savetauxAction($tauxtva)
    {
        $sortie = array("erreur"=>true,
                        "action" => "new",
                        "type"=>"tauxtva",
                        "typezone" => "onglet",            
                        "message"=>"Le taux n'a pas été enregistré");
        $em = $this->getDoctrine()->getManager();
        $taux = new Tauxtva();
        $taux->setTaux($tauxtva);        
        $em->persist($taux);
        $em->flush();                
        $sortie["erreur"] = false;             
        $sortie["message"] = "Le taux a été enregistré";   
        $sortie["resultat"] = array('id' => $taux->getId(),'taux' => $tauxtva);        
        $response = new JsonResponse();
        $response->setData($sortie);
        return $response;
    }        
        
    public function deletetauxAction(Request $request, $id)
    {
        $sortie = array("erreur"=>true,
                        "action" => "delete",
                        "type"=>"tauxtva",
                        "typezone" => "onglet",            
                        "message"=>"Le taux n'a pas été supprimé"); 
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AcmePmeBundle:Tauxtva')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Devis entity.');
        }
        $em->remove($entity);
        $em->flush();
        $sortie["erreur"] = false;
        $sortie["id"] = $id;               
        $sortie["message"] = "Le taux a été supprimé";              
        $response = new JsonResponse();
        $response->setData($sortie);
        return $response;
//        return $this->redirect($this->generateUrl('devis'));
    }   
    
    public function AfficherServicesAction()
    {
        $service = new Services();
        $form = $this->createFormBuilder($service)
            ->add('listeservices',null,array(
                                        'mapped' => false,
                                         'attr'=> array(
                                                        'data-dojo-id'=> 'grilleservices',                                                
                                                        'data-dojo-type' =>'GrilleServices',
                                                        'data-dojo-props'=> "id:'grilleservices',store:StoreServices",
                                                        'onClick' =>"deleteservice.set('disabled', false);"
                                                    )) ) 
            ->add('nouveauservice', 'text',array('label'=>'saisir un serice : ',
                                        'mapped' => false,                    
                                        'required'=>false,                    
                                        'attr'=> array(
                                                        'data-dojo-id'=> 'nouveauservice',                                                 
                                                        'data-dojo-type' =>'dijit/form/TextBox',
                                                        'data-dojo-props' =>"id:'nouveauservice'",                                                 
//                                                            'placeHolder' => 'saiir un taux',
                                                        'style'=>"width:200px;",
                                                        'onFocus' =>"saveservice.setDisabled(false);" 
                                                    )) )                    
            ->add('delete', 'button',array('label'=>'Supprimer',
//                                        'mapped' => false,
                                         'disabled'=>true,                    
                                         'attr'=> array(
                                                        'data-dojo-id'=> 'deleteservice',                                                
                                                        'data-dojo-type' =>'dijit/form/Button',
                                                        'data-dojo-props'=> "id:'deleteservice'",
//                                                            'onClick' =>"SupprimerTauxTva(grilletauxtva);"
                                                        'onClick' =>"Execute_href('post',grilleservices.select.row.getSelected()[0]+'/deleteservice',grilleservices);"                                                 
                                                    )) )                 
            ->add('save', 'button',array('label'=>'Sauvegarder',
//                                        'mapped' => false,
                                         'disabled'=>true,
                                         'attr'=> array(
                                                        'data-dojo-id'=> 'saveservice',                                                
                                                        'data-dojo-type' =>'dijit/form/Button',
                                                        'data-dojo-props'=> "id:'saveservice'",
                                                        'onClick' =>"Execute_href('post',nouveauservice.value+'/saveservice',grilleservices);"                                                 
                                                    )) )                 
//            ->add('save', 'submit',array('label'=>'Sauvegarder'))
            ->getForm();        
        return $this->render('AcmePmeBundle:Parametres:services.html.twig', array( 
            'form' => $form->createView(),
        ));
    } 
 
    public function saveserviceAction($nomservice)
    {
        $sortie = array("erreur"=>true,
                        "action" => "new",
                        "type"=>"service",
                        "typezone" => "onglet",            
                        "message"=>"Le service n'a pas été enregistré");
        $em = $this->getDoctrine()->getManager();
        $service = new Services();
        $service->setNom($nomservice);        
        $em->persist($service);
        $em->flush();                
        $sortie["erreur"] = false;             
        $sortie["message"] = "Le service a été enregistré";   
        $sortie["resultat"] = array('id' => $service->getId(),'service' => $nomservice);        
        $response = new JsonResponse();
        $response->setData($sortie);
        return $response;
    }        
        
    public function deleteserviceAction(Request $request, $id)
    {
        $sortie = array("erreur"=>true,
                        "action" => "delete",
                        "type"=>"service",
                        "typezone" => "onglet",            
                        "message"=>"Le service n'a pas été supprimé"); 
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AcmePmeBundle:Services')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Devis entity.');
        }
        $em->remove($entity);
        $em->flush();
        $sortie["erreur"] = false;
        $sortie["id"] = $id;               
        $sortie["message"] = "Le service a été supprimé";              
        $response = new JsonResponse();
        $response->setData($sortie);
        return $response;
//        return $this->redirect($this->generateUrl('devis'));
    }      
    
    public function AfficherStatutsAction()
    {
        $service = new Services();
        $form = $this->createFormBuilder($service)
            ->add('listestatuts',null,array(
                                        'mapped' => false,
                                         'attr'=> array(
                                                        'data-dojo-id'=> 'grillestatuts',                                                
                                                        'data-dojo-type' =>'GrilleStatuts',
                                                        'data-dojo-props'=> "id:'grillestatuts',store:StoreStatuts",
                                                        'onClick' =>"deletestatut.set('disabled', false);"
                                                    )) ) 
            ->add('nouveaustatut', 'text',array('label'=>'saisir un statut : ',
                                        'mapped' => false,                    
                                        'required'=>false,                    
                                        'attr'=> array(
                                                        'data-dojo-id'=> 'nouveaustatut',                                                 
                                                        'data-dojo-type' =>'dijit/form/TextBox',
                                                        'data-dojo-props' =>"id:'nouveaustatut'",                                                 
//                                                            'placeHolder' => 'saiir un taux',
                                                        'style'=>"width:200px;",
                                                        'onFocus' =>"savestatut.setDisabled(false);" 
                                                    )) )                    
            ->add('delete', 'button',array('label'=>'Supprimer',
//                                        'mapped' => false,
                                         'disabled'=>true,                    
                                         'attr'=> array(
                                                        'data-dojo-id'=> 'deletestatut',                                                
                                                        'data-dojo-type' =>'dijit/form/Button',
                                                        'data-dojo-props'=> "id:'deletestatut'",
//                                                            'onClick' =>"SupprimerTauxTva(grilletauxtva);"
                                                        'onClick' =>"Execute_href('post',grillestatuts.select.row.getSelected()[0]+'/deletestatut',grillestatuts);"                                                 
                                                    )) )                 
            ->add('save', 'button',array('label'=>'Sauvegarder',
//                                        'mapped' => false,
                                         'disabled'=>true,
                                         'attr'=> array(
                                                        'data-dojo-id'=> 'savestatut',                                                
                                                        'data-dojo-type' =>'dijit/form/Button',
                                                        'data-dojo-props'=> "id:'saveservice'",
                                                        'onClick' =>"Execute_href('post',nouveaustatut.value+'/savestatut',grillestatuts);"                                                 
                                                    )) )                 
            ->getForm();        
        return $this->render('AcmePmeBundle:Parametres:statuts.html.twig', array( 
            'form' => $form->createView(),
        ));
    } 
 
    public function savestatutAction($nomstatut)
    {
        $sortie = array("erreur"=>true,
                        "action" => "new",
                        "type"=>"service",
                        "typezone" => "onglet",            
                        "message"=>"Le service n'a pas été enregistré");
        $em = $this->getDoctrine()->getManager();
        $statut = new Statuts();
        $statut->setNom($nomstatut);        
        $em->persist($statut);
        $em->flush();                
        $sortie["erreur"] = false;             
        $sortie["message"] = "Le service a été enregistré";   
        $sortie["resultat"] = array('id' => $statut->getId(),'statut' => $nomstatut);        
        $response = new JsonResponse();
        $response->setData($sortie);
        return $response;
    }        
        
    public function deletestatutAction(Request $request, $id)
    {
        $sortie = array("erreur"=>true,
                        "action" => "delete",
                        "type"=>"service",
                        "typezone" => "onglet",            
                        "message"=>"Le service n'a pas été supprimé"); 
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AcmePmeBundle:Statuts')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Devis entity.');
        }
        $em->remove($entity);
        $em->flush();
        $sortie["erreur"] = false;
        $sortie["id"] = $id;               
        $sortie["message"] = "Le service a été supprimé";              
        $response = new JsonResponse();
        $response->setData($sortie);
        return $response;
//        return $this->redirect($this->generateUrl('devis'));
    }  
    
    public function AfficherCentresInteretsAction()
    {
        $centreinteret = new Centresinteret();
        $form = $this->createFormBuilder($centreinteret)
            ->add('listecentresinterets',null,array(
                                        'mapped' => false,
                                         'attr'=> array(
                                                        'data-dojo-id'=> 'grillecentresinterets',                                                
                                                        'data-dojo-type' =>'GrilleCentresInterets',
                                                        'data-dojo-props'=> "id:'grillecentresinterets',store:StoreCentresInterets",
                                                        'onClick' =>"deletecentreinteret.set('disabled', false);"
                                                    )) ) 
            ->add('nouveaucentreinteret', 'text',array('label'=>'saisir un centre d\'intérêt : ',
                                        'mapped' => false,                    
                                        'required'=>false,                    
                                        'attr'=> array(
                                                        'data-dojo-id'=> 'nouveaucentreinteret',                                                 
                                                        'data-dojo-type' =>'dijit/form/TextBox',
                                                        'data-dojo-props' =>"id:'nouveaucentreinteret'",                                                 
//                                                            'placeHolder' => 'saiir un taux',
                                                        'style'=>"width:200px;",
                                                        'onFocus' =>"savecentreinteret.setDisabled(false);" 
                                                    )) )                    
            ->add('delete', 'button',array('label'=>'Supprimer',
//                                        'mapped' => false,
                                         'disabled'=>true,                    
                                         'attr'=> array(
                                                        'data-dojo-id'=> 'deletecentreinteret',                                                
                                                        'data-dojo-type' =>'dijit/form/Button',
                                                        'data-dojo-props'=> "id:'deletecentreinteret'",
//                                                            'onClick' =>"SupprimerTauxTva(grilletauxtva);"
                                                        'onClick' =>"Execute_href('post',grillecentresinterets.select.row.getSelected()[0]+'/deletecentreinteret',grillecentresinterets);"                                                 
                                                    )) )                 
            ->add('save', 'button',array('label'=>'Sauvegarder',
//                                        'mapped' => false,
                                         'disabled'=>true,
                                         'attr'=> array(
                                                        'data-dojo-id'=> 'savecentreinteret',                                                
                                                        'data-dojo-type' =>'dijit/form/Button',
                                                        'data-dojo-props'=> "id:'savecentreinteret'",
                                                        'onClick' =>"Execute_href('post',nouveaucentreinteret.value+'/savecentreinteret',grillecentresinterets);"                                                 
                                                    )) )                 
            ->getForm();        
        return $this->render('AcmePmeBundle:Parametres:centresinterets.html.twig', array( 
            'form' => $form->createView(),
        ));
    } 
 
    public function savecentreinteretAction($nomcentreinteret)
    {
        $sortie = array("erreur"=>true,
                        "action" => "new",
                        "type"=>"service",
                        "typezone" => "onglet",            
                        "message"=>"Le centre d'intérêt n'a pas été enregistré");
        $em = $this->getDoctrine()->getManager();
        $centreinteret = new Centresinteret();
        $centreinteret->setNom($nomcentreinteret);        
        $em->persist($centreinteret);
        $em->flush();                
        $sortie["erreur"] = false;             
        $sortie["message"] = "Le centre d'intérêt a été enregistré";   
        $sortie["resultat"] = array('id' => $centreinteret->getId(),'centreinteret' => $nomcentreinteret);        
        $response = new JsonResponse();
        $response->setData($sortie);
        return $response;
    }        
        
    public function deletecentreinteretAction(Request $request, $id)
    {
        $sortie = array("erreur"=>true,
                        "action" => "delete",
                        "type"=>"service",
                        "typezone" => "onglet",            
                        "message"=>"Le centre d'intérêt n'a pas été supprimé"); 
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AcmePmeBundle:Centresinteret')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Devis entity.');
        }
        $em->remove($entity);
        $em->flush();
        $sortie["erreur"] = false;
        $sortie["id"] = $id;               
        $sortie["message"] = "Le centre d'intérêt a été supprimé";              
        $response = new JsonResponse();
        $response->setData($sortie);
        return $response;
    }        
    
    public function listemodelesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $listemodeles = array();           
        $modeles= $em->getRepository('AcmePmeBundle:Modelescourriers')->findAll();
        if (!$modeles) {
            throw $this->createNotFoundException('Impossible de trouver des modèles.');
        }            
        foreach ($modeles as $key => $modele) {
            $listemodeles[] = array('id' => $modele->getId(),'sujet' => $modele->getSujet() ,'modele' => $modele->getLibelle());
        }   
        $response = new JsonResponse();
        $response->setData($listemodeles);
        return $response;
    }    
    
    
    public function AfficherModelesAction()
    {
        $modele = new Modelescourriers();
        $form = $this->createFormBuilder($modele)
            ->add('modelecourrier',null,array(
                                        'mapped' => false,
                                         'attr'=> array(
                                                        'data-dojo-id'=> 'grillemodeles',                                                
                                                        'data-dojo-type' =>'GrilleModeles',
                                                        'data-dojo-props'=> "id:'grillemodeles',store:StoreModeles",
                                                        'onClick' =>"deletemodele.set('disabled', false);"
                                                    )) )         
            ->add('sujetmodele', 'text',array('label'=>'sujet du modèle : ',
                                        'mapped' => false,                    
                                        'required'=>false,                    
                                        'attr'=> array(
                                                        'data-dojo-id'=> 'sujetmodele',                                                 
                                                        'data-dojo-type' =>'dijit/form/TextBox',
                                                        'data-dojo-props' =>"id:'sujetmodele'",                                                 
                                                        'placeHolder' => 'sujet du modèle',
                                                        'style'=>"width:300px;",
                                                        'onFocus' =>"updatemodele.setDisabled(false);" 
                                                    )) )                 
            ->add('descriptionmodele', 'textarea',array('label'=>'Description du modèle : ',
                                        'mapped'=>false,
                                        'attr'=> array(
                                                        'data-dojo-id'=> 'modele_description',                                               
                                                        'data-dojo-type' =>'dijit/Editor',                                              
                                                        'data-dojo-props' =>"id:'modele_description',extraPlugins:['foreColor','hiliteColor',{name:'dijit/_editor/plugins/FontChoice', command:'fontName', generic:true}]",
                                                        'placeHolder' => 'description du modèle',
                                                        'style'=>"width:300px;",
                                                        'onFocus' => "updatemodele.setDisabled(false);"                                            
                                                    )) )
            ->add('nouveaumodele', 'text',array('label'=>'saisir un nouveau modèle : ',
                                        'mapped' => false,                    
                                        'required'=>false,                    
                                        'attr'=> array(
                                                        'data-dojo-id'=> 'nouveaumodele',                                                 
                                                        'data-dojo-type' =>'dijit/form/TextBox',
                                                        'data-dojo-props' =>"id:'nouveaumodele'",                                                 
//                                                            'placeHolder' => 'saiir un taux',
                                                        'style'=>"width:200px;",
                                                        'onFocus' =>"savemodele.setDisabled(false);" 
                                                    )) )                    
            ->add('update', 'button',array('label'=>'Mettre à jour le modèle',
//                                        'mapped' => false,
                                         'disabled'=>true,                    
                                         'attr'=> array(
                                                        'data-dojo-id'=> 'updatemodele',                                                
                                                        'data-dojo-type' =>'dijit/form/Button',
                                                        'data-dojo-props'=> "id:'updatemodele'",
                                                        'onClick' => 'grillemodeles.Updatemodele();'
//                                                            'onClick' =>"SupprimerTauxTva(grilletauxtva);"
//                                                        'onClick' =>"Execute_href('post',grilletauxtva.select.row.getSelected()[0]+'/deletetaux',grilletauxtva);"                                                 
                                                    )) )  
            ->add('delete', 'button',array('label'=>'Supprimer',
//                                        'mapped' => false,
                                         'disabled'=>true,                    
                                         'attr'=> array(
                                                        'data-dojo-id'=> 'deletemodele',                                                
                                                        'data-dojo-type' =>'dijit/form/Button',
                                                        'data-dojo-props'=> "id:'deletemodele'",
//                                                            'onClick' =>"SupprimerTauxTva(grilletauxtva);"
                                                        'onClick' =>"Execute_href('post',grillemodeles.select.row.getSelected()[0]+'/deletemodele',grillemodeles);"                                                 
                                                    )) )                 
            ->add('save', 'button',array('label'=>'Sauvegarder',
//                                        'mapped' => false,
                                         'disabled'=>true,
                                         'attr'=> array(
                                                        'data-dojo-id'=> 'savemodele',                                                
                                                        'data-dojo-type' =>'dijit/form/Button',
                                                        'data-dojo-props'=> "id:'savemodele'",
                                                        'onClick' =>"Execute_href('post',nouveaumodele.value+'/savemodele',grillemodeles);"                                                 
                                                    )) )                 
//            ->add('save', 'submit',array('label'=>'Sauvegarder'))
            ->getForm();        
        return $this->render('AcmePmeBundle:Modelescourriers:descriptionmodeles.html.twig', array(
            'form' => $form->createView(),
        ));
    }          

    public function savemodeleAction($nommodele)
    {
        $sortie = array("erreur"=>true,
                        "action" => "new",
                        "type"=>"modele",
                        "typezone" => "onglet",            
                        "message"=>"Le modèle n'a pas été enregistré");
        $em = $this->getDoctrine()->getManager();
        $modele = new Modelescourriers();
        $modele->setLibelle($nommodele);
        $modele->setSujet(' ');
        $modele->setDescription(null);
        $em->persist($modele);
        $em->flush();                
        $sortie["erreur"] = false;             
        $sortie["message"] = "Le modèle a été enregistré";   
        $sortie["resultat"] = array('id' => $modele->getId(),'modele' => $nommodele);        
        $response = new JsonResponse();
        $response->setData($sortie);
        return $response;
    }   
    
    public function updatemodeleAction($id,$sujet,$description)
    {
        $sortie = array("erreur"=>true,
                        "action" => "new",
                        "type"=>"modele",
                        "typezone" => "onglet",            
                        "message"=>"Le modèle n'a pas été enregistré");
        $em = $this->getDoctrine()->getManager();
        $modele = $em->getRepository('AcmePmeBundle:Modelescourriers')->find($id);    
        if (!$modele) {
            throw $this->createNotFoundException('Impossible de trouver le modèle.');
        }        
//        $modele->setSujet($sujet);
//        $modele->setDescription($description);
//        $em->persist($modele);
//        $em->flush();                
        $sortie["erreur"] = false;             
        $sortie["message"] = "Le modèle a été enregistré";   
//        $sortie["resultat"] = array('id' => $id,'modele' => $modele->getLibelle());   
        $sortie["resultat"] = array('id' => $id,'modele' => $description);          
        $response = new JsonResponse();
        $response->setData($sortie);
        return $response;
    }     
    public function deletemodeleAction(Request $request, $id)
    {
        $sortie = array("erreur"=>true,
                        "action" => "delete",
                        "type"=>"modele",
                        "typezone" => "onglet",            
                        "message"=>"Le modèle n'a pas été supprimé"); 
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AcmePmeBundle:Modelescourriers')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Devis entity.');
        }
        $em->remove($entity);
        $em->flush();
        $sortie["erreur"] = false;
        $sortie["id"] = $id;               
        $sortie["message"] = "Le modèle a été supprimé";              
        $response = new JsonResponse();
        $response->setData($sortie);
        return $response;
    }
    
    public function detailmodeleAction()
    {
        $request = $this->getRequest();
        $id = $request->get("id");  
        $detailmodele = array();
        $em = $this->getDoctrine()->getManager();
        $sortie = array("erreur"=>true,
                        "action" => "detail",
                        "type"=>"modelecourrier",              
                        "message"=>"Détail du modèle"); 
        if ($id!=null) {
            $modele = $em->getRepository('AcmePmeBundle:Modelescourriers')->find($id); 
            $detailmodele = array('libelle'=>$modele->getLibelle(),
                                  'sujet'=>$modele->getSujet(),                   
                                  'description'=>$modele->getDescription());
            $sortie["erreur"] = false;         
            $sortie["resultat"] = $detailmodele;                  
        } 
        $response = new JsonResponse();
        $response->setData($sortie);
        return $response;             
    }     
}
