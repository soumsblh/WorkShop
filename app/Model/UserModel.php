<?php

  namespace Model;

  use \W\Model\Model;
  use \W\Model\UsersModel;

  class UserModel extends UsersModel
  {
  	//on herite de tout ce qu il ya dans W

    public function isValidToken($token) {
     $query = $this->dbh->prepare('SELECT id FROM users WHERE token_forget = :token AND NOW() < date_forget');
     $query->bindValue(':token', $token, \PDO::PARAM_STR);
     $query->execute();
     return $query->fetchColumn();
 }

 function changeUserPassword($id, $password) {
     global $db;
     $query = $this->dbh->prepare('UPDATE users SET password = :password, token_forget = NULL, date_forget = NULL WHERE id = :id'); // On met à jour le mot de passe de l'utilisateur et on supprime le token
     $query->bindValue(':id', $id);
     $query->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
     return $query->execute();
 }

 function changeTokenLogin($user_id) {
     global $db;
     $token_login = sha1(md5(sha1($user_id) . sha1(time()) . md5('1a4g51rz74hz21rz4h') . md5(uniqid()))); // Génére un token du style 3a4f74a7f5a7f4v7g4ae5g41ae2gea87gv
     $db->query('UPDATE users SET token_login = "'.$token_login.'" WHERE id = ' . $user_id);
     return $token_login;
 }

  function checkUserByEmail($user_email) {

      $query = $this->dbh->prepare('SELECT id FROM user WHERE email = :email');
      $query->bindValue(':email', $user_email, PDO::PARAM_STR);
      $query->execute();
      return $query->fetchColumn();
  }

   public function getAllEventsByUser($id_user)
  {
                                  //lutilisateur          //l'évènement
    $sql = ('SELECT * FROM events WHERE user_id = ' . $id_user);
    $sth = $this->dbh->prepare($sql);
    $sth->execute();

    return $sth->fetchAll();
  }

  public function countUsers()
  {
    $query = $this->dbh->query('SELECT COUNT(*) as users FROM users');
    return $query->fetch();
  }

}
