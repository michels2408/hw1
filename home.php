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
        <link rel="stylesheet" href="style/home1.css" />
        <script src='scripts/home.js' defer='true'></script>
    </head>  
    <body>
        <article>
            <header>
                <div id ="overlay"></div>
                <nav>
                    <div id="links">
                        <a href="home.php">Home</a>
                        <a href="about.php">About</a>
                        <a href="services.php">Servizi</a>
                        <a href="news.php">News</a>
                        <a href="contacts.php">Contattaci</a>
                        <a id="logout" href="logout.php">Logout<a>
                    </div>
                    <a id="menu" href="menu_mobile.php">
                        <div></div>
                        <div></div>
                        <div></div>
                    </a>
                </nav>
            
                <img src="images/resized_logo.jpg" />
                <h1>
                    <em>Centro benessere</em></br>
                    <strong>QUIET WAVE</strong></br>
                    <em>La tua oasi del relax</em>
                </h1>
            </header>
        
            <section>
                <div id="main"> 
                    <div id="text_main">
                        <h1>Scegli di coccolarti</h1>
                        <p>Rilascia lo stress quotidiano con noi.</p>
                        <p>Scegli di prenderti cura del tuo corpo e della tua chioma selezionando tra un'ampia gamma di trattamenti esclusivi solo per te.</p></br>
                        <a class="button" href="new_appointment.php">Prenota ora il tuo appuntamento</a></br>
                        <a id="view">Vedi i tuoi appuntamenti</a>
                        <div id = "modal" class = "hidden">
                    </div>
                </div>
        
                <div id="dipart">
                    <div id="massaggi">
                        <img src="https://www.healthnearbuy.com/dtup/1524059766.jpg" />
                        <h1>MASSAGGI</h1>
                        <p>La nostra ampia selezione di massaggi verrà incontro a tutte le tue esigenze, devi solo scegliere quello che fa per te.</p>
                    </div>

                    <div id="depilaz">
                        <img src="https://static.toiimg.com/photo/msid-71307818/71307818.jpg" />
                        <h1>DEPILAZIONE</h1>
                        <p>Scegli l'attenzione e la delicatezza dei nostri collaboratori per una pelle liscia e luminosa.</p></br>
                    </div>
                
                    <div id="capelli">
                        <img src="https://thumbs.dreamstime.com/b/hairdresser-cutting-long-hair-salon-blond-129356808.jpg" />
                        <h1>CAPELLI</h1>
                        <p>Dona vita ai tuoi capelli con noi affidandoti all'esperienza dei nostri hairstylist e alla qualità dei nostri prodotti.</p>
                    </div>

                </div>
            
                <div id="prodotti">
                    <div id="text_prod">
                        <h1>I nostri prodotti</h1>
                        <p>Vieni a scoprire i nostri prodotti biologici per la cura dei tuoi capelli!</p>
                        <p>I nostri esperti ti aiuteranno a trovare quelli adatti a te.</p>
                        <a class="button" href="products.php">Scopri la gamma</a>
                    </div>
                    <img src="https://maneaddicts.com/wp-content/uploads/2017/01/function.png" />
                </div>
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