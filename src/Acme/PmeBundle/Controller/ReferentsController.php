<?php

namespace Acme\PmeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\PmeBundle\Entity\Referents;
use Acme\PmeBundle\Form\ReferentsType;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Referents controller.
 *
 */
class ReferentsController extends Controller
{

    private function setSecurePassword($entity) {
        $factory = $this->get('security.encoder_factory');
        $encoder = $factory->getEncoder($entity);      
        $password = $encoder->encodePassword($entity->getPassword(), $entity->getSalt());
        $entity->setPassword($password);   
    }    
    
    public function getSignaturesAction($id)
    {
        $lessignatures = array();
        $em = $this->getDoctrine()->getManager();        
        $referent = $em->getRepository('AcmePmeBundle:Referents')->find($id);
        if (!$referent) {
            throw $this->createNotFoundException('Unable to find Devis entity.');
        }        

        $lessignatures = array(
                                "signature"=>$referent->getSignature()?utf8_encode(stream_get_contents($referent->getSignature())):null,
                                "signatureweb"=>$referent->getSignatureWeb()?utf8_encode(stream_get_contents($referent->getSignatureWeb())):null
                        );
        $response = new JsonResponse();
        $response->setData($lessignatures);
        return $response;        
    }
    
    /**
     * Lists all Referents entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmePmeBundle:Referents')->findAll();

        return $this->render('AcmePmeBundle:Referents:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Referents entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Referents();
        $niveau = $request->get("niveau");             
        $sortie = array("erreur"=>true,
                        "action" => "new",
                        "type"=>"referent",
                        "typezone" => "onglet",
                        "message"=>"Le Référent n'a pas été enregistré");        
        $form = $this->createCreateForm($entity,$niveau);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $this->setSecurePassword($entity);
            $em->persist($entity);
            $em->flush();
            $sortie["erreur"] = false;
            $sortie["message"] = "Le Référent a été enregistré avec succès";  
            $sortie["idonglet"] = "new_referent";              
        }
        $response = new JsonResponse();
        $response->setData($sortie);
        return $response;
    }

    /**
     * Creates a form to create a Referents entity.
     *
     * @param Referents $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Referents $entity,$niveau)
    {
        $form = $this->createForm(new ReferentsType($niveau), $entity, array(
            'action' => $this->generateUrl('referents_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Referents entity.
     *
     */
    public function newAction()
    {
        $entity = new Referents();
        $request = $this->getRequest();        
        $niveau = $request->get("niveau");          
        $form   = $this->createCreateForm($entity,$niveau);

        return $this->render('AcmePmeBundle:Referents:new.html.twig', array(
            'entity' => $entity,
            'niveau' =>$niveau,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Referents entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmePmeBundle:Referents')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Referents entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        return $this->render('AcmePmeBundle:Referents:show.html.twig', array(
            'entity'      => $entity,
            'signature' => stream_get_contents($entity->getSignature()),
            'signatureweb' => stream_get_contents($entity->getSignatureweb()),            
            'delete_form' => $deleteForm->createView()));
    }

    /**
     * Displays a form to edit an existing Referents entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();        
        $niveau = $request->get("niveau");
        $entity = $em->getRepository('AcmePmeBundle:Referents')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Referents entity.');
        }

        $editForm = $this->createEditForm($entity,$niveau);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmePmeBundle:Referents:edit.html.twig', array(
            'entity'      => $entity,
            'niveau' =>$niveau,            
            'signature' => $entity->getSignature()?stream_get_contents($entity->getSignature()):null,
            'signatureweb' => $entity->getSignatureweb()?stream_get_contents($entity->getSignatureweb()):null,             
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Referents entity.
    *
    * @param Referents $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Referents $entity,$niveau)
    {
        $form = $this->createForm(new ReferentsType($niveau), $entity, array(
            'action' => $this->generateUrl('referents_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Referents entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager(); 
        $request = $this->getRequest();        
        $niveau = $request->get("niveau");        
        $sortie = array("erreur"=>true,
                        "action" => "update",
                        "type"=>"referent",
                        "typezone" => "onglet",                
                        "message"=>"Le référent n'a pas été mis à jours");
        $entity = $em->getRepository('AcmePmeBundle:Referents')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Referents entity.');
        }

//        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity,$niveau);
        $current_pass = $entity->getPassword();          
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            if ($current_pass != $entity->getPassword()) {
                $entity->setSalt(md5(uniqid(null, true)));            
                $this->setSecurePassword($entity);
            }    
//            $entity->upload();            
            $em->flush();
            $sortie["erreur"] = false;
            $sortie["message"] = "Le référent a été mis à jours avec succès";  
            $sortie["idonglet"] = "update_referent_".$entity->getId();                        
//            return $this->redirect($this->generateUrl('referents_edit', array('id' => $id)));
        }
        $response = new JsonResponse();
        $response->setData($sortie);
        return $response;
    }
    /**
     * Deletes a Referents entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmePmeBundle:Referents')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Referents entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('referents'));
    }

    /**
     * Creates a form to delete a Referents entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('referents_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
