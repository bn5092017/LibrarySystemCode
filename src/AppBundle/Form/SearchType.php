<?php
/**
 * Created by PhpStorm.
 * User: jennifer
 * Date: 08/04/17
 * Time: 20:18
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('author')
            ->add('title')
            ->add('catagory', ChoiceType::class, [//renders options instead of free-text textbox
                'multiple' => true,//allows multiple selection
                'expanded' => true,//renders checkboxes if multiple is true or else radio buttons
                'choices' => [
                    'biography' => 'biography',
                    'children' => 'children',
                    'fiction' => 'fiction',
                    'sci-fi and fantasy' => 'sci-fi and fantasy'
                    ]
            ])
            ;
    }

}