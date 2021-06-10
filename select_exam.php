<?php
include "redirect_login.php";
include 'header.php';
include 'connection.php';
?>


<div class="container">
    <section class="exams">
        <h1>Your exams</h1>
        <p class="exams__presentation">You are now on the page that contains all the exams uploaded by your teachers. We hope you have studied well and we wish you good results!</p>
        <div class="exams__box-all-exams">
            <div class="exams__title">
                <h2>Sum Up</h2>
                <p>Choose your exam and don't forget to keep an eye on the clock.</p>
            </div>
            <table class="exams__all-exams">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Exam</th>
                        <th>Time</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count=0;
                    $request = $bdd->query("SELECT * FROM exam_category") or die(print_r($bdd->errorInfo()));
                    while ($row = $request->fetch()) {
                        $count++;
                        ?>
                        <tr>
                            <td><?php echo $count;?></td>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['time'];?></td>
                            <td><input type="button" class="btn btn--delete" value="<?php echo $row["name"];?>" onclick="set_exam_type_session(this.value)"></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <?php
    include 'footer.php';
    ?>

    <script type="text/javascript">
        function set_exam_type_session(exam_name)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if(xmlhttp.readyState == 4 && xmlhttp.status==200) {
                    window.location = "desktop_exam.php";
                }
            };
            xmlhttp.open("GET", "forajax/set_exam_type_session.php?exam_name="+ exam_name, true);
            //xmlhttp.open("GET", "forajax/change_question_no.php", true);
            xmlhttp.send(null);
        }
    </script>

</div>


</body>
</html>