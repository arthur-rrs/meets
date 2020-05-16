<?php

namespace Application\Controller\Factory;

use Application\Controller\MakeController;
use Zend\Db\Adapter\AdapterInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class MakeControllerFactory implements FactoryInterface 
{
  public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, ?array $options = null)
  {
    return new MakeController($container->get(AdapterInterface::class));
  }
}