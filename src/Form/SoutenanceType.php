<?php

namespace App\Form;

use App\Entity\Enseignant;
use App\Entity\Etudiant;
use App\Entity\Soutenance;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SoutenanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateSoutenance')
            ->add('note')
            ->add('enseignant', EntityType::class, [
                'class' => Enseignant::class,
                'choice_label' => 'matricule', // You can change this to any appropriate property
            ])
            ->add('etudiant', EntityType::class, [
                'class' => Etudiant::class,
                'choice_label' => 'nce', // Adjust this if needed
            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Soutenance::class,
        ]);
    }
}
