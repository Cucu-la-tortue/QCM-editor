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
        <table class="questions__all-results">
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

            $total = 0;
            $request = $bdd->query("SELECT * FROM questions WHERE name='$_SESSION[exam_name]'") or die(print_r($bdd->errorInfo()));
            $total = $request->rowCount();
            $wrong = $total - $correct;
            $grade = round(($correct - 0.5*$wrong)*20/$total, 1);
            if ($grade < 0) {
                $grade = 0;
            }
        ?>
            <thead>
                <caption>Your grade : <?php echo $grade;?> / 20</caption>
                <tr>
                    <th>#</th>
                    <th>Question</th>
                    <th>Correct</th>
                    <th>You</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 0;
                while ($row = $request->fetch()) {
                    $count++;
                    $question = $row['question'];
                    $correct_answer = $row['answer'];
                    $question_no = $row['question_no'];
                    $answer_user = $_SESSION['answer'][$question_no];
                    ?>
                    <tr>
                        <td><?php echo $count;?></td>
                        <td><?php echo $question;?></td>
                        <td><?php echo $correct_answer;?></td>
                        <td><?php echo $answer_user;?></td>
                    </tr>
                    <?php
                }
                ?>
                
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