<?php

namespace Controller;

use \W\Controller\Controller;
use  Model\EventsModel;
use  Model\UserModel;
use  Model\SubscribersModel;

class EventController extends Controller
{

    /**
      *  On creer un evenements
      *
     **/
    public function create()
    {

        $this->allowTo(['admin' , 'user']);

        $title           = null;
        $event           = null;
        $date            = null;
        $image           = null;
        $message         = null;
        $depart          = null;
        $depart_lat      = null;
        $depart_long     = null;
        $arrivee         = null;
        $arrivee_lat     = null;
        $arrivee_long    = null;
        $arrivee_address = null;
        $depart_address  = null;
        $hour            = null;
        $distance        = null;
        $temps           = null;

        if(!empty($_POST))
        {
            $title   = ucfirst(trim($_POST['title']));
            $event   = trim($_POST['event']);
            $image   = trim($_POST['image']);
            $date    = date('Y-m-d' , strtotime( $_POST['date'] ));
            $hour    = date('H:i' , strtotime( $_POST['hour'] ));
            $depart  = ucfirst(trim($_POST['depart']));
            $arrivee = ucfirst(trim($_POST['arrivee']));

            $event_manager = new EventsModel();

            if (!empty($_POST['depart']) && !empty($_POST['arrivee'])) {
              $coords = $this->setTrajet($depart, $arrivee);
              $dist   = $this->getdistance($depart, $arrivee);
            }


             $errors=[];

             if( strlen( $title ) < 3 || empty($title) )
             {
                 $errors['title'] = "Le titre doit comporter 3 caractères minimum.";
             }

             if( strlen( $event ) < 15 || empty($event))
             {
                 $errors['event'] = "Votre paragraphe doit comporter 15 lignes minimum.";
             }
             if(!filter_var($image, FILTER_VALIDATE_URL) === true  )
             {
                 $errors['image'] = "Votre url doit etre valide.";
             }

             if( empty( $date ) )
             {
                 $errors['date'] = "Votre date doit être au format Jour/Mois/Année.";
             }

             if( strlen( $depart ) <= 3 || empty($depart) )
             {
                 $errors['depart'] = "L'addresse de départ doit comporter 3 caractères minimum.";
             }

             if( strlen( $arrivee ) <= 3 || empty($arrivee) )
             {
               $errors['arrivee'] = "L'addresse d'arrivée doit comporter 3 caractères minimum.";
             }

             if( empty($errors) )
             {
                 $auth_manager = new \W\Security\AuthentificationModel();


            $result = $event_manager->insert([
                    'title'           => $title,
                    'event'           => $event,
                    'image'           => $image,
                    'date_time'       => date('Y-m-d' , strtotime( $_POST['date'] )),
                    'hour'            => date('H:i' , strtotime( $_POST['hour'] )),
                    'user_id'         => $this->getUser()['id'],  // ici l'id de lutilisateur connecté $this->getuser()['id']
                    'depart'          => $depart,
                    'depart_lat'      => $coords['depart']['depart_lat'],
                    'depart_long'     => $coords['depart']['depart_long'],
                    'depart_address'  => $coords['depart']['depart_address'],
                    'arrivee'         => $arrivee,
                    'arrivee_lat'     => $coords['arrivee']['arrivee_lat'],
                    'arrivee_long'    => $coords['arrivee']['arrivee_long'],
                    'arrivee_address' => $coords['arrivee']['arrivee_address'],
                    'distance'        => $dist[0],
                    'temps_dist'      => $dist[1]
                  ]);



             }
             else {
                 $message = $errors ;
             }
        }
        $this->show('event/create' , ['message' => $message  , 'title'=>$title , 'event' => $event ]);
    }

    /**
      *  Recupère un seul évènement
      *
     **/
    public function view($id)
    {
        //$this->allow(['admin' , 'user']);
        $event_manager = new EventsModel();
        $subscribers_manager = new SubscribersModel();
        $event = $event_manager->find($id);
        $subscribers_event 	= $event_manager->subscribersEvent($id);

        // S'inscrire à l'événement
        if (isset($_POST['button-subscribe']) ) {
            $id_event  = $event['id'];
            $id   = $this->getUser()['id'];
            // Evite que l'utilisateur s'inscrit plusieurs fois au même événement
            foreach ($subscribers_event as $subscriber) {
              if ($subscriber['id_user'] == $this->getUser()['id']) {
                $subscribers_manager->deleteId($id);
              }
            }

            $subscribers_manager->insert([
            'id_event'=> $id_event,
            'id_user' => $id
            ]);
            $this->redirectToRoute('event_view', ['id' => $id_event]);
        }

        // Se désinscrire à l'événement
        if (isset($_POST['button-unsigned']) ) {
            $id_event  = $event['id'];
            $id = $this->getUser()['id'];

            // Evite que l'utilisateur s'inscrit plusieurs fois au même événement
            foreach ($subscribers_event as $subscriber) {
              if ($subscriber['id_user'] == $this->getUser()['id']) {

                $subscribers_manager->deleteId($id);
                $this->redirectToRoute('event_view', ['id' => $id_event]);

              }
            }

            }

        $this->show('event/view' , ['event'=> $event, 'subscribers_event' => $subscribers_event]);
    }

