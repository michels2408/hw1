<?php
    require_once 'auth.php';

    header('Content-Type: application/json');

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

    $username = mysqli_real_escape_string($conn, $_SESSION['spa_username']);
    $comment_id = $_GET['type'];

    $query = "SELECT C1.ID as ID FROM ((COMMENTO C1 join LIKES L on C1.ID = L.commento)
            join CLIENTE C2 on L.cliente = C2.ID) WHERE C1.ID = '$comment_id' and C2.username = '$username'";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    if (mysqli_num_rows($res) > 0) {
        $entry = mysqli_fetch_assoc($res);

        $returndata = array('ok' => true, 'commento' => $entry['ID']);

        echo json_encode($returndata);

        mysqli_close($conn);

        exit;

    }

    mysqli_close($conn);
    echo json_encode(array('ok' => false, 'commento' => $comment_id));
?>