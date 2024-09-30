<?php
/**
 *
 */
class Db_handler extends Conexion
{
  private $conexion;
  private $queryString;
  private $valuesArray;

  function __construct($type)
  {
    if ($type == 'pgsql') {
      $this->conexion = new Conexion(DBP_POSTGRES,DBP_NAME,DBP_HOST,DBP_USER,DBP_PASSWORD);
      $this->conexion = $this->conexion->getConnect();
    }
    if ($type == 'mysql') {
      $this->conexion = new Conexion(DBM_MYSQL,DBM_NAME,DBM_HOST,DBM_USER,DBM_PASSWORD);
      $this->conexion = $this->conexion->getConnect();
    }
  }

  //insertar un registro
  public function insert(string $query,array $values)
  {
    $this->queryString = $query;
    $this->valuesArray = $values;
    $result = $this->conexion->prepare($this->queryString);
    try {
      $result = $result->execute($this->valuesArray);
      if ($result) {
        $lastInsert = $this->conexion->lastInsertId();
      }else {
        $lastInsert = 0;
      }
      return $lastInsert;
    } catch (\Exception $e) {
      return false;
    }


  }
  //insertar multiples registros desde arreglo con el dato de cada fila
  public function insertMultiple(string $query,array $values)
  {
    // $data = [
    //     'John','Doe', 22,
    //     'Jane','Roe', 19,
    // ];
    $this->queryString = $query;
    $this->valuesArray = $values;
    $stmt = $this->conexion->prepare($this->queryString);//"INSERT INTO users (name, surname, age) VALUES (?,?,?)");
    try {
        $this->conexion->beginTransaction();
        foreach ($this->valuesArray as $row)
        {
            $stmt->execute($row);
        }
        $this->conexion->commit();
    }catch (Exception $e){
        $this->conexion->rollback();
        throw $e;
    }
  }
  //busca un registro
  public function select(string $query)
  {
    $this->queryString = $query;
    $result = $this->conexion->prepare($this->queryString);
    $result->execute();
    $data = $result->fetch(PDO::FETCH_ASSOC);
    return $data;
  }
  //busca todos los registros
  public function selectAll(string $query)
  {
    $this->queryString = $query;
    $result = $this->conexion->prepare($this->queryString);
    $result->execute();
    $data = $result->fetchall(PDO::FETCH_ASSOC);
    return $data;
  }
  //actualizar registros
  public function update(string $query, array $values)
  {
    $this->queryString = $query;
    $this->valuesArray = $values;
    $result = $this->conexion->prepare($this->queryString);
    $result->execute($this->valuesArray);
    return $result;
  }
  //eliminar registros
  public function delete(string $query)
  {
    $this->queryString = $query;
    $result = $this->conexion->prepare($this->queryString);
    try {
      $result->execute();
      return $result;
    } catch (\Exception $e) {
      return false;
    }


  }
}
