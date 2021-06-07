<?php
include "../connection.php";
$request = $bdd->prepare("DELETE FROM exam_category WHERE id = ?") or die(print_r($bdd->errorInfo()));
$request->execute(array($_GET['id']));
?>

<script type="text/javascript">
    window.location = "exams.php";
</script>