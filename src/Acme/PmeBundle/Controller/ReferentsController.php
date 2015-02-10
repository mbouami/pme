<?php

namespace Acme\PmeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\PmeBundle\Entity\Referents;
use Acme\PmeBundle\Form\ReferentsType;

/**
 * Referents controller.
 *
 * @Route("/referents")
 */
class ReferentsController extends Controller
{

    /**
     * Lists all Referents entities.
     *
     * @Route("/", name="referents")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmePmeBundle:Referents')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Referents entity.
     *
     * @Route("/", name="referents_create")
     * @Method("POST")
     * @Template("AcmePmeBundle:Referents:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Referents();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($entity, $entity->getPassword());
            $entity->setPassword($encoded);            
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('referents_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Referents entity.
     *
     * @param Referents $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Referents $entity)
    {
        $form = $this->createForm(new ReferentsType(), $entity, array(
            'action' => $this->generateUrl('referents_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Referents entity.
     *
     * @Route("/new", name="referents_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Referents();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Referents entity.
     *
     * @Route("/{id}", name="referents_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmePmeBundle:Referents')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Referents entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Referents entity.
     *
     * @Route("/{id}/edit", name="referents_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmePmeBundle:Referents')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Referents entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Referents entity.
    *
    * @param Referents $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Referents $entity)
    {
        $form = $this->createForm(new ReferentsType(), $entity, array(
            'action' => $this->generateUrl('referents_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Referents entity.
     *
     * @Route("/{id}", name="referents_update")
     * @Method("PUT")
     * @Template("AcmePmeBundle:Referents:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmePmeBundle:Referents')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Referents entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($entity, $entity->getPassword());
            $entity->setPassword($encoded);             
            $em->flush();

            return $this->redirect($this->generateUrl('referents_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Referents entity.
     *
     * @Route("/{id}", name="referents_delete")
     * @Method("DELETE")
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
