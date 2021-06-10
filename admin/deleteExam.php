<?php
include "redirect_login.php";
include "../connection.php";
$request = $bdd->prepare("SELECT * FROM exam_category WHERE id = ?") or die(print_r($bdd->errorInfo()));
$request->execute(array($_GET['id']));
while ($row = $request->fetch()) {
    $exam_name = $row['name'];
}

$request2 = $bdd->prepare("DELETE FROM questions WHERE name = ?") or die(print_r($bdd->errorInfo()));
$request2->execute(array($exam_name));

$request3 = $bdd->prepare("DELETE FROM exam_category WHERE id = ?") or die(print_r($bdd->errorInfo()));
$request3->execute(array($_GET['id']));
?>

<script type="text/javascript">
    window.location = "exams.php";
</script>