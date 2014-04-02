<?php

namespace Entities\Batalla;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

 /**
  * @ORM\Entity
  */
class Desafio extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;
    
    /**
    * @ORM\ManyToMany(targetEntity="Entities\Usuario\Usuario", cascade={"persist"})
    * @ORM\JoinTable(name="ArenaUsuarioDesafio",
    *      joinColumns={@ORM\JoinColumn(name="desafio_id", referencedColumnName="id")},
    *      inverseJoinColumns={@ORM\JoinColumn(name="usuario_id", referencedColumnName="id")}
    *      )
    */
    protected $usuario;
    
    /**
    * @ORM\ManyToOne(targetEntity="DesafioEstado", cascade={"persist"})
    */
    protected $estado;
    
    /**
    * @ORM\ManyToOne(targetEntity="Batalla", cascade={"persist"})
    */
    protected $batalla;
        
    public function __constructor()
    {
      $this->usuario = new ArrayCollection();
    }    
    
    // getters/setters
} 
 
