<?php
session_start();
include "../connection.php";

$question_no = "";
$question = "";
$opt1 = "";
$opt2 = "";
$opt3 = "";
$answer = "";
$count = 0;
$ans = "";


$queno = $_GET['answer'];
if (isset($_SESSION['answer'][$queno])) {
    $ans = $_SESSION['answer'][$queno];
}


$request = $bdd->prepare("SELECT * FROM questions WHERE name = ? && question_no = ?");
$request->execute(array($_SESSION['name'], $_GET['question_no']))



?>