<?php

/**
 *Inicializa el objeto cargando el tipo de base de Datos
 *almacenado en las constantes DBP_POSTGRES y DBM_MYSQL
 */
class stockModel extends Db_handler
{
  public $tableName = 'STOCK';

  function __construct($type)
  {
    parent::__construct($type);
  }
  public function setStock(string $id_medicamento=null, $cantidad=0)
  {
    $id = Helpers::passGenerator();
    $query = "INSERT INTO $this->tableName (_id_stock,_fk_id_medicamento, _cantidad, _update_date, _reg_date)
              VALUES(?,?,?,?,?)";
    $lastupdated = date('Y-m-d H:i:s');
    $data = array($id, $id_medicamento, $cantidad, $lastupdated, $lastupdated);
    $result = $this->insert($query,$data);
    return $result;
  }

  public function getAll()
  {
    $query = "SELECT m._id_medicamento, m._nombre, m._miligramos, s._id_stock, s._cantidad, s._update_date
              FROM $this->tableName AS s
              INNER JOIN MEDICAMENTO AS m ON m._id_medicamento=s._fk_id_medicamento
              ";
    $result = $this->selectAll($query);
    return $result;
  }

  public function get(string $id)
  {
    $id = "'".trim($id)."'";
    $query = "SELECT m._id_medicamento, m._nombre, m._miligramos, s._id_stock, s._cantidad, s._update_date
              FROM $this->tableName AS s
              INNER JOIN MEDICAMENTO AS m ON m._id_medicamento=s._fk_id_medicamento
              WHERE s._id_stock = $id";
    $result = $this->select($query);
    return $result;
  }

  public function getIdMedicamento(string $id)
  {
    $id = "'".trim($id)."'";
    $query = "SELECT * FROM $this->tableName WHERE _fk_id_medicamento = $id";
    $result = $this->select($query);
    return $result;
  }

  public function deleteStock(string $id){
    $id = "'".trim($id)."'";
    $query = "DELETE FROM $this->tableName WHERE _id_stock = $id";
    $result = $this->delete($query);
    return $result;
  }

  public function updateStock(string $id, $cantidad){
    $id = "'".trim($id)."'";
    $data = [
      'cantidad'=>$cantidad,
    ];
    $query = "UPDATE $this->tableName SET _cantidad =:cantidad WHERE _id_stock=$id";
    $result = $this->update($query,$data);
    return $result;
  }

}
