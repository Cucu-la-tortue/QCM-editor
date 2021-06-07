<?php
session_start();
if (!isset($_SESSION['username'])) {
    ?>
    <script type="text/javascript">
        window.location = "login.php";
    </script>
    <?php
}
?>

<?php
include 'header.php';
include 'connection.php';
?>


<div class="container">
    <section class="exams">
        <h1><?php echo $_SESSION['exam_name']; ?></h1>
        <p class="exams__presentation">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam atque voluptatum voluptate quaerat quisquam itaque vitae quos adipisci explicabo consequatur?</p>
        <div class="exams__box-all-exams">
            <div id="countdowntimer"></div>
            <div class="exams__title">
                <h2>Question 1</h2>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatum, culpa!</p>
            </div>
        </div>
    </section>

    <?php
    include 'footer.php';
    ?>

</div>


</body>
</html>