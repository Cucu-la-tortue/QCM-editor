<?php
include 'header.php';
include '../connection.php';

$id = (int) $_GET['id'];
$request = $bdd->prepare("SELECT * FROM exam_category WHERE id = ?") or die(print_r($bdd->errorInfo()));
$request->execute(array($id));
while ($row = $request->fetch()) {
    $exam_name = $row['name'];
    $exam_time = $row['time'];
}
?>

<div class="container">
    <section class="exams">
        <h1>Edit exams</h1>
        <p class="exams__presentation">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam atque voluptatum voluptate quaerat quisquam itaque vitae quos adipisci explicabo consequatur?</p>
        <div class="exam__edit-form">
            <div class="exams__title">
                <h2>Edit <?php echo $exam_name; ?></h2>
                <p class="exams__details">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatum, culpa!</p>
            </div>
            <form action="" class="exams__edit-exam" method="post">
                <div class="box-input-label">
                    <label for="examNewName">New name</label>
                    <input type="text" name="examNewName" value="<?php echo $exam_name ?>">
                </div>
                <div class="box-input-label">
                    <label for="examNewTime">New time (in minutes)</label>
                    <input type="number" name="examNewTime" value="<?php echo $exam_time ?>">
                </div>
                <input type="submit" name="submit1" class="btn btn--exams" value="Edit exam">
            </form>
        </div>
    </section>

    <?php
    if (isset($_POST['submit1'])) {
        $request = $bdd->prepare("UPDATE exam_category SET name = ?, time = ? WHERE id = $id") or die(print_r($bdd->errorInfo()));
        $request->execute(array($_POST['examNewName'], $_POST['examNewTime']));

        ?>
        <script type='text/javascript'>
            window.location = "exams.php";
        </script>
        <?php
    }
    ?>



    <?php
    include 'footer.php';
    ?>
</div>


</body>
</html>