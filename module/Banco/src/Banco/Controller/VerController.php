<?php

namespace Banco\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Controller\ControllerPrivate;

class VerController extends ControllerPrivate
{
      
  public function infoAction()
  {
      $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');  
      
      if($this->params()->fromRoute('id') != null)
      {
	$em = $this->getServiceLocator()->get('Service\Banco');
	$ban = $em->getBanco($this->params()->fromRoute('id'));
	
	$this->view->banco = $ban;
      
	$this->view->lista = 0;
	return $this->view;
      }
      
	$lb = $em->getRepository('Entities\Banco\Banco')->findAll();

	$this->view->listab = $lb;
	$this->view->lista = 1;
	
	$this->view->messages = $this->flashmessenger()->getMessages();
	return $this->view;  
  
  }

  public function primeraAction()
  {
    if($this->getRequest()->isPost())
    {
      $data = $this->getRequest()->getPost();
      
      $u = $this->getServiceLocator()->get("Usuarios/Model/Usuario");
      $u->crearUsuario($this->getServiceLocator()->get('AuthService')->getIdentity());

      if($u->region->id_region == 28)
      {
	$u->elegirRegion($data['id_region']);
      
	$this->flashmessenger()->addMessage("Has seleccionado tu región de inicio con éxito");
	return $this->redirect()->toUrl('/');
      }else
      {
	$this->flashmessenger()->addMessage("Error. Ya tienes una región de inicio definida.");
	return $this->redirect()->toUrl('/');

      }
    }
  
    return $this->response;
  }
  
  public function indexAction()
  {
    return $this->response;
  }
}