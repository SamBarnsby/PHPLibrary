<?php
    session_cache_limiter ('nocache,private');
    session_start();
    if($_SESSION['login_user'] == '') {
        header('Location: index.php');  
    }
    if($_SESSION['user_type'] != 1) {
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
            <img src="images/smaller_trans.png">
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
                    <a class="nav-link " href="userlist.php">User List</a>
                  </li>
                    <li class="nav-item">
                    <a class="nav-link " href="reservations.php">Reservations</a>
                  </li>
                </ul>
                <span>
                    <ul class="navbar-nav mr-auto">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span><a class="nav-link" href="logout.php">logout</a>
                    </ul>
                </span>
              </div>
            </nav>
        <br/>
        <?php
            $id = 0;
            $id = $_GET['id'];
        ?>
            
    <form method="POST" class="container" id="needs-validation" novalidate <?php echo "action='" . "./add_user.php?id=" . $id . "'";?>>
        <?php
            include ("login.inc");
            $conexion = new mysqli ($mysql_server,$mysql_login,$mysql_pass,$servername);
            if($id != 0) {
                $select = "SELECT Name, Email, User_type, password FROM user WHERE ID = " . $id . ";";
                $registros = $conexion->query ($select);
                $name;
                $email;
                $password;
                $usertype;
                while ($row = $registros->fetch_assoc()){
                    $name = $row['Name'];
                    $email = $row['Email'];
                    $usertype = $row['User_type'];
                    $password = $row['password'];
                }
                $select2 = "SELECT Name FROM user_type WHERE ID = " . $usertype . ";";
                $registros2 = $conexion->query ($select2);
                $nametype;
                while ($row = $registros2->fetch_assoc()){
                    $nametype = $row['Name'];
                }
            }
        ?>
  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="validationCustom01">Name</label>
      <input type="text" class="form-control" id="validationCustom01" name="validationCustom01" <?php if($id != 0) echo "value='" . $name . "' ";?>placeholder="User Name" required>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Email</label>
      <input type="text" class="form-control" id="validationCustom02"  name="validationCustom02" <?php if($id != 0) echo "value='" . $email . "' ";?>placeholder="User Email" required> 
    </div>
  </div>
    <div class="row">
    <div class="col-md-6 mb-3">
        <label for="validationCustom03">User Type</label>
        <select id="validationCustom03"  name="validationCustom03" required>
            <?php 
                
                include ("login.inc");
                $conexion = new mysqli ($mysql_server,$mysql_login,$mysql_pass,$servername);
                if ($conexion->connect_errno) {
                    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
                    die();
                }                
                $sql = ("SELECT Name FROM user_type");
                $registros = $conexion->query ($sql);
                while ($row = $registros->fetch_assoc()){
                    if(strcmp($row['Name'], $nametype)) {
                        echo "<option value=" . '"' . $row['Name'] . '"' .">" . $row['Name'] . "</option>";
                    }
                    else {
                        echo "<option selected value=" . '"' . $row['Name'] . '"' .">" . $row['Name'] . "</option>";
                    }
                }
            ?>
        </select>
        <br/>
    </div>
    <div class="col-md-6 mb-3">
        <label for="validationCustom04">Password</label>
            <input type="password" class="form-control" id="validationCustom04" name="validationCustom04" <?php if($id != 0) echo "value='" . $password . "' ";?>placeholder="Password" required>
    </div>
    </div>
    <button class="btn btn-primary" type="submit"><?php if($id != 0) {echo "Update User";} else {echo "Add User";}?></button>
</form>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  "use strict";
  window.addEventListener("load", function() {
    var form = document.getElementById("needs-validation");
    form.addEventListener("submit", function(event) {
      if (form.checkValidity() == false) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add("was-validated");
    }, false);
  }, false);
}());
</script>
        
<?php
    include ("login.inc");
    $conexion = new mysqli ($mysql_server,$mysql_login,$mysql_pass,$servername);

    if ($conexion->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            die();
    }
         if (isset($_POST['validationCustom01']) && isset($_POST['validationCustom02']) && isset($_POST['validationCustom03']) &&                     isset($_POST['validationCustom04'])) {
            
            $type;
             
            $idSentence = "SELECT ID from user_type WHERE Name = '" . $_POST['validationCustom03'] . "';";
             
            $result = $conexion->query($idSentence);
            
            if ($row = $result->fetch_assoc()){
                $type = $row['ID'];
            }
            if($id == 0) {
                $sentenciaSQL = "INSERT INTO user VALUES(null, '" . $_POST['validationCustom01'] . "','" . $_POST['validationCustom02'] . "'," . $type . ",'" . $_POST['validationCustom04'] . "');";
                $registros = $conexion->query ($sentenciaSQL);
                echo "Added User succesfully!";
            }
            else {
                $sentenciaSQL = "UPDATE user SET Name = '" . $_POST['validationCustom01'] . "', Email = '" . $_POST['validationCustom02'] . "', User_type = " . $type . ", password = '" . $_POST['validationCustom04'] . "' WHERE ID = " . $id . ";";
                $registros = $conexion->query ($sentenciaSQL);
                echo "Updated User succesfully!";
            }
            echo "<br/>";
            echo "<button class=" . '"' . "btn btn-primary" . '"' . "type=" . '"' . "submit" . '"' . "onClick=" . '"' . "document.location.href=" . "'userlist.php'" . '"' . ">" . "Back" . "</button>";
            exit();
         }

?>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    </body>
</html>