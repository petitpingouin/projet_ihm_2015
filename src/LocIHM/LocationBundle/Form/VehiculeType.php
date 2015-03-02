<?php

namespace LocIHM\LocationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VehiculeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('marque')
            ->add('modele')
            ->add('puissance')
            ->add('couleur')
            ->add('prixJournalier')
            ->add('typeVehicule')
            ->add('agence')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LocIHM\LocationBundle\Entity\Vehicule'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'locihm_locationbundle_vehicule';
    }
}
