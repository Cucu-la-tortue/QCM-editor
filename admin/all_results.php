<?php
include "redirect_login.php";
include '../connection.php';
include 'header.php';
?>


<div class="container">
    <section class="exams">
        <h1>Last results</h1>
        <p class="exams__presentation">You wanna know if your students studied? Check out their results.</p>
        <div class="results__box-all-results">
            <?php
                $request = $bdd->query("SELECT * FROM exam_results ORDER BY id DESC") or die(print_r($bdd->errorInfo()));
                $count = $request->rowCount();
                $no_exam = 0;

                if ($count == 0) {
                    ?>
                    <h2 class="results__no-results">No results available</h2>
                    <?php
                }

                else {
                    ?>
                    <h2>Your results</h2>
                    <table class="results__all-results">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student</th>
                                <th>Exam</th>
                                <th>Result</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php

                    while ($row = $request->fetch()) {
                        $exam_name = $row['exam_name'];
                        $student_name = $row['username'];
                        $exam_date = $row['exam_time'];
                        $nb_correct = $row['correct_answer'];
                        $nb_questions = $row['total_question'];
                        $nb_wrong = $row['wrong_answer'];
                        $grade = round(($nb_correct - 0.5*$nb_wrong)*20/$nb_questions, 1);
                        if ($grade < 0) {
                            $grade = 0;
                        }
                        $no_exam++;

                        ?>
                        <tr>
                            <td><?php echo $no_exam;?></td>
                            <td><?php echo $student_name;?></td>
                            <td><?php echo $exam_name;?></td>
                            <td><?php echo $grade . "/20";?></td>
                            <td><?php echo $exam_date;?></td>
                        </tr>
                        <?php
                    }
                    ?>
                        </tbody>
                    </table>
                    <?php
                }
            ?>

            
        </div>
                
    </section>

    <?php
    include "footer.php";
    ?>
</div>

</body>
</html>