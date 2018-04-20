<?php

	$w_routes = array(

        ['GET', '/home', 'default#home', 'default_home'],

		['GET|POST', '/frontpage', 'default#login', 'default_frontPage'],//page d'acceuil après avoir cliqué sur la carte

		//Dans le fichier je Crée le controller ContactController
        ['GET|POST', '/apropos', 'Default#apropos', 'default_apropos'], //affiche la page contact
        ['GET|POST', '/contact', 'Default#contact', 'default_contact'], //affiche la page contact

		//Dans le fichier je Crée le controller SecurityController
		['GET|POST', '/registre'   , 'Security#registre'   , 'security_registre'],    //connexion ou inscription
		['GET|POST', '/login'   , 'Security#login'   , 'security_login'],    //connexion ou inscription
		['GET|POST', '/logout'  , 'Security#logout'  , 'security_logout'],   //deconnexion
		['GET|POST', '/forget'  , 'Security#forget'  , 'security_forget'],   //mot de passe oublié


		//Dans le fichier je Crée le controller CategoriesController

		//Dans le fichier je Crée le controller ProfilController
		['GET|POST', '/profile/?[i:id]?'        , 'Default#profile'      , 'default_profile'], //affiche la page profil
		['GET|POST', '/profile/changeInfos'     , 'Security#changeInfos' , 'security_changeInfos'], //permet à l'utilisateur de changer ses infos
		['GET|POST', '/profile/admin'           , 'Default#profileAdmin' , 'default_profile_admin'], //affiche la page profil admin
		['GET|POST', '/profile/admin/userslist' , 'Default#userslist'    , 'default_userslist'], //affiche la liste des utilisateurs depuis le panel admin


	);
