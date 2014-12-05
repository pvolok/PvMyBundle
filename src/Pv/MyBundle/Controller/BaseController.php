<?php

namespace Pv\MyBundle\Controller;

use Doctrine\ODM\MongoDB\DocumentManager;
use Pv\MyBundle\Helper\CC;
use Pv\MyBundle\Helper\HH;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Translation\TranslatorInterface;

class BaseController extends Controller
{
    /**
     * @return HH
     */
    protected function hh()
    {
        return $this->get('pv.hh');
    }

    /**
     * @return CC
     */
    protected function cc()
    {
        return $this->get('pv.cc');
    }

    /**
     * @return DocumentManager
     */
    protected function getDM()
    {
        return $this->get('doctrine.odm.mongodb.document_manager');
    }

    protected function findOrThrow($documentName, $id, $msg = 'Not Found')
    {
        $obj = $this->getDM()->find($documentName, $id);

        if (!$obj) {
            throw $this->createNotFoundException($msg);
        }

        return $obj;
    }

    protected function addFlashMessage($type, $message)
    {
        /** @var Session $session */
        $session = $this->get('session');

        $session->getFlashBag()->add($type, $message);
    }

    protected function trans($id, $parameters = array(), $domain = null, $locale = null)
    {
        /** @var TranslatorInterface $translator */
        $translator = $this->get('translator');

        return $translator->trans($id, $parameters, $domain, $locale);
    }

    protected function secure($attributes)
    {
        if (!$this->isGranted($attributes)) {
            throw new AccessDeniedException();
        }
    }

    /**
     * @return FormBuilder
     */
    protected function createNamedFormBuilder($name, $type = 'form', $data = null, $options = array())
    {
        return $this->get('form.factory')->createNamedBuilder($name, $type, $data, $options);
    }
}
