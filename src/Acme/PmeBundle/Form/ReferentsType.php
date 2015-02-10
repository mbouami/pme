<?php

namespace Acme\PmeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReferentsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('username')
            ->add('salt')
            ->add('password')
            ->add('email')
            ->add('fixe')
            ->add('mobile')
            ->add('signature')
            ->add('signatureweb')
            ->add('isActive')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('connectedAt')
            ->add('civilite')
            ->add('groupes')
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
