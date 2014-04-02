<?php

namespace Entities\Usuario;

use Doctrine\ORM\Mapping as ORM;

use Entities\Entity;

/** @ORM\Entity */

class UsuarioPerfil extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /**  
    * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="usuario_perfil", cascade={"persist"}) 
    */
    protected $usuario;

    /** @ORM\Column(type="string") */
    protected $nombre;
    
    /** @ORM\Column(type="text") */
    protected $valor;
    
    // getters/setters
} 
