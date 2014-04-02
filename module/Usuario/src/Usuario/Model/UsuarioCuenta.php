<?php
namespace Usuarios\Model;
use Zend\Db\ResultSet\ResultSet;

class UsuarioCuenta
{
    private $_dbAdapter;
    
    
    public $saldo;
    public $moneda;
    public $simbolo;
    
    public $id_banco;
    public $id_moneda;
    public $tipo_cambio;
    
    public function crearCuenta($id_u)
    {
    
	      $sql = "SELECT * FROM modelo_UsuarioCuenta WHERE id_usuario = ?";
	      $optionalParameters = array($id_u);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();    
	      
	      $cuenta = $result->current();
	      
	      $this->saldo = $cuenta['saldo'];

	      $this->id_banco = $cuenta['id_banco'];
	      
	      $this->id_moneda = $cuenta['id_moneda'];
	      $this->moneda = $cuenta['moneda'];
	      $this->simbolo = $cuenta['simbolo'];
	      
	      $this->tipo_cambio = $cuenta['tipo_cambio'];
	      
    }
    
    public function getCuenta()
    {
	return $this;
    }
    
    public function setDbAdapter($dbAdapter) {
        $this->_dbAdapter = $dbAdapter;
    }

    public function getDbAdapter() {
        return $this->_dbAdapter;
   }   

}