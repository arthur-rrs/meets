<?php

namespace Application\InputFilter\Factory;

use Application\InputFilter\CarInputFilter;
use Zend\Db\Adapter\AdapterInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class CarInputFilterFactory implements FactoryInterface
{
  public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, ?array $options = null)
  {
    $adapter = $container->get(AdapterInterface::class);
    return new CarInputFilter($adapter);
  }
}
