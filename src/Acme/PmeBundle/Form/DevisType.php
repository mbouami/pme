<?php

namespace Acme\PmeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DevisType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    private $niv=0;
    private $org=0;   
    private $store=null;    
    
    public function __construct($niv,$idorg,$store)
    {
        $this->niv = $niv;
        $this->org = $idorg;      
        $this->store = $store;
    }  
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dossier','text',array('label'=>'Nom du dossier : ',
                                        'attr'=> array(
                                                        'data-dojo-type' =>'dijit/form/TextBox',
                                                        'data-dojo-props' =>"id:'devis_dossier_$this->niv'",                                                 
                                                        'placeHolder' => 'nom du dossier',
                                                        'style'=>"width:300px;",
//                                                        'onChange'=>"Afficher_Produits(\"produits\");Afficher_Lignes_Devis(\"lignesdevis\");"
                                                    )) )
            ->add('organisation','entity',array('label'=>'Organisation : ',
                                        'required'=>false,   
                                        'empty_value' => false,
//                                        'empty_value' => 'Choisir une organisation',
//                                        'empty_data'  => null,
                                        'class' => 'AcmePmeBundle:Organisations',                
                                         'attr'=> array(
                                                        'data-dojo-id'=> 'listeorganisations',
                                                        'data-dojo-type' =>'dijit/form/FilteringSelect',
                                                        'data-dojo-props' =>"id:'devis_organisation_$this->niv'",                                               
                                                        'placeHolder' => 'Organisation',
                                                        'style'=>"width:300px;",
                                                        'onChange' =>"Afficher_Contacts(this.value);"                                           
                                                    )) )                 
            ->add('contact', 'entity', array('label'=>'Contact : ',
                                        'required'=>true,                  
                                        'empty_value' => false,
                                        'class' => 'AcmePmeBundle:Contacts',        
                                        'query_builder' => function(\Acme\PmeBundle\Entity\Repository\ContactsRepository $er) {            
                                                return $this->org>0?$er->ListeContactsParOrganisation($this->org):$er->ListeContacts();                
                                        },                 
                                         'attr'=> array(
                                                        'data-dojo-id'=> 'listecontacts',
                                                        'data-dojo-type' =>'dijit/form/FilteringSelect',
                                                        'data-dojo-props' =>"id:'devis_contact_$this->niv'",                                                 
                                                        'placeHolder' => 'Choisir un contact',
                                                        'style'=>"width:200px;"
                                        )) )    
            ->add('quantite',null,array('label'=>'Quantité : ',
                                        'mapped' => false,
                                         'attr'=> array(
                                                        'data-dojo-type' =>'dijit/form/NumberSpinner',
                                                        'data-dojo-props' =>"id:'devis_quantite_$this->niv'",                                                 
                                                        'placeHolder' => 'quantité',
                                                        'value'=>1,
                                                        'style'=>"text-align:center;width:50px;"
                                                    )) )     
            ->add('produits',null,array('mapped' => false,
                                         'attr'=> array(
                                                        'data-dojo-id'=> 'listeproduits',                                             
                                                        'data-dojo-type' =>'GrilleProduits',
                                                        'data-dojo-props'=> "id:'grilleproduits_$this->niv',niveau:'$this->niv',store:StoreProduits"
                                                    )) )  
            ->add('produitsdevis',null,array(
                                        'mapped' => false,
                                         'attr'=> array(
                                                        'data-dojo-id'=> 'grillelignesdevis',                                                
                                                        'data-dojo-type' =>'GrilleLignesDevis',
                                                        'data-dojo-props'=> "id:'grillelignesdevis_$this->niv',niveau:'$this->niv',donnees:'$this->store'"
                                                    )) )                                                                                              
//            ->add('reference')
            ->add('totalht',null,array('label'=>'Total HT : ',                
                                         'attr'=> array(
                                                        'data-dojo-id'=> 'tht',                                             
                                                        'data-dojo-type' =>'dijit.form.CurrencyTextBox',
                                                        'data-dojo-props' =>"id:'devis_totalht_$this->niv',constraints:{fractional:true},currency: 'EUR',lang: 'fr-fr',invalidMessage:'Vous devez saisir un format valide'",
//                                                        'value'=>0,
                                                        'style' =>'width: 120px',                                          
                                                        'class' => 'alignement_a_droite',                                               
//                                                        'onChange' =>"Calculer_Total_TTC();"                                              
                                                    )) )
