<?php

namespace Acme\PmeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\PmeBundle\Entity\Organisations;
use Acme\PmeBundle\Form\OrganisationsType;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Organisations controller.
 *
 */
class OrganisationsController extends Controller
{
  public function listeorganisationsAction()
  {
            $request = $this->getRequest();
            $id = $request->get("id");  
            $listeorganisations = array();
            $em = $this->getDoctrine()->getManager();
            $sortie = array("erreur"=>true,
                            "action" => "liste",
                            "type"=>"organisation",              
                            "message"=>"Liste des organsations"); 
            if ($id!=null) {
                if ($id==0) {
                    $organisations = $em->getRepository('AcmePmeBundle:Organisations')->findAll();                    
                } else {
                    $organisations = $em->getRepository('AcmePmeBundle:Organisations')->findBy(array('referent'=>$id),array('nom'=>'ASC'));                    
                }
                foreach ($organisations as $key => $organisation) {
                        $listeorganisations[] = array(
                                        'id'=>$organisation->getId(),
                                        'nom'=>$organisation->getNom(),
                                        'tel'=>$organisation->getTel(),
                                        'fax'=>$organisation->getFax(),
                                        'idreferent'=>$organisation->getReferent()->getId(),                            
                                        'referent'=>$organisation->getReferent()->__toString(),
//                                        'nomville'=>$organisation->getVille()?$organisation->getVille()->__toString():null,                         
                                        'nomville'=>$organisation->getVille()?$organisation->getVille()->getNom():null,                           
                                        'cat'=>'organisation'
                        );
                }       
                $sortie["erreur"] = false;         
                $sortie["resultat"] = $listeorganisations;                  
            }           
        $response = new JsonResponse();
        $response->setData($sortie);
        return $response;           
        }   

  public function detailorganisationAction()
  {
            $request = $this->getRequest();
            $id = $request->get("id");  
            $detailorganisation = array();
            $em = $this->getDoctrine()->getManager();
            $sortie = array("erreur"=>true,
                            "action" => "detail",
                            "type"=>"organisation",              
                            "message"=>"Liste des contacts"); 
            if ($id!=null) {
                $organisation = $em->getRepository('AcmePmeBundle:Organisations')->find($id); 
                $detailorganisation = array(
                                            'detail'=>$organisation->getDetail(),                  
                                            'contacts'=>$organisation->getListecontacts(),
  //                                            'devis'=>$organisation->getListedevis(),
                                            'devis'=>array('identifier'=> 'id','items'=>$organisation->getListedevis()),                     
                                            'commandes'=>$organisation->getListecommandes(),
                                            'actions'=>$organisation->getListeactions());                
                $sortie["erreur"] = false;         
                $sortie["resultat"] = $detailorganisation;                  
            } 
            $response = new JsonResponse();
            $response->setData($sortie);
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
            if ($id!=null) {
                if ($id==0) {
                    $villes = $em->getRepository('AcmePmeBundle:Villes')->findAll();                    
                } else {
                    $villes = $em->getRepository('AcmePmeBundle:Villes')->findBy(array('pays'=>$id),array('nom'=>'ASC'));                    
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
            }           
            $response = new JsonResponse();
            $response->setData($sortie);
            return $response;                
        }        

  public function listecontactsAction()
  {
            $request = $this->getRequest();
            $id = $request->get("id");            
            $listecontacts = array();
            $em = $this->getDoctrine()->getManager();
            $sortie = array("erreur"=>true,
                            "action" => "liste",
                            "type"=>"contacts",              
                            "message"=>"Liste des contacts");                 
            $organisation = $em->getRepository('AcmePmeBundle:Organisations')->find($id);
            foreach ($organisation->getContact() as $key => $contact) {
                $listecontacts[] = array(
                                        'id'=>$contact->getId(),   
                                        'idorg'=>$id,                
                                        'nom'=>$contact->__toString(),        
                                        'name'=>$contact->__toString(),
                                        'cat'=>'contact'
                                );            
            }   
            $sortie["erreur"] = false;         
            $sortie["resultat"] = $listecontacts;                      
            $response = new JsonResponse();
            $response->setData($sortie);
            return $response;               
  }    

    /**
     * Lists all Organisations entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmePmeBundle:Organisations')->findAll();

        return $this->render('AcmePmeBundle:Organisations:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Organisations entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Organisations();
        $niveau = $request->get("niveau");          
        $form = $this->createCreateForm($entity,$niveau);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('organisations_show', array('id' => $entity->getId())));
        }
        return $this->render('AcmePmeBundle:Organisations:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Organisations entity.
     *
     * @param Organisations $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Organisations $entity, $niveau)
    {
        $form = $this->createForm(new OrganisationsType($niveau), $entity, array(
            'action' => $this->generateUrl('organisations_create'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Enregistrer'));
        return $form;
    }

    /**
     * Displays a form to create a new Organisations entity.
     *
     */
    public function newAction()
    {
        $entity = new Organisations();
        $request = $this->getRequest();        
        $niveau = $request->get("niveau");         
        $entity->setReferent($this->getUser());         
        $form   = $this->createCreateForm($entity,$niveau);
        return $this->render('AcmePmeBundle:Organisations:new.html.twig', array(
            'entity' => $entity,
            'idform' => 'neworganisation_'.$niveau,                  
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Organisations entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmePmeBundle:Organisations')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organisations entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmePmeBundle:Organisations:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Organisations entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();        
        $niveau = $request->get("niveau");
        $entity = $em->getRepository('AcmePmeBundle:Organisations')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organisations entity.');
        }

        $editForm = $this->createEditForm($entity,$niveau);
        $deleteForm = $this->createDeleteForm($id);
        return $this->render('AcmePmeBundle:Organisations:edit.html.twig', array(
            'entity'      => $entity,
            'idform' => 'editorganisation_'.$niveau,            
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Organisations entity.
    *
    * @param Organisations $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Organisations $entity,$niveau)
    {
        $form = $this->createForm(new OrganisationsType($niveau), $entity, array(
            'action' => $this->generateUrl('organisations_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        $form->add('submit', 'submit', array('label' => 'Mettre à jour'));
        return $form;
    }
    /**
     * Edits an existing Organisations entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();     
        $niveau = $request->get("niveau");         
        $sortie = array("erreur"=>true,
                        "action" => "update",
                        "type"=>"organisation",
                        "typezone" => "onglet",                
                        "message"=>"L'organisation n'a pas été mis à jours");
        $entity = $em->getRepository('AcmePmeBundle:Organisations')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organisations entity.');
        }
        $editForm = $this->createEditForm($entity,$niveau);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $sortie["erreur"] = false;
            $sortie["message"] = "L'organisation a été mis à jours avec succès";  
            $sortie["idonglet"] = "update_organisation_".$entity->getId();              
            $sortie["resultat"] = array(
                                    'id'=>$entity->getId(),               
                                    'nom'=>$entity->__toString(),
                                    'tel'=>$entity->getTel(),
                                    'fax'=>$entity->getFax(),
                                    'email'=>$entity->getEmail(),  
                                    'nomville'=>$entity->getVille()?$entity->getVille()->__toString():null,
                                    'referent'=>$entity->getReferent()->__toString(),                
                                    'cat'=>'organisation'                
                                    ); 
        }
        $response = new JsonResponse();
        $response->setData($sortie);
        return $response;
    }
    /**
     * Deletes a Organisations entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmePmeBundle:Organisations')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Organisations entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('organisations'));
    }

    /**
     * Creates a form to delete a Organisations entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('organisations_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
