<?php

/**
 *
 */
class Conexion // extends AnotherClass
{

  private $connect;

  function __construct(string $db_type)
  {
    try {
      if ($db_type == 'pgsql') {
        $this->connect = new PDO($db_type . ":dbname=" . DBP_NAME . " host=" . DBP_HOST, DBP_USER, DBP_PASSWORD);
        $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      if ($db_type == 'mysql') {
        $this->connect = new PDO($db_type . ":host=" . DBM_HOST . ";dbname=" . DBM_NAME, DBM_USER, DBM_PASSWORD);
        $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
    } catch (PDOException $e) {
      $this->connect = 'Error de conexión';
      echo "ERROR: " . $e->getMessage();
    }
  }

  public function getConnect()
  {
    return $this->connect;
  }
}
