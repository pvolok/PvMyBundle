<?php

namespace Pv\MyBundle\Templating;

class TwigExtension extends \Twig_Extension
{
    private $html;

    public function __construct(HtmlHelper $html)
    {
        $this->html = $html;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('pv_date', [$this->html, 'formatDate']),
        );
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('pv_link', [$this->html, 'link'],
                ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('pv_svc', [$this->html, 'svc']),
            new \Twig_SimpleFunction('pv_pagelet', [$this->html, 'pagelet'],
                ['is_safe' => ['html']]),
        );
    }

    public function getName()
    {
        return 'pv';
    }
}
