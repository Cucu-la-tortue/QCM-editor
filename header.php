<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!------- CSS ------>
    <!-- Index -->
    <link rel="stylesheet" href="./css/index.css">
    <!-- Navbar -->
    <link rel="stylesheet" href="./css/header.css">
    <!-- Footer -->
    <link rel="stylesheet" href="./css/footer.css">
    <!-- Favicon -->
    <link rel="icon" href="assets/logo.svg" type="image/svg">
    <!-- Title -->
    <title>QCM Maker</title>
</head>
<body>
    <header id="header">
        <div class="qcm-header__logo">
            <img src="./assets/logo.svg" alt="logo" />
            <h3>QCM Maker</h3>
        </div>
        <nav>
            <ul>
                <li><a href="dashboard.php">Home</a></li>
                <li><a href="select_exam.php">Exams</a></li>
                <li><a href="all_results.php">Results</a></li>
                <li><a href="logout.php" class="btn btn--header">Log out</a></li>
            </ul>
        </nav>
        <script type="text/javascript">
            setInterval(function(){
                timer();
            }, 1000);
            function timer()
            {
                var xmlhttp=new XMLHttpRequest();
                xmlhttp.onreadystatechange=function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                        if(xmlhttp.responseText=="00:00:01")
                        {
                            window.location="result.php";
                        }

                        document.getElementById("countdowntimer").innerHTML=xmlhttp.responseText;

                    }
                };
                xmlhttp.open("GET","forajax/load_timer.php", true);
                xmlhttp.send(null);
            }
        </script>
    </header>
