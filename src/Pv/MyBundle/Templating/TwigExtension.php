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
            new \Twig_SimpleFilter('pv_date', array($this->html, 'formatDate')),
        );
    }

    public function getName()
    {
        return 'pv';
    }
}