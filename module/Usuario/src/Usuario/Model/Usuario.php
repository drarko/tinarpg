<?php

namespace Usuarios\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Usuario implements ServiceLocatorAwareInterface
{
    public $id;
    public $usuario;
    public $email;
    public $clave;
    public $perfil;
    public $cuenta;
    public $objetos;
    public $mascotas;
    public $region;
    public $zona;
    public $rol;
    
    private $_dbAdapter;
    protected $services;
    
    
    public function crearUsuario($id = 0)
    {
    
	if($id != 0)
	{
	    $this->getDatosBasicos($id);
	    $this->getPerfil($id);
	    $this->getCuenta($id);
	    $this->getInv($id); 
	    $this->getMascotas($id);
	    $this->getRegion($id); 
	}
    }
    
    public function getDatosBasicos($id)
    {
	      $sql = "SELECT * FROM portal_usuario WHERE id_usuario = ?";
	      $optionalParameters = array($id);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();
	      
	      if($result->count() == 0)
	      {
		  throw new \Exception("No se encuentra el usuario $id");
	      }else if ($result->count() > 1)
	      {
		  throw new \Exception("Hay multiples usuarios $id");
	      }
	      
	      $row = $result->current();
	      
	      $this->id = $id;
	      $this->usuario = $row['usuario'];
	      $this->clave = $row['clave'];
	      $this->email = $row['email'];
    }
    
    public function getPerfil($id)
    {
	      $p = $this->getServiceLocator()->get('Usuarios/Model/UsuarioPerfil');
	      $p->crearPerfil($id);
	      $this->perfil = $p->getPerfil();
    }
    
    public function getCuenta($id)
    {
	      $p = $this->getServiceLocator()->get('Usuarios/Model/UsuarioCuenta');
	      $p->crearCuenta($id);
	      $this->cuenta = $p->getCuenta();
    }
    
    public function getInv($id)
    {
	      $p = $this->getServiceLocator()->get('Usuarios/Model/UsuarioInventario');
	      $p->crearInv($id);
	      $this->objetos = $p->getInv();
    }
    
    public function getMascotas($id)
    {
	      $sql = "SELECT * FROM portal_usuario_mascota WHERE id_usuario = ?";
	      $optionalParameters = array($id);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();
	      

	      $this->mascotas = array();
	      
	      for($i = 0; $i < $result->count(); $i++)
	      {
		$r = $result->current();
		$this->mascotas[$i] = $r['id_mascota'];
	      }
    }    
   
