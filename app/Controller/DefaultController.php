<?php

namespace Controller;

use Model\UserModel;
use Model\EventsModel;
use \W\Controller\Controller;

class DefaultController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function home()
	{
		$this->show('default/home');
	}

	/**
	* Page de profil admin
	*/
	public function profileAdmin()
	{

		//redirection a une page d'erreur si on on n'est pas admin
		$this->allowTo('admin');

		$event_manager 	= new EventsModel();
		$user_manager		= new UserModel();
		$user = $user_manager->find($this->getUser()['id']);
		$events       	= $event_manager->findAll();
		$count_events 	= $event_manager->countEvents($this->getUser()['id']);
		$count_users 		= $user_manager->countUsers();
		$this->show('default/profileAdmin' , ['events' => $events, 'user' => $user, 'count_events' => $count_events, 'count_users' => $count_users]);

	}

	/**
	* Page pour afficher tous les utilisateurs
	*/
	public function userslist()
	{

		//redirection a une page d'erreur si on on n'est pas admin
		$this->allowTo('admin');

		$user_manager = new UserModel();
		$event_manager 	= new EventsModel();
		$user = $user_manager->find($this->getUser()['id']);
		$users       	= $user_manager->findAll();
		$count_events = $event_manager->countEvents();
		$count_users 	= $user_manager->countUsers();

		// Traitement du formulaire pour changer l'email; $_POST['button-email'] vient du name dans l'HTML pour différencier les deux formulaires
		foreach ($users as $user) {

			if (isset($_POST['button-'.$user['id']])) {
				$role = $_POST['role'];
				$id = $user['id'];
				$users = $user_manager->update(['role' => $role], $id);
			}
		}

		$users       	= $user_manager->findAll();
		$this->show('default/userslist' , ['users' => $users, 'user' => $user, 'count_events' => $count_events, 'count_users' => $count_users]);

	}

	/**
	 * Page de profil
	 */
	public function profile()
	{

   	//Ici on doit afficher les evenements liés à l'utilisateur connecté
		//si l'utilisateur n'a pas d'evenement on lui indiquera le chemin à suivre pour en créer un

		$this->allowTo('user');
		$user_manager = new UserModel();
		$event_manager = new EventsModel();

		$profil = $user_manager->find($this->getUser()['id']);

		$count_events = $event_manager->countEvents($this->getUser()['id']);

		$profil_event = $user_manager->getAllEventsByUser($this->getUser()['id']);

		$count_events 	= $event_manager->countEventsOfUser($this->getUser()['id']);

		$km =	$event_manager->countKmOfUser($this->getUser()['id']);
		
		$this->show('default/profile', [ 'km' => $km ,'count_events' => $count_events , 'profil' => $profil , 'profil_event' => $profil_event]);

	}

	 /**
	  * Page contact
	  */
	 public function contact()
	 {
		$message = '';
		$mail    = '';
		$nom     = '';
		$contenu = '';

    if (!empty($_POST)){
        $mail = 'labonnesortie@yopmail.com'; // Déclaration de l'adresse de destination.
        if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.
        {
            $passage_ligne = "\r\n";
        }else{
            $passage_ligne = "\n";
        }
        //=====Déclaration des messages au format texte et au format HTML.
			$message_txt = $_POST['mail'];
			$message_html = "<html><head></head><body><p>".$_POST['contenus']."</p></body></html>";
        //==========
        // Remplacement de certains caractères spéciaux
			$message = str_replace("&#039;","'",$message);
			$message = str_replace("&;#8217;","'",$message);
			$message = str_replace("&quot;",'"',$message);
			$message = str_replace('<br>;','',$message);
			$message = str_replace('<br />;','',$message);
			$message = str_replace("&lt;","<",$message);
			$message = str_replace("&gt;",">",$message);
			$message = str_replace("&amp;","&",$message);
			$message = str_replace("&©;","é",$message);
			$message = str_replace("&Ã;","&",$message);
        //=====Création de la boundary.
			$boundary     = "-----=".md5(rand());
			$boundary_alt = "-----=".md5(rand());
        //==========

        //=====Définition du sujet.
       	 	$sujet = $_POST['nom'];
        //=========

        //=====Création du header de l'e-mail.
			$header = "From: \" ".$_POST['nom']." \" <".$_POST['mail'].">".$passage_ligne;
			$header.= "Reply-to: \" ".$_POST['nom']." \" <labonnesortie@yopmail.com>".$passage_ligne;
			$header.= "MIME-Version: 1.0".$passage_ligne;
			$header.= "Content-Type: multipart/mixed;charset='iso-8859-1'; DelSp='Yes'; format=flowed'".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
        //==========

        //=====Création du message.
			$message = $passage_ligne."--".$boundary.$passage_ligne;
			$message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
			$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;

        //=====Ajout du message au format texte.
			$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
			$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
			$message.= $passage_ligne.$message_txt.$passage_ligne;
        //==========

        	$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;

        //=====Ajout du message au format HTML.
			$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
			$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
			$message.= $passage_ligne.$message_html.$passage_ligne;
        //==========

        //=====On ferme la boundary alternative.
        	$message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
        //==========



        	$message.= $passage_ligne."--".$boundary.$passage_ligne;

        //=====Ajout de la pièce jointe.
			$message.= "Content-Type: image/jpeg; name=\"image.jpg\"".$passage_ligne;
			$message.= "Content-Transfer-Encoding: base64".$passage_ligne;
			$message.= "Content-Disposition: attachment; filename=\"image.jpg\"".$passage_ligne;
        //$message.= $passage_ligne.$attachement.$passage_ligne.$passage_ligne;
        	$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
        //==========
        //=====Envoi de l'e-mail.
        	mail($mail,$sujet,$message,$header);

    	}
	 	$this->show('default/contact');
	 }
	/**
		* Permet la connexion d'un utilisateur
	*/
	public function login()
	{

		if (isset($_POST['button-login'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$auth_manager = new \W\Security\AuthentificationModel();

			$user_id = $auth_manager->isValidLoginInfo($username, $password);
			if ($user_id) { // Si le couple username/password est valid
				$user_manager = new UserModel();
				$user = $user_manager->find($user_id); // Récupére toutes les infos de l'utilisateur qui se connecte
				$auth_manager->logUserIn($user); // La connexion se fait
				$this->redirectToRoute('default_frontPage');
			}
		}

			$user_manager  = new UserModel();
			$event_manager = new EventsModel();
			$lastevent     = $event_manager->findAllWithAuthor('post', 'DESC', 3);
			$kilo    = $event_manager->sumtotalki();

			// $lastevent4     = $event_manager->findAllWithAuthor('post', 'DESC', 4);
			// J'injecte la variable messages dans ma vue
			$this->show('default/frontPage', ['lastevent'=> $lastevent, 'kilo' => $kilo]);


	}

}
