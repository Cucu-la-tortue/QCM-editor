<?php
include "redirect_login.php";
$date = date("Y-m-d H:i:s");
$_SESSION['end_time'] = date('Y-m-d H:i:s', strtotime($date."+ $_SESSION[exam_time] minutes"));
include "connection.php";
include "header.php";
?>


<div class="container">
    <section class="exams exams__box-all-exams">
        <h1>Result</h1>
        <p class="exams__presentation">You want to know your grade? It's right over there. But remember, never get discouraged and keep studying!</p>
        <table class="exams__all-exams">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Time</th>
                    <th>Correct</th>
                    <th>Wrong</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $correct = 0;
                $wrong = 0;

                if (isset($_SESSION['answer'])) {
                    for ($i = 0; $i <= sizeof($_SESSION['answer']); $i++) {
                        $answer = "";
                        $request = $bdd->query("SELECT * FROM questions WHERE name='$_SESSION[exam_name]' && question_no = $i") or die(print_r($bdd->errorInfo()));
                        while ($row = $request->fetch()) {
                            $answer = $row['answer'];
                        }

                        if (isset($_SESSION['answer'][$i])) {
                            if ($answer == $_SESSION['answer'][$i]) {
                                $correct++;
                            }
                            else {
                                $wrong++;
                            }
                        }
                        else {
                            $wrong++;
                        }
                    }
                }

                $count = 0;
                $request = $bdd->query("SELECT * FROM questions WHERE name='$_SESSION[exam_name]'") or die(print_r($bdd->errorInfo()));
                $count = $request->rowCount();
                $wrong = $count - $correct;
                ?>


                <tr>
                    <td><?php echo $_SESSION['exam_name'];?></td>
                    <td><?php echo $_SESSION['exam_time'];?></td>
                    <td><?php echo $correct;?></td>
                    <td><?php echo $wrong;?></td>
                    <td><?php echo $count;?></td>

                </tr>

            </tbody>
        </table>        
    </section>

    <?php
    if (isset($_SESSION['exam_start'])) {
        date_default_timezone_set('Europe/Paris');
        $date = date('d/m H:i');
        $request = $bdd->exec("INSERT INTO exam_results(username, exam_name, total_question, correct_answer, wrong_answer, exam_time) VALUES('$_SESSION[username]', '$_SESSION[exam_name]', '$count', '$correct', '$wrong', '$date')") or die(print_r($bdd->errorInfo()));
        unset($_SESSION['exam_start']);
        ?>
        <script type="text/javascript">
            window.location.href = window.location.href;
        </script>
        <?php
    }

    ?>

    <?php
    include "footer.php";
    ?>
</div>

</body>
</html>