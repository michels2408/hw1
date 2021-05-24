<?php
    require_once 'auth.php';

    header('Content-Type: application/json');

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

    $budget = $_GET['type'];

    $query = "SELECT S.trattamento as trattamento, T.prezzo as prezzo 
            FROM tutti_servizi T join SERVIZIO S on T.id_servizio = S.codice WHERE T.prezzo <= '$budget'";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $servicesArray = array();
    while($services = mysqli_fetch_assoc($res)) {
        $servicesArray[] = array('trattamento' => $services['trattamento'], 'prezzo' => $services['prezzo']);
    }
    echo json_encode($servicesArray);
    exit;
?>