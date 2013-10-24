<?php

namespace Pv\MyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TagsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addViewTransformer(new TagsTransformer());
    }

    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'tags';
    }
}
