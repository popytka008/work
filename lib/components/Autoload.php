<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 04.09.15
 * Time: 7:48
 */
class Autoload
{
}

function __autoload($className)
{

  switch (strtoupper($className[0] . $className[1])) {
    case 'C_':
      require_once 'lib/c/' . $className . '.php';
      break;
    case 'M_':
      require_once 'lib/m/' . $className . '.php';
      break;
    case 'V_':
      break;
      require_once 'v/' . $className . '.php';
    default: {

      switch (strtoupper($className)) {
        case 'VIEWER':
          require_once 'lib/v/' . $className . '.php';
          break;
        case 'MODEL':
          require_once 'lib/m/' . $className . '.php';
          break;
        case 'CONTROLLER':
          require_once 'lib/c/' . $className . '.php';
          break;
        case 'DATA':
          require_once 'lib/data/' . $className . '.php';
          break;
        default:
          require_once 'lib/components/' . $className . '.php';
      }
    }
  }
}
