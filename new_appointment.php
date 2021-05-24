<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }

    if(!empty($_POST["service"]) && !empty($_POST["type"]) && !empty($_POST["date"]) && !empty($_POST["time"])) {
        $error = array();
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

        //DATE
        $dayofweek = date('w', strtotime($_POST['date']));
        if($dayofweek == "0" || $dayofweek == "6") {
            $error[] = "No sabati e domeniche";
            $err = true;
        } else {
            $date = mysqli_real_escape_string($conn, $_POST['date']);
        }

        if (count($error) == 0) {
            $service = mysqli_real_escape_string($conn, $_POST['service']);
            $employee = mysqli_real_escape_string($conn, $_POST['type']);
            
            $query_napp = "SELECT max(ID)+1 FROM APPUNTAMENTO";
            $res_napp = mysqli_query($conn, $query_napp) or die(mysqli_error($conn));
            $napp = mysqli_fetch_row($res_napp);

            $username = mysqli_real_escape_string($conn, $_SESSION['spa_username']);
            $query_client = "SELECT ID FROM CLIENTE WHERE username = '$username'";
            $res_client = mysqli_query($conn, $query_client) or die(mysqli_erro($conn));
            $client = mysqli_fetch_row($res_client);

            $name_surname = explode(" ", $employee);
            $query_employee = "SELECT ID FROM IMPIEGATO WHERE nome = '$name_surname[0]' and cognome = '$name_surname[1]'";
            $res_employee = mysqli_query($conn, $query_employee) or die(mysqli_error($conn));
            $employee1 = mysqli_fetch_row($res_employee);

            $query_service = "SELECT codice FROM SERVIZIO WHERE trattamento = '$service'";
            $res_service = mysqli_query($conn, $query_service) or die(mysqli_error($conn));
            $service1 = mysqli_fetch_row($res_service);

            $query = "INSERT INTO APPUNTAMENTO VALUES('$napp[0]', '$client[0]', '$employee1[0]', '$service1[0]', '$date', '$time')";
        }

        if (mysqli_query($conn, $query)) {
            header("Location: home.php");
            mysqli_close($conn);
            exit;
        } else {
            $error[] = "Errore di connessione al database";
        }
    } else {
        $error = array("Form incompleto");
    }
?>

<html>
    <head>
        <title>Quiet Wave - Centro Benessere</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style/new_appointment1.css" />
        <script src='scripts/new_appointment.js' defer='true'></script>
    </head>  
    <body>
        <div id="head"></div>

        <div id="central_block">
            <h1>Prenota un nuovo appuntamento</h1>
            <p>Riempi il form per prenotare un nuovo appuntamento!</p>

            <form name='new_appointment' method='post'>
                <div class="service">
                    <p>Servizio:</p>
                    <select name="service" id="service">
                        <option value="choose">Seleziona un servizio</option>
                        <option value="Maschera">Maschera</option>
                        <option value="Depilazione viso">Depilazione viso</option>
                        <option value="Pulizia viso">Pulizia viso</option>
                        <option value="Massaggio">Massaggio</option>
                        <option value="Depilazione corpo">Depilazione corpo</option>
                        <option value="Laser">Laser</option>
                        <option value="Taglio">Taglio</option>
                        <option value="Colore">Colore</option>
                        <option value="Piega">Piega</option>
                    </select>
                </div>

                <?php
                    if(isset($err)) {
                        echo "<span>Il centro benessere non lavora durante il weekend, scegli un altro giorno!</span>";
                    }
                ?>

                <div id="show"></div>

                <a href="home.php">Annulla prenotazione</a>
            </form>
        </div>

        <div id="foot"></div>
    </body>
</html>