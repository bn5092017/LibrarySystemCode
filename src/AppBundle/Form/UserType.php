<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username')
            ->add('firstname')
            ->add('lastname')
            ->add('address')
            ->add('email')
            ->add('plainPassword')//plainPassword input into forms, see PasswordListener class
            ->add('roles', ChoiceType::class, [//renders options instead of free-text textbox
                'multiple' => true,//allows multiple selection
                'expanded' => true,//renders checkboxes if multiple is true or else radio buttons
                'choices' => [
                    'user' => 'ROLE_USER',
                    'staff' => 'ROLE_STAFF'
                ]
            ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}
