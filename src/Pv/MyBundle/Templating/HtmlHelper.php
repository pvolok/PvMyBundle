<?php

namespace Pv\MyBundle\Templating;

use Pv\MyBundle\PageletLib\PageletManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Translation\TranslatorInterface;

class HtmlHelper
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function formatDate($date)
    {
        /** @var TranslatorInterface $trans */
        $trans = $this->container->get('translator');

        if ($date instanceof \DateTime) {
            $date = $date->getTimestamp();
        }
        $diff = time() - $date;

        if ($diff < 60 * 60) {
            $msg = 'date.format.minutes_ago';
            $count = round($diff / 60);
        } elseif ($diff < 3600 * 48) {
            $msg = 'date.format.hours_ago';
            $count = round($diff / 3600);
        } elseif ($diff < 3600 * 24 * 30) {
            $msg = 'date.format.days_ago';
            $count = round($diff / (3600 * 24));
        }

        if (isset($msg, $count)) {
            return $trans->transChoice($msg, $count,
                ['%count%' => $count], 'PvMyBundle');
        }

        return date($trans->trans('date.format.format', [], 'PvMyBundle'),
            $date);
    }

    public function link($url, $label, $attrs = [], $tokenId = 'pv_def')
    {
        /** @var CsrfTokenManagerInterface $csrfTokenManager */
        $csrfTokenManager = $this->container->get('security.csrf.token_manager');
        $csrf = $csrfTokenManager->getToken($tokenId)->getValue();

        $html = "<form action='$url' method='post' style='display: inline-block'>";
        $html .= '<input type="hidden" name="token_" value="'.$csrf.'">';
        $html .= '<button';
        $attrs['type'] = 'submit';
        foreach ($attrs as $attr => $value) {
            $html .= ' '.$attr.'="'.htmlentities($value).'"';
        }
        $html .= '>'.$label.'</button>';
        $html .= '</form>';

        return $html;
    }

    public function svc($id)
    {
        return $this->container->get($id);
    }

    public function pagelet($name, $args = [])
    {
        /** @var PageletManager $pm */
        $pm = $this->container->get('pv.pagelet_manager');
        return $pm->render($name, $args);
    }
}
