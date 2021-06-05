<?php
    include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/register.css">
    <title>Registration</title>
</head>
<body>
    <section>
        <h1>Register now</h1>
        <form action="" method="post" name="form1">
            <div class="box-input">
                <label for="firstname">Firstname</label>
                <input type="text" name="firstname" placeholder="John">
            </div>
            <div class="box-input">
                <label for="lastname">Lastname</label>
                <input type="text" name="lastname" placeholder="Wright">
            </div>
            <div class="box-input">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="John23">
            </div>
            <div class="box-input">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="**********">
            </div>
            <input class='btn-submit' name="btn-register" type="submit" value="Register">
        </form>

        <div class="alert alert-success" id="success">
            <strong>Success !</strong> Account registration successfully.
        </div>

        <div class="alert alert-danger" id="failure">
            <strong>Already exist !</strong> This username already exist.
        </div>
        
        <a class="already-registered" href="login.php">Already registered ?</a>
    </section>


    <?php
        if (isset($_POST['btn-register'])) {

            // On regarde si le nom d'utilisateur est déjà utilisé
            $request = $bdd->query("SELECT * FROM registration WHERE username='$_POST[username]'") or die(print_r($bdd->errorInfo()));
            $count = $request->rowCount(); # on compte le nombre de lignes contenant le pseudo
            
            // Si le pseudo est déjà utilisé, on affiche un message d'erreur
            if ($count > 0) {
                ?>
                <script type="text/javascript">
                    document.getElementById("success").style.display="none";
                    document.getElementById("failure").style.display="block";
                </script>
                <?php
            }

            // Sinon, on enregistre le nom d'utilisateur dans la base de données
            else {
                $bdd->exec("INSERT INTO registration(firstname, lastname, username, password) VALUES('$_POST[firstname]', '$_POST[lastname]', '$_POST[username]', '$_POST[password]')") or die(print_r($bdd->errorInfo()));
                ?>
                <script type="text/javascript">
                    document.getElementById("failure").style.display="none";
                    document.getElementById("success").style.display="block";
                </script>
                <?php
            }
        }

    ?> 


</body>
</html>