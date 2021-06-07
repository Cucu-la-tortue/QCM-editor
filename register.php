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

        <div class="alert alert-danger" id="failure">
            <strong>Already exist !</strong> This username already exist.
        </div>

        <div class="alert alert-danger" id="incomplete">
            <strong>Invalid !</strong> Please fill required informations.
        </div>
        
        <a class="already-registered" href="login.php">Already registered ?</a>
    </section>


    <?php
        if (isset($_POST['btn-register'])) {
            if ($_POST['firstname']!=NULL AND $_POST['lastname']!=NULL AND $_POST['username']!=NULL AND $_POST['password']!=NULL) {
                // On regarde si le nom d'utilisateur est déjà utilisé
                $request = $bdd->prepare("SELECT * FROM registration WHERE username = ?") or die(print_r($bdd->errorInfo()));
                $request->execute(array($_POST['username']));
                $count = $request->rowCount(); # on compte le nombre de lignes contenant le pseudo
                
                // Si le pseudo est déjà utilisé, on affiche un message d'erreur
                if ($count > 0) {
                    ?>
                    <script type="text/javascript">
                        document.getElementById("incomplete").style.display="none";
                        document.getElementById("failure").style.display="block";
                    </script>
                    <?php
                }

                // Sinon, on enregistre le nom d'utilisateur dans la base de données
                else {
                    $bdd->exec("INSERT INTO registration(firstname, lastname, username, password) VALUES('$_POST[firstname]', '$_POST[lastname]', '$_POST[username]', '$_POST[password]')") or die(print_r($bdd->errorInfo()));
                    ?>
                    <script type="text/javascript">
                        window.location = "dashboard.php";
                    </script>
                    <?php
                }
            }

            else {
                ?>
                <script type="text/javascript">
                    document.getElementById("failure").style.display="none";
                    document.getElementById("incomplete").style.display="block";
                </script>
                <?php
            }
        }

    ?> 


</body>
</html>