<?php

namespace Acme\PmeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Acme\PmeBundle\Entity\Contacts;
use Acme\PmeBundle\Form\ContactsType;

/**
 * Contacts controller.
 *
 */
class ContactsController extends Controller
{
    public function editNomMelAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();   
        $niveau = $request->get("niveau");        
        $contact = $em->getRepository('AcmePmeBundle:Contacts')->find($id);
        $sortie = array("erreur"=>false,
                        "action" => "nommel",
                        "type"=>"contact");
        if (!$contact) {
            throw $this->createNotFoundException('Unable to find Contacts entity.');
        }
        $sortie["resultat"] = array(
                                'id'=>$contact->getId(),            
                                'nom'=>$contact->__toString(),
                                'mel' => $contact->getEmail(),
                                'niveau' => $niveau
                                );
        $response = new JsonResponse();
        $response->setData($sortie);
        return $response;
    }  
    /**
     * Lists all Contacts entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmePmeBundle:Contacts')->findAll();

        return $this->render('AcmePmeBundle:Contacts:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Contacts entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Contacts();
        $niveau = $request->get("niveau");
        $idorg = $request->get("idorg");        
        $sortie = array("erreur"=>true,
                        "action" => "new",
                        "type"=>"contact",
                        "typezone" => "onglet",
                        "message"=>"Le Contact n'a pas été enregistré");
        if ($idorg){ 
            $em = $this->getDoctrine()->getManager();            
            $organisation = $em->getRepository('AcmePmeBundle:Organisations')->find($idorg);            
            $entity->setOrganisation($organisation);          
        }          
        $form = $this->createCreateForm($entity,$idorg,$niveau);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $sortie["erreur"] = false;
            $sortie["message"] = "Le Contact a été enregistré avec succès";  
            $sortie["idonglet"] = "new_contact_".$entity->getOrganisation()->getId();            
            $sortie["resultat"] = array(
                                    'id'=>$entity->getId(),   
                                    'idorg'=>$entity->getOrganisation()->getId(),                
                                    'nom'=>$entity->__toString(),
                                    'name'=>$entity->__toString(),                
                                    'tel'=>$entity->getFixe(),                
                                    'mobile'=>$entity->getMobile(),
                                    'email'=>$entity->getEmail(),
                                    'centresinteret'=> $entity->getListecentresinteret(),
                                    'cat'=>'contact'
                                    ); 
//            return $this->redirect($this->generateUrl('contacts_show', array('id' => $entity->getId())));
        }
        $response = new JsonResponse();
        $response->setData($sortie);
        return $response;
    }

    /**
     * Creates a form to create a Contacts entity.
     *
     * @param Contacts $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Contacts $entity,$idorg,$niveau)
    {
        $form = $this->createForm(new ContactsType($niveau), $entity, array(
            'action' => $this->generateUrl('contacts_create',array('idorg'=>$idorg)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Enregistrer'));

        return $form;
    }

    /**
     * Displays a form to create a new Contacts entity.
     *
     */
    public function newAction()
    {
        $entity = new Contacts();
        $entity->setSaisipar($this->getUser());       
        $request = $this->getRequest();
        $idorg = $request->get("idorg");   
        $niveau = $request->get("niveau"); 
        if ($idorg){ 
            $em = $this->getDoctrine()->getManager();
            $organisation = $em->getRepository('AcmePmeBundle:Organisations')->find($idorg);            
            $entity->setOrganisation($organisation);          
        }            
        $form   = $this->createCreateForm($entity,$idorg,$niveau);

        return $this->render('AcmePmeBundle:Contacts:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Contacts entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmePmeBundle:Contacts')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contacts entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmePmeBundle:Contacts:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Contacts entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();        
        $niveau = $request->get("niveau");
        $entity = $em->getRepository('AcmePmeBundle:Contacts')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contacts entity.');
        }

        $editForm = $this->createEditForm($entity,$niveau);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmePmeBundle:Contacts:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Contacts entity.
    *
    * @param Contacts $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Contacts $entity,$niveau)
    {
        $form = $this->createForm(new ContactsType($niveau), $entity, array(
            'action' => $this->generateUrl('contacts_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        $form->add('submit', 'submit', array('label' => 'Mettre à jour'));
        return $form;
    }
    /**
     * Edits an existing Contacts entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $niveau = $request->get("niveau");          
        $sortie = array("erreur"=>true,
                        "action" => "update",
                        "type"=>"contact",
                        "typezone" => "onglet",            
                        "message"=>"Le Contact n'a pas été mis à jours");
        $entity = $em->getRepository('AcmePmeBundle:Contacts')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contacts entity.');
        }
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity,$niveau);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $sortie["erreur"] = false;
            $sortie["message"] = "Le Contact a été mis à jours avec succès";  
            $sortie["idonglet"] = "update_contact_".$entity->getId();              
            $sortie["resultat"] = array(
                                    'id'=>$entity->getId(),   
                                    'idorg'=>$entity->getOrganisation()->getId(),                
                                    'nom'=>$entity->__toString(),
                                    'name'=>$entity->__toString(),                
                                    'tel'=>$entity->getFixe(),                
                                    'mobile'=>$entity->getMobile(),
                                    'email'=>$entity->getEmail(),
                                    'centresinteret'=> $entity->getListecentresinteret(),
                                    'cat'=>'contact'               
                                    );    
        }
        $response = new JsonResponse();
        $response->setData($sortie);
        return $response;
    }
    /**
     * Deletes a Contacts entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $sortie = array("erreur"=>true,
                        "action" => "delete",
                        "type"=>"contact",
                        "message"=>"Le contact n'a pas été supprimé");        
//        $form = $this->createDeleteForm($id);
//        $form->handleRequest($request);

//        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmePmeBundle:Contacts')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Contacts entity.');
            }
            $sortie["idorg"] = $entity->getOrganisation()->getId();     
            $em->remove($entity);
            $em->flush();
            $sortie["erreur"] = false;
            $sortie["id"] = $id;              
            $sortie["message"] = "Le contact a été supprimé";              
//        }
        $response = new JsonResponse();
        $response->setData($sortie);
        return $response;
    }

    /**
     * Creates a form to delete a Contacts entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contacts_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
