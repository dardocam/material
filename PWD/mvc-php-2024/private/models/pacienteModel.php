<?php

/**
 *Inicializa el objeto cargando el tipo de base de Datos
 *almacenado en las constantes DBP_POSTGRES y DBM_MYSQL
 */
class pacienteModel extends Db_handler
{
  public $tableName = 'PACIENTE';

  function __construct($type)
  {
    parent::__construct($type);
  }
  public function setPaciente(string $nombre=null, string $apellido=null, string $dni=null)
  {
    $id = Helpers::passGenerator();

    $query = "INSERT INTO $this->tableName (_id_paciente, _nombre, _apellido, _dni, _update_date, _reg_date)
              VALUES(?,?,?,?,?,?)";
    $lastupdated = date('Y-m-d H:i:s');
    $data = array($id, $nombre, $apellido, $dni, $lastupdated, $lastupdated);
    $result = $this->insert($query,$data);
    return $result;
  }

  public function getAll()
  {
    $query = "SELECT *
              FROM $this->tableName
              ";
    $result = $this->selectAll($query);
    return $result;
  }

  public function get(string $id)
  {
    $id = "'".trim($id)."'";
    $query = "SELECT * FROM $this->tableName WHERE _id_paciente = $id";
    $result = $this->select($query);
    return $result;
  }

  public function deletePaciente(string $id){
    $id = "'".trim($id)."'";
    $query = "DELETE FROM $this->tableName WHERE _id_paciente = $id";
    $result = $this->delete($query);
    return $result;
  }

  public function updateItem(string $id, array $data){
    $id = "'".trim($id)."'";
    $query = "UPDATE $this->tableName
              SET _nombre=:nombre, _apellido=:apellido, _dni=:dni, _update_date=:timestamp_actualizacion
              WHERE _id_paciente = $id";
    $result = $this->update($query,$data);
    return $result;
  }

}