    /**
      *  Recupère tous les évènements
      *
     **/
    public function index($page = 1)
    {
        $event_manager= new EventsModel();
        $user_manager = new UserModel();
        //$events       = $event_manager->findAll();

        if(isset($w_user)){
            $count_events = $event_manager->countEventsForUser($this->getUser()['id']);
        }
        $count_users  = $user_manager->countUsers();

        $event_by_page = 4;
        $total_events   = count( $event_manager->findAll() );
        $offset        = ( $page - 1 ) * $event_by_page;
        $max_pages    = ceil($total_events / $event_by_page);

        $events = $event_manager->eventsPagination('' , 'DESC' , $event_by_page , $offset);

      if(isset($count_events)) {
        $this->show('event/index' , [
            'events'       => $events,
            'count_events' => $count_events,
            'count_users'  => $count_users,
            'page'         => $page,
            'event_by_page'=> $event_by_page,
            'offset'       => $offset,
            'max_pages'    => $max_pages
            ]);
        }
        else {
             $this->show('event/index' , [
                 'events'      => $events,
                 'count_users' => $count_users,
                 'page'         =>$page,
                 'event_by_page'=>$event_by_page,
                 'offset'       =>$offset,
                 'max_pages'   => $max_pages
                 ]);
        }
    }

    /**
     * Edition d'un article
    */

    public function update($id)
    {
      //$this->allow('admin');
      $title           = null;
      $description     = null;
      $date            = null;
      $image           = null;
      $message         = '';
      $depart          = null;
      $depart_lat      = null;
      $depart_long     = null;
      $arrivee         = null;
      $arrivee_lat     = null;
      $arrivee_long    = null;
      $arrivee_address = null;
      $depart_address  = null;
      $hour            = null ;

      $allowed = ['admin'];

      $event_manager = new EventsModel();

      $event = $event_manager->find($id); // Je vais chercher un evenement dans la bdd par son id
      if ( $this->getUser()['role'] === 'user' && $this->getUser()['id'] == $event['user_id'] ) { // Si le role est user et que l'event appartient à cet user

        $allowed[] = 'user';
      }

      $this->allowTo($allowed);

      if(!empty($_POST))
      {

          $title       = ucfirst(trim($_POST['title']));
          $description = trim($_POST['event']);
          $image       = trim($_POST['image']);
          $date        = date('Y-m-d' , strtotime( $_POST['date'] ));
          $hour        = date('H:i:s' , strtotime( $_POST['hour'] ));
          $depart      = ucfirst(trim($_POST['depart']));
          $arrivee     = ucfirst(trim($_POST['arrivee']));

          if (!empty($_POST['depart']) && !empty($_POST['arrivee'])) {
            $coords = $this->setTrajet($depart, $arrivee);
          }


           $errors=[];

           if( strlen( $title ) < 3 || empty($title) )
           {
               $errors['title'] = "Le titre doit comporter 3 caractères minimum.";
           }

           if( strlen( $description ) < 15 || empty($description))
           {
               $errors['event'] = "Votre paragraphes doit comporte 15 lignes minimum.";
           }

           if(!filter_var($image, FILTER_VALIDATE_URL) === true )
           {
               $errors['image'] = "Votre url doit etre valide";
           }

           if(  empty( $date ) )
           {
               $errors['date']= "Votre date doit etre au format Année/Mois/Jours .";
           }

           if( strlen( $depart ) <= 3 || empty($depart) )
           {
               $errors['depart'] = "L'addresse de départ doit comporter 3 caractères minimum.";
           }

           if( strlen( $arrivee ) <= 3 || empty($arrivee) )
           {
             $errors['arrivee'] = "L'addresse d'arrivée doit comporter 3 caractères minimum.";
           }

           if( empty($errors) )
           {
               $auth_manager = new \W\Security\AuthentificationModel();

          $result = $event_manager->update([
                  'title'          => $title,
                  'event'          => $description,
                  'image'          => $image,
                  'date_time'      => date('Y-m-d' , strtotime( $_POST['date'] )),
                  'hour'           => date('H:i:s' , strtotime( $_POST['hour'] )),
                  'depart'         => $depart,
                  'depart_lat'     => $coords['depart']['depart_lat'],
                  'depart_long'    => $coords['depart']['depart_long'],
                  'depart_address' => $coords['depart']['depart_address'],
                  'arrivee'        => $arrivee,
                  'arrivee_lat'    => $coords['arrivee']['arrivee_lat'],
                  'arrivee_long'   => $coords['arrivee']['arrivee_long'],
                  'arrivee_address'=> $coords['arrivee']['arrivee_address']

                ], $id);

                // Si le role est user et que l'event appartient à cet user / &&  $this->getUser()['id'] == $w_user['role']
                if ( $this->getUser()['role'] === 'user' && $this->getUser()['id'] == $event['user_id'] ) {
                  $this->redirectToRoute('default_profile');
                }

                elseif ($this->getUser()['role'] === 'admin') {
                $this->redirectToRoute('default_profile_admin');
                }
                // //si cest un admin et quil est sur profil on le renvoi a profil
                // if (isset($_GET['redirect']) && $_GET['redirect'] == 'default_profile_admin') {
                //   $this->redirectToRoute('default_profile_admin');
                // }
          }
          else {

               $message = $errors ;
          }
      }
      $this->show('event/update' , ['message' => $message  , 'title'=> $title , 'event' => $event ]);
    }

