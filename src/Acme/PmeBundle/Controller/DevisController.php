<?php

namespace Acme\PmeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\PmeBundle\Entity\Devis;
use Acme\PmeBundle\Form\DevisType;
use Acme\PmeBundle\Entity\Lignesdevis;
use AppBundle\Entity\Document;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Devis controller.
 *
 * @Route("/devis")
 */
class DevisController extends Controller
{
    /**
     * Liste des Devis en cours en json
     *
     * @Route("/listedevisencours", name="pme_liste_devis_en_cours")
     * @Method("GET")
     * @Template()
     */    
    public function listedevisencoursAction()
    {  
        $listedevis = array();
        $request = $this->getRequest();
        $id = $request->get("id");          
        $sortie = array("erreur"=>false,
                        "action" => "afficher",
                        "type"=>"devis",
                        "typezone" => "onglet",                
                        "message"=>"Liste des devis en cours");   
        $em = $this->getDoctrine()->getManager();        
        $listedevis = $em->getRepository('AcmePmeBundle:Devis')->ListeDerniersDevis($id); 
        $sortie["resultat"] = $listedevis;
        $response = new JsonResponse();
        $response->setData($sortie);
        return $response;        
    }     
    
    /**
     * Détail du Devis en json
     *
     * @Route("/detaildevis", name="pme_detail_devis")
     * @Method("GET")
     * @Template()
     */     
    public function detaildevisAction()
    {
        $request = $this->getRequest();
        $id = $request->get("id");  
        $detaildevis = array();
        $em = $this->getDoctrine()->getManager();
        $sortie = array("erreur"=>true,
                        "action" => "detail",
                        "type"=>"devis",              
                        "message"=>"Détail du devis"); 
        if ($id!=null) {
            $devis = $em->getRepository('AcmePmeBundle:Devis')->find($id); 
            $detaildevis = array(
                                    'id'=>$devis->getId(),
                                    'reference'=>$devis->getReference(),
                                    'dossier'=>$devis->getDossier(),
                                    'createdAt' =>  date_format($devis->getCreatedAt(), "d-m-Y"),
                                    'organisation' => $devis->getOrganisation()->__toString(),    
                                    'adresseorganisation' => $devis->getOrganisation()->getAdresse()." ".$devis->getOrganisation()->getVille(),                
                                    'contact'=>$devis->getContact()?$devis->getContact()->__toString():null,
                                    'referent'=>$devis->getReferent()->__toString(),  
                                    'signatureweb'=>$devis->getReferent()->getSignatureWeb()?utf8_encode(stream_get_contents($devis->getReferent()->getSignatureWeb())):null,
                                    'iddevisparent' => $devis->getParent()!=null?$devis->getParent()->getId():null, 
                                    'devisparent'=> $devis->getParent()==null?null:$devis->getParent()->getReference()                            
                                );
            $sortie["erreur"] = false;         
            $sortie["resultat"] = $detaildevis;                  
        } 
        $response = new JsonResponse();
        $response->setData($sortie);
        return $response;             
    }    
    
