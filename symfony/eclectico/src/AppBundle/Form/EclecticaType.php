<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use AppBundle\Entity\Eclectica;

class EclecticaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('esVerdad', CheckboxType::class)
                ->add('name', TextType::class)
                ->add('email', EmailType::class)
                ->add('ipHost', TextType::class)
                ->add('puntuacion', RangeType::class)
                ->add('fecha', DateType::class)
                ->add('difuso', ChoiceType::class, [
                    'choices' => [
                        'blanco' => 'blanco',
                        'negro' => 'negro',
                        'gris' => 'gris'
                    ]
                        ]
                )
                ->add('pais', TextType::class)
                ->add('numeroPar', IntegerType::class)
                ->add('save', SubmitType::class, array('label' => 'Crear registro'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Eclectica::class,
        ));
    }

}
