<?php
    session_start();
    if(!isset($_SESSION["username"]))
    {
        header("Location: login.php");
        exit;
    }

?>



<!DOCTYPE html>
<html>
    <head>
        <title>Food Delivery - Home</title>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">  
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">     
        <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@1,300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="home.css">
        <script src="home.js" defer="true"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
        <header>
            <nav>
                <div id="logo">
                    <img src="https://img.apkappsdownload.co/v2/image1/Y29tLm11ZnVtYm8uYW5kcm9pZC5yZWNpcGUuc2VhcmNoX2ljb25fMTU1NzMxMTU1MV8wMjQ/icon.png?w=170&fakeurl=1" />
                </div>
                <div id="menu">
                    <a href='home.php'>Home</a> <a href='ricette.php'>Ricette</a> <a href='foto.php'>Foto</a> <a href='ordini.php'>Ordini</a>
                    <a href='ingredienti.php'>Scopri</a> <a href='logout.php'>Logout</a> 
                </div>
                <div id="menu-mobile">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>

                <div id="mm" class="hidden"></div>

            </nav>

                <h1>Food Delivery </h1>                
        </header>

        <article>

            <section>
                <div class="instructions">
                    <img src="https://res.cloudinary.com/glovoapp/image/fetch///https://glovoapp.com/images/why-glovo/restaurants.svg"/>
                    <br/><span>Scegli e personalizza i tuoi piatti preferiti.</span>
                </div>

                <div class="instructions">
                    <img src="https://res.cloudinary.com/glovoapp/image/fetch///https://glovoapp.com/images/why-glovo/delivery.svg"/>
                    <br/><span>Inserisci il tuo indirizzo,<br/>
                    consegneremo il tuo ordine in pochi minuti.</span>
                </div>

                <div class="instructions">
                    <img src="https://res.cloudinary.com/glovoapp/image/fetch///https://glovoapp.com/images/landing/cities.svg"/>
                    <br/><span>Gusta la nostra cucina a casa tua!</span>
                </div>
            </section>
          
          <section>
            <div class="box">
              <img src="https://www.informacibo.it/wp-content/uploads/2018/04/carbonara-500x500.jpg"/>
                <p>
                  <strong>Ti consigliamo:</strong><br/>
                  <span>Carbonara:</span><br/> guanciale speziato, una crema dorata a base di tuorli e tanto Pecorino grattugiato al momento.
                            La ricetta degli spaghetti alla carbonara e'una tra le piu' amate.
                </p>
            </div>

            <div class="box">
              <img src="https://ordina.pepperone.com/wp-content/uploads/capricciosa.jpg"/>
              <p>
                  <strong>Ti consigliamo:</strong><br/>
                  <span>Pizza Capricciosa:</span><br/>  La pizza capricciosa e' una di quelle che non passa mai di moda.
                        Gli ingredienti di base sono pomodoro, mozzarella, prosciutto cotto, funghi, olive e carciofini.
                </p>     
            </div>
          </section>

            <section id="ticket-background" class="hidden">
            </section>

          <section id="carrello">
            <div id="info-ordine">Dettagli dell'ordine:
                <form method="GET">
                    <label>Data: <input type="date" name="d"></label>
                    <label>Ora: <input type="time" name="t"></label>
 
                    <input id="buy" type="submit" value="Procedi all'ordine 🛒">
                </form>
            </div>

            <div id="in-the-cart">
            </div>
          </section>

            <section id="main_block">
            </section>

        </article>

        <footer>
            <div class="info">
                <span>Prodotti forniti da <br/>
                  <strong>Ristorante da Mario</strong>
                  <address>Via del Mare, 45, Catania.</address></span>
            </div>
  
              <div class="info">
                  <h1>Federica Martello <br/>O46002249
                  </h1>
              </div>
  
          <div class="info">
              <p><strong>Orari:</strong><br/>
              Lun-Ven: 10:00-23:00<br/>
              Sab-Dom: 16:00-23:00<br/></p>
  
              <p><strong>Attenzione:</strong><br>
              possibili variazioni di orario in seguito ad emergenza COVID-19.<br/>
              </p>
          </div>        
          
          <div id="footer-mobile">
              <div class="f-m"> <a>Info</a> </div>
              <div class="f-m"> <h1>Federica Martello <br/>O46002249</h1> </div>
              <div class="f-m"> <a>Orari - Avvisi</a> </div>
          </div>
          </footer>
      </body>
  </html>