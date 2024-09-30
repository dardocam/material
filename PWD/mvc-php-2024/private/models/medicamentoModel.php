<?php

/**
 *Inicializa el objeto cargando el tipo de base de Datos
 *almacenado en las constantes DBP_POSTGRES y DBM_MYSQL
 */
class medicamentoModel extends Db_handler
{
  public $tableName = 'MEDICAMENTO';

  function __construct($type)
  {
    parent::__construct($type);
  }
  public function setMedicamento(string $nombre=null, string $miligramos=null, string $descripcion=null, string $categoria=null)
  {
    $id = Helpers::passGenerator();

    $query = "INSERT INTO MEDICAMENTO (_id_medicamento, _nombre, _miligramos, _descripcion, _categoria, _update_date, _reg_date)
              VALUES(?,?,?,?,?,?,?)";
    $lastupdated = date('Y-m-d H:i:s');
    $data = array($id, $nombre, $miligramos, $descripcion, $categoria, $lastupdated, $lastupdated);
    $result = $this->insert($query,$data);
    return $result;
  }
  public function getMedicamento(string $nombre, string $miligramos)
  {
    $query = "SELECT * FROM MEDICAMENTO WHERE _nombre = $nombre AND _miligramos = $miligramos";
    $result = $this->select($query);
    return $result;
  }
  public function get(string $id)
  {
    $id = "'".trim($id)."'";
    $query = "SELECT * FROM $this->tableName WHERE _id_medicamento = $id";
    $result = $this->select($query);
    return $result;
  }
  public function getAll()
  {
    $query = "SELECT * FROM MEDICAMENTO ORDER BY _nombre";
    $result = $this->selectAll($query);
    return $result;
  }
  public function deleteMedicamento(string $id){
    $id = "'".trim($id)."'";
    $query = "DELETE FROM $this->tableName WHERE _id_medicamento = $id";
    $result = $this->delete($query);
    return $result;
  }
  public function updateItem(string $id, array $data){
    $id = "'".trim($id)."'";
    $query = "UPDATE $this->tableName
              SET _nombre=:nombre, _miligramos=:miligramos, _categoria=:categoria, _descripcion=:descripcion , _update_date=:timestamp_actualizacion
              WHERE _id_medicamento = $id";
    $result = $this->update($query,$data);
    return $result;
  }




















}
