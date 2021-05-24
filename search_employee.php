<?php
    require_once 'auth.php';

    header('Content-Type: application/json');

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

    $username = mysqli_real_escape_string($conn, $_SESSION['spa_username']);
    $service = $_GET['type'];

    $query = "SELECT I.nome as nome, I.cognome as cognome, S.trattamento as trattamento
            FROM ((((CLIENTE C join DIPARTIMENTO D on C.centro = D.centro) join IMPIEGATO I on D.ID = I.dipartimento)
            join OFFERTA O on D.ID = O.dipartimento) join SERVIZIO S on O.servizio = S.codice)
            WHERE C.username = '$username' and S.trattamento = '$service'";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $employeeArray = array();
    while($employee = mysqli_fetch_assoc($res)) {
        $employeeArray[] = array('nome' => $employee['nome'], 'cognome' => $employee['cognome'],
                                'type' => $employee['trattamento']);
    }

    echo json_encode($employeeArray);
    exit;
?>