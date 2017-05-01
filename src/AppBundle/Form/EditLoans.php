<?php
/**
 * Created by PhpStorm.
 * User: jennifer
 * Date: 29/04/17
 * Time: 18:08
 */

namespace AppBundle\Form;



use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class EditLoans extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //no need to modify the dateOut property
        $builder->add('bookIsbn')
            ->add('dateDueBack', DateType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Loans'
        ));
    }
}
