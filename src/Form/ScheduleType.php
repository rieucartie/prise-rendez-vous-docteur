<?php

namespace App\Form;

use App\Entity\Schedule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScheduleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $jours = $options['jourdelasemaine'];


        $builder
            ->add('ScheduleDate',DateType::class,[
                "label" => "Date :",
                'widget'=>'single_text'
            ])
            ->add('ScheduleDay', ChoiceType::class, [
                "label" => "Jour :",
                'choices' => array(
                    'Lundi' => 'Lundi',
                    'Mardi' => 'Mardi',
                    'Mercredi' => 'Mercredi',
                    'Jeudi' => 'Jeudi',
                    'Vendredi' => 'Vendredi',
                    'Samedi' => 'Samedi',
                    'Dimanche'=>'Dimanche'
                ),
            ])
            ->add('StartTime', TimeType::class, [
                'widget' => 'single_text',
                'label' => 'Debut',
                'error_bubbling' => true,
                'attr' => array('class' => 'time-picker'),
                'model_timezone' => 'UTC',
            ])
            ->add('EndTime',TimeType::class, [
                'widget' => 'single_text',
               "label" => "Fin :",
                'error_bubbling' => true,
                'attr' => array('class' => 'time-picker'),
                'model_timezone' => 'UTC',
            ])
            ->add('BookAvail', ChoiceType::class, [
                "label" => "A eu lieu :",
                'choices' =>  [
                    'non' => 'non disponible',
                    'oui' => 'disponible',
                ],
                'expanded' => true,  // => boutons
                'data' =>  'disponible'//valeur par defaut
            ])

            ->add('submit',SubmitType::class, [
                "label" => "Enregistrer :",

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Schedule::class, 'jourdelasemaine' => []
        ]);
    }

}
