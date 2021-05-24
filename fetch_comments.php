<?php
    require_once 'auth.php';

    header('Content-Type: application/json');

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

    $query = "SELECT C2.username as username, C1.testo as testo, C1.giorno as giorno, C1.ora as ora,  C1.nlikes as nlikes
            FROM COMMENTO C1 join CLIENTE C2 on C1.cliente = C2.ID";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $commentsArray = array();
    while($comments = mysqli_fetch_assoc($res)) {
        $commentsArray[] = array('username' => $comments['username'], 'testo' => $comments['testo'],
                                'giorno' => $comments['giorno'], 'ora' => $comments['ora'], 'nlikes' => $comments['nlikes']);
    }

    echo json_encode($commentsArray);
    exit;
?>