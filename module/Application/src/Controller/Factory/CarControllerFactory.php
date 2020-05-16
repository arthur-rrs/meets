<?php

namespace Application\Controller\Factory;

use Application\Controller\CarController;
use Application\InputFilter\CarInputFilter;
use Zend\InputFilter\InputFilterPluginManager;
use Zend\Db\Adapter\AdapterInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class CarControllerFactory implements FactoryInterface
{
  public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, ?array $options = null)
  {
    $adapter = $container->get(AdapterInterface::class);
    $pluginManager = $container->get(InputFilterPluginManager::class);
    $inputFilter = $pluginManager->get(CarInputFilter::class);
    return new CarController($adapter, $inputFilter);
  }
}
