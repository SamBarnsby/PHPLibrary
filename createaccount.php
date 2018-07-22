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
                  <li class="nav-item active">
                    <a class="nav-link " href="createaccount.php">Create Account</a>
                  </li>
                </ul>
                <span>
                    <ul class="navbar-nav mr-auto">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span><a class="nav-link" href="login.php">login</a>
                    </ul>
                </span>
              </div>
            </nav>
        <br/>
    <form action="./createaccount.php" method="POST" class="container" id="needs-validation" novalidate>
  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="validationCustom01">Username</label>
      <input type="text" class="form-control" id="validationCustom01" name="validationCustom01" placeholder="First name" required>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Email</label>
      <input type="text" class="form-control" id="validationCustom02"  name="validationCustom02" placeholder="@" required> 
    </div>
  </div>
    <div class="row">
     <div class="col-md-6 mb-3">
        <label for="validationCustom03">Password</label>
            <input type="password" class="form-control" id="validationCustom03" name="validationCustom03" placeholder="Password" required>
        </div>
    </div>
    <button class="btn btn-primary" type="submit">Create Account</button>
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
         if (isset($_POST['validationCustom01']) && isset($_POST['validationCustom02']) && isset($_POST['validationCustom03'])) {
    
            $sentenciaSQL = "INSERT INTO user VALUES(null,'" . $_POST['validationCustom01'] . "','" . $_POST['validationCustom02'] . "',3,'" . $_POST['validationCustom03'] . "');";
            $registros = $conexion->query ($sentenciaSQL);
            header('Location: login.php');
            exit();
         }

?>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    </body>
</html>