    <?php
    include 'redirect_login.php';
    include 'header.php';
    include 'connection.php';
    ?>
    <!-- <script type="text/javascript">
        document.getElementById("header").style.display="none";
    </script> -->
    
    
    <div class="container">
        <section class="exams">
            <h1><?php echo $_SESSION['exam_name'];?></h1>
            <p class="exams__presentation">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam atque voluptatum voluptate quaerat quisquam itaque vitae quos adipisci explicabo consequatur?</p>
            <div class="exams__box-all-exams">
                <div class="exams__question-info">
                    <div><p><span id="current_que">0</span> / <span id="total_que">0</span></p></div>
                    <div id="countdowntimer"></div>
                </div>
                <div id="load_questions" class="exams__title"></div>
                <div class="exams__question-buttons">
                    <input type="button" class="btn btn--question" value="Previous" onclick="load_previous();">
                    <input type="button" class="btn btn--question" value="Next" onclick="load_next();">
                </div>
            </div>
        </section>
    
        <?php
        include 'footer.php';
        ?>
</div>

<script type="text/javascript">
    // Load number of questions
    function load_total_que() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status==200) {
                document.getElementById("total_que").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "forajax/load_total_que.php", true);
        xmlhttp.send(null);
    }

    // Load all questions
    function load_questions(question_no) {
        document.getElementById("current_que").innerHTML = question_no;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status==200) {
                if (xmlhttp.responseText=="over") {
                    window.location="result.php";
                }
                else {
                    document.getElementById("load_questions").innerHTML = xmlhttp.responseText;
                    load_total_que();
                }
            }
        };
        xmlhttp.open("GET", "forajax/load_questions.php?question_no=" + question_no, true);
        xmlhttp.send(null);
    }

    // 
    function radioclick(radiovalue, question_no) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status==200) {
            }
        };
        xmlhttp.open("GET", "forajax/save_answer.php?question_no=" + question_no + "&value1=" + radiovalue, true);
        xmlhttp.send(null);
    }

    // Load previous question
    function load_previous() {
        if (question_no == "1") {
            load_questions(question_no);
        }
        else {
            question_no = eval(question_no)-1;
            load_questions(question_no);
        }
    }

    // Load next question
    function load_next() {  
        question_no = eval(question_no)+1;
        load_questions(question_no);
    }


    
    var question_no = "1";
    load_questions(question_no);

</script>
    
</body>
</html>