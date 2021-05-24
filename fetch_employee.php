<?php
    require_once 'auth.php';

    header('Content-Type: application/json');

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

    $query = "SELECT I.*, D.centro as centro, D.nome as dip_nome, C.citta as citta_centro FROM (IMPIEGATO I join DIPARTIMENTO D on I.dipartimento = D.ID) join CENTRO C on D.centro = C.codice";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $employeeArray = array();
    while($employee = mysqli_fetch_assoc($res)) {
        $employeeArray[] = array('nome' => $employee['nome'], 'cognome' => $employee['cognome'], 
                                'dob' => $employee['data_nascita'], 'citta' => $employee['citta_centro'], 
                                'dipartimento' => $employee['dip_nome']);
    }

    echo json_encode($employeeArray);
    exit;
?>