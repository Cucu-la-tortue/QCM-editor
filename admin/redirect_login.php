<?php
    session_start();
    if (!isset($_SESSION['admin_name'])) {
        ?>
        <script type="text/javascript">
            window.location = "index.php";
        </script>
        <?php
    }
?>