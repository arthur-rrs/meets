<?php

namespace Application\Controller;

use Application\InputFilter\CarInputFilter;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class CarController extends AbstractRestfulController {

  /**
   * @var AdapterInterface
   */
  private $adapter = null;

  /**
   * @var CarInputFilter
   */
  private $carInputFilter = null;
  
  public function __construct(AdapterInterface $adapter, CarInputFilter $carInputFilter)
  {
    $this->adapter = $adapter;
    $this->carInputFilter = $carInputFilter;
  }

  public function create($data)
  {
    $this->carInputFilter->setData($data);
    if (!$this->carInputFilter->isValid()) {
      $this->response->setStatusCode(400);
      return new JsonModel([
        'errors' => $this->carInputFilter->getMessages(),
      ]);
    }
    $input = $this->carInputFilter->getValues();
    $tableGateway = new TableGateway('car', $this->adapter);
    $tableGateway->insert($input);
    return new JsonModel([]);
  }

  public function getList()
  {
    $plate = $this->params()->fromQuery('plate');
    $tableGateway = new TableGateway('car', $this->adapter);
    $resultSet = $tableGateway->select(function (Select $select) use ($plate) {
      $select
        ->join('make', 'make.id = car.make_id', ['make' => 'name'])
        ->join('class', 'class.id = car.class_id', ['class' => 'name']);
        $select->order('car.plate');
        if ($plate || $plate !== '') {
          $select->where(['car.plate' => $plate]);
        }
    });
    $result = [];
    foreach ($resultSet as $value) {
      $result[] = $value;
    }
    return new JsonModel($result);
  }

  
}