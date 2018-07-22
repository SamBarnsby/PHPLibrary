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
                  <li class="nav-item">
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
                            echo  "<a class=" . '"nav-link active"' .  "href=" . '"reservations.php"' . ">Reservations</a>";
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
        <br/>
        <br/>
            <div id="mytable">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>ID</th>
                      <th>User</th>
                      <th>Book</th>
                      <th>Pickup Date(dd/mm/yy)</th>
                      <th>Return Date(dd/mm/yy)</th>
                      <th>Days Since Pick Up</th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php 
                            include ("login.inc");
                        
                            $conexion = new mysqli ($mysql_server,$mysql_login,$mysql_pass,$servername);
                        
                            if ($conexion->connect_errno) {
                                header('Location: index.php');  
                            }
                            $bool = true;
                            $id = 0;
                            $userid = 0;
                            $book = 0;
                            $pickup="";
                            $return="";
                            $pickup = "";
                            $return = "";
                            $sentenciaSQL = "SELECT ID, userID, bookID, DatePickUp, DateReturn FROM reservation;";
                            $registros = $conexion->query ($sentenciaSQL); 
                            
                            
                            $registros = $conexion->query ($sentenciaSQL); 
                            
                            $increment = 1;
                            while ($row = $registros->fetch_assoc()){
                                $id = $row['ID'];
                                $book = $row['bookID'];
                                $userid = $row['userID'];
                                $pickup = $row['DatePickUp'];
                                $return = $row['DateReturn'];   
                                $userSQL = "SELECT Name FROM user WHERE ID = " . $userid . ";";
                                $bookSQL = "SELECT Name FROM book_copy WHERE ID = " . $book . ";";
                                $registros2 = $conexion->query ($userSQL); 
                                $registros3 = $conexion->query ($bookSQL); 
                                echo "<tr>"; 
                                echo "<th scope=" . '"row"' . ">" . $increment . "</th>";
                                echo "<td>" . $row['ID'] . "</th>";
                                while ($row2 = $registros2->fetch_assoc()){
                                    echo "<td>" . $row2['Name'] . "</td>";
                                }
                                 while ($row3 = $registros3->fetch_assoc()){
                                    echo "<td>" . $row3['Name'] . "</td>";
                                }
                                    echo "<td>";
                                    
                                    
                                    if($pickup == "") {
                                        echo "<form action=" . '"./reservations.php?type=1"' . "method='" . "POST" . "'>";
                                        echo "<input type='" . "text" . "'name='" . "pickup" . "'size='" . "10" . "'/>";
                                        echo "<input type='" . "hidden" . "'name='" . "id" . "'value='" . $id . "'/>";
                                        echo "<input type='" . "Submit" . "'name='" . "submit" . "'value='Set'/>";
                                        
                                        echo "</form>"; 
                                    }
                                    if(($_SERVER['REQUEST_METHOD'] == 'POST' and $_GET['type'] == 1) and $bool = true) {
                                        $date = $_POST['pickup'];
                                        try {
                                            $reserveid = $_POST['id'];
                                            $pickupSQL = "UPDATE reservation SET DatePickUp = '" . $date . "' WHERE ID = " . $reserveid . ";";
                                            $registros4 = $conexion->query ($pickupSQL); 
                                            $bool = false;
                                            header('Location: reservations.php');
                                        }
                                        catch(Exception $e){}
                                        
                                    }
                                    else {
                                        echo $pickup;
                                    }
                                    
                                    echo "</td>";
                                   echo "<td>";
                                    
                                    
                                    if($return == "") {
                                        echo "<form action=" . '"./reservations.php?type=2"' . "method='" . "POST" . "'>";
                                        echo "<input type='" . "text" . "'name='" . "return" . "'size='" . "10" . "'/>";
                                        echo "<input type='" . "hidden" . "'name='" . "id" . "'value='" . $id . "'/>";
                                        echo "<input type='" . "Submit" . "'name='" . "submit" . "'value='Set'/>";
                                        
                                        echo "</form>"; 
                                    }
                                    if(($_SERVER['REQUEST_METHOD'] == 'POST' and $_GET['type'] == 2) and $bool = true) {
                                        $date = $_POST['return'];
                                        try {
                                            $reserveid = $_POST['id'];
                                            $returnSQL = "UPDATE reservation SET DateReturn = '" . $date . "' WHERE ID = " . $reserveid . ";";
                                            $registros4 = $conexion->query ($returnSQL); 
                                            $bool = false;
                                            header('Location: reservations.php');
                                        }
                                        catch(Exception $e){}
                                        
                                    }
                                    else {
                                        echo $return;
                                    }
                                    
                                    echo "</td>";
                                    echo "<td>";
                                    if($return == "" and $pickup != "") {
                                        include('constants.inc');
                                        $selectdateSQL = "SELECT DatePickUp FROM reservation WHERE ID = " . $id . ";";
                                        $registros5 = $conexion->query ($selectdateSQL); 
                                        while ($row4 = $registros5->fetch_assoc()){
                                           $sqldate = $row4['DatePickUp'];
                                        }
                                        $replace = str_replace("/", "-" ,$sqldate); 
                                        $datetime1 = new DateTime($replace);
                                        $datetime2 = new DateTime('now');
                                        $interval = $datetime1->diff($datetime2);
                                        if($interval->format('%R%a') > $maximumdays) {
                                            echo "<font color='" . "red" . "'>" . "OVERDUE" . "</font>";
                                        }
                                        else {
                                           echo $interval->format('%R%a'); 
                                        }

                                    }   
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