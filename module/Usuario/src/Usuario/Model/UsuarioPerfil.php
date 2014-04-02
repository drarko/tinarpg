<?php
namespace Usuarios\Model;
use Zend\Db\ResultSet\ResultSet;

class UsuarioPerfil
{

    private $_dbAdapter;

    public function crearPerfil($id)
    {
	      
	      $sql = "SELECT * FROM portal_usuario_perfil WHERE id_usuario = ?";
	      $optionalParameters = array($id);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();
	      
	      for($i=0; $i < $result->count(); $i++)
	      {
		$row = $result->current();
		$this->setCampo($row['campo'],$row['valor']);
	      }    
    
    }

    public function setCampo($campo, $valor)
    {
	$this->$campo = $valor;
    }

    public function getPerfil()
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