<?php

	$w_routes = array(



		['GET|POST', '/frontpage', 'default#login', 'default_frontPage'],//page d'acceuil après avoir cliqué sur la carte

		//Dans le fichier je Crée le controller ContactController
        ['GET|POST', '/apropos', 'Default#apropos', 'default_apropos'], //affiche la page contact
        ['GET|POST', '/contact', 'Default#contact', 'default_contact'], //affiche la page contact

		//Dans le fichier je Crée le controller SecurityController
		['GET|POST', '/login'   , 'Security#login'   , 'security_login'],    //connexion
		['GET|POST', '/register', 'Security#register', 'security_register'], //inscription
		['GET|POST', '/logout'  , 'Security#logout'  , 'security_logout'],   //deconnexion
		['GET|POST', '/forget'  , 'Security#forget'  , 'security_forget'],   //mot de passe oublié


		//Dans le fichier je Crée le controller EventController
		['GET|POST', '/event/[i:page]?/'   , 'Event#index' , 'event_index'],  //afficher un evenement*
		['GET|POST', '/event/create'       , 'Event#create', 'event_create'], //add un evenement*
		['GET|POST', '/event/update/[i:id]', 'Event#update', 'event_update'], //modifie un evenement
		['GET|POST', '/event/delete/[i:id]', 'Event#delete', 'event_delete'], //supprime un evenement
		['GET|POST', '/event/trajet'       , 'Event#trajet', 'event_trajet'], //ajoute un trajet
		['GET|POST', '/event/[i:id]'       , 'Event#view' , 'event_view'  ], //affiche un seule event precis (avec l'id)
		['GET|POST', '/event/search'       , 'Event#searching' , 'event_search'  ],

		//Dans le fichier je Crée le controller ProfilController
		['GET|POST', '/profile/?[i:id]?'        , 'Default#profile'      , 'default_profile'], //affiche la page profil
		['GET|POST', '/profile/changeInfos'     , 'Security#changeInfos' , 'security_changeInfos'], //permet à l'utilisateur de changer ses infos
		['GET|POST', '/profile/admin'           , 'Default#profileAdmin' , 'default_profile_admin'], //affiche la page profil admin
		['GET|POST', '/profile/admin/userslist' , 'Default#userslist'    , 'default_userslist'], //affiche la liste des utilisateurs depuis le panel admin


	);
