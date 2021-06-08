<?php
session_start();
$question_no = $_GET['question_no'];
$value1 = $_GET['value1'];

$_SESSION['answer'][$question_no] = $value1;
?>