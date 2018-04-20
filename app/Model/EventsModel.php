<?php

namespace Model;

use \W\Model\Model;
use  Model\EventsModel;

class EventsModel extends Model
{

    public function countEvents()
    {
      $query = $this->dbh->query('SELECT COUNT(*) as events FROM events');
      return $query->fetch();
    }

    public function countEventsOfUser($id)
    {
      $query = $this->dbh->query('SELECT COUNT(*) as events FROM events WHERE  user_id = '. $id);
      return $query->fetch();
    }

    public function findAllWithAuthor($orderBy = '', $orderDir = 'ASC', $limit = null, $offset = null)
    {
      // Il faut utiliser des alias (as) pour éviter d'écraser l'id article avec l'id user
      $sql = 'SELECT *, users.id as id_user, events.id as id_event FROM ' . $this->table;
      if (!empty($orderBy)){
        //sécurisation des paramètres, pour éviter les injections SQL
        if(!preg_match('#^[a-zA-Z0-9_$]+$#', $orderBy)){
          die('Error: invalid orderBy param');
        }
        $orderDir = strtoupper($orderDir);
        if($orderDir != 'ASC' && $orderDir != 'DESC'){
          die('Error: invalid orderDir param');
        }
        if ($limit && !is_int($limit)){
          die('Error: invalid limit param');
        }
        if ($offset && !is_int($offset)){
          die('Error: invalid offset param');
        }

      }

        $sql .= ' LEFT JOIN users ON users.id = events.user_id';

        $sql .= ' GROUP BY '.$orderBy.' '.$orderDir;

          if($limit){
              $sql .= ' LIMIT '.$limit;
              if($offset){
                  $sql .= ' OFFSET '.$offset;
              }
          }

      $sth = $this->dbh->prepare($sql);
      $sth->execute();

      return $sth->fetchAll();
    }

  public function subscribersEvent($id)
{
  if (!is_numeric($id)){
    return false;
  }

  $sql = 'SELECT id_event, id_user, username, firstname, lastname FROM ' . $this->table . '
  LEFT JOIN subscribers ON subscribers.id_event = events.id
  INNER JOIN users ON users.id = subscribers.id_user
  WHERE events.' . $this->primaryKey .'  = :id';
  $sth = $this->dbh->prepare($sql);
  $sth->bindValue(':id', $id);
  $sth->execute();

  return $sth->fetchAll();
}

  public function countAllEvent(){
    $query = $this->dbh->query('SELECT * FROM `users` INNER JOIN events ON users.id = events.user_id' );
    return $query->fetchAll();
  }

	  public function countEventsForUser($id)
    {
      $query = $this->dbh->query('SELECT COUNT(*) as events FROM events Where events.user_id =' . $id);
      return $query->fetch();
    }
    public function countKmOfUser($id)
    {
      $query = $this->dbh->query('SELECT SUM(distance) FROM `events` WHERE user_id = ' .$id);
      return $query->fetch();
    }

    public function eventsPagination($orderBy = '', $orderDir = 'DESC', $limit = null, $offset = null)
    {

     // SELECT * FROM `users` INNER JOIN events ON users.id = events.user_id ORDER BY `post` DESC LIMIT 10 OFFSET 0
      $sql = 'SELECT *, users.id as id_user, events.id as id_events FROM ' . $this->table;
      if (!empty($orderBy)){

        //sécurisation des paramètres, pour éviter les injections SQL
        if(!preg_match('#^[a-zA-Z0-9_$]+$#', $orderBy)){
          die('Error: invalid orderBy param');
        }
        $orderDir = strtoupper($orderDir);
        if($orderDir != 'ASC' && $orderDir != 'DESC'){
          die('Error: invalid orderDir param');
        }
        if ($limit && !is_int($limit)){
          die('Error: invalid limit param');
        }
        if ($offset && !is_int($offset)){
          die('Error: invalid offset param');
        }

        $sql .= ' ORDER BY '.$orderBy.' '.$orderDir;
      }
      $sql .= ' LEFT JOIN users ON users.id = events.user_id'; // ne pas oublier lespace avant le LEFT JOIN
          if($limit){
              $sql .= ' LIMIT '.$limit;
              if($offset){
                  $sql .= ' OFFSET '.$offset;
              }
          }
      $sth = $this->dbh->prepare($sql);
      $sth->execute();

      return $sth->fetchAll();
    }
    public function sumtotalki()
      {
        $query = $this->dbh->query('SELECT SUM(distance) FROM `events`');
        return $query->fetch();
      }

    public function search(array $search, $operator = 'OR', $stripTags = true){

    // Sécurisation de l'opérateur
    $operator = strtoupper($operator);
    if($operator != 'OR' && $operator != 'AND'){
      die('Error: invalid operator param');
    }

        $sql = 'SELECT *, events.id as event_id, users.id as user_id  FROM ' . $this->table.' INNER JOIN users ON  users.id = events.user_id WHERE';

    foreach($search as $key => $value){
      $sql .= " `$key` LIKE :$key ";
      $sql .= $operator;
    }
    // Supprime les caractères superflus en fin de requète
    if($operator == 'OR') {
      $sql = substr($sql, 0, -3);
    }
    elseif($operator == 'AND') {
      $sql = substr($sql, 0, -4);
    }

    $sth = $this->dbh->prepare($sql);

    foreach($search as $key => $value){
      $value = ($stripTags) ? strip_tags($value) : $value;
      $sth->bindValue(':'.$key, '%'.$value.'%');
    }
    if(!$sth->execute()){
      return false;
    }
        return $sth->fetchAll();
  }
} //class EventsModel
