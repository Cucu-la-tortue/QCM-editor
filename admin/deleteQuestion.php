<?php
include "../connection.php";
$request = $bdd->prepare("SELECT * FROM exam_category WHERE name = ?") or die(print_r($bdd->errorInfo()));
$request->execute(array($_GET['name_exam']));
while ($row = $request->fetch()) {
    $id = $row['id'];
}

$request2 = $bdd->prepare("DELETE FROM questions WHERE id = ?") or die(print_r($bdd->errorInfo()));
$request2->execute(array($_GET['id_question']));
?>

<script type="text/javascript">
    window.location = "edit.php?id=<?php echo $id;?>";
</script>