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
                  <li class="nav-item">
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
            $isbn = "";
            $isbn = $_POST['isbn'];
            $name;
            include ("login.inc");                        
            include ("constants.inc");                        
            $conexion = new mysqli ($mysql_server,$mysql_login,$mysql_pass,$servername);

            if ($conexion->connect_errno) {
                header('Location: index.php');  
            }
            $sentenciaSQL = "SELECT Name FROM book where ISBN = '" . $isbn . "';";
            $registros = $conexion->query ($sentenciaSQL); 
            while ($row = $registros->fetch_assoc()){
                $name = $row['Name'];
            }
            echo "<h1>" . $name . "</h1>";
            echo " <h6>FROM THE MOMENT YOU PICK UP THE BOOK YOU HAVE " . $maximumdays . " DAYS TO RETURN IT</h6>";
            echo " <h6>WHEN YOU CLICK ON RESERVE YOUR BOOK WILL BE PREPARED AN READY FOR PICKUP</h6>";
        ?>
        <div id="mytable">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Book</th>
                        <th>Language</th>
                        <th>State</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
            <?php 
                $sentenciaSQL = "SELECT ID, Name, Language, state FROM book_copy WHERE original_ISBN = '" . $isbn . "' AND (ID NOT IN (SELECT bookID FROM reservation WHERE DateReturn IS NULL) OR ID NOT IN (SELECT bookID FROM reservation group by bookID))";
                $registros = $conexion->query ($sentenciaSQL);
                $increment = 1;
                while ($row = $registros->fetch_assoc()){
                    echo "<tr>"; 
                    echo "<th scope=" . '"row"' . ">" . $increment . "</th>";
                    echo "<td>" . $row['Name'] . "</td>";
                    echo "<td>" . $row['Language'] . "</td>";
                    echo "<td>" . $row['state'] . "</td>";
                    echo "<td>";
                    echo "<form action=" . '"./reserve.php"' . "method='" . "post" . "'>";
                    echo "<input type='" . "hidden" . "'name='" . "id" . "'value='" . $row['ID'] . "'/>";
                    echo "<input type='" . "Submit" . "'name='" . "submit" . "'value='Reserve'/>";
                    echo "</form>";
                    echo "</td>";
                    $increment++;
                    echo "</tr>";
                }

            ?>
            </tbody>
        </table>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    </body>
</html>