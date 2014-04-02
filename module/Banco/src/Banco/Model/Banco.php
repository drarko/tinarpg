<?php

namespace Banco\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


Class Banco implements ServiceLocatorAwareInterface 
{

    public $id_banco;
    public $id_padre;
    
    public $nombre;
    public $descripcion;
    
    public $reservas;

    public $es_sucursal;
    
    public $tipo_cambio;
    
    public $id_moneda;
    public $moneda;
    public $simbolo;

    protected $_dbAdapter;
    protected $services;    

    public function crearBanco($id)
    {
    
	if($id != 0)
	{
	      $sql = "SELECT * FROM portal_banco WHERE id_banco = ?";
	      $optionalParameters = array($id);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();
	      
	      if($result->count() == 0)
	      {
		  throw new \Exception("No se encuentra el banco $id");
	      }else if ($result->count() > 1)
	      {
		  throw new \Exception("Hay multiples bancos $id");
	      }
	      
	      $row = $result->current();
	      
	      $this->id_banco = $row['id_banco'];
	      $this->id_padre = $row['id_banco_padre'];
	      
	      $this->nombre = $row['nombre'];
	      $this->descripcion = $row['descripcion'];
	      
              $this->id_moneda = $row['id_moneda'];
              
              $sql = "SELECT * FROM portal_banco_moneda WHERE id_moneda = ?";
	      $optionalParameters = array($this->id_moneda);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();
	      
	      $mon = $result->current();
	      
	      $this->moneda = $mon['moneda'];
	      $this->simbolo = $mon['simbolo'];
	      
              $sql = "SELECT * FROM portal_banco_moneda_cambio WHERE id_banco = ?";
	      $optionalParameters = array($this->id_banco);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();
	      
	      $cambio = $result->current();
	      
	      $this->tipo_cambio = $cambio['valor'];
	      
	      
	      $this->esSucursal();

	      if($this->es_sucursal == 1)
	      {
		$sql = "SELECT * FROM portal_banco WHERE id_banco = ?";
		$optionalParameters = array($this->id_padre);
		$statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
		$result = $statement->execute();
		
		$resv = $result->current();
		
		$this->reservas = $resv['reservas'];
	      
	      }else
	      {
		  $this->reservas = $row['reservas'];
	      
	      }

	      $this->descripcion = str_replace("\n","<br>",$this->descripcion);
	 }    
    }
    
    public function esSucursal()
    {
	if($this->id_padre == 0)
	  $this->es_sucursal = 0;
	else
	  $this->es_sucursal = 1;
	  
	return $this->es_sucursal;
    
    }

    public function getCantSucursales()
    {
	      $sql = "SELECT id_banco FROM portal_banco WHERE id_banco_padre = ?";
	      $optionalParameters = array($this->id_banco);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();    
	      
	      return $result->count();      
    }
    
    public function getSucursales()
    {
	      $sql = "SELECT * FROM portal_banco WHERE id_banco_padre = ?";
	      $optionalParameters = array($this->id_banco);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();    
	      
	      $hijos = array();
	      
	      for($i = 0;$i < $result->count(); $i++)
	      {
		  $hijos[$i] = $result->current();
	      }
	      
	      return $hijos;
    }
    
    public function getBancos()
    {
    
	      $sql = "SELECT * FROM portal_banco WHERE id_banco_padre = 0";
	      
	      $statement = $this->_dbAdapter->createStatement($sql);
	      $result = $statement->execute();  
	      
	      
	      return $result;
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
