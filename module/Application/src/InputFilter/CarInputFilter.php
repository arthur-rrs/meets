<?php

namespace Application\InputFilter;

use Zend\Db\Adapter\AdapterInterface;
use Zend\InputFilter\InputFilter;
use Zend\Validator\Between;
use Zend\Validator\Db\NoRecordExists;
use Zend\Validator\Db\RecordExists;
use Zend\Validator\Regex;

class CarInputFilter extends InputFilter
{

  private $adapter;

  public function __construct(AdapterInterface $adapter)
  {
    $this->adapter = $adapter;
  }

  public function init()
  {
   
    $this->add([
      'name' => 'plate',
      'required' => true,
      'filters' => [
        ['name' => 'Alnum',],
        ['name' => 'StringTrim'],
        ['name' => 'StringToUpper'],
      ],
      'validators' => [
        [
          'name' => 'Regex',
          'options' => [
            'pattern' => '/^[A-z]{3}[0-9]{4}$/',
            'messages' => [
              Regex::NOT_MATCH => 'A Placa tem que está no formato AAA-1234 ou AAA1234',
            ]
          ],
        ],
        [
          'name' => NoRecordExists::class,
          'options' => [
            'adapter' => $this->adapter,
            'table' => 'car',
            'field' => 'plate',
            'messages' => [
              NoRecordExists::ERROR_RECORD_FOUND => 'Placa já cadastrada no Sistema',
            ]
          ],
        ],
      ],
    ]);
    $this->add([
      'name' => 'model',
      'required' => true,
      'filters' => [
        ['name' => 'StringTrim'],
        [
          'name' => 'Alnum',
          'options' => [
            'allowWhiteSpace' => true,
          ],
        ],
      ],
      'validators' => [
        [
          'name' => 'StringLength',
          'options' => [
            'max' => 20,
          ],
        ],
      ],
    ]);

    $this->add([
      'name' => 'year_of',
      'required' => true,
      'filters' => [
        ['name' => 'StringTrim',],
        ['name' => 'ToInt'],
      ],
      'validators' => [
        [
          'name' => 'Between',
          'options' => [
            'min' => 1970,
            'max' => 9999,
            'messages' => 
            [
              Between::NOT_BETWEEN => 'Informe um Ano valido! '
            ]
          ],
        ],
      ],
    ]);

    $this->add([
      'name' => 'make_id',
      'required' => true,
      'filters' => [
        ['name' => 'ToInt'],
      ],
      'validators' => [
        [
          'name' => 'GreaterThan',
          'options' => [
            'min' => 0,
          ],
        ],
        [
          'name' => RecordExists::class,
          'options' => [
            'adapter' => $this->adapter,
            'table' => 'make',
            'field' => 'id',
          ],
        ],
      ],
    ]);

    $this->add([
      'name' => 'class_id',
      'required' => true,
      'filters' => [
        ['name' => 'ToInt'],
      ],
      'validators' => [
        [
          'name' => 'GreaterThan',
          'options' => [
            'min' => 0,
          ],
        ],
        [
          'name' => RecordExists::class,
          'options' => [
            'adapter' => $this->adapter,
            'table' => 'class',
            'field' => 'id',
          ],
        ],
      ],
    ]);
  }
}
