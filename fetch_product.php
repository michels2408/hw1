<?php
        require_once 'auth.php';

    header('Content-Type: application/json');

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

    $query = "SELECT * FROM PRODOTTO";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $productsArray = array();
    while($products = mysqli_fetch_assoc($res)) {
        $productsArray[] = array('titolo' => $products['titolo'], 'tipo' => $products['tipo'],
                                'foto' => $products['foto'], 'descrizione' => $products['descrizione']);
    }
    echo json_encode($productsArray);

?>