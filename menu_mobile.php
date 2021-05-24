<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<html>
    <head>
        <title>Quiet Wave - Centro Benessere</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style/menu_mobile.css" />
    </head>  
    <body>
        <div id="links">
            <a href="home.php">Home</a>
            <a href="about.php">About</a>
            <a href="services.php">Servizi</a>
            <a href="news.php">News</a>
            <a href="contacts.php">Contattaci</a>
            <a id="logout" href="logout.php">Logout<a>
        </div>
    </body>
</html>