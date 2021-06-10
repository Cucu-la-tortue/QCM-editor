<?php
session_start();
include '../connection.php';


$exam_name = $_SESSION['exam_name'];
// Change randomly questions numbers
// Get the questions of the exam
$request = $bdd->query("SELECT * FROM questions WHERE name = '$exam_name' ORDER BY id ASC") or die(print_r($bdd->errorInfo()));

// Count number of questions
$total_que = $request->rowCount();

// Create an array with all the questions ids ordered ASC
$all_question_id = array();
while ($row = $request->fetch()) {
    array_push($all_question_id, $row['id']);
}

// Create a range array and shuflle it to create new question num
$list_question_no = range(1, $total_que);
shuffle($list_question_no);
print_r($list_question_no);
print_r($all_question_id);

// Insert new question num into the database
for ($i = 0; $i < $total_que; $i++) {
    $new_question_no = $list_question_no[$i];
    $question_id = $all_question_id[$i];
    echo $new_question_no . ' - ' . $question_id . '<br>';
    $request2 = $bdd->exec("UPDATE questions SET question_no = $new_question_no WHERE id = $question_id");
}



?>