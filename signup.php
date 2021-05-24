<?php
    session_start();
    if(isset($_SESSION['username']))
    {
        header("Location: home.php");
        exit;
    }

    if (isset($_POST["name"]) && isset($_POST["address"]) && isset($_POST["tel"]) && isset($_POST["username"])
        && isset($_POST["password"]) && isset($_POST["test_password"]))
    {
        $error = array();
        $conn = mysqli_connect("localhost", "root", "", "progetto") or die(mysqli_error($conn));


        //Controllo PASSWORD
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        $passTest = mysqli_real_escape_string($conn, $_POST["test_password"]);

        if (strlen($password)>5                 //almeno 5 caratteri
            && strlen($password)<15             //al max 15 caratteri
            && preg_match('`[A-Z]`', $password) //Alemno un carattere maiuscolo
            && preg_match('`[a-z]`', $password) //Almeno un carattere minuscolo
            && preg_match('`[0-9]`', $password) //Almeno un numero
            && (preg_match('`[?]`', $password) || preg_match('`[@]`', $password) || preg_match('`[_]`', $password)|| preg_match('`[%]`', $password)) //Caratteri speciali
        ){
            echo "Password valida";
        }else
        {
            $error[] = "Caratteri non validi";
            echo "password non valida";
        }
            
        if(strcmp($password, $passTest) != 0)
        {
            $error[] = "Le password non coincidono";
            echo "Le password non coincidono";
        }


        //Controllo USERNAME già in uso
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $query_username = "SELECT username FROM cliente WHERE  username = '$username' ";
        $res_query_username = mysqli_query($conn, $query_username);
        if(mysqli_num_rows($res_query_username) > 0)
        {
            $error[]="Username già in uso";
            echo "username già in uso";
        }


        //Inserimento nel DATABASE
        if(count($error)==0)
        {
            $name = mysqli_real_escape_string($conn, $_POST["name"]);
            $address = mysqli_real_escape_string($conn, $_POST["address"]);
            $tel = mysqli_real_escape_string($conn, $_POST["tel"]);
            $password = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO cliente (username, password, name, indirizzo, tel) VALUES ('$username', '$password', '$name', '$address', '$tel')";
            $res = mysqli_query($conn, $query);

            if($res)
            {
                $_SESSION["username"] = $_POST["username"];
                $_SESSION["username_id"] = mysqli_insert_id($conn);
                mysqli_close($conn);
                header("Location: home.php");
                exit;
            }else
            {
                $error[] = "Errore di connessione al Database";
                echo "Errore di connessione al Database";
            }
        }

        mysqli_close($conn);
    }
    else if (isset($_POST["username"]))
    {
        $error = array("Riempi tutti i campi");
        echo "Riempi tutti i campi";
    }
   
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Food Delivery - Sign up</title>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">                                
        <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@1,300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">


        <link rel="stylesheet" href="signup.css">
        <script src='signup.js' defer></script>


        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
        <header>
            <nav>
                <div id="logo">
                <img src="https://img.apkappsdownload.co/v2/image1/Y29tLm11ZnVtYm8uYW5kcm9pZC5yZWNpcGUuc2VhcmNoX2ljb25fMTU1NzMxMTU1MV8wMjQ/icon.png?w=170&fakeurl=1" />
                <h1>Food Delivery</h1>
                </div>
                
                <a href='login.php'>Hai un account? Accedi</a>
            </nav>
        </header>

        <article>
            <section id="user-dates">
                <form name='sign-up' method='POST'>
                        <p>
                            <label>Nome<input type='text' id="name" placeholder="Nome Cognome" name='name' <?php if(isset($_POST["name"])){echo "value=".$_POST["name"];} ?> ></label>
                        </p>
                        <p>
                            <label>Indirizzo<input type='text' id="indirizzo" placeholder="Via..." name='address' <?php if(isset($_POST["address"])){echo "value=".$_POST["address"];} ?>></label>
                        </p>
                        <p>
                            <label>Telefono<input type='text' id="tel" placeholder="+39" name='tel' <?php if(isset($_POST["tel"])){echo "value=".$_POST["tel"];} ?>></label>
                        </p>
                        <p>
                            <label>Username<input type='text' id="username" placeholder="yourUsername" name='username' <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>></label>
                        </p>
                        <p>
                            <label>Password<input type='text' id="password" placeholder="yourpassword" name='password' <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>></label>
                        </p>
                        <p>
                            <label>Ripeti password<input type='text' id="test" placeholder="yourpassword" name='test_password' <?php if(isset($_POST["test_password"])){echo "value=".$_POST["test_password"];} ?>></label>
                        </p>
                        <p>
                            <label>&nbsp;<input type="submit" value='Registrati' id='button'></label>
                        </p>
                    </form>
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
              Lun-Dom: 11:00-23:00</p>
  
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