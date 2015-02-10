<?php

namespace Acme\PmeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    private $niv=0;
    
    public function __construct($niv)
    {
        $this->niv = $niv;
    } 
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civilite','entity',array('label'=>'Civilité : ',
//                                        'empty_value' => 'Choisissez une civilité',
                                        'class' => 'AcmePmeBundle:Civilites',
                                         'attr'=> array(
                                                        'data-dojo-type' =>'dijit/form/FilteringSelect',
                                                        'data-dojo-props' =>"id:'contact_civilite_$this->niv'",
                                                        'placeHolder' => 'Civilité',
                                                        'style'=>"width:50px;"                                           
                                                    )) )                  
            ->add('nom','text',array('label'=>'Nom : ',
                                        'required'=> true,
                                        'attr'=> array(
                                                        'data-dojo-type' =>'dijit/form/TextBox',
                                                        'data-dojo-props' =>"id:'contact_nom_$this->niv'",
                                                        'placeHolder' => 'nom',
                                                        'style'=>"width:200px;"
                                                    )) )
            ->add('prenom','text',array('label'=>'Prénom : ',
                                        'required'=> false,                
                                        'attr'=> array(
                                                        'data-dojo-type' =>'dijit/form/TextBox',
                                                        'data-dojo-props' =>"id:'contact_prenom_$this->niv'",
                                                        'placeHolder' => 'prénom',
                                                        'style'=>"width:200px;"
                                                    )) )
            ->add('email','email',array('label'=>'Email : ',
                                        'required'=> true,                
                                        'attr'=> array(
                                                        'data-dojo-type' =>'dijit/form/TextBox',
                                                        'data-dojo-props' =>"id:'contact_email_$this->niv'",                                            
                                                        'placeHolder' => 'email',
                                                        'style'=>"width:200px;"
                                                    )) )
            ->add('fixe','text',array('label'=>'Téléphone Fixe : ',
                                        'required'=> false,                
                                        'attr'=> array(
                                                        'data-dojo-type' =>'dijit/form/TextBox',
                                                        'data-dojo-props' =>"id:'contact_fixe_$this->niv'",                                            
                                                        'placeHolder' => 'fixe',
                                                        'style'=>"width:100px;"
                                                    )) )
            ->add('fax','text',array('label'=>'Fax : ',
                                        'required'=> false,                
                                        'attr'=> array(
                                                        'data-dojo-type' =>'dijit/form/TextBox',
                                                        'data-dojo-props' =>"id:'contact_fax_$this->niv'",                                            
                                                        'placeHolder' => 'fax',
                                                        'style'=>"width:100px;"
                                                    )) )
            ->add('mobile','text',array('label'=>'Téléphone Mobile : ',
                                        'required'=> false,                
                                        'attr'=> array(
                                                        'data-dojo-type' =>'dijit/form/TextBox',
                                                        'data-dojo-props' =>"id:'contact_mobile_$this->niv'",                                            
                                                        'placeHolder' => 'mobile',
                                                        'style'=>"width:100px;"
                                                    )) )
            ->add('adresse','textarea',array('label'=>'Adresse : ', 
                                        'required'=> false,                
                                         'attr'=> array(
                                                        'placeHolder' => 'adresse',
                                                        'data-dojo-props' =>"id:'contact_adresse_$this->niv'",                                             
                                                        'rows'=>"2",'cols'=>'20'                                           
                                                    )) )
            ->add('observation','textarea',array('label'=>'Observation : ',
                                        'required'=> false,                
                                         'attr'=> array(
                                                        'placeHolder' => 'observation',
                                                        'data-dojo-props' =>"id:'contact_observation_$this->niv'",                                             
                                                        'rows'=>"5",'cols'=>'10'                                           
                                                    )) )
//            ->add('createdAt')
//            ->add('updatedAt')
//            ->add('connectedAt')
//            ->add('ville')
            ->add('saisipar',null,array('label'=>'Saisie par : ',
                                        'required'=>false,                
                                         'attr'=> array(
                                                        'data-dojo-type' =>'dijit/form/FilteringSelect',
                                                        'data-dojo-props' =>"id:'contact_saisipar_$this->niv'",                                               
                                                        'placeHolder' => 'saisie par',
                                                        'style'=>"width:200px;"                                           
                                                    )) ) 
//            ->add('organisation')
            ->add('service',null,array('label'=>'Service : ',
                                        'required'=>false,                
                                         'attr'=> array(
                                                        'data-dojo-type' =>'dijit/form/FilteringSelect',
                                                        'data-dojo-props' =>"id:'contact_service_$this->niv'",                                                
                                                        'placeHolder' => 'service',
                                                        'style'=>"width:200px;"                                           
                                                    )) ) 
            ->add('centresinteret',null,array('label'=>'Les Centres d\'intérêt : ','required'=>false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\PmeBundle\Entity\Contacts'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acme_pmebundle_contacts';
    }
}
