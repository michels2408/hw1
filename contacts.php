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
        <link rel="stylesheet" href="style/contacts.css" />
        <script src='scripts/contacts.js' defer='true'></script>
    </head>  
    <body>
        <article>
            <header>
                <div id ="overlay"></div>
                <nav>
                    <div id="links">
                        <a href="home.php">Home</a>
                        <a href="about.php"> About</a>
                        <a href="services.php">Servizi</a>
                        <a href="news.php">News</a>
                        <a href="contacts.php">Contattaci</a>
                        <a id="logout" href="logout.php">Logout<a>
                    </div>
                    <div id="menu">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </nav>
            
                <img src="images/resized_logo.jpg" />
                <h1>
                    <strong>CONTATTACI</strong></br>
                </h1>
            </header>
        
            <section id="main">
                <h1>I nostri contatti</h1>
                <p>Preferisci prendere appuntamento telefonicamente con uno dei nostri dipendenti?</p>
                <p>Vuoi lavorare con noi?</p>
                <p>Chiamaci!</p>
            </section>

            <section id="contacts">
            </section>
        
            <footer>
                <div id="details">
                    <div id="luogo">
                        <h1>Trova il salone più vicino a te</h1>
                        <p>Roma</p>
                        <p>Milano</p>
                        <p>Bologna</p>
                    </div>

                    <div id="ora">
                        <h1>Orari di apertura</h1>
                        <p>Martedì 08.30-12.30 / 14.30-19.00</p>
                        <p>Mercoledì 08.30-12.30 / 14.30-19.00</p>
                        <p>Giovedì 08.30-12.30 / 14.30-19.00</p>
                        <p>Venerdì 08.30-19.00</p>
                        <p>Sabato 08.30-17.30</p>
                    </div>

                    <div id="covid">
                        <h1>Annuncio normative COVID-19</h1>
                        <p>Il centro benessere Quiet Wave ci tiene alla salute dei suoi clienti, per cui informiamo la gentile clientela che il centro segue le normative di prevenzione al COVID-19 fornite dallo Stato. Inoltre, saranno forniti mascherina e gel igienizzante all'ingresso a coloro che non ne sono forniti.</p>
                    </div>
                </div>
            
                <div id="firma">
                    <h1>Michela Lucia Saraceno</h1>
                    <p>Matricola: O46002296</p>
                </div>
            </footer>
        </article>
    </body>
</html>