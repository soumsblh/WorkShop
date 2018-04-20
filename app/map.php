<?php
$user = "root";
$pass = "";

$connect = new  PDO('mysql:host=localhost;dbname=greentech;charset=UTF8', $user, $pass);

$tab = [];
$count=0;
//$answer = $connect->prepare("SELECT * FROM `company` where IdCompany=1");
foreach($connect->query('SELECT * FROM company') as $row) {
    $tab[$count] = $row;
    $count++;
}

echo json_encode($tab);

$answer = null;
$connect = null;

?>