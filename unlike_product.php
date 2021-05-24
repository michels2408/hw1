<?php 
    include 'auth.php';
    if (!$userid = checkAuth()) exit;

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    $username = mysqli_real_escape_string($conn, $_SESSION['spa_username']);
    $product_id = $_GET['type'];

    $user_query = "SELECT ID FROM CLIENTE WHERE username = '$username'";
    $user_res = mysqli_query($conn, $user_query) or die(mysqli_error($conn));
    $user_id = mysqli_fetch_row($user_res);

    $query = "DELETE FROM LIKES_PRODOTTO WHERE cliente = '$user_id[0]' AND prodotto = '$product_id'";

    $res = mysqli_query($conn, $query) or die (mysqli_error($conn));

    if($res) {
        $returndata = array('remove' => true, 'add' => false, 'prodotto' => $product_id);

        echo json_encode($returndata);

        mysqli_close($conn);

        exit;
    }

    mysqli_close($conn);
    echo json_encode(array('remove' => false, 'add' => false, 'prodotto' => $product_id));
?>