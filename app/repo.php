<?php

namespace App;

use PDO;
use PDOException;

/**
 * @Annotation 
 * All SQL Query function
 */
class Repo
{
  private $_query = '';
  private $_conn;
  private $_distinct;

  function __construct()
  {
    $attributes = [
      PDO::ATTR_EMULATE_PREPARES => false,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_PERSISTENT => true
    ];
    $this->_conn =
      new PDO(
        'mysql:host=' . DB['host'] . ';dbname=' . DB['name'] . ';charset=utf8',
        DB['user'],
        DB['password'],
        $attributes
      );
    $this->_conn->exec('set session sql_mode = traditional');
    $this->_distinct = false;
  }

  /**
   * @param bool $bool Specific distinct select query
   */
  public function distinct(bool $bool)
  {
    $this->_distinct = $bool;
    return $this;
  }

  private function _do_select($params)
  {
    if (is_array($params)) {
      $this->_query .= join(',', $params);
    } else if (is_string($params)) {
      $this->_query .= $params;
    }
  }

  /**
   * @param string|array $params Specify column name to fetch 
   */
  public function select($params = '*')
  {
    if ($this->_distinct) {
      $this->_query .= 'select distinct ';
      $this->_do_select($params);
      return $this;
    } else {
      $this->_query .= 'select ';
      $this->_do_select($params);
      return $this;
    }
  }

  private function _do_from($table)
  {
    if (is_array($table)) {
      $c = 0;
      foreach ($table as $t) {
        $c++;
        if ($c === count($table))
          $this->_query .= $t;
        else
          $this->_query .= $t . ',';
      }
    } else {
      $this->_query .= $table;
    }
  }

  /**
   * @param string $table Specify which table to fetch
   */
  public function from(string $table)
  {
    if (empty($this->_query)) {
      $this->_query .= 'select * from ';
      $this->_do_from($table);
    } else {
      $this->_query .= ' from ';
      $this->_do_from($table);
    }
    return $this;
  }

  /**
   * @param string $clause Clause of where() function
   */
  public function where(string $clause)
  {
    $this->_query .= " where {$clause}";
    return $this;
  }

  /**
   * @param string $fields Group of specific column separate with ','
   */
  public function group_by(string $fields)
  {
    $this->_query .= " group by {$fields}";
    return $this;
  }

  /**
   * @param string $position Left, Right, Inner, Full
   * @param array $params Array of clause join() function
   */
  public function join(string $position, array $params)
  {
    foreach ($params as $key => $value) {
      $this->_query .= " {$position} join {$key} on {$value}";
    }
    return $this;
  }

  /**
   * @param array $params Define order by : e.g. ['desc' => 'id']
   */
  public function order_by(array $params)
  {
    $this->_query .= ' order by ';
    $round = 0;
    foreach ($params as $key => $value) {
      $round++;
      if ($round > 1)
        $this->_query .= ",{$value} {$key}";
      else
        $this->_query .= "{$value} {$key}";
    }
    return $this;
  }

  /**
   * @param integer|array $number Number of records to fetch
   * - integer - limit(5) // limit since row 0 to row 5
   * - array - limit([5, 10]) // limit since row 5 to row 10
   */
  public function limit($number)
  {
    if (is_int($number))
      $this->_query .= " limit {$number}";
    else if (is_array($number))
      $this->_query .= " limit {$number[0]},{$number[1]}";
    return $this;
  }

  /**
   * Doing many query with safe guard. If error raise it will auto rollback all changed.
   * @param array $callback Transaction function with anonymous function inside, e.g. transaction(fn(x) => 'query')
   * @return true|exception If process committed it return True, Else if process rollback it raise exception.
   */
  public function transaction(array $callback)
  {
    try {
      $this->_conn->beginTransaction();
      $callback;
      $this->_conn->commit();
      return true;
    } catch (PDOException $e) {
      $this->_conn->rollBack();
      exit($e->getMessage());
    }
  }

  /**
   * Call in last command row lines and return only one result.
   * @return array|null|exception If none return null. Else if error raise exception.
   */
  public function one()
  {
    try {
      $stmt =
        $this
        ->_conn
        ->prepare($this->_query);
      $stmt->execute();
      $results = $stmt->fetch();
      $this->_query = '';
      return $results;
    } catch (PDOException $e) {
      exit($e->getMessage());
    }
  }

  /**
   * Call in last command row lines and return many of results 
   * @return array|null|exception If none return null. Else if error raise exception
   */
  public function all()
  {
    try {
      $stmt =
        $this
        ->_conn
        ->prepare($this->_query);
      $stmt->execute();
      $results = $stmt->fetchAll();
      $this->_query = '';
      return $results;
    } catch (PDOException $e) {
      exit($e->getMessage());
    }
  }

  /**
   * Fetch all column one record with ID
   * @param string $table Specify table to query
   * @param integer $id The id of record to fetch
   * @return array|null|exception If none return null. Else if error raise exception
   */
  public function get(string $table, int $id)
  {
    return
      $this
      ->select('*')
      ->from($table)
      ->where("id={$id}")
      ->one();
  }

  /**
   * Fetch all column one record with multiple where clause
   * @param string $table Specify table to query
   * @param array $clause The value of fields to fetch
   * @return array|null|exception If none return null. Else if error raise exception
   */
  public function get_by(string $table, array $clause)
  {
    $result =
      $this
      ->select('*')
      ->from($table);
    foreach ($clause as $key => $val) {
      if (is_int($val))
        $result = $result->where("{$key}={$val}");
      else
        $result = $result->where("{$key}='{$val}'");
    }
    return
      $result
      ->order_by(['desc' => 'id'])
      ->one();
  }

  /**
   * Update many records with new data in array form
   * @param string $table Specify table to query
   * @param integer $id The value of fields to update
   * @param array $params The [fieldname => values] in array form to update
   * @return array|exception If success return data column that updated. Else if error raise exception
   */
  public function update(string $table, int $id, array $params)
  {
    foreach ($params as $k => $v) {
      $binds[] = "{$k}=?";
      $values[] = $v;
    }
    $bind = join(',', $binds);
    try {
      $sql = "UPDATE {$table} SET {$bind} WHERE id={$id}";
      $this
        ->_conn
        ->prepare($sql)
        ->execute($values);
      return $this->get($table, $id);
    } catch (PDOException $e) {
      exit($e->getMessage());
    }
  }

  /**
   * Insert many records with new data in array form
   * @param string $table Specify table to query
   * @param array $params The [fieldname => values] in array form to insert
   * @return true|exception If success return True. Else if error raise exception
   */
  public function insert(string $table, array $params)
  {
    foreach ($params as $k => $v) {
      $binds[] = "?";
      $keys[] = $k;
      $values[] = $v;
    }
    $key = join(',', $keys);
    $bind = join(',', $binds);
    try {
      $sql = "INSERT INTO {$table} ({$key}) VALUES ({$bind})";
      $this
        ->_conn
        ->prepare($sql)
        ->execute($values);
      return true;
    } catch (PDOException $e) {
      exit($e->getMessage());
    }
  }

  /**
   * Insert many records with new data in array form
   * @param string $table Specify table to query
   * @param integer $id The value of fields to delete
   * @return true|exception If success return True. Else if error raise exception
   */
  public function delete(string $table, int $id)
  {
    try {
      $sql = "DELETE FROM {$table} WHERE id=?";
      $this
        ->_conn
        ->prepare($sql)
        ->execute([$id]);
      return true;
    } catch (PDOException $e) {
      exit($e->getMessage());
    }
  }
}
