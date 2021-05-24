<?php
    require_once 'auth.php';

    header('Content-Type: application/json');

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

    $query = "SELECT * FROM CENTRO";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $contactsArray = array();
    while($contacts = mysqli_fetch_assoc($res)) {
        $contactsArray[] = array('codice' => $contacts['codice'], 'citta' => $contacts['citta'],
                                'telefono' => "0".$contacts['telefono']);
    }

    echo json_encode($contactsArray);
    exit;
?>