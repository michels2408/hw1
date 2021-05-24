<?php
    include 'auth.php';
    if (checkAuth()) {
        header('Location: home.php');
        exit;
    }

    if (!empty($_POST["username"]) && !empty($_POST["password"]) )
    {
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $query = "SELECT id, username, password FROM CLIENTE WHERE username = '$username'";

        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $row = mysqli_fetch_assoc($res);

        if ($row['username'] == $_POST['username'] && $row['password'] == $_POST['password']) {
            $_SESSION['spa_username'] = $row['username'];
            $_SESSION['spa_user_id'] = $row['password'];
            header("Location: home.php");
            mysqli_free_result($res);
            mysqli_close($conn);
            exit;
        }
        else {
            $error = "Username e/o password errati.";    
        }

    }
    else if (isset($_POST["username"]) || isset($_POST["password"])) {
        // Se solo uno dei due è impostato
        $error = "Inserisci username e password.";
    }

?>

<html>
    <head>
        <title>Quiet Wave - Centro Benessere</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style/login1.css" />
    </head>
    <body>
        <div id="head"></div>

        <div id="central_block">
            <h1>Bentornato dal Centro Benessere Quiet Wave!</h1>
            <p>Inserisci le tue credenziali e prenota un appuntamento in uno dei nostri centri.</p>

            <form name='login' method='post'>
                <div class="username">
                    <div><label for='username'>Username</label></div>
                    <div><input type='text' name='username'></div>
                </div>
                <div class="password">
                    <div><label for='password'>Password</label></div>
                    <div><input type='password' name='password'></div>
                </div>
                <div>
                    <input class="submit" type='submit' value="Accedi">
                </div>
                <div class="signup">Non hai un account? <a href="signup.php">Iscriviti</a></div>
            </form>
        </div>

        <div id="foot"></div>
    </body>
</html>