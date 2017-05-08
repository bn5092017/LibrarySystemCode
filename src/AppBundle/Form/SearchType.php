<?php
/**
 * Created by PhpStorm.
 * User: jennifer
 * Date: 08/04/17
 * Time: 20:18
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('author')
            ->add('title')
            ->add('catagory')
            ;
    }

}