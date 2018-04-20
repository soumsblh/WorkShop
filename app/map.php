<?php

$user = "root";
$pass = "";
$connect = new  PDO('mysql:host=localhost;dbname=greentech', $user, $pass);

$query="SELECT * from company";

$locations = [];
$count = 0;

$reponse = $connect->query($query);

echo json_encode($reponse->fetchAll());

?>