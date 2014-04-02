<?php

namespace Banco\Service;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Service\Entity;

class BancoService extends Entity
{

    public function getBanco($id)
    {
      $ban = $this->em->getRepository('Entities\Banco\Banco')->findOneById($id);
      return $ban;
    }

} 
