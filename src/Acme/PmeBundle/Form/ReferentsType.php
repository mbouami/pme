<?php

namespace Acme\PmeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReferentsType extends AbstractType
{
    private $niv=0;
    private $caneva="";
    private $canevaweb="";    
    
    public function __construct($niv)
    {
        $this->niv = $niv;
        $this->caneva ="signature_canvas_".$niv ;
        $this->canevaweb = "signatureweb_canvas_".$niv ;
    }    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civilite','entity',array('label'=>'Civilité : ',
//                                        'empty_value' => 'Choisissez une civilité',
//                                        'required'=>true,
                                        'class' => 'AcmePmeBundle:Civilites',
                                         'attr'=> array(
                                                        'data-dojo-type' =>'dijit/form/FilteringSelect',
                                                        'data-dojo-props' =>"id:'referent_civilite_$this->niv'",                                             
                                                        'placeHolder' => 'Civilité',
                                                        'style'=>"width:200px;"                                           
                                                    )) )                 
            ->add('nom','text',array('label'=>'nom : ','attr'=> array(
                                                                        'data-dojo-type' =>'dijit/form/TextBox',
                                                                        'data-dojo-props' =>"id:'referent_nom_$this->niv'",                   
                                                                        'placeHolder' => 'nom',
                                                                        'style'=>"width:200px;"
                                                                    )) )
            ->add('prenom','text',array('label'=>'Prénom : ','attr'=> array(
                                                                        'data-dojo-type' =>'dijit/form/TextBox',
                                                                        'data-dojo-props' =>"id:'referent_prenom_$this->niv'",                      
                                                                        'placeHolder' => 'prénom',
                                                                        'style'=>"width:200px;"
                                                                    )) )
            ->add('username','text',array('label'=>'Login : ','attr'=> array(
                                                                        'data-dojo-type' =>'dijit/form/TextBox',
                                                                        'data-dojo-props' =>"id:'referent_username_$this->niv'",                      
                                                                        'placeHolder' => 'login',
                                                                        'style'=>"width:200px;"
                                                                    )) )

//            ->add('salt')
            ->add('password', 'repeated', array(
               'label'=>'Mot de passe : ',
               'first_options'  => array('label' => 'Mot de passe : ','attr'=> array('data-dojo-type' =>'dijit/form/TextBox',
                                                                                     'data-dojo-props' =>"id:'referent_password_first_$this->niv'",
                                                                                     'placeHolder' => 'mot de passe',
                                                                                     'style'=>"width:200px;")),
               'second_options' => array('label' => 'Confirmer : ','attr'=> array('data-dojo-type' =>'dijit/form/TextBox',
                                                                                  'data-dojo-props' =>"id:'referent_password_second_$this->niv'",                   
                                                                                  'placeHolder' => 'confirmer le mot de passe',
                                                                                  'style'=>"width:200px;")),
               'type'        => 'password',
                                         ) )                 
            ->add('email','email',array('label'=>'mail : ','attr'=> array(
                                                                        'data-dojo-type' =>'dijit/form/TextBox',
                                                                        'data-dojo-props' =>"id:'referent_email_$this->niv'",    
                                                                        'placeHolder' => 'mail',
                                                                        'style'=>"width:200px;"
                                                                    )) )
            ->add('fixe','text',array('label'=>'Tél Fixe : ','attr'=> array(
                                                                        'data-dojo-type' =>'dijit/form/TextBox',
                                                                        'data-dojo-props' =>"id:'referent_fixe_$this->niv'",    
                                                                        'placeHolder' => 'fixe',
                                                                        'style'=>"width:200px;"
                                                                    )) )
            ->add('mobile','text',array('label'=>'Tél Mobile : ','attr'=> array(
                                                                        'data-dojo-type' =>'dijit/form/TextBox',
                                                                        'data-dojo-props' =>"id:'referent_mobile_$this->niv'",    
                                                                        'placeHolder' => 'mobile',
                                                                        'style'=>"width:200px;"
                                                                    )) )

//            ->add('signature')
//            ->add('signatureweb')
            ->add('file','file',array('label'=>'signature : ',
//                                        'mapped' => false,
                                        'required'=>false,
                                        'attr' => array('onchange'=>"loadimage(this,'$this->caneva')")
                                        )
                    )               
//            ->add('signatureweb')   
            ->add('file1','file',array('label'=>'signatureweb : ',
//                                        'mapped' => false,
                                        'required'=>false,  
                                        'attr' => array('onchange'=>"loadimage(this,'$this->canevaweb')")                
                                        )
                    )                  
            ->add('isActive')
//            ->add('createdAt')
//            ->add('updatedAt')
//            ->add('connectedAt')
            ->add('groupes',null,array('label'=>'Groupes : '))                  
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\PmeBundle\Entity\Referents'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acme_pmebundle_referents';
    }
}