    public function getRegion($id)
    {
	      $sql = "SELECT * FROM modelo_UsuarioRegion WHERE id_usuario = ?";
	      $optionalParameters = array($id);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();
	      

	      $r = $result->current();
	
	      $this->region = new \Regiones\Model\Region();
	      $this->region->setDbAdapter($this->getDbAdapter());
	      $this->region->crearRegion($r['id_region']);
      
    }
   
   
    public function nuevoUsuario($usuario, $clave, $email)
    {
	      $sql = "INSERT INTO portal_usuario VALUES (0, ?,?,?)";
	      $optionalParameters = array($usuario, SHA1($clave), $email);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();
    
	      $id_usuario = $this->_dbAdapter->getDriver()->getLastGeneratedValue();
	      $sql = "INSERT INTO portal_usuario_perfil VALUES (0, ?,?,?)";
	      $optionalParameters = array($id_usuario, "rol", "usuario");
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();    

	      
	      $sql = "INSERT INTO portal_usuario_region VALUES (0, ?,?)";
	      $optionalParameters = array($id_usuario, 28);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();    	      
    }
    public function actualizarUsuario($id, $usuario, $clave, $email)
    {
	      $sql = "UPDATE portal_usuario SET usuario = ?, clave = ?, email = ? WHERE id_usuario = ?";
	      $optionalParameters = array($usuario, SHA1($clave), $email, $id);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();
    
    }
    public function nuevoUsuarioFacebook($email, $facebook_id)
    {
	      $sql = "INSERT INTO portal_usuario VALUES (0, ?,?,?)";
	      $optionalParameters = array("_fb_", SHA1("_fb_"), "_fb_");
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();
    
    
	      $id_usuario = $this->_dbAdapter->getDriver()->getLastGeneratedValue();
	      $sql = "INSERT INTO portal_usuario_perfil VALUES (0, ?,?,?)";
	      $optionalParameters = array($id_usuario, "facebook_id", $facebook_id);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();

	      $sql = "INSERT INTO portal_usuario_perfil VALUES (0, ?,?,?)";
	      $optionalParameters = array($id_usuario, "rol", "usuario");
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();
	      
	      $sql = "INSERT INTO portal_usuario_region VALUES (0, ?,?)";
	      $optionalParameters = array($id_usuario, 28);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();    	      
	      
	      return $id_usuario;
    }    
    public function facebookUser($id_facebook)
    {
	      $sql = "SELECT * FROM portal_usuario_perfil WHERE campo = ? AND valor = ?";
	      $optionalParameters = array("facebook_id",$id_facebook);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();
	      
	      if($result->count() != null)
	      {
		$row = $result->current();
		$this->crearUsuario($row['id_usuario']);
		return $this;
	      }
	      else
		return false;
    
    }
    public function asociarFacebook($id_fb)
    {
	      
	      $sql = "INSERT INTO portal_usuario_perfil VALUES (0, ?,?,?)";
	      $optionalParameters = array($this->id, "facebook_id", $id_fb);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();    
    
    }
    public function asociarTwitter($token)
    {
	      
	      $sql = "INSERT INTO portal_usuario_perfil VALUES (0, ?,?,?)";
	      $optionalParameters = array($this->id, "twitter_id", $token['user_id']);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();

	      $sql = "INSERT INTO portal_usuario_perfil VALUES (0, ?,?,?)";
	      $optionalParameters = array($this->id, "twitter_token", $token['oauth_token']);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();

	      $sql = "INSERT INTO portal_usuario_perfil VALUES (0, ?,?,?)";
	      $optionalParameters = array($this->id, "twitter_token_secreat", $token['oauth_token_secret']);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();

    }    
    public function twitterUser($id_tw)
    {
	      $sql = "SELECT * FROM portal_usuario_perfil WHERE campo = ? AND valor = ?";
	      $optionalParameters = array("twitter_id",$id_tw);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();
	      
	      if($result->count() != null)
	      {
		$row = $result->current();
		$this->crearUsuario($row['id_usuario']);
		return $this;
	      }
	      else
		return false;
    
    }    
    public function nuevoUsuarioTwitter($token)
    {
	      $sql = "INSERT INTO portal_usuario VALUES (0, ?,?,?)";
	      $optionalParameters = array("_tw_", SHA1("_tw_"), $token['oauth_token']);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();
    
    
	      $id_usuario = $this->_dbAdapter->getDriver()->getLastGeneratedValue();
	      $sql = "INSERT INTO portal_usuario_perfil VALUES (0, ?,?,?)";
	      $optionalParameters = array($id_usuario, "twitter_id", $token['user_id']);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();

	      $sql = "INSERT INTO portal_usuario_perfil VALUES (0, ?,?,?)";
	      $optionalParameters = array($id_usuario, "twitter_token", $token['oauth_token']);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();

	      $sql = "INSERT INTO portal_usuario_perfil VALUES (0, ?,?,?)";
	      $optionalParameters = array($id_usuario, "twitter_token_secreat", $token['oauth_token_secret']);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();
	      
	      $sql = "INSERT INTO portal_usuario_perfil VALUES (0, ?,?,?)";
	      $optionalParameters = array($id_usuario, "rol", "usuario");
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();

	      $sql = "INSERT INTO portal_usuario_region VALUES (0, ?,?)";
	      $optionalParameters = array($id_usuario, 28);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();    
	      
	      return $id_usuario;
    }      
    
    public function elegirRegion($id_region)
    {
	      $sql = "DELETE FROM portal_usuario_region WHERE id_usuario = ?";
	      $optionalParameters = array($this->id);
	      $statement = $this->_dbAdapter->createStatement($sql, $optionalParameters);
	      $result = $statement->execute();
    
	      $sql = "INSERT INTO portal_usuario_region VALUES (0, ?,?)";
	      $optionalParameters = array($this->id, $id_region);
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
