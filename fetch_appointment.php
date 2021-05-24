<?php
    require 'auth.php';

    header('Content-Type: application/json');

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

    $username = mysqli_real_escape_string($conn, $_SESSION['spa_username']);

    $query = "SELECT C2.citta as centro, S.trattamento as trattamento, A.data_app as data, A.ora_app as ora,
            I.nome as nome_imp, I.cognome as cognome_imp FROM ((((APPUNTAMENTO A join CLIENTE C1 on A.cliente = C1.ID)
            join CENTRO C2 on C1.centro = C2.codice) join SERVIZIO S on A.servizio = S.codice) 
            join IMPIEGATO I on A.impiegato = I.ID) WHERE C1.username = '$username'";
    
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    $appointmentArray = array();
    while($appointment = mysqli_fetch_assoc($res)) {
        $appointmentArray[] = array('centro' => $appointment['centro'], 'trattamento' => $appointment['trattamento'],
                                'data' => $appointment['data'], 'ora' => $appointment['ora'],
                                'nome_impiegato' => $appointment['nome_imp'], 'cognome_impiegato' => $appointment['cognome_imp']);
    }

    echo json_encode($appointmentArray);
    exit;
?>