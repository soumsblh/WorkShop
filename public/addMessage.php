<?php

  $db = new PDO('mysql:host=127.0.0.1;dbname=labonnesortie;charset=utf8', 'root', '');


  if (!empty($_POST)) {
    $message = $_POST['message'];
    // $publish_datetime = $_POST['publish_datetime'];

    $error = [];

    if (empty($message)) {
      $error['message'] = 'Le message est vide';
    }
    var_dump($message);
    if (empty($error)) {

      $query = $db->prepare('INSERT INTO messages (content, publish_datetime) VALUES (:content, NOW())');
      $query->bindValue(':content', $message, PDO::PARAM_STR);
      // $query->bindValue(':publish_datetime', $publish_datetime, PDO::PARAM_STR);

      if ($query->execute() ) {
        $_POST['message'] = 'Le message a bien été ajouté dans la BDD';
      }
    }
    else {
      $_POST['message'] = 'Il y a des erreurs';
    }

    // json_encode transforme un tableau en chaine de caractères json
    echo json_encode($_POST);
    header('location:http://localhost/labonnesortie/public/frontpage');
  }


?>
