<?php

/**
 *Inicializa el objeto cargando el tipo de base de Datos
 *almacenado en las constantes DBP_POSTGRES y DBM_MYSQL
 */
class mbaseModel extends Db_handler
{
  public $tableName = 'MBASE';

  function __construct($type)
  {
    parent::__construct($type);
  }

  public function get(string $id_medicamento, string $id_paciente)
  {
    $id_paciente = "'".trim($id_paciente)."'";
    $id_medicamento = "'".trim($id_medicamento)."'";
    $query = "SELECT * FROM $this->tableName WHERE _fk_id_medicamento = $id_medicamento AND _fk_id_paciente = $id_paciente";
    $result = $this->select($query);
    return $result;
  }

  public function getAll(string $id_paciente)
  {
    $id_paciente = "'".trim($id_paciente)."'";
    $query = "SELECT p._nombre, p._apellido, m._nombre as '_medicamento', m._miligramos, mbase._cantidad, mbase._update_date
              FROM $this->tableName AS mbase
              INNER JOIN PACIENTE AS p ON p._id_paciente = mbase._fk_id_paciente
              INNER JOIN MEDICAMENTO AS m ON m._id_medicamento = mbase._fk_id_medicamento
              WHERE p._id_paciente = $id_paciente
              ";
    $result = $this->selectAll($query);
    return $result;
  }

  public function set(string $id_paciente=null, string $id_medicamento=null, int $cantidad=null)
  {
    $query = "INSERT INTO $this->tableName (_fk_id_paciente, _fk_id_medicamento, _cantidad, _update_date, _reg_date)
              VALUES(?,?,?,?,?)";
    $lastupdated = date('Y-m-d H:i:s');
    $data = array($id_paciente, $id_medicamento, $cantidad, $lastupdated, $lastupdated);
    $result = $this->insert($query,$data);
    return $result;
  }
}
