<?php
namespace Articulos\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Articulo implements ServiceLocatorAwareInterface
{

    public $id_articulo;
    public $id_padre;
    
    public $id_usuario;
    public $usuario;
    
    public $fecha;
    
    public $titulo;
    public $resumen;
    public $texto;
    
    public $id_tipo;
    public $tipo;
    

    protected $_dbAdapter;
    protected $services;    
    
    
    
    public function crearArticulo($id)
    {
    
	if($id != 0)
	{
	      $sql = "SELECT * FROM modelo_Articulo WHERE id_articulo = ?";
	      $optionalParameters = array($id);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();
	      
	      if($result->count() == 0)
	      {
		  throw new \Exception("No se encuentra el articulo $id");
	      }else if ($result->count() > 1)
	      {
		  throw new \Exception("Hay multiples articulos $id");
	      }
	      
	      $row = $result->current();
	      
	      $this->id_articulo = $id;
	      $this->id_padre = $row['id_articulo_padre'];	      
	      
	      $this->id_usuario = $row['id_usuario'];
	      $this->usuario = $row['usuario'];
	      
	      $this->fecha = $row['fecha'];

	      $this->titulo = $row['titulo'];
	      $this->resumen = $row['resumen'];
	      $this->texto = $row['texto'];
	      
	      $this->id_tipo = $row['id_articulo_tipo'];
	      $this->tipo = $row['tipo'];
	}    
    }
    
    public function getArticulo()
    {
      return $this;
    }
    
    public function getHijos()
    {
	      $sql = "SELECT id_articulo, id_articulo_tipo FROM modelo_Articulo WHERE id_articulo_padre = ?";
	      $optionalParameters = array($this->id_articulo);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();    
	      
	      $hijos = array();
	      
	      for($i = 0;$i < $result->count(); $i++)
	      {
		  $hijos[$i] = $result->current();
	      }
	      
	      return $hijos;
    }
    
    public function nuevoArticulo($padre, $usuario, $fecha, $titulo, $resumen, $texto, $tipo)
    {
	$data1 = array($tipo,$usuario,$fecha,$titulo,$resumen,$padre);
	
	$sql = "INSERT INTO portal_articulo VALUES(0, ?, ?, ?, ?, ?, ?)";
	$optionalParameters = $data1;
	$statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	$result = $statement->execute();    
	
	$id_articulo = $this->_dbAdapter->getDriver()->getLastGeneratedValue();
	
	$data2 = array($id_articulo,$texto);
    
	$sql = "INSERT INTO portal_articulo_texto VALUES(0, ?, ?)";
	$optionalParameters = $data2;
	$statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	$result = $statement->execute();    
    
    
    }
    
    public function aprobarModeracion()
    {
	if($this->id_tipo == 5)
	{
	  $this->id_tipo = 2;
	}
	if($this->id_tipo == 6)
	{
	  $this->id_tipo = 1;
	}
	if($this->id_tipo == 7)
	{
	  $this->id_tipo = 3;
	}

	$sql = "UPDATE portal_articulo SET id_articulo_tipo = ? WHERE id_articulo = ?";
	$optionalParameters = array($this->id_tipo, $this->id_articulo);
	$statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	$result = $statement->execute();    
    
    }
    
    public function eliminarPorReportado()
    {
	$sql = "UPDATE portal_articulo SET id_articulo_tipo = ? WHERE id_articulo = ?";
	$optionalParameters = array(8, $this->id_articulo);
	$statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	$result = $statement->execute();    
    
	$sql = "DELETE FROM portal_articulo WHERE id_articulo = ?";
	$optionalParameters = array($this->id_articulo);
	$statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	$result = $statement->execute();    

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
