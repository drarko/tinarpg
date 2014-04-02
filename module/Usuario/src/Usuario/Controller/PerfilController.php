<?php

namespace Usuarios\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class PerfilController extends AbstractActionController
{
    public function indexAction()
    {
        return array();
    }

    public function registrarAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /module-specific-root/skeleton/foo
        return array();
    }
}
