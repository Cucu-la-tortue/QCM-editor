<!-- INCLUDE HEADER -->
<?php
include 'redirect_login.php';
include 'header.php';
?>



<!-- CONTENT -->
<div class="container">
    <section class="qcm-actions">
        <h1>Hi <?php echo $_SESSION['username'];?> !</h1>
        <p class="qcm-actions__presentation">Welcome to your online MCQ site. Here you will find all the MCQs put online by your teacher.</p>
        <ul class="qcm-actions__all-actions">
            <li class="exams__box-all-exams">
                <div class="qcm-actions__title">
                    <h2>Select an exam</h2>
                    <img src="./assets/exam-icon.svg" alt="icon">
                </div>
                <p class="qcm-actions__details">Here are all the assignments posted by your teacher. Choose your subject and pay careful attention to time! </p>
                <a href="select_exam.php" class="btn btn--actions">Select</a>
                
            </li>
            <li class="exams__box-all-exams">
                <div class="qcm-actions__title">
                    <h2>View last results</h2>
                    <img src="./assets/results-icon.svg" alt="icon">
                </div>
                <p class="qcm-actions__details">Want to see your results? It's not impossible. You will find the results of your previous exams here.</p>
                <a href="all_results.php" class="btn btn--actions">Results</a>
            </li>
            <li class="exams__box-all-exams">
                <div class="qcm-actions__title">
                    <h2>Log out</h2>
                    <img src="./assets/exit-icon.svg" alt="icon">
                </div>
                <p class="qcm-actions__details">Session over? Don't forget to log out! See you soon on QCM Maker.</p>
                <a href="logout.php" class="btn btn--actions">Tschuss</a>
            </li>
        </ul>
    </section>


    <!-- INCLUDE FOOTER -->
    <?php
    include 'footer.php';
    ?>


</div>
    
</body>
</html>