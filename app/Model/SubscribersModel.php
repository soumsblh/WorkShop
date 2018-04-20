<?php

namespace Model;

use \W\Model\Model;

class SubscribersModel extends Model
{
  /**
   * On supprime l'id_user s'il est déja inscrit pour cet événement pour éviter que l'utilisateur s'inscrit plusieurs fois au même événement
  */
  public function deleteId($id)
  {
  if (!is_numeric($id)){
    return false;
  }

  $sql = 'DELETE FROM ' . $this->table . ' WHERE id_user = :id';
  $sth = $this->dbh->prepare($sql);
  $sth->bindValue(':id', $id);
  return $sth->execute();
  }
}
