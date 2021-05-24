<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }

    if(!empty($_GET['type'])) {
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
    
        $comment = mysqli_real_escape_string($conn, $_GET['type']);

        $query_id = "SELECT count(*) + 1 as n_comm FROM COMMENTO";
        $res_id = mysqli_query($conn, $query_id) or die(mysqli_error($conn));
        $id = mysqli_fetch_row($res_id);

        $username = mysqli_real_escape_string($conn, $_SESSION['spa_username']);
        $query_client = "SELECT ID FROM CLIENTE WHERE username = '$username'";
        $res_client = mysqli_query($conn, $query_client) or die(mysqli_error($conn));
        $client = mysqli_fetch_row($res_client);

        $date = date('Y-m-y');
        $current_date = mysqli_real_escape_string($conn, $date);

        $time = date('H:i:s');
        $current_time = mysqli_real_escape_string($conn, $time);

        $query = "INSERT INTO COMMENTO VALUES('$id[0]', '$client[0]', '$comment', '$current_date', '$current_time', '0')";
        
        if (mysqli_query($conn, $query)) {
            mysqli_close($conn);
            exit;
        }
    }
?>