<!-- INCLUDE HEADER -->
<?php
include 'header.php';
include '../connection.php';
?>



<!-- CONTENT -->
<div class="container">
    <section class="exams">
        <h1>Exams</h1>
        <p class="exams__presentation">Here you are on the page where you can find all your prepared exams. You can create new ones or remove them as you wish.</p>
        <ul class="exams__all-actions">
            <li>
                <div class="exams__title">
                    <h2>Your exams</h2>
                    <p class="exams__details">Main informations of your MCQs</p>
                </div>
                <table class="exams__all-exams">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Time</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count=0;
                        $request = $bdd->query("SELECT * FROM exam_category") or die(print_r($bdd->errorInfo()));
                        while ($row = $request->fetch()) {
                            $count++
                            ?>
                            <tr>
                                <td><?php echo $count;?></td>
                                <td><?php echo $row['name'];?></td>
                                <td><?php echo $row['time'];?></td>
                                <td><a href="deleteExam.php?id=<?php echo $row['id'];?>" class="btn btn--delete">Delete</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </li>

            <li>
                <div class="exams__title">
                    <h2>Add an exam</h2>
                    <p class="exams__details">Create a new MCQ with simplicity.</p>
                </div>
                <form action="" class="exams__new-exam" method="post" name="form2">
                    <div class="box-input-label">
                        <label for="examName">Name</label>
                        <input type="text" name="examName" placeholder="Geography">
                    </div>
                    <div class="box-input-label">
                        <label for="examTime">Time (in minutes)</label>
                        <input type="number" name="examTime" placeholder="60">
                    </div>
                    <input type="submit" name="submit2" class="btn btn--exams" value="+ Add exam">
                </form>
            </li>

            <li>
                <div class="exams__title">
                    <h2>Edit an exam</h2>
                    <p class="exams__details">You are no longer satisfied? Feel free to modify your MCQs for more fun!</p>
                </div>
                <form action="" method="post" name="form3" class="exams__drop-down-menu">
                    <label for="exam-choice" style="display:none;"></label>
                    <input list="list-all-exams" class="exam-choice" name="exam-choice" placeholder="Choose an exam"/>
                    <datalist id="list-all-exams">
                        <?php
                        $request = $bdd->query("SELECT name FROM exam_category") or die(print_r($bdd->errorInfo()));
                        while ($row = $request->fetch()) {
                            ?>
                            <option value="<?php echo $row['name']; ?>">
                            <?php
                        }
                        ?>
                    </datalist>
                    <input type="submit" name="submit3" value="Edit exam" class="btn btn--exams">
                </form>
            </li>
        </ul>
    </section>

    <?php
    if (isset($_POST['submit2'])) {
        if ($_POST['examName']!=NULL AND $_POST['examTime']!=NULL) {
            $request = $bdd->prepare("INSERT INTO exam_category(name, time) VALUES(?, ?)") or die(print_r($bdd->errorInfo()));
            $request->execute(array($_POST['examName'], $_POST['examTime']));

            ?>
            <script type="text/javascript">
                window.location.href = window.location.href;
            </script>
            <?php
        }

        else {
            ?>
            <script type="text/javascript">
                window.location.href = window.location.href;
            </script>
            <?php
        }
        
    }

    elseif (isset($_POST['submit3'])) {
        if ($_POST['exam-choice']!=NULL) {
            $request = $bdd->prepare("SELECT id, name FROM exam_category WHERE name = ?") or die(print_r($bdd->errorInfo()));
            $request->execute(array($_POST['exam-choice']));
            while ($data = $request->fetch()) {
                $id = $data['id'];
            }

            if (isset($id)) {
                ?>
                <script type="text/javascript">
                    window.location.href = 'edit.php?id=<?php echo $id; ?>';
                </script>
                <?php
            }
        }
    }
    ?>


    <!-- INCLUDE FOOTER -->
    <?php
    include 'footer.php';
    ?>


</div>
    
</body>
</html>