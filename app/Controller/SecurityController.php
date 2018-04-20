<?php

namespace Controller;

use Model\UserModel;
use Model\MessagesModel;
use  Model\EventsModel;
use \W\Controller\Controller;

class SecurityController extends Controller
{
    public function register()
    {
        //traitement de notre formulaire ici conexion
        $firstname = null;
        $siren  = null;
        $username  = null;
        $email     = null;
        $password  = null;
        $message   = null;

        if (isset($_POST['button-register']) ) {
            $username   = trim($_POST['username']);
            $siren   = trim($_POST['siren']);
            $email      = trim($_POST['email']);
            $password   = trim($_POST['password']);
            $cfpassword = trim($_POST['cfpassword']);

            $user_manager = new UserModel();  //on dois crée User model et m'herié de W de base


            $errors = [];
                if (strlen($username) < 2 ) {
                    $errors['username'] = "Le prenom doit comporter au moins 2 caractères.";
                }
                if (strlen($siren) < 2 ) {
                    $errors['siren'] = "Le nom doit comporter au moins 2 caratères.";
                }
                if ( $user_manager->emailExists($email) || $user_manager->usernameExists($username) ) {
                    $errors['exists'] = "L'email ou le nom d'utilisateur existe deja";
                }
                if ( empty($username)) {
                    $errors['username'] = "Le nom d'utilisateur est vide.";
                }
                if ( empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) ){
                    $errors['email'] = "L'email est vide ou invalide.";
                }
                if ( empty($password)) {
                    $errors['password'] = "Le mot de passe est vide.";
                }
                if ( $password != $cfpassword ){
                    $errors['cfpassword'] = "Les mots de passe ne correspondent pas.";
                }

            if( empty($errors) ){
                $auth_manager = new \W\Security\AuthentificationModel();
                  //si il n'y a pas d'erreur on inscrit lutilisateur en bdd
                  $user_manager->insert([

                      'username' => $username,
                      'siren' => $siren,
                      'email'    => $email ,
                      'role'     => 'user',
                      'password' => $auth_manager->hashPassword($password) //$auth_manager->hashPassword() pbm avec hashage de mt d passe

                  ]);

                  $message['success'] = "Vous etes bien inscris.";
                  $user_id = $auth_manager->isValidLoginInfo($username, $password);
                  if ($user_id) { // Si le couple username/password est valid
                      $user_manager = new UserModel();
                      $user = $user_manager->find($user_id); // Récupére toutes les infos de l'utilisateur qui se connecte
                      $auth_manager->logUserIn($user); // La connexion se fait
                      $this->redirectToRoute('default_profilPro');
                  }

            }
            else {

                $message = $errors;
            }

          }
        $this->show('security/registre' , ['siren' => $siren, 'username' => $username , 'email' => $email ]);
    }

    /**
     * Permet la connexion d'un utilisateur
    */
    public function login()
    {

        if (isset($_POST['button-login'])) {
            var_dump($_POST);
            $username = $_POST['username'];
            $password = $_POST['password'];
            $auth_manager = new \W\Security\AuthentificationModel();

            $user_id = $auth_manager->isValidLoginInfo($username, $password);
            if ($user_id) { // Si le couple username/password est valid
                $user_manager = new UserModel();
                $user = $user_manager->find($user_id); // Récupére toutes les infos de l'utilisateur qui se connecte
                $auth_manager->logUserIn($user); // La connexion se fait
                $this->redirectToRoute('default_profilPro');
            }
        }

    $this->show('security/login');
  }

    /**
     * Déconnexion de l'utilisateur
    */
    public function logout()
    {
        $auth_manager = new \W\Security\AuthentificationModel();
        $auth_manager->logUserOut(); // Déconnecte l'utilisateur connecté
        $this->redirectToRoute('default_frontPage');
    }

    /**
    * Permet la connexion d'un utilisateur
    */
    public function forget()
    {
      $user_manager = new UserModel();
      $user_id = new UserModel();

      if (!empty($_POST) && isset($_POST['forgetSend'])) { // On vérifie le 1er formulaire qui doit envoyer le mail avec un lien pour redéfinir le password
        $email = $_POST['email'];
        if ($user = $user_manager->getUserByUsernameOrEmail($email)) {
          // Créer un token_forget et date_forget dans la bdd
          $token_forget = md5(time() . uniqid()); // Le token
          // echo strtotime(date('Y-m-d h:i:s') . ' +1 month');
          $date_forget = date('Y-m-d h:i:s', time() + 3600 * 24); // Date d'expiration du token
          // J'envoie le token et sa date d'expiration dans la bdd pour l'utilisateur
          $user_manager->update([
                 /* Modifie une ligne en fonction d'un identifiant
                 -Le premier argument est un tableau associatif de valeurs à insérer
                  -Le second est l'identifiant de la ligne à modifier
                  -Retourne les données mises à jour
                 -public function update(array $data, $id, $stripTags = true)*/

                  'token_forget' =>$token_forget,
                   'date_forget' =>$date_forget
                                ] , $user['id'] ); // l'id est $user

          $message = "Voici le lien vous permettant de redéfinir votre mot de passe :
          <a href='http://localhost/Labonnesortie/public/forget?token=".$token_forget."'
          >http://localhost/Labonnesortie/public/forget?token=".$token_forget."</a>";

          // echo "Voici le lien vous permettant de redéfinir votre mot de passe :
          // <a href='http://localhost/Labonnesortie/public/forget?token=".$token_forget."'
          // >http://localhost/Labonnesortie/public/forget?token=".$token_forget."</a>";

          } else {
            echo 'L\'email n\'existe pas';
          }
        }

        if (!empty($_POST) && isset($_POST['forgetPassword'])) {
          $token = $_GET['token'];
          $password = $_POST['password'];
          $cfpassword = $_POST['cfpassword'];

          if ($user_id->isValidToken($token)) {
            if ($password == $cfpassword) { // Je vérifie que les deux champs mot de passe soit identique
              $user_manager->changeUserPassword($user_id->isValidToken($token), $password);

              $this->redirectToRoute('default_frontPage');
            }

          } else {
            echo "Le token a expiré ou n'existe pas.";
          }
        }
      if (isset($message)) {
        $this->show('security/forget', ['message' => $message]);
      }
      else {
        $this->show('security/forget');
      }
    }
  public function changeInfos()
  {

    // Changer l'email

    $user_manager = new UserModel();

		$profil = $user_manager->find($this->getUser()['id']);

    $errors = [];
    $message = null;

    // Traitement du formulaire pour changer l'email; $_POST['button-email'] vient du name dans l'HTML pour différencier les deux formulaires
    if (isset($_POST['button-email'])) {
      $id = $profil['id'];
      $email = trim($_POST['email']);

      // Vérification du champ email
      if ( $user_manager->emailExists($email) ) {
          $errors['email'] = "Lemail existe deja";
      }
      if (empty($email)) {
          $errors['email'] = "L'email est vide";
      }
      if (!filter_var($email, FILTER_VALIDATE_EMAIL) ){
          $errors['email'] = "L'email est invalide";
      }

      if(empty($errors)){

        //si il n'y a pas d'erreur j'utilise la méthode update créée par le framework et je définis que la variable $profil vaut l'update
        $profil = $user_manager->update(['email' => $email], $id);

        $message = ["Votre email a été mis à jour"];
      }
      else {
        $message = $errors;
      }
    }


    // Changer le mot de passe

    // J'instancie la classe pour gérer mes users en BDD
    $user_manager = new UserModel();

    $profil = $user_manager->find($this->getUser()['id']);

    $errors = [];
    $password  = null;
    $message   = null;

    // Traitement du formulaire pour changer le mot de passe; $_POST['button-password'] vient du name dans l'HTML pour différencier les deux formulaires
    if (isset($_POST['button-password'])) {
      $id = $profil['id'];
      $password   = trim($_POST['password']);
      $cfpassword = trim($_POST['cfpassword']);

      if ( $password != $cfpassword ) {
        $errors['password'] = "Les mots de passe ne correspondent pas";
      }

      // S'il n'y a pas d'erreurs on change le mot de passe de l'utilisateur
      if(empty($errors)) {
        $auth_manager = new \W\Security\AuthentificationModel();
        $user_manager->update(['password' => $auth_manager->hashPassword($password)], $id);

        $message = ["Vous etes bien inscris"];
      }
      else {
        $message = $errors;
      }

    }

    // var_dump($_POST['email']);
		$this->show('security/changeInfos', ['profil' => $profil, 'message' => $message]);

  }

} //class SecurityController
