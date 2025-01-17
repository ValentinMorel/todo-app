<?php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Task Name',
                'required' => true,
            ])
            ->add('isCompleted', CheckboxType::class, [
                'label' => 'Completed',
                'required' => false,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Save Task',
            ]);
    }
}
