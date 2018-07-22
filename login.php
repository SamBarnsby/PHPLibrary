<?php
    session_cache_limiter ('nocache,private');
    session_start();
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
                    <a class="nav-link " href="createaccount.php">Create Account</a>
                  </li>
                </ul>
                <span>
                    <ul class=" navbar-nav mr-auto">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span><a class="nav-link" href="login.php">login</a>
                    </ul>
                </span>
              </div>
            </nav>
        <br/>
    <form action="login.php" method="POST" class="container" id="needs-validation" novalidate>
  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="validationCustom01">Username</label>
      <input type="text" class="form-control" placeholder="First name" name="username">
    </div>
  </div>
    <div class="row">
     <div class="col-md-6 mb-3">
        <label for="validationCustom03">Password</label>
            <input type="password" class="form-control" placeholder="Password" name="password" >
        </div>
    </div>
    <button class="btn btn-primary" type="submit">Login </button>
</form>
        
<?php
    include ("login.inc");
    include ("includes.inc");
    $username = "";
    $password = "";
    if(isset($_POST["username"]) && isset($_POST["username"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
       
        // connecting to BD
        $conexion = new mysqli ($mysql_server,$mysql_login,$mysql_pass,$servername);

        if ($conexion->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            die();
        }

        $sentenciaSQL = "SELECT Name, password, User_type FROM user where Name = '" . $username . "' and password = '" . $password . "';";
        $registros = $conexion->query ($sentenciaSQL); 
        if ($row = $registros->fetch_assoc()){
             if(strcmp($row['Name'],$username) == 0 and strcmp($row['password'],$password) == 0) {
                 $_SESSION['login_user'] = $username;
                 $_SESSION['user_type'] = $row['User_type'];
                 
                 header('Location: index.php');
             }
                else {
                    echo "USERNAME OR PASSWORD INCORRECT";
                }
        }
    }


?>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    </body>
</html>