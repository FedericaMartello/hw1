<?php
    session_start();
    if(isset($_SESSION["username"]))
    {
        header("Location: home.php");
        exit;
    }

    if(isset($_POST["username"]) && isset($_POST["password"]))
    {
        $conn = mysqli_connect("localhost", "root", "", "progetto");

        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);

        $query = "SELECT * FROM cliente WHERE username ='".$username."'";
        $res = mysqli_query($conn, $query);
        if(mysqli_num_rows($res)>0) 
        {
            $data=mysqli_fetch_assoc($res);
            $hidden_password=$data["password"];
            if(password_verify($password, $hidden_password))
            {    
                $_SESSION["username"] = $username;
                header("Location: home.php");
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            }
            else
            {
                $error= true;
            }
        }
        else
        {
            $error = true;
        }
    }
?>





<!DOCTYPE html>
<html>
    <head>
        <title>Food Delivery - Login</title>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">                          
        <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@1,300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p&display=swap" rel="stylesheet">


        <link rel="stylesheet" href="login.css">


        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
        <header>
            <div id='login'>
                <img id='logo' src="https://img.apkappsdownload.co/v2/image1/Y29tLm11ZnVtYm8uYW5kcm9pZC5yZWNpcGUuc2VhcmNoX2ljb25fMTU1NzMxMTU1MV8wMjQ/icon.png?w=170&fakeurl=1" />
                
                <h1>Food Delivery</h1>

                <?php
                    if(isset($error))
                    {
                        echo "<p class='errore'>";
                        echo "Credenziali non valide";
                        echo "</p>";
                    }
                ?>

                <form name='credenziali' method='POST'>
                    <p>
                        <label>Username<input type='text' placeholder="example@email.com" name='username'></label>
                    </p>
                    <p>
                        <label>Password<input type='password' placeholder="yourpassword" name='password'></label>
                    </p>
                    <p>
                        <label>&nbsp;<input type="submit" value='Accedi' id='button'></label>
                    </p>
                </form>
                <a id="sign-up" href='signup.php'>Non hai ancora un account? Iscriviti</a>
            </div>
        </header>

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
              Lun-Dom: 10:00-23:00</p>
  
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