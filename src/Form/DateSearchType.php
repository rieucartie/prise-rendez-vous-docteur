<?php
namespace App\Form;
use App\Entity\DateSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DateSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateSearch1', DateType::class,[
                'required'=>false,
                'label'=>'date à choisir',
                 // adds a class that can be selected in JavaScript
                 //'attr' => ['class' => 'js-datepicker'],
                'widget' => 'single_text'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DateSearch::class,
            'method'     => 'post',
            'csrf_protection'       => 'false'
        ]);
    }
    public function getBlockPrefix()
    {
        return '';
    }
}
