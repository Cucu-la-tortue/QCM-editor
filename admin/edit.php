<?php
include 'header.php';
include '../connection.php';

$id = $_GET['id'];
$request = $bdd->prepare("SELECT * FROM exam_category WHERE id = ?") or die(print_r($bdd->errorInfo()));
$request->execute(array($id));
while ($row = $request->fetch()) {
    $exam_name = $row['name'];
    $exam_time = $row['time'];
}
?>

<div class="container">
    <section class="exams">
        <h1><?php echo $exam_name; ?></h1>
        <p class="exams__presentation">Here are your different QCUs. You can modify them to make it more challenging for your students.</p>
        <ul>
            <li>
                <div class="exams__title">
                    <h2>Sum Up</h2>
                    <p class="exams__details">Questions of <?php echo $exam_name; ?></p>
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

            <li>
                <div class="exams__title">
                    <h2>Edit <?php echo $exam_name; ?></h2>
                    <p class="exams__details">Change the name and timer of your exam <?php echo $exam_name; ?>.</p>
                </div>
                <form action="" method="post">
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
            </li>
                
            <li>
                <div class="exams__title">
                    <h2>Add questions to <?php echo $exam_name; ?></h2>
                    <p class="exams__details">Add and remove questions from your QCU</p>
                </div>
                <form action="" method="post" class="exam__question-form">
                    <div class="box-input-label box-input-label--question">
                        <label for="question">Question</label>
                        <input type="text" name="question" placeholder="What is the capital of France ?">
                    </div>
                    <div class="box-input-label box-input-label--question">
                        <label for="optA">Option A</label>
                        <input type="text" name="optA" placeholder="Marseille">
                    </div>
                    <div class="box-input-label box-input-label--question">
                        <label for="optB">Option B</label>
                        <input type="text" name="optB" placeholder="Paris">
                    </div>
                    <div class="box-input-label box-input-label--question">
                        <label for="optC">Option c</label>
                        <input type="text" name="optC" placeholder="Versailles">
                    </div>
                    <div class="box-input-label--answer">
                        <label for="answer">Answer</label>
                        <select name="answer" class="drop-down-answer">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                        </select>
                    </div>
                    <input type="submit" name="submit2" class="btn btn--exams" value="+ Add question">
                </form>
            </li>
        </ul>
        
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

    elseif (isset($_POST['submit2'])) {
        if ($_POST['question']!=NULL AND $_POST['optA']!=NULL AND $_POST['optB']!=NULL AND $_POST['optC']!=NULL AND $_POST['answer']!=NULL) {
            $loop = 0;
            $count = 0;
            $request = $bdd->query("SELECT * FROM questions WHERE name = '$exam_name' ORDER BY id ASC") or die(print_r($bdd->errorInfo()));
            $count = $request->rowCount();

            if ($count != 0) {
                while($row = $request->fetch()) {
                    $loop = $loop + 1;
                    $request2 = $bdd->prepare("UPDATE questions SET question_no = ? WHERE id = ?") or die(print_r($bdd->errorInfo()));
                    $request2->execute(array($loop, $row['id']));
                }
            }

            $loop = $loop + 1;
            $request3 = $bdd->prepare("INSERT INTO questions(question_no, question, optA, optB, optC, answer, name) VALUES(:question_no, :question, :optA, :optB, :optC, :answer, :name)") or die(print_r($bdd->errorInfo()));
            $request3->execute(array(
                'question_no' => $loop,
                'question' => $_POST['question'],
                'optA' => $_POST['optA'],
                'optB' => $_POST['optB'],
                'optC' => $_POST['optC'],
                'answer' => $_POST['answer'],
                'name' => $exam_name
            ));
            
            ?>
            <script type="text/javascript">
                window.location.href = window.location.href;
            </script>
            <?php
        }
    }
    ?>


    <?php
    include 'footer.php';
    ?>
</div>


</body>
</html>