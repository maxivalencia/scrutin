<?php

namespace App\Form;

use App\Entity\Resultat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResultatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('CreatedAt')
            ->add('bureau')
            ->add('candidat')
            ->add('tour')
            ->add('vote')
            ->add('session')
            ->add('code')
            ->add('utilisateur')
            ->add('mode')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Resultat::class,
        ]);
    }
}
