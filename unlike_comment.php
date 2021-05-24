<?php
    include 'auth.php';
    if (!$userid = checkAuth()) exit;


    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    $username = mysqli_real_escape_string($conn, $_SESSION['spa_username']);
    $comment_id = $_GET['type'];

    $user_query = "SELECT ID FROM CLIENTE WHERE username = '$username'";
    $user_res = mysqli_query($conn, $user_query) or die(mysqli_error($conn));
    $user_id = mysqli_fetch_row($user_res);

    $in_query = "DELETE FROM LIKES WHERE cliente = '$user_id[0]' AND commento = '$comment_id'";

    $out_query = "SELECT nlikes FROM COMMENTO WHERE ID = '$comment_id'";

    $res1 = mysqli_query($conn, $in_query) or die (mysqli_error($conn));

    if($res1) {
        $res2 = mysqli_query($conn, $out_query);

        if(mysqli_num_rows($res2) > 0) {

            $entry = mysqli_fetch_assoc($res2);

            $returndata = array('ok' => true, 'commento' => $comment_id, 'nlikes' => $entry['nlikes']);

            echo json_encode($returndata);

            mysqli_close($conn);

            exit;

        }
    }

    mysqli_close($conn);
    echo json_encode(array('ok' => false));
?>