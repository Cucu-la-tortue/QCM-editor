<?php
session_start();
include "../connection.php";

$question_no = "";
$question = "";
$optA = "";
$optB = "";
$optC = "";
$answer = "";
$count = 0;
$ans = "";


$queno = $_GET['question_no'];
if (isset($_SESSION['answer'][$queno])) {
    $ans = $_SESSION['answer'][$queno];
}


$request = $bdd->prepare("SELECT * FROM questions WHERE name = ? && question_no = ?");
$request->execute(array($_SESSION['exam_name'], $_GET['question_no']));
$count = $request->rowCount();

// Si plus de questions
if ($count == 0) {
    echo "over";
}

// S'il reste des questions
else {
    while ($row = $request->fetch()) {
        $question_no = $row['question_no'];
        $question = $row['question'];
        $optA = $row['optA'];
        $optB = $row['optB'];
        $optC = $row['optC'];
    }


    ?>
    <h2 class="exams__question-no">Question <?php echo $question_no;?></h2>
    <p class="exams__question" style="opacity: 1;"><?php echo $question;?></p>
    <form action="" method="post" class="exams__question-all-answers">
        <div class="exams__question-answer">
            <label for="optA"><?php echo $optA;?></label>
            <input type="radio" name="option" id="optA" value="<?php echo $optA;?>" onclick="radioclick(this.value, <?php echo $question_no;?>)" <?php if ($ans == $optA) {echo "checked";}?>>
        </div>
        <div class="exams__question-answer">
            <label for="optB"><?php echo $optB;?></label>
            <input type="radio" name="option" id="optB" value="<?php echo $optB;?>" onclick="radioclick(this.value, <?php echo $question_no;?>)"  <?php if ($ans == $optB) {echo "checked";}?>>
        </div>
        <div class="exams__question-answer">
            <label for="optC"><?php echo $optC;?></label>
            <input type="radio" name="option" id="optC" value="<?php echo $optC;?>" onclick="radioclick(this.value, <?php echo $question_no;?>)"  <?php if ($ans == $optC) {echo "checked";}?>>
        </div>
    </form>
    <?php

}



?>