    /**
     * Liste des Devis en cours en json
     *
     * @Route("/imprimerdevis", name="pme_imprimer_devis_en_cours")
     * @Method("POST")
     * @Template()
     */    
    public function imprimerdevisAction()
    {    
        $document = new Document();
        $request = $this->getRequest();
        $id = $request->get("iddevis");         
        $em = $this->getDoctrine()->getManager();
        $devis = $em->getRepository('AcmePmeBundle:Devis')->find($id);   
        if (!$devis) {
            throw $this->createNotFoundException('Impossible de trouver le devis recherché.');
        }    
        $parametrepaiement = $em->getRepository('AcmePmeBundle:Parametres')->findOneBy(array('nom'=>'paiement'));
        $nomfichier = "Devis_".$devis->getReference().'.pdf';
        $outputfile = $document->getUploadRootDir().'/'.$nomfichier;        
        if (file_exists($outputfile)) unlink ($outputfile);        
        $html = $this->renderView('AcmePmeBundle:Devis:imprimer.html.twig', array(
                            'entity'      => $devis,
                            'devisparent'=> $devis->getParent()==null?null:$devis->getParent()->getReference(),           
                            'signature'=>$devis->getReferent()->getSignature()?utf8_encode(stream_get_contents($devis->getReferent()->getSignature())):null,          
                            'paiement'    => $parametrepaiement,
        ));        
        $this->get('knp_snappy.pdf')->generateFromHtml($html, $outputfile);        
        $sortie["message"] = $nomfichier;  
        $sortie["url"] = $this->generateUrl('homepage').'../uploads/documents/'.$nomfichier;         
        return new JsonResponse(
            $sortie,
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="'.$nomfichier.'"'
            )
        );
    }
    
    /**
     * Lists all Devis entities.
     *
     * @Route("/", name="devis")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmePmeBundle:Devis')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Devis entity.
     *
     * @Route("/", name="devis_create")
     * @Method("POST")
     * @Template("AcmePmeBundle:Devis:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Devis();
        $niveau = $request->get("niveau");  
        $sortie = array("erreur"=>true,
                        "action" => "new",
                        "type"=>"devis",
                        "typezone" => "onglet",                
                        "message"=>"Le Devis n'a pas été enregistré");   
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());       
        $serializer = new Serializer($normalizers, $encoders);         
        $form = $this->createCreateForm($entity,$niveau);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $entity->setReference($entity->getId().$entity->getReferent()->getRefDevis());               
            $em->flush();  
            $lignesdevis = $request->get("lignesdevis"); 
            if($lignesdevis) {
                foreach (json_decode($lignesdevis) as $lignedevis) {
                    $Lignedevis = new Lignesdevis();                  
                    $Lignedevis = $serializer->deserialize(json_encode($lignedevis),'Acme\PmeBundle\Entity\Lignesdevis','json');                 
                    $Lignedevis->setDevis($entity);
                    $em->persist($Lignedevis);
                    $em->flush();
                }    
                $sortie["erreur"] = false;
                $sortie["message"] = "Les Lignes du Devis ont été enregistrées avec succès";  
                $sortie["idorg"] = $entity->getOrganisation()->getId();   
                $sortie["iddevis"] = $entity->getId();             
                $sortie["idonglet"] = "new_devis_".$niveau; 
                $sortie["resultat"] = array(
                                'id'=>$entity->getId(),
                                'reference'=>$entity->getReference(),
                                'dossier'=>$entity->getDossier(),
                                'datedevis' =>  date_format($entity->getCreatedAt(), "d-m-Y"),       
                                'organisation' => $entity->getOrganisation()->__toString(),            
                                'contact'=>$entity->getContact()?$entity->getContact()->__toString():null,
                                'referent'=>$entity->getReferent()->__toString(),  
                                'totalht' => $entity->getTotalht(), 
                                'totaltva' => $entity->getTotaltva(),
                                'tauxtva' => $entity->getTauxtva(),             
                                'fraisport' => $entity->getFraisport(),             
                                'totalttc' => $entity->getTotalttc(), 
                                'iddevisparent' => $entity->getParent()!=null?$entity->getParent()->getId():null, 
                                'devisparent'=> $entity->getParent()==null?null:$entity->getParent()->getReference(),            
                                'listeproduits'=> json_decode($lignesdevis),
                                'cat'=>'devis'    				
                                );                
//                $sortie["devis"] = array('identifier'=> 'id','items'=>array('id'=>$entity->getDossier(),"reference"=>$entity->getDossier(),'cat'=>'dossier',"children"=>$entity->getArrayDevis()));
            }             
        }
        $response = new JsonResponse();
        $response->setData($sortie);
        return $response;
    }

    /**
     * Creates a form to create a Devis entity.
     *
     * @param Devis $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Devis $entity,$niveau,$idorg=0)
    {
        $form = $this->createForm(new DevisType($niveau,$idorg,json_encode($entity->getListeproduits())), $entity, array(
            'action' => $this->generateUrl('devis_create',array('niveau'=>$niveau)),            
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Enregistrer'));

        return $form;
    }

    /**
     * Displays a form to create a new Devis entity.
     *
     * @Route("/new", name="devis_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Devis();
        $request = $this->getRequest();        
        $niveau = $request->get("niveau");  
        $idorg = $request->get("idorg");    
        $iddevis = $request->get("iddevis");         
        $entity->setReferent($this->getUser()); 
        $entity->setTauxtva("21.50");
        if ($idorg){ 
            $em = $this->getDoctrine()->getManager();
            $organisation = $em->getRepository('AcmePmeBundle:Organisations')->find($idorg);            
            $entity->setOrganisation($organisation);          
        } 
        if ($iddevis){ 
            $em = $this->getDoctrine()->getManager();
            $devisparent = $em->getRepository('AcmePmeBundle:Devis')->find($iddevis);            
            $entity = clone $devisparent; 
            $entity->setParent($devisparent);
        }         
        $form   = $this->createCreateForm($entity,$niveau,$idorg);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'niveau' => $niveau,              
        );
    }

    /**
     * Finds and displays a Devis entity.
     *
     * @Route("/{id}", name="devis_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmePmeBundle:Devis')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Devis entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Devis entity.
     *
     * @Route("/{id}/edit", name="devis_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();        
        $niveau = $request->get("niveau");
        $entity = $em->getRepository('AcmePmeBundle:Devis')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Devis entity.');
        }

        $editForm = $this->createEditForm($entity,$niveau);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Devis entity.
    *
    * @param Devis $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Devis $entity,$niveau)
    {
        $form = $this->createForm(new DevisType($niveau,$entity->getOrganisation()->getId(),json_encode($entity->getListeproduits())), $entity, array(        
            'action' => $this->generateUrl('devis_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Mettre à jour'));

        return $form;
    }
    /**
     * Edits an existing Devis entity.
     *
     * @Route("/{id}", name="devis_update")
     * @Method("PUT")
     * @Template("AcmePmeBundle:Devis:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $niveau = $request->get("niveau");
        $entity = $em->getRepository('AcmePmeBundle:Devis')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Devis entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity,$niveau);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('devis_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Devis entity.
     *
     * @Route("/{id}", name="devis_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $sortie = array("erreur"=>true,
                        "action" => "delete",
                        "type"=>"devis",
                        "typezone" => "onglet",            
                        "message"=>"Le devis n'a pas été supprimé"); 
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AcmePmeBundle:Devis')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Devis entity.');
        }
        $em->remove($entity);
        $em->flush();
        $sortie["erreur"] = false;
        $sortie["id"] = $id;  
        $sortie["dossier"] = $entity->getDossier();            
        $sortie["idorg"] = $entity->getOrganisation()->getId();          
        $sortie["message"] = "Le devis a été supprimé";              
        $response = new JsonResponse();
        $response->setData($sortie);
        return $response;
    }

    /**
     * Creates a form to delete a Devis entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('devis_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
