<?php
    session_cache_limiter ('nocache,private');
    session_start();
    if($_SESSION['login_user'] == '') {
        header('Location: index.php');  
    }
    if($_SESSION['user_type'] != 3) {
        header('Location: index.php');  
    }
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/index.css">
    
    </head>
    <body>
        <div>
                <img src="images/smaller_trans.png"/>
            </div>
       <nav class="navbar navbar-expand-lg navbar-light bg-light navbar navbar-dark bg-dark">
              <a class="navbar-brand" href="#">Menu</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon glyphicon glyphicon-search"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="catalog.php">Books</a>
                  </li>
                </ul>
                <span>
                    <ul class="navbar-nav mr-auto">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        <?php
                            if(isset($_SESSION['login_user']) and $_SESSION['login_user'] != "") {
                                echo  "<a class=" . '"nav-link"' .  "href=" . '"profile.php"' . ">profile</a>";
                                echo  "<a class=" . '"nav-link"' .  "href=" . '"logout.php"' . ">logout</a>";
                            }
                            else {
                                echo  "<a class=" . '"nav-link"' .  "href=" . '"login.php"' . ">login</a>";
                            }
                        ?>
                    </ul>
                </span>
              </div>
            </nav>
        <br/>
        <?php 
            $id = "";
            $id = $_POST['id'];
            include ("login.inc");        
            $conexion = new mysqli ($mysql_server,$mysql_login,$mysql_pass,$servername);

            if ($conexion->connect_errno) {
                header('Location: index.php');  
            }
            $sentenciaSQL = "SELECT Name, Language, state FROM book_copy where ID = '" . $id . "';";
            $registros = $conexion->query ($sentenciaSQL); 
            while ($row = $registros->fetch_assoc()){
                $name = $row['Name'];
                $language = $row['Language'];
                $state = $row['state'];
            }
            echo "<h1>" . $name . "(Reservation Details)</h1>";
            echo "<br/>";
            echo "<h4> Language: " . $language . "</h4/>";
            echo "<h4> State: " . $state . "</h4/>";
            echo "<h6> YOU CAN PICK UP YOUR ORDER FROM YOUR 'THE LIBRARY' STORE!";
            echo "<h6> YOU HAVE 10 DAYS TO PICK UP YOUR BOOK OR YOUR ORDER IS CANCELLED!";
            echo "<br/><br/><a href=" . '"index.php"' . "type=" . '"button"' . "class=" . '"btn btn-outline-primary"' . ">" . "Finish" . "</a>";
            $userSQL = "SELECT ID FROM user WHERE Name = '" . $_SESSION['login_user'] . "';";
            $registros = $conexion->query($userSQL);
            while ($row = $registros->fetch_assoc()){
                $nameid = $row['ID'];
            }
            $insert = "INSERT INTO reservation VALUES (null, " . $nameid . "," . $id . ",NULL,NULL);";
            $registros = $conexion->query ($insert);
        ?>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    </body>
</html>