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
        <h1>Edit exams</h1>
        <p class="exams__presentation">Here are your different QCUs. You can modify them to make it more challenging for your students.</p>
        <ul>
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
                        <label for="opt1">Option 1</label>
                        <input type="text" name="opt1" placeholder="Marseille">
                    </div>
                    <div class="box-input-label box-input-label--question">
                        <label for="opt2">Option 2</label>
                        <input type="text" name="opt2" placeholder="Paris">
                    </div>
                    <div class="box-input-label box-input-label--question">
                        <label for="opt3">Option 3</label>
                        <input type="text" name="opt3" placeholder="Versailles">
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
        if ($_POST['question']!=NULL AND $_POST['opt1']!=NULL AND $_POST['opt2']!=NULL AND $_POST['opt3']!=NULL AND $_POST['answer']!=NULL) {
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
            $request3 = $bdd->prepare("INSERT INTO questions(question_no, question, opt1, opt2, opt3, answer, name) VALUES(:question_no, :question, :opt1, :opt2, :opt3, :answer, :name)") or die(print_r($bdd->errorInfo()));
            $request3->execute(array(
                'question_no' => $loop,
                'question' => $_POST['question'],
                'opt1' => $_POST['opt1'],
                'opt2' => $_POST['opt2'],
                'opt3' => $_POST['opt3'],
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