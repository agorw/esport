<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\TicketAgenda;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TicketAgendaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_event')
            ->add('title')
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Tournoi' => 0,
                    'Festival' => 1,
                    'Stream' => 2,
                    'Autres' => 3,
                ],
            ])
            ->add('description');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TicketAgenda::class,
        ]);
    }
}
