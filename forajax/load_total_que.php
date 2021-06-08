<?php
session_start();
include "../connection.php";
$total_que = 0;

$request1 = $bdd->prepare("SELECT * FROM questions WHERE name=?");
$request1->execute(array($_SESSION['name']));
$total_que = $request1->rowCount();
echo $total_que;

?>