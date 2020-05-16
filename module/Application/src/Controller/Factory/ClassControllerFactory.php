<?php

namespace Application\Controller\Factory;

use Application\Controller\ClassController;
use Zend\Db\Adapter\AdapterInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ClassControllerFactory implements FactoryInterface
{
  public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, ?array $options = null)
  {
    return new ClassController($container->get(AdapterInterface::class));
  }
}
