<?php
namespace Usuarios\Model;
use Zend\Db\ResultSet\ResultSet;

class UsuarioInventario
{
    private $_dbAdapter;

    
    
    public function crearInv($id_u)
    {
    
	      $sql = "SELECT * FROM modelo_UsuarioInventario WHERE id_usuario = ?";
	      $optionalParameters = array($id_u);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();    
	  
	  for($i = 0; $i < $result->count(); $i++)
	  {
	      $this->setObjeto($result->current(), $i);
	  }
	  
	
    }
    
    public function setObjeto($row, $i)
    {
	$this->$row['id_inventario'] = $row;
    }

    
    public function getInv()
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