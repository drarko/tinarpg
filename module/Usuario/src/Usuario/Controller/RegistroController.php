<?php

namespace Usuario\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Usuario\Model\Usuario;          // <-- Add this import
use Usuario\Form\RegistroForm;       // <-- Add this import

class RegistroController extends AbstractActionController
{

    protected $usuarioTable;

    public function indexAction()
    {
        return array();
    }

    public function registrarAction()
    {
        if($this->identity !== FALSE){
            return $this->redirect()->toUrl('/');
        }
     
	$form = $this->getServiceLocator()->get('Usuario/Form/RegistroForm');
	$u = $this->getServiceLocator()->get('Usuario/Model/Usuario');
            
        $request = $this->getRequest();
        if ($request->isPost()) {
       
          
            $form->setData($request->getPost());

            if ($form->isValid()) {
            
                
                $data = $form->getData();
                $u->nuevoUsuario($data['usuario'],$data['clave'],$data['email']);
                
                return $this->redirect()->toUrl('/');
            }
        }
        $this->view->form = $form;
        return $this->view;
    }
    
}
