<?php

namespace Pv\MyBundle\Templating;

use Symfony\Component\DependencyInjection\ContainerInterface;
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
                array('%count%' => $count), 'PvMyBundle');
        }

        return date($trans->trans('date.format.format', array(), 'PvMyBundle'), $date);
    }

    public function svc($id)
    {
        return $this->container->get($id);
    }
}
