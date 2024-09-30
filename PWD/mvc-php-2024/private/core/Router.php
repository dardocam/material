<?php

/**
 *La clase Router trabaja con la url amigable
 *seteada en .htaccess, guarda un arreglo con la url
 *Metodo: start() -> extrae de la url el controlador el metodo y los parametros
 */
class Router
{
  private static $routes = [];

  function __construct()
  {
    // code...
  }

  public static function setRoutes(string $route, string $controller, string $method, array $params)
  {
    static::$routes = ['url' => $route, 'controller' => $controller, 'method' => $method, 'params' => $params];
  }

  public static function getRoutes()
  {
    return static::$routes;
  }

  public static function start()
  {
    $stringUrl = !empty($_GET['url']) ? $_GET['url'] : 'home/index';
    $arrayAux = explode("/", $stringUrl);
    $controller = $arrayAux[0];
    $params = "";
    if (!empty($arrayAux[1])) {
      if ($arrayAux[1] != "") {
        $method = $arrayAux[1];
      }
    } else {
      $method = 'index';
    }
    if (!empty($arrayAux[2])) {
      if ($arrayAux[2] != "") {
        for ($i = 2; $i < count($arrayAux); $i++) {
          $params .= $arrayAux[$i] . ',';
        }
        $params = trim($params, ','); //cortar la ultima ,
        $params = explode(",", $params);
      }
    } else {
      settype($params, "array");
    }
    if ($_GET != NULL) {
      self::setRoutes($_GET['url'], $controller, $method, $params);
    } else {
      self::setRoutes(HOME_URL, $controller, $method, $params);
    }
  }

  public static function loadController()
  {
    $routes = self::getRoutes();
    $controllerFile = "private/controllers/" . $routes['controller'] . "Controller.php";
    if (file_exists($controllerFile)) {
      require_once($controllerFile);
      $controller = new $routes['controller']();
      if (method_exists($controller, $routes['method'])) {
        $controller->{$routes['method']}($routes['params']);
      } else {
        require_once('private/controllers/_404Controller.php');
        $controller = new _404();
        $controller->index();
      }
    } else {
      require_once('private/controllers/_404Controller.php');
      $controller = new _404();
      $controller->index();
    }
  }

  // public static function getAction($route)
  // {
  //   if (array_key_exists($route, static::$routes)) {
  //     return static::$routes[$route];
  //   } else {
  //     return false;
  //     //throw new Exception("La ruta no existe");
  //   }
  // }
}
