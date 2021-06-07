<?php
include 'header.php';
include 'connection.php';
?>


<div class="container">
    <section class="exams">
        <h1><?php echo $exam_name; ?></h1>
        <p class="exams__presentation">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam atque voluptatum voluptate quaerat quisquam itaque vitae quos adipisci explicabo consequatur?</p>
        <ul>
            <li>
                <div class="exams__title">
                    <h2>Sum Up</h2>
                    <p class="exams__details">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatum, culpa!</p>
                </div>
                <table class="exams__all-questions">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Question</th>
                            <th>A</th>
                            <th>B</th>
                            <th>C</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $request = $bdd->query("SELECT * FROM questions WHERE name='$exam_name'") or die(print_r($bdd->errorInfo()));
                        while ($row = $request->fetch()) {
                            ?>
                            <tr>
                                <td><?php echo $row['question_no'];?></td>
                                <td><?php echo $row['question'];?></td>
                                <td id="optA<?php echo $row['question_no'];?>"><?php echo $row['optA'];?></td>
                                <td id="optB<?php echo $row['question_no'];?>"><?php echo $row['optB'];?></td>
                                <td id="optC<?php echo $row['question_no'];?>"><?php echo $row['optC'];?></td>
                                <td><a href="deleteQuestion.php?id_question=<?php echo $row['id']?>&name_exam=<?php echo $exam_name;?>" class="btn btn--delete">Delete</a></td>
                                <script type="text/javascript">
                                    document.getElementById("opt<?php echo $row['answer'] . $row['question_no'];?>").style.color="#560094";
                                    document.getElementById("opt<?php echo $row['answer'] . $row['question_no'];?>").style.fontWeight="bold";
                                </script>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </li>