<?php

namespace Acme\PmeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\PmeBundle\Entity\Commandes;
use Acme\PmeBundle\Form\CommandesType;
use Acme\PmeBundle\Entity\Lignescommandes;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Commandes controller.
 *
 * @Route("/commandes")
 */
class CommandesController extends Controller
{

    /**
     * Lists all Commandes entities.
     *
     * @Route("/", name="commandes")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmePmeBundle:Commandes')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Commandes entity.
     *
     * @Route("/", name="commandes_create")
     * @Method("POST")
     * @Template("AcmePmeBundle:Commandes:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Commandes();
        $niveau = $request->get("niveau"); 
        $idlivraison = $request->get("idlivraison"); 
        $idfacturation= $request->get("idfacturation");         
        $sortie = array("erreur"=>true,
                        "action" => "new",
                        "type"=>"commande",
                        "typezone" => "onglet",                
                        "message"=>"La Commande n'a pas été enregistrée");           
        $form = $this->createCreateForm($entity,0,$niveau);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $iddevis = $form->get('devis')->getData();
            $devis = $em->getRepository('AcmePmeBundle:Devis')->find($iddevis);              
            $parametrenumcommande = $em->getRepository('AcmePmeBundle:Parametres')->findOneBy(array('nom'=>'numcommande'));
            $parametrenumcommande->setValeur($parametrenumcommande->getValeur()+1);
            $entity->setNumcommande($parametrenumcommande->getValeur()); 
            $entity->setTauxtva($devis->getTauxtva());
            $em->persist($entity);
            $em->persist($parametrenumcommande);
            $lignesdevis = $devis->getLignesdevis();
            foreach ($lignesdevis as $key => $lignedevis) {
                    $lignecommande = new Lignescommandes();
                    $lignecommande->setCommande($entity);
                    $lignecommande->setOrdre($lignedevis->getOrdre());
                    $lignecommande->setReference($lignedevis->getReference());
                    $lignecommande->setPrixht($lignedevis->getPrixht());     
                    $lignecommande->setQuantite($lignedevis->getQuantite());       
                    $lignecommande->setRemise($lignedevis->getRemise());      
                    $lignecommande->setTotalht($lignedevis->getTotalht());     
                    $lignecommande->setDescription($lignedevis->getDescription());
                    $entity->addLignescommande($lignecommande);
            }  
            if (!$entity->getLivrermemeadresse() && $idlivraison>0) {
              $adresselivraison = $em->getRepository('AcmePmeBundle:Adresseslivraisonsfacturations')->find($idlivraison);
              $entity->setLivraison($adresselivraison);
            }
            if (!$entity->getFacturermemeadresse() && $idfacturation>0) {
              $adressefacturation = $em->getRepository('AcmePmeBundle:Adresseslivraisonsfacturations')->find($idfacturation);
              $entity->setFacturation($adressefacturation);
            }            
            $em->flush();
            $em->remove($devis->getParentOriginedevis());
            $em->flush();            
            $sortie["erreur"] = false;
            $sortie["message"] = "La Commande a été enregistrée avec succès";  
            $sortie["idorg"] = $entity->getOrganisation()->getId();  
            $sortie["iddevis"] = $iddevis;             
            $sortie["idcommande"] = $entity->getId();             
            $sortie["idonglet"] = "new_commande_".$iddevis; 
            $sortie["resultat"] = $entity->getArrayCommandes();
        }
        $response = new JsonResponse();
        $response->setData($sortie);
        return $response;  
    }

    /**
     * Creates a form to create a Commandes entity.
     *
     * @param Commandes $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Commandes $entity,$iddevis=0,$niveau)
    {
        $form = $this->createForm(new CommandesType($niveau,$iddevis,json_encode($entity->getListeproduits())), $entity, array(
            'action' => $this->generateUrl('commandes_create'),
            'method' => 'POST',
        ));        

        $form->add('submit', 'submit', array('label' => 'Enregistrer'));

        return $form;
    }

    /**
     * Displays a form to create a new Commandes entity.
     *
     * @Route("/new", name="commandes_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $commande = new Commandes();
        $em = $this->getDoctrine()->getManager();        
        $request = $this->getRequest();        
        $niveau = $request->get("niveau"); 
        $iddevis = $request->get("iddevis");  
        $devis = $em->getRepository('AcmePmeBundle:Devis')->find($iddevis);      
        $commande->setDossier($devis->getDossier());
        $commande->setContact($devis->getContact());       
        $commande->setReferent($devis->getReferent());          
        $commande->setModereglement($devis->getModereglement());    
        $commande->setOrganisation($devis->getOrganisation());
        $commande->setObservation($devis->getObservation()); 
        $commande->setFraisport($devis->getFraisport());          
        $commande->setTauxtva($devis->getTauxtva());  
        $commande->setTotaltva($devis->getTotaltva()); 
        $commande->setTotalht($devis->getTotalht());          
        $commande->setTotalttc($devis->getTotalttc());  
        $lignesdevis = $devis->getLignesdevis();
        foreach ($lignesdevis as $key => $lignedevis) {
                $lignecommande = new Lignescommandes();
                $lignecommande->setCommande($commande);
                $lignecommande->setOrdre($lignedevis->getOrdre());
                $lignecommande->setReference($lignedevis->getReference());
                $lignecommande->setPrixht($lignedevis->getPrixht());     
                $lignecommande->setQuantite($lignedevis->getQuantite());       
                $lignecommande->setRemise($lignedevis->getRemise());      
                $lignecommande->setTotalht($lignedevis->getTotalht());     
                $lignecommande->setDescription($lignedevis->getDescription());
                $commande->addLignescommande($lignecommande);
        }        
        $form   = $this->createCreateForm($commande,$iddevis,$niveau);

        return array(
            'entity' => $commande,
            'niveau' => $niveau,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Commandes entity.
     *
     * @Route("/{id}", name="commandes_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmePmeBundle:Commandes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Commandes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Commandes entity.
     *
     * @Route("/{id}/edit", name="commandes_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmePmeBundle:Commandes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Commandes entity.');
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
    * Creates a form to edit a Commandes entity.
    *
    * @param Commandes $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Commandes $entity)
    {
        $form = $this->createForm(new CommandesType(), $entity, array(
            'action' => $this->generateUrl('commandes_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Commandes entity.
     *
     * @Route("/{id}", name="commandes_update")
     * @Method("PUT")
     * @Template("AcmePmeBundle:Commandes:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmePmeBundle:Commandes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Commandes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('commandes_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Commandes entity.
     *
     * @Route("/{id}", name="commandes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $sortie = array("erreur"=>true,
                        "action" => "delete",
                        "type"=>"commande",
                        "typezone" => "onglet",            
                        "message"=>"La commande n'a pas été supprimée");
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AcmePmeBundle:Commandes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Commandes entity.');
        }

        $em->remove($entity);
        $em->flush();
        $sortie["erreur"] = false;
        $sortie["id"] = $id;                   
        $sortie["message"] = "La commande a été supprimée";                      
        $response = new JsonResponse();
        $response->setData($sortie);
        return $response;    }

    /**
     * Creates a form to delete a Commandes entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('commandes_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
