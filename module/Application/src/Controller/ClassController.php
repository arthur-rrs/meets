<?php

namespace Application\Controller;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class ClassController extends AbstractRestfulController
{

  /**
   * @var AdapterInterface
   */
  private $adapter = null;

  public function __construct(AdapterInterface $adapter)
  {
    $this->adapter = $adapter;
  }

  public function getList()
  {
    $tableGateway = new TableGateway('class', $this->adapter);
    $resultSet = $tableGateway->select(function(Select $select) {
        $select->order('name');  
    });
    $result = [];
    foreach ($resultSet as $value) {
      $result[] = $value;
    }
    return new JsonModel($result);
  }
}
