<?php
    session_cache_limiter ('nocache,private');
    session_start();
    if($_SESSION['login_user'] == '') {
        header('Location: index.php');  
    }
    if($_SESSION['user_type'] != 1 and $_SESSION['user_type'] != 2) {
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
                    
                  <li class="nav-item">
                    <?php
                            if(isset($_SESSION['login_user']) and (isset($_SESSION['user_type']) and (($_SESSION['user_type']== 1)))) {
                                echo  "<a class=" . '"nav-link"' .  "href=" . '"userlist.php"' . ">User List</a>";
                                
                            }
                            else if(isset($_SESSION['login_user']) and (isset($_SESSION['user_type']) and (($_SESSION['user_type']== 3)))) {
                            }
                            else if (isset($_SESSION['user_type']) and (($_SESSION['user_type']== 0))) {
                                echo  "<a class=" . '"nav-link"' .  "href=" . '"createaccount.php"' . ">Create Account</a>";
                            }
                        ?>
                  </li>
                <li class="nav-item">
                    <?php
                        if (isset($_SESSION['user_type']) and (($_SESSION['user_type']== 1) or ($_SESSION['user_type']== 2))) {
                            echo  "<a class=" . '"nav-link"' .  "href=" . '"reservations.php"' . ">Reservations</a>";
                        } 
                    ?>
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
            if(isset($_SESSION['user_type']) and (($_SESSION['user_type']== 1) or ($_SESSION['user_type']== 2))) {
                echo "<a href=" . '"catalog.php"' . "type=" . '"button"' . "class=" . '"btn btn-outline-primary"' . ">" . "List Books" . "</a>";
                echo " ";
                echo "<a href=" . '"add_copy.php?id=0"' . "type=" . '"button"' . "class=" . '"btn btn-outline-primary"' . ">" . "Add Copy" . "</a>";
            }
        ?>
        <br/>
        <br/>
            <div id="mytable">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Book</th>
                      <th>Language</th>
                      <th>State</th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php 
                            include ("login.inc");
                        
                            $conexion = new mysqli ($mysql_server,$mysql_login,$mysql_pass,$servername);
                        
                            if ($conexion->connect_errno) {
                                header('Location: index.php');  
                            }
                        
                            $sentenciaSQL = "SELECT ID, Name, state, Language FROM book_copy order by original_ISBN;";
                            $registros = $conexion->query ($sentenciaSQL); 
                            $increment = 1;
                            while ($row = $registros->fetch_assoc()){
                                echo "<tr>"; 
                                    echo "<th scope=" . '"row"' . ">" . $increment . "</th>";
                                    echo "<td>" . $row['Name'] . "</td>";
                                    echo "<td>" . $row['Language'] . "</td>";
                                    echo "<td>" . $row['state'] . "</td>";
                                    echo "<td>" .  "<a href=" . '"add_copy.php?id=' . $row['ID'] . '"' . ">" . "<img src=" . '"images/edit_book.png"' . "/>" . "</a>" . "</td>";
                                    echo "<td>" .  "<a href=" . '"delete.php?type=book_copy&id=' . $row['ID'] . '"' . ">" . "<img src=" . '"images/delete.png"' . "/>" . "</a>" . "</td>";
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