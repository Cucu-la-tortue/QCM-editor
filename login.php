<?php
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/register.css">
    <title>Login</title>
</head>
<body>
    <section>
        <h1>Login</h1>
        <form action="" name="form1" method="post">
            <div class="box-input">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="John23">
            </div>
            <div class="box-input">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="**********">
            </div>
            <input class='btn-submit' name="btn-login" type="submit" value="Login">
        </form>

        <div class="alert alert-danger" id="failure" style="margin-top: 1.5rem;">
            <strong>Invalid !</strong> Invalid Username Or Password
        </div>

        <a class="already-registered" href="register.php">Create your account</a>
    </section>

    <?php
        if (isset($_POST['btn-login'])) {

            // On regarde si le nom d'utilisateur est déjà enregistré
            $request = $bdd->prepare("SELECT * FROM registration WHERE username = ? AND password = ?") or die(print_r($bdd->errorInfo()));
            $request->execute(array($_POST['username'], $_POST['password']));
            $count = $request->rowCount(); # on compte le nombre de lignes contenant le pseudo
            
            // Si le pseudo n'est pas enregistré, on affiche un message d'erreur et on demande au user de s'inscrire
            if ($count == 0) {
                ?>
                <script type="text/javascript">
                    document.getElementById("failure").style.display="block";
                </script>
                <?php
            }

            // Sinon, on enregistre le nom d'utilisateur dans la base de données
            else {
                ?>
                <script type="text/javascript">
                    window.location = "demo.php";
                </script>
                <?php
            }
        }

    ?> 




</body>
</html>