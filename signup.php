<?php
    require_once 'auth.php';

    if (checkAuth()) {
        header("Location: home.php");
        exit;
    }   

    if (!empty($_POST["branch"]) && !empty($_POST["name"]) && !empty($_POST["surname"]) && !empty($_POST["dob"]) && 
        !empty($_POST["cf"]) && !empty($_POST["city"]) && !empty($_POST["username"]) && !empty($_POST["password"]) &&
        !empty($_POST["confirm_password"]))
    {
        $error = array();
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

        #CF
        if(strlen($_POST["cf"]) != 16) {
            $error[] = "Il codice fiscale ha più di 16 cifre";
        } else {
            $cf = mysqli_real_escape_string($conn, $_POST['cf']);
            // Cerco se il cf esiste già o se appartiene a una delle 3 parole chiave indicate
            $query = "SELECT cod_fiscale FROM CLIENTE WHERE cod_fiscale = '$cf'";
            $res = mysqli_query($conn, $query);
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Codice fiscale già utilizzato";
            }
        }

        # USERNAME
        if(!preg_match('/^[a-zA-Z0-9_-]{1,15}$/', $_POST['username'])) {
            $error[] = "Username non valido";
        } else {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            // Cerco se l'username esiste già o se appartiene a una delle 3 parole chiave indicate
            $query = "SELECT username FROM CLIENTE WHERE username = '$username'";
            $res = mysqli_query($conn, $query);
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Username già utilizzato";
            }
        }
        # PASSWORD
        if (strlen($_POST["password"]) < 8  || strlen($_POST["password"]) > 15) {
            $error[] = "Caratteri password insufficienti o eccessivi";
        } 
        # CONFERMA PASSWORD
        if (strcmp($_POST["password"], $_POST["confirm_password"]) != 0) {
            $error[] = "Le password non coincidono";
        }

        # REGISTRAZIONE NEL DATABASE
        if (count($error) == 0) {
            $dob = mysqli_real_escape_string($conn, $_POST['dob']);
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $surname = mysqli_real_escape_string($conn, $_POST['surname']);
            $city = mysqli_real_escape_string($conn, $_POST['city']);

            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = password_hash($password, PASSWORD_BCRYPT);
            
            $query_nclienti = "SELECT count(*)+1 FROM CLIENTE";
            $res_nclienti = mysqli_query($conn, $query_nclienti) or die(mysqli_error($conn));
            $nclienti = mysqli_fetch_row($res_nclienti);
        
            if($_POST["branch"] == "Roma") {
                $query = "INSERT INTO CLIENTE VALUES('$nclienti[0]', '1', '$cf', '$name', '$surname', '$dob', '$city', '$username', '$password')";
            } else if($_POST["branch"] == "Milano") {
                $query = "INSERT INTO CLIENTE VALUES('$nclienti[0]', '2', '$cf', '$name', '$surname', '$dob', '$city', '$username', '$password')";
            } else {
                $query = "INSERT INTO CLIENTE VALUES('$nclienti[0]', '3', '$cf', '$name', '$surname', '$dob', '$city', '$username', '$password')";
            }
            
            if (mysqli_query($conn, $query)) {
                $_SESSION["spa_username"] = $_POST["username"];
                $_SESSION["spa_user_id"] = $_POST["password"];
                header("Location: home.php");
                mysqli_close($conn);
                exit;
            } else {
                $error[] = "Errore di connessione al database";
            }
        }
    }
    else if (isset($_POST["username"])) {
        $error = array("Form incompleto");
    }
?>

<html>
    <head>
        <title>Quiet Wave - Centro Benessere</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style/signup1.css" />
        <script src='scripts/signup.js' defer="true"></script>
    </head>
    <body>
        <div id="head"></div>

        <div id="central_block">
            <h1>Benvenuto!</h1>
            <p>Unisciti alla nostra community, inserisci le tue credenziali.</p>

            <form name='signup' method='post'>
                <div class="branch">
                    <div><label for='branch'>Filiale:</label></div>
                    <input type='radio' name='branch' value='Roma'>Roma
                    <input type='radio' name='branch' value='Milano'>Milano
                    <input type='radio' name='branch' value='bologna'>Bologna
                </div>
                <div class="name">
                    <div><label for='name'>Nome:</label></div>
                    <div><input type='text' name='name'></div>
                </div>
                <div class="surname">
                    <div><label for='surname'>Cognome:</label></div>
                    <div><input type='text' name='surname'></div>
                </div>
                <div class="dob">
                    <div><label for='dob'>Data di nascita:</label></div>
                    <div><input type='date' name='dob' value='2003-01-01' min='1921-01-01' max= '2003-01-01'></div>
                </div>
                <div class="cf">
                    <span class="hidden">Errore, formato codice fiscale non supportato!</span>
                    <div><label for='cf'>Codice fiscale:</label></div>
                    <div><input type='text' name='cf'></div>
                </div>
                <div class="city">
                    <div><label for='city'>Città di residenza:</label></div>
                    <div><input type='text' name='city' id='dob'></div>
                </div>
                <div class="username">
                    <span class="hidden">Errore, username già in uso!</span>
                    <div><label for='username'>Username:</label></div>
                    <div><input type='text' name='username'></div>
                </div>
                <div class="password">
                    <span class="hidden">Errore, la password deve avere tra gli 8 e i 15 caratteri!</span>
                    <div><label for='password'>Password (compresa tra 8 e 15 caratteri):</label></div>
                    <div><input type='password' name='password'></div>
                </div>
                <div class="confirm_password">
                    <span class="hidden">Errore, la password non coincide!</span>
                    <div><label for='confirm_password'>Conferma password:</label></div>
                    <div><input type='password' name='confirm_password'></div>
                </div>
                <div>
                    <input class="submit" type='submit' value="Registrati">
                </div>
                <div class="signup">Sei già registrato? <a href="login.php">Accedi</a></div>
            </form>
        </div>

        <div id="foot"></div>
    </body>
</html>