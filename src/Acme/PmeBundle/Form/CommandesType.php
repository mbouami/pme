<?php

namespace Acme\PmeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommandesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    private $niv=0;
    private $iddevis=0;    
    private $store=null;     
    
    public function __construct($niv,$iddevis,$store)
    {
        $this->niv = $niv;
        $this->iddevis = $iddevis; 
        $this->store = $store;        
    }      
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('numcommande','text',array('label'=>'NumCommande : ',
//                                        'read_only'=>true,
////                                        'disabled'=>true,                
//                                        'attr'=> array(
//                                                        'data-dojo-type' =>'dijit/form/TextBox',
//                                                        'data-dojo-props' =>"id:'commande_numcommande_$this->niv'",                                                
//                                                        'placeHolder' => 'numéro de la commande',
//                                                        'style'=>"width:100px;",
////                                                        'onChange'=>"Afficher_Produits(\"produits\");Afficher_Lignes_Devis(\"lignesdevis\");"
//                                                    )) )
            ->add('produitscommande',null,array(
                                        'mapped' => false,
                                         'attr'=> array(                                               
                                                        'data-dojo-type' =>'GrilleLignesDevis',
                                                        'data-dojo-props'=> "id:'grillelignescommande_$this->niv',niveau:'$this->niv',donnees:'$this->store'"
                                                    )) )                  
            ->add('dossier','text',array('label'=>'Nom du dossier : ',
                                        'attr'=> array(
                                                        'data-dojo-type' =>'dijit/form/TextBox',
                                                        'data-dojo-props' =>"id:'commande_dossier_$this->niv'",                                                 
                                                        'placeHolder' => 'nom du dossier',
                                                        'style'=>"width:300px;",
//                                                        'onChange'=>"Afficher_Produits(\"produits\");Afficher_Lignes_Devis(\"lignesdevis\");"
                                                    )) )
            ->add('referenceclient','text',array('label'=>'Référence du Client : ',
                                        'attr'=> array(
                                                        'data-dojo-type' =>'dijit/form/TextBox',
                                                        'data-dojo-props' =>"id:'commande_referenceclient_$this->niv'",                                              
                                                        'placeHolder' => 'référence client',
                                                        'style'=>"width:300px;",
//                                                        'onChange'=>"Afficher_Produits(\"produits\");Afficher_Lignes_Devis(\"lignesdevis\");"
                                                    )) ) 
            ->add('totalht',null,array('label'=>'Total HT : ',                
                                         'attr'=> array(
//                                                        'data-dojo-id'=> 'commandetht',                                             
                                                        'data-dojo-type' =>'dijit/form/CurrencyTextBox',
                                                        'data-dojo-props' =>"id:'commande_totalht_$this->niv',constraints:{fractional:true},currency: \"EUR\",lang: 'fr-fr',",
                                                        'class' => 'alignement_a_droite',                                               
//                                                        'onChange' =>"Calculer_Total_TTC();"                                              
                                                    )) )
            ->add('totaltva',null,array('label'=>'Total TVA : ',                
                                         'attr'=> array(
//                                                        'data-dojo-id'=> 'commandetttva',                                             
                                                        'data-dojo-type' =>'dijit/form/CurrencyTextBox',
                                                        'data-dojo-props' =>"id:'commande_totaltva_$this->niv',constraints:{fractional:true},currency: \"EUR\",lang: 'fr-fr',",
                                                        'class' => 'alignement_a_droite',                                               
//                                                        'onChange' =>"Calculer_Total_TTC();"                                             
                                                    )) )
            ->add('totalttc',null,array('label'=>'Total TTC : ',
                                         'attr'=> array(
//                                                        'data-dojo-id'=> 'commandetttc',
                                                        'data-dojo-type' =>'dijit/form/CurrencyTextBox',
                                                        'data-dojo-props' =>"id:'commande_totalttc_$this->niv',constraints:{fractional:true},currency: \"EUR\",lang: 'fr-fr',",
                                                        'class' => 'alignement_a_droite'
                                                    )) )  
            ->add('fraisport',null,array('label'=>'Frais de port : ',                
                                         'attr'=> array(
//                                                        'data-dojo-id'=> 'commandefport',                                             
                                                        'data-dojo-type' =>'dijit/form/CurrencyTextBox',
                                                        'data-dojo-props' =>"id:'commande_fraisport_$this->niv',constraints:{fractional:true},currency: \"EUR\",lang: 'fr-fr',",
                                                        'value' => "0",
                                                        'class' => 'alignement_a_droite',                                             
//                                                        'onChange' =>"Calculer_Total_TTC();"                                             
                                                    )) )
            ->add('observation','textarea',array('label'=>'Observation : ',  
                                        'required'=>false,                   
                                         'attr'=> array(
                                                        'data-dojo-props' =>"id:'commande_observation_$this->niv'",
                                                        'placeHolder' => 'observation',
                                                        'rows'=>"5",'cols'=>'50'                                           
                                                    )) )
            ->add('livrermemeadresse',null,array('label'=>'Livraison à la même adresse : ',
                                        'required'=>false,                
                                         'attr'=> array(
//                                                        'data-dojo-id'=> 'livraisonmemeadresse',                                             
                                                        'data-dojo-type' =>'dijit/form/CheckBox',
                                                        'data-dojo-props' =>"id:'commande_livrermemeadresse_$this->niv',checked:true", 
                                                        'onChange' =>"Activer_Liste(this,'adresseslivraisons_$this->niv');"
//                                                        'onChange'=>"console.log(this.get('value'))"
//                                                        'onChange' =>"Activer_Liste(livraisonmemeadresse,adresselivraison);"
                                                    )) ) 
            ->add('adresseslivraisons',null,array(
                                         'mapped' => false,
                                         'attr'=> array(    
                                                        'data-dojo-id'=> 'adresseslivraisons',                                              
                                                        'data-dojo-type' =>'GrilleAdresses',
                                                        'data-dojo-props'=> "id:'adresseslivraisons_$this->niv',niveau:'$this->niv'",
//                                                        'style'=>"width:200px;disabled: true"                                           
                                                    )))           
            ->add('facturermemeadresse',null,array('label'=>'Facturation à la même adresse : ',
                                        'required'=>false,                
                                         'attr'=> array(
//                                                        'data-dojo-id'=> 'facturationmemeadresse',                                             
                                                        'data-dojo-type' =>'dijit/form/CheckBox',
                                                        'data-dojo-props' =>"id:'commande_facturermemeadresse_$this->niv',checked:true",
                                                        'onChange' =>"Activer_Liste(this,'adressesfacturations_$this->niv');"                                           
//                                                        'onChange' =>"Activer_Liste(facturationmemeadresse,adressefacturation);"
                                                    )) )  
            ->add('adressesfacturations',null,array(
                                         'mapped' => false,
                                         'attr'=> array(    
                                                        'data-dojo-id'=> 'adressesfacturations',                                              
                                                        'data-dojo-type' =>'GrilleAdresses',
                                                        'data-dojo-props'=> "id:'adressesfacturations_$this->niv',niveau:'$this->niv'",
//                                                        'style'=>"width:200px;disabled: true"                                            
                                                    )))              
//            ->add('createdAt')
//            ->add('updatedAt')
            ->add('modereglement',null,array('label'=>'Mode de réglement : ',
                                        'required'=>false,                
                                         'attr'=> array(
                                                        'data-dojo-type' =>'dijit/form/FilteringSelect',
                                                        'data-dojo-props' =>"id:'commande_modereglement_$this->niv',",
                                                        'placeHolder' => 'mode réglement',
                                                        'style'=>"width:200px;"                                          
                                                    )) ) 
            ->add('referent',null,array('label'=>'Référent : ',
                                        'required'=>false,                
                                         'attr'=> array(
                                                        'data-dojo-type' =>'dijit/form/FilteringSelect',
                                                        'data-dojo-props' =>"id:'commande_referent_$this->niv',",
                                                        'placeHolder' => 'référent',
                                                        'style'=>"width:200px;"                                          
                                                    )) ) 
            ->add('tauxtva', 'entity', array('label'=>'Taux TVA : ',
                                        'empty_value' => false,
                                        'class' => 'AcmePmeBundle:Tauxtva',
                                        'property' => 'taux',          
                                         'attr'=> array(
//                                                        'data-dojo-id'=> 'ttva',                                             
                                                        'data-dojo-type' =>'dijit/form/FilteringSelect',
                                                        'data-dojo-props' =>"id:'commande_tauxtva_$this->niv'",
                                                        'placeHolder' => 'taux TVA',
                                                        'class' => 'tva', 
                                                        'style' =>'width: 70px',                                             
//                                                        'onChange' =>"Calculer_Total_TTC($this->niv);"  
                                        )) )    
            ->add('organisation','entity',array('label'=>'Organisation : ',
                                        'required'=>false,     
                                        'empty_value' => 'Choisir une organisation',
                                        'empty_data'  => null,
                                        'class' => 'AcmePmeBundle:Organisations',                
                                         'attr'=> array(
//                                                        'data-dojo-id'=> 'listeorganisations',
                                                        'data-dojo-type' =>'dijit/form/FilteringSelect',
                                                        'data-dojo-props' =>"id:'commande_organisation_$this->niv',",                                             
                                                        'placeHolder' => 'Organisation',
                                                        'style'=>"width:300px;",
                                                        'onChange' =>"Afficher_Contacts(this.value);"                                           
                                                    )) )  
            ->add('contact', 'entity', array('label'=>'Contact : ',
                                        'empty_value' => 'Choisir un contact',
                                        'empty_data'  => null,
                                        'class' => 'AcmePmeBundle:Contacts',
//                                        'query_builder' => function(ContactsRepository $er) {            
//                                                return $this->idorg>0?$er->ListeContactsParOrganisation($this->idorg):$er->ListeContacts();               
//                                        },              
                                         'attr'=> array(
//                                                        'data-dojo-id'=> 'listecontacts',
                                                        'data-dojo-type' =>'dijit/form/FilteringSelect',
                                                        'data-dojo-props' =>"id:'commande_contact_$this->niv',",                                              
                                                        'placeHolder' => 'Choisir un contact',
                                                        'style'=>"width:200px;"
                                        )) ) 
            ->add('devis', 'hidden', array(
                'mapped' => false,    
                'data' => $this->iddevis,
            ))               
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\PmeBundle\Entity\Commandes'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acme_pmebundle_commandes';
    }
}
