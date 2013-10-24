<?php

namespace Pv\MyBundle\Form;

use Symfony\Component\Form\DataTransformerInterface;

class TagsTransformer implements DataTransformerInterface
{
    public function transform($tags)
    {
        $tags = $tags ?: array();

        return implode(', ', $tags);
    }

    public function reverseTransform($tags)
    {
        $tags = $tags ?: '';

        return array_filter(array_map('trim', explode(',', $tags)));
    }
}
