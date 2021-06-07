<?php
session_start();
include '../connection.php';
$exam_name = $_GET['exam_name'];
$_SESSION['exam_name'] = $exam_name;

$request = $bdd->prepare("SELECT * FROM exam_category WHERE name = ?") or die(print_r($bdd->errorInfo()));
$request->execute(array($exam_name));

while ($row = $request->fetch()) {
    $_SESSION['exam_time'] = $row['time'];
}

$date = date('Y-m-d H:i:s');
$_SESSION['end_time'] = date('Y-m-d H:i:s', strtotime($date . "+$_SESSION[exam_time] minutes"));
$_SESSION['exam_start'] = "yes";
?>