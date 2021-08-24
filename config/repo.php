<?php
#- all query db follow in here.
class Repo
{
  private string $query;

  function __construct()
  {
    $this->query = "";
  }

  private function connect(): bool
  {
    try {
      $this->conn =
        new PDO(
          "mysql:host=" . DB["HOST"] . ";dbname=" . DB["NAME"],
          DB["USER"],
          DB["PASSWORD"]
        );
      return
        $this
        ->conn
        ->setAttribute(
          PDO::ATTR_ERRMODE,
          PDO::ERRMODE_EXCEPTION
        );
    } catch (PDOException $e) {
      exit("Connection failed: " . $e->getMessage());
    }
  }

  public function select($params)
  {
    if (is_array($params)) {
      $this->query .= "SELECT " . join(", ", $params);
      return $this;
    } else if (is_string($params)) {
      $this->query .= "SELECT {$params}";
      return $this;
    }
  }

  public function select_distinct($params)
  {
    if (is_array($params)) {
      $this->query .= "SELECT DISTINCT " . join(", ", $params);
      return $this;
    } else if (is_string($params)) {
      $this->query .= "SELECT {$params}";
      return $this;
    }
  }

  public function where(string $clause)
  {
    $this->query .= " WHERE {$clause}";
    return $this;
  }

  public function join($position, array $params)
  {
    foreach ($params as $key => $value) {
      $this->query .= " {$position} JOIN {$key} ON {$value}";
    }
    return $this;
  }

  public function from($table)
  {
    $this->query .= " FROM {$table}";
    return $this;
  }

  public function order_by(array $params)
  {
    $this->query .= " ORDER BY ";
    foreach ($params as $key => $value) {
      $this->query .= "{$value} {$key}";
    }
    return $this;
  }

  #- Select one record
  public function one()
  {
    try {
      $this->connect();
      $stmt =
        $this
        ->conn
        ->prepare($this->query);
      $stmt->execute();
      $results = $stmt->fetch(PDO::FETCH_ASSOC);
      $this->query = "";
      return $results;
    } catch (PDOException $e) {
      return $e->getMessage();
    }
    $this->conn = null;
  }

  #- Select for universal
  public function all()
  {
    try {
      $this->connect();
      $stmt =
        $this
        ->conn
        ->prepare($this->query);
      $stmt->execute();
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $this->query = "";
      return $results;
    } catch (PDOException $e) {
      return $e->getMessage();
    }
    $this->conn = null;
  }

  #- Fetch all record in table by ID
  public function get($table, int $id)
  {
    return
      $this
      ->select("*")
      ->from($table)
      ->where("id = {$id}")
      ->one();
  }

  #- Fetch all record in table by specific params
  public function get_by($table, array $params)
  {
    $clause = "";
    foreach ($params as $key => $value) {
      if (is_string($value))
        $clause .= "{$key} = '{$value}'";
      else
        $clause .= "{$key} = {$value}";
    }
    return
      $this
      ->select("*")
      ->from($table)
      ->where($clause)
      ->order_by(["DESC" => "id"])
      ->one();
  }

  #- update with specific
  public function update($table, array $params, int $id)
  {
    try {
      $this->connect();
      $sql = "UPDATE {$table} SET {$params} WHERE id = {$id}";
      $stmt =
        $this
        ->conn
        ->prepare($sql);
      $stmt->execute();
      $return = $this->get($table, $id);
      return $return;
    } catch (PDOException $e) {
      return $e->getMessage();
    }
    $this->conn = null;
  }

  public function insert($table, array $params)
  {
    foreach ($params as $key => $val) {
      $k = ":{$key}";
      $keys[] = $key;
      $binds[] = $k;
      $assoc[$k] = $val;
    }
    $col = join(", ", $keys);
    $bind = join(", ", $binds);
    try {
      $this->connect();
      $sql = "INSERT INTO {$table} ({$col}) VALUES ({$bind})";
      $stmt =
        $this
        ->conn
        ->prepare($sql);
      $stmt->execute($assoc);
      return true;
    } catch (PDOException $e) {
      return $e->getMessage();
    }
    $this->conn = null;
  }

  public function delete($table, int $id)
  {
    try {
      $this->connect();
      $sql = "DELETE FROM {$table} WHERE id = {$id}";
      $stmt =
        $this
        ->conn
        ->prepare($sql);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      return $e->getMessage();
    }
    $this->conn = null;
  }
}
