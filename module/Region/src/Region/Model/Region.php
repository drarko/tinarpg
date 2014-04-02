<?php

namespace Regiones\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


Class Region implements ServiceLocatorAwareInterface 
{

    public $id_region;
    public $id_padre;
    
    public $nombre;
    public $descripcion;
    public $imagen;


    protected $_dbAdapter;
    protected $services;    

    public function crearRegion($id)
    {
    
	if($id != 0)
	{
	      $sql = "SELECT * FROM portal_region WHERE id_region = ?";
	      $optionalParameters = array($id);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();
	      
	      if($result->count() == 0)
	      {
		  throw new \Exception("No se encuentra la region $id");
	      }else if ($result->count() > 1)
	      {
		  throw new \Exception("Hay multiples regiones $id");
	      }
	      
	      $row = $result->current();
	      
	      $this->id_region = $row['id_region'];
	      $this->id_padre = $row['id_region_padre'];
	      
	      $this->nombre = $row['nombre'];
	      $this->descripcion = $row['descripcion'];
	      $this->imagen = $row['imagen'];

	      $this->descripcion = str_replace("\n","<br>",$this->descripcion);
	 }    
    }
    

    public function getCantHijos()
    {
	      $sql = "SELECT id_region FROM portal_region WHERE id_region_padre = ?";
	      $optionalParameters = array($this->id_region);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();    
	      
	      return $result->count();      
    }
    
    public function getHijos()
    {
	      $sql = "SELECT * FROM portal_region WHERE id_region_padre = ?";
	      $optionalParameters = array($this->id_region);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();    
	      
	      $hijos = array();
	      
	      for($i = 0;$i < $result->count(); $i++)
	      {
		  $hijos[$i] = $result->current();
	      }
	      
	      return $hijos;
    }
    public function setDbAdapter($dbAdapter) {
        $this->_dbAdapter = $dbAdapter;
    }

    public function getDbAdapter() {
        return $this->_dbAdapter;
   }   

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->services = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->services;
    }             
}