//              ->add('tauxtva')
            ->add('tauxtva', 'entity', array('label'=>'Taux TVA : ',
                                        'empty_value' => false,
                                        'class' => 'AcmePmeBundle:Tauxtva',
                                        'property' => 'taux', 
                                         'attr'=> array(
                                                        'data-dojo-id'=> 'ttva',                                             
                                                        'data-dojo-type' =>'dijit.form.FilteringSelect',
                                                        'data-dojo-props' =>"id:'devis_tauxtva_$this->niv',niveau:$this->niv",
                                                        'placeHolder' => 'taux TVA',
                                                        'class' => 'tva', 
                                                        'style' =>'width: 70px',                                             
                                                        'onChange' =>"Calculer_Total_TTC($this->niv);"  
                                        )) )                                                 
            ->add('totaltva',null,array('label'=>'Total TVA : ',                
                                         'attr'=> array(
                                                        'data-dojo-id'=> 'ttva',                                             
                                                        'data-dojo-type' =>'dijit.form.CurrencyTextBox',
                                                        'data-dojo-props' =>"id:'devis_totaltva_$this->niv',constraints:{fractional:true},currency: 'EUR',lang: 'fr-fr',invalidMessage:'Vous devez saisir un format valide'",
//                                                        'value'=>0,                                             
                                                        'class' => 'alignement_a_droite', 
                                                        'style' =>'width: 120px;',                                          
//                                                        'onChange' =>"Calculer_Total_TTC();"                                             
                                                    )) )
            ->add('fraisport',null,array('label'=>'Frais de port : ',                
                                         'attr'=> array(
                                                        'data-dojo-id'=> 'fport',                                             
                                                        'data-dojo-type' =>'dijit/form/CurrencyTextBox',
                                                        'data-dojo-props' =>"id:'devis_fraisport_$this->niv',niveau:$this->niv,constraints:{fractional:true},currency: 'EUR',lang: 'fr-fr',",
//                                                        'value'=>0,                                             
                                                        'class' => 'alignement_a_droite', 
                                                        'style' =>'width: 120px',                                             
                                                        'onChange' =>"Calculer_Total_TTC($this->niv);"                                                                                         
                                                    )) )                                                        
            ->add('observation',null,array('label'=>'Observation : ', 
                                        'required'=>false,                 
                                         'attr'=> array(
                                                        'data-dojo-id'=> 'observation',
                                                        'data-dojo-props' =>"id:'devis_observation_$this->niv',height:'60px'",                                             
                                                        'placeHolder' => 'observation',                                          
                                                    )) )                              
            ->add('modereglement',null,array('label'=>'Mode de réglement : ',
                                        'required'=>false,  
                                        'empty_value' => false,
                                         'attr'=> array(
                                                        'data-dojo-type' =>'dijit/form/FilteringSelect',
                                                        'data-dojo-props' =>"id:'devis_modereglement_$this->niv'",                                                 
                                                        'placeHolder' => 'mode réglement',
                                                        'style'=>"width:200px;"                                          
                                                    )) )
            ->add('typedevis',null,array('label'=>'Type de Devis : ',
                                        'required'=>false,  
                                        'empty_value' => false,
                                         'attr'=> array(
                                                        'data-dojo-type' =>'dijit/form/FilteringSelect',
                                                        'data-dojo-props' =>"id:'devis_typedevis_$this->niv'",                                              
                                                        'placeHolder' => 'type de devis',
                                                        'style'=>"width:200px;"                                          
                                                    )) ) 
            ->add('referent',null,array('label'=>'Référent : ',
                                        'empty_value' => false,
                                         'attr'=> array(
                                                        'data-dojo-type' =>'dijit/form/FilteringSelect',
                                                        'data-dojo-props' =>"id:'devis_referent_$this->niv'",                                                 
                                                        'placeHolder' => 'référent',
                                                        'style'=>"width:200px;"                                          
                                                    )) ) 
            ->add('totalttc',null,array('label'=>'Total TTC : ',
                                         'attr'=> array(
                                                        'data-dojo-id'=> 'tttc',
                                                        'data-dojo-type' =>'dijit/form/CurrencyTextBox',
                                                        'data-dojo-props' =>"id:'devis_totalttc_$this->niv',constraints:{fractional:true},currency: 'EUR',lang: 'fr-fr',invalidMessage:'Format non valid.',",
//                                                        'value'=>0,
                                                        'style' =>'width: 120px',
                                                        'class' => 'alignement_a_droite'
                                                    )) )  
            ->add('parent',null,array('label'=>'Devis de référence : '))                                               
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\PmeBundle\Entity\Devis'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acme_pmebundle_devis';
    }
}
