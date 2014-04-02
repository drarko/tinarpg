<?php

namespace Contenido\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ControllerPrivate;

class ModerarController extends ControllerPrivate
{
  public function pendientesAction()
  {
	$query = new \Zend\Db\Sql\Select("modelo_Articulo");
	$query->where("id_articulo_tipo = 5 OR id_articulo_tipo = 6 OR id_articulo_tipo = 7");
	$query->order('fecha DESC');
	
	
	$adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
	$paginator = new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\DbSelect($query, $adapter));        
	
	$paginator->setCurrentPageNumber($this->params()->fromRoute('page'));
	$paginator->setItemCountPerPage(5);
	
	$vm = new ViewModel();
	$vm->setVariable('paginator', $paginator);
	$vm->messages = $this->flashmessenger()->getMessages();
	return $vm;  
  
  }
  public function reportadosAction()
  {
	$query = new \Zend\Db\Sql\Select("modelo_Articulo");
	$query->join(
		'portal_articulo_reporte', // table name,
		'modelo_Articulo.id_articulo = portal_articulo_reporte.id_articulo');// (optional), one of inner, outer, left, right also represtned by constants in the API
	$query->order('fecha DESC');
	
	
	$adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
	$paginator = new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\DbSelect($query, $adapter));        
	
	$paginator->setCurrentPageNumber($this->params()->fromRoute('page'));
	$paginator->setItemCountPerPage(5);
	
	$vm = new ViewModel();
	$vm->setVariable('paginator', $paginator);
	$vm->messages = $this->flashmessenger()->getMessages();
	return $vm;  
  
  }
  
  public function aprobarAction()
  {
    $data = $this->request->getPost();
    $art = $this->getServiceLocator()->get("Articulos/Model/Articulo");
    $art->crearArticulo($data['art']);
    
    $art->aprobarModeracion();
    
    $this->flashmessenger()->addMessage("Articulo aprobado");
    return $this->redirect()->toUrl("/articulos/moderar/pendientes");
  }
  
  public function eliminarAction()
  {
    $data = $this->request->getPost();
    $art = $this->getServiceLocator()->get("Articulos/Model/Articulo");
    $art->crearArticulo($data['art']);
    
    $art->eliminarPorReportado();
    
    $this->flashmessenger()->addMessage("Articulo eliminado");
    return $this->redirect()->toUrl("/articulos/moderar/reportados");
  }
  
  public function indexAction()
  {
    return $this->response;
  }
}