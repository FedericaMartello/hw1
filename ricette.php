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
        <title>Food Delivery - Ricette</title>

        <link rel="preconnect" href="https://fonts.gstatic.com">   
        <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">      
        <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@1,300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p&display=swap" rel="stylesheet">

        <script src="ricette.js" defer='true'></script>
        <link rel="stylesheet" href="ricette.css">

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

        </header>

        <h1 id='main_title'> Le nostre ricette </h1>  
        
        <article>
            <section id='album-ricette'>
            </section>

            <section id='show-recipe' class='hidden'>
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
              Lun-Dom: 11:00-23:00S</p>
  
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