    //on recupere l'id de l'article avec l'url pour le supprimer
  public function delete($id)
  {
    $event_manager = new EventsModel();
    $event_manager->delete($id); // ici on supprime l'article de la bdd

    //si c'est un bien un user
    if ( $this->getUser()['role'] === 'user' && $this->getUser()['id'] == $event['user_id'] ) { // Si le role est user et que l'event appartient à cet user / &&  $this->getUser()['id'] == $w_user['role']
        $this->redirectToRoute('profil_index');
    }

    //si cest un admin et quilest sur profil on le renvoi a profil
    if (isset($_GET['redirect']) && $_GET['redirect'] == 'profil_index') {
        $this->redirectToRoute('profil_index');
    }


    $this->redirectToRoute('event_index');
  }

  public function geocode($address)
  {
        $lati = null;
        $longi = null;
        // url encode l'adresse
        $address = urlencode($address);

        // google map geocode api url
        $url = "http://maps.google.com/maps/api/geocode/json?address={$address}";

        // recupère les données en json
        $resp_json = file_get_contents($url);

        // decode le json
        $resp = json_decode($resp_json, true);

        // response status will be 'OK', if able to geocode given address
        if($resp['status']=='OK'){

            // get the important data
            $lati = $resp['results'][0]['geometry']['location']['lat'];
            $longi = $resp['results'][0]['geometry']['location']['lng'];
            $formatted_address = $resp['results'][0]['formatted_address'];



        // verify if data is complete
        if ($lati && $longi && $formatted_address) {

            // put the data in the array
            $data_arr = array();
            array_push($data_arr, $lati, $longi, $formatted_address);

            return $data_arr;
        }
    }

    return false;
  }


  public function setTrajet($depart = null, $arrivee = null)
  {
    $arrivee_coord = $this->geocode($_POST['arrivee']);
    $depart_coord = $this->geocode($_POST['depart']);
    $tableau = [
        'depart'  => [
            'depart_lat'    => $depart_coord[0],
            'depart_long'   => $depart_coord[1],
            'depart_address'=> $depart_coord[2]
                ],
        'arrivee' => [
            'arrivee_lat' => $arrivee_coord[0],
            'arrivee_long'  => $arrivee_coord[1],
            'arrivee_address' => $arrivee_coord[2]
                ]
            ];
    return $tableau;
  }

  // function to geocode address, it will return false if unable to geocode address
  public function getdistance($depart, $arrivee)
  {
        $distance = null;
        $temps_dist = null;
        // url encode the address
        $depart = urlencode($depart);
        $arrivee = urlencode($arrivee);

        // google map geocode api url
        $url = "https://maps.googleapis.com/maps/api/directions/json?origin={$depart}&destination={$arrivee}&key=AIzaSyDw-gYmqJqQ-8RYU_8LZoTNFyQ51_yWYCY";
        https://maps.googleapis.com/maps/api/directions/json?origin={$depart}&destination={$arrivee}&key=AIzaSyDw-gYmqJqQ-8RYU_8LZoTNFyQ51_yWYCY  // clef moh:  AIzaSyCBLynodCrw0lB99t1SANF8PbXwANKcBK4

        // get the json response
        $resp_json = file_get_contents($url);

        // decode the json
        $resp = json_decode($resp_json, true);

        // response status will be 'OK', if able to geocode given address
        if($resp['status']=='OK'){

            // get the important data
            $distance = $resp['routes'][0]['legs'][0]['distance']['text'];
            $temps_dist = $resp['routes'][0]['legs'][0]['duration']['text'];

        // verify if data is complete
        if ($distance && $temps_dist) {

            // put the data in the array
            $data_arr = array();
            array_push($data_arr, $distance, $temps_dist);

            return $data_arr;
        }

    }
  }

  public function searching()
  {
    if (!empty($_GET['search'])) {
      $event_manager = new EventsModel();
      $searching = ['depart' => $_GET['search'], 'arrivee' => $_GET['search'], 'depart_address' => $_GET['search'], 'arrivee_address' => $_GET['search']];
      $result = $event_manager->search($searching, 'OR');
      if (!empty($result) && !empty($searching) ) {
        $this->show('event/search' , ['result'=> $result]);
      } else {
        $this->flash('il n\'existe pas d\'évenement dans cette ville' , 'success');
        $this->redirectToRoute('default_frontPage');
      }
    }
    $this->redirectToRoute('default_frontPage');
  }

}
