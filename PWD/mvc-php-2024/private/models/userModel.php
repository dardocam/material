<?php

/**
 *Inicializa el objeto cargando el tipo de base de Datos
 *almacenado en las constantes DBP_POSTGRES y DBM_MYSQL
 */
class userModel extends Db_handler
{
  private $table = 'USUARIO';

  function __construct($type)
  {
    parent::__construct($type);
  }

  public function get($email,$passw)
    {
      $email = "'".$email."'";
      $query = "SELECT * FROM $this->table WHERE _email = $email";
      $result = $this->select($query);
      if ($result) {
        if(isset($result['_email']) && isset($result['_password'])){
          if(password_verify($passw, $result['_password'])){
            return $result;
          }
        }
      }else {
        return false;
      }
    }

}
