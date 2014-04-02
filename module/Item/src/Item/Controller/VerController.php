<?php

namespace Region\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class VerController extends AbstractActionController
{
  public function infoAction()
  {
      if($this->params()->fromRoute('id') != null)
      {
	
	$reg = $this->getServiceLocator()->get("Region/Model/Region");
        $reg->crearRegion($this->params()->fromRoute('id'));
      
	$hijos = 0;
	$accion = "Sin acciones disponibles";
	
	if($reg->getCantHijos() > 0)
	{
	    $hijos = $reg->getHijos();

	    for($i=0;$i < $reg->getCantHijos(); $i++)
	    {
	      $hijos[$i]['accion'] = "Sin acciones disponibles";
	    }
	}

	if($u->region->id_region == 28)
	{
	    $accion = "<form method=\"post\" action=\"/regiones/ver/primera\"><input type=\"hidden\" name=\"id_region\" value=\"".$reg->id_region."\"><a href=\"#\" onclick=\"$(this).parent().submit();\">Elegir como regi&oacute;n de inicio</a></form>";
	    
	    if($reg->getCantHijos() > 0)
	    {
		for($i=0;$i < $reg->getCantHijos(); $i++)
		{
		  $hijos[$i]['accion'] = "<form method=\"post\" action=\"/regiones/ver/primera\"><input type=\"hidden\" name=\"id_region\" value=\"".$hijos[$i]['id_region']."\"><a href=\"#\" onclick=\"$(this).parent().submit();\">Elegir como regi&oacute;n de inicio</a></form>";
		}
	    }
	    
	}
	
	$this->view->nombre =  $reg->nombre;
	$this->view->descripcion =  $reg->descripcion;
	$this->view->imagen =  $reg->imagen;
	$this->view->canth =  $reg->getCantHijos();
	$this->view->hijos =  $hijos;
	$this->view->mapa =  0;
	$this->view->accion =  $accion;
	
	return $this->view;
		 
      }
  
	$this->view->mapa = 1;
	
	return $this->view;  
  
  }

  public function primeraAction()
  {
    if($this->getRequest()->isPost())
    {
      $data = $this->getRequest()->getPost();

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