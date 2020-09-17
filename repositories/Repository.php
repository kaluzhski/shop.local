<?php

namespace App\repositories;

use App\services\DB;

abstract class Repository
{
  /**
   * @var DB
   */

  public $db;
  public $container;

  abstract protected function getTableName();
  abstract protected function getEntityName();


  protected function setDB()
  {
      $this->db = $this->container->db;
  }

  public function setContainer($container){
    $this->container = $container;
    $this->setDB();
  }

  public function getOne($id)
  {
      $sql = "SELECT * FROM {$this->getTableName()} WHERE id = :id";
      $params = [':id' => $id];
      return $this->db->find($sql, $params);
  }

  public function getOneObj($id)
  {
      $tableName = $this->getTableName();
      $sql = "SELECT * FROM {$tableName} WHERE id = :id";
      $params = [':id' => $id];
      return $this->db->queryObject($sql, $this->getEntityName(), $params);
  }

  public function getAllObj()
  {
      $tableName = $this->getTableName();
      $sql = "SELECT * FROM {$tableName}";
      return $this->db->queryObjects($sql, $this->getEntityName());
  }

  public function getAll()
  {
      $sql = "SELECT * FROM {$this->getTableName()}";
      return $this->db->findAll($sql);
  }

  public function insert($entity)
  {
      foreach ($entity as $fieldName => $value) {
              $params[':' . $fieldName] = $value;
          }

          $sql = "INSERT INTO {$this->getTableName()} VALUES (" . implode(', ', array_keys($params)) . ")";
          $this->db->exec($sql, $params);
  }

  public function update(Entity $entity)
  {
      foreach ($entity as $fieldName => $value) {
              $params[':' . $fieldName] = $value;
              if($fieldName != 'id') {
                  $set[] = $fieldName . '=' . ':' . $fieldName;
              }
          }

      $sql = "UPDATE {$this->getTableName()} SET " . implode(', ', $set) .  " where id=:id";
      $this->db->exec($sql, $params);

  }

  public function delete(Entity $entity)
  {
      $sql = "DELETE from {$this->getTableName()} where id=" . $entity->id;
      $this->db->exec($sql);
  }

  public function save($entity)
  {
      if (empty($entity->id)) {
          $this->insert($entity);
      } else $this->update($entity);
  }
}
