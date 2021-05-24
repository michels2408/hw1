<?php
    require_once 'auth.php';

    header('Content-Type: application/json');

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

    $username = mysqli_real_escape_string($conn, $_SESSION['spa_username']);

    $query = "SELECT P.codice as codice, P.titolo as titolo, P.tipo as tipo, P.foto as foto
            FROM ((PRODOTTO P join LIKES_PRODOTTO L on P.codice = L.prodotto) join CLIENTE C on L.cliente = C.ID) 
            WHERE C.username = '$username'";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    if (mysqli_num_rows($res) > 0) {
        $favsArray = array();

        while($fav = mysqli_fetch_assoc($res)) {
            $favsArray[] = array('ok' => true, 'codice' => $fav['codice'], 'titolo' => $fav['titolo'],
                                'tipo' => $fav['tipo'], 'foto' => $fav['foto']);
        }

        echo json_encode($favsArray);

        mysqli_close($conn);

        exit;

    }

    mysqli_close($conn);
    echo json_encode(array('ok' => false));

?>