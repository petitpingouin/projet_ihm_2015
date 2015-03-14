<?php

namespace LocIHM\LocationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContratType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDebut', 'date', array(
                'input'=>'string',
                'widget'=>'single_text',
                'format'=>'dd-MM-yyyy',))
            ->add('dateFin', 'date', array(
                'input'=>'string',
                'widget'=>'single_text',
                'format'=>'dd-MM-yyyy',))
            ->add('user')
            ->add('vehicule', 'entity', array(
                'class' => 'LocIHMLocationBundle:Vehicule',
            ))
            ->add('forfait', 'entity', array(
                'class' => 'LocIHMLocationBundle:Forfait',
                'property' => 'Nom',
            ))
            ->add('submit', 'submit');
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LocIHM\LocationBundle\Entity\Contrat'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'locihm_locationbundle_contrat';
    }
}
