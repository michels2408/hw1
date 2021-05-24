<?php
    require_once 'auth.php';

    header('Content-Type: application/json');

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

    $query = "SELECT * FROM (((tutti_servizi T join SERVIZIO S on T.id_servizio = S.codice)
            join OFFERTA O on T.id_servizio = O.servizio) left join DIPARTIMENTO D on O.dipartimento = D.ID)
            WHERE D.centro = '2'";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $servicesArray = array();
    while($services = mysqli_fetch_assoc($res)) {
        $servicesArray[] = array('trattamento' => $services['trattamento'], 'prezzo' => $services['prezzo'],
                                'dipartimento' => $services['nome'], 'foto' => $services['foto']);
    }
    echo json_encode($servicesArray);
    exit;
?>