<?php

namespace Theodo\Bundle\ScrumOrNotScrumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterScrumQuizType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('authorName', 'text', array(
                'required' => true,
            ))
            ->add('question', 'textarea', array(
                'required' => true,
            ))
            ->add('answer', 'choice', array(
                'choices'   => array(
                    true  => 'true',
                    false => 'false',
                ),
                'expanded' => true,
                'required' => true,
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Theodo\Bundle\ScrumOrNotScrumBundle\Entity\ScrumQuiz'
        ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'register_scrum_quiz';
    }
}