<?php
#- all query db follow in here.
class Repo
{
  private $query = "";

  function __construct()
  {
    $attributes = [
      PDO::ATTR_EMULATE_PREPARES => false,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    $this->conn =
      new PDO(
        "mysql:host=" . DB["HOST"] . ";dbname=" . DB["NAME"] . ";charset=utf8",
        DB["USER"],
        DB["PASSWORD"],
        $attributes
      );
  }

  function __destruct()
  {
    if (isset($this->conn))
      $this->conn = null;
  }

  public function select($params, string $opt = null)
  {
    if (isset($opt)) {
      if (is_array($params)) {
        $this->query .= "select {$opt}" . join(",", $params);
        return $this;
      } else if (is_string($params)) {
        $this->query .= "select {$opt} {$params}";
        return $this;
      }
    } else {
      if (is_array($params)) {
        $this->query .= "select " . join(",", $params);
        return $this;
      } else if (is_string($params)) {
        $this->query .= "select {$params}";
        return $this;
      }
    }
  }

  public function where(string $clause)
  {
    $this->query .= " where {$clause}";
    return $this;
  }

  public function join($position, array $params)
  {
    foreach ($params as $key => $value) {
      $this->query .= " {$position} join {$key} on {$value}";
    }
    return $this;
  }

  public function from($table)
  {
    $this->query .= " from {$table}";
    return $this;
  }

  public function order_by(array $params)
  {
    $this->query .= " order by ";
    foreach ($params as $key => $value) {
      $this->query .= "{$value} {$key}";
    }
    return $this;
  }

  public function limit(int $number)
  {
    $this->query .= " limit {$number}";
    return $this;
  }

  #- Select one record
  public function one()
  {
    try {
      $stmt =
        $this
        ->conn
        ->prepare($this->query);
      $stmt->execute();
      $results = $stmt->fetch(PDO::FETCH_ASSOC);
      $this->query = "";
      return $results;
    } catch (PDOException $e) {
      exit($e->getMessage());
    }
  }

  #- Select for universal
  public function all()
  {
    try {
      $stmt =
        $this
        ->conn
        ->prepare($this->query);
      $stmt->execute();
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $this->query = "";
      return $results;
    } catch (PDOException $e) {
      exit($e->getMessage());
    }
  }


  #- Fetch all record in table by ID
  public function get($table, int $id)
  {
    return
      $this
      ->select("*")
      ->from($table)
      ->where("id={$id}")
      ->one();
  }

  #- Fetch all record in table by specific params
  public function get_by($table, string $clause)
  {
    return
      $this
      ->select("*")
      ->from($table)
      ->where($clause)
      ->order_by(["desc" => "id"])
      ->one();
  }

  #- update with specific
  public function update($table, array $data, array $params)
  {
    foreach ($params as $key => $val) {
      if (is_string($val))
        $values[] = "{$key}='{$val}'";
      else
        $values[] = "{$key}={$val}";
    }
    $value = join(",", $values);
    try {
      $sql = "UPDATE {$table} SET {$value} WHERE id={$data['id']}";
      $this
        ->conn
        ->prepare($sql)
        ->execute();
      return $this->get($table, $data["id"]);
    } catch (PDOException $e) {
      exit($e->getMessage());
    }
  }

  public function insert($table, array $params)
  {
    foreach ($params as $key => $val) {
      $keys[] = $key;
      $binds[] = ":{$key}";
      $data[":{$key}"] = $val;
    }
    $col = join(",", $keys);
    $bind = join(",", $binds);
    try {
      $sql = "INSERT INTO {$table} ({$col}) VALUES ({$bind})";
      $this
        ->conn
        ->prepare($sql)
        ->execute($data);
      return true;
    } catch (PDOException $e) {
      exit($e->getMessage());
    }
  }

  public function delete($table, int $id)
  {
    try {
      $sql = "DELETE FROM {$table} WHERE id={$id}";
      $this
        ->conn
        ->prepare($sql)
        ->execute();
      return true;
    } catch (PDOException $e) {
      exit($e->getMessage());
    }
  }
}
