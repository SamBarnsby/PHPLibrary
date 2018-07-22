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
    <form method="POST" class="container" id="needs-validation" novalidate <?php echo "action='" . "./add_book.php?id=" . $id . "'";?>>
        <?php
            include ("login.inc");
            $conexion = new mysqli ($mysql_server,$mysql_login,$mysql_pass,$servername);
            if($id != 0) {
                $select = "SELECT ISBN, Name, Author, Year, Editorial, Language, Genre FROM book WHERE ISBN = '" . $id . "';";
                $registros = $conexion->query ($select);
                $isbn;
                $name;
                $author;
                $year;
                $editorial;
                $language;
                $genre;
                while ($row = $registros->fetch_assoc())    {
                    $isbn = $row['ISBN'];
                    $name = $row['Name'];
                    $author = $row['Author'];
                    $year = $row['Year'];
                    $editorial = $row['Editorial'];
                    $language = $row['Language'];
                    $genre = $row['Genre'];
                }
                $select2 = "SELECT Name FROM author WHERE ID = '" . $author . "';";
                $registros2 = $conexion->query ($select2);
                while ($row = $registros2->fetch_assoc()){
                    $author = $row['Name'];
                }
                $select2 = "SELECT Name FROM editorial WHERE ID = '" . $editorial . "';";
                $registros2 = $conexion->query ($select2);
                while ($row = $registros2->fetch_assoc()){
                    $editorial = $row['Name'];
                }
            }
        ?>
  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="validationCustom01">ISBN</label>
      <input type="text" class="form-control" id="validationCustom01" name="validationCustom01" <?php if($id != 0) echo "value='" . $isbn . "' ";?>placeholder="Book ISBN" required>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Name</label>
      <input type="text" class="form-control" id="validationCustom02"  name="validationCustom02" <?php if($id != 0) echo "value='" . $name . "' ";?>placeholder="Book Name" required> 
    </div>
  </div>
    <div class="row">
    <div class="col-md-6 mb-3">
        <label for="validationCustom03">Author</label>
        <select id="validationCustom03"  name="validationCustom03" required>
            <?php 
                
                include ("login.inc");
                $conexion = new mysqli ($mysql_server,$mysql_login,$mysql_pass,$servername);
                if ($conexion->connect_errno) {
                    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
                    die();
                }                
                $sql = ("SELECT Name FROM author");
                $registros = $conexion->query ($sql);
                while ($row = $registros->fetch_assoc()){
                    if(strcmp($row['Name'], $author)) {
                        echo "<option value=" . '"' . $row['Name'] . '"' .">" . $row['Name'] . "</option>";
                    }
                    else {
                        echo "<option selected value=" . '"' . $row['Name'] . '"' .">" . $row['Name'] . "</option>";
                    }
                }
            ?>
        </select>
        <br/>
        <label for="validationCustom04">Editorial</label>
        <select id="validationCustom04"  name="validationCustom04" required>
            <?php 
                
                include ("login.inc");
                $conexion = new mysqli ($mysql_server,$mysql_login,$mysql_pass,$servername);
                if ($conexion->connect_errno) {
                    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
                    die();
                }                
                $sql = ("SELECT Name FROM editorial");
                $registros = $conexion->query ($sql);
                while ($row = $registros->fetch_assoc()){
                    if(strcmp($row['Name'], $editorial)) {
                        echo "<option value=" . '"' . $row['Name'] . '"' .">" . $row['Name'] . "</option>";
                    }
                    else {
                        echo "<option selected value=" . '"' . $row['Name'] . '"' .">" . $row['Name'] . "</option>";
                    }
                }
            ?>
        </select>
    </div>
    <div class="col-md-6 mb-3">
        <label for="validationCustom05">Year</label>
            <input type="text" class="form-control" id="validationCustom05" name="validationCustom05" <?php if($id != 0) echo "value='" . $year . "' ";?>placeholder="Year" required>
    </div>
    
    </div>
    <div class="row">
    <div class="col-md-6 mb-3">
        <label for="validationCustom06">Genre</label>
            <input type="text" class="form-control" id="validationCustom06" name="validationCustom06" <?php if($id != 0) echo "value='" . $genre . "' ";?>placeholder="Book Genre" required>
        
    </div>
    <div class="col-md-6 mb-3">
        <label for="validationCustom07">Language</label>
            <input type="text" class="form-control" id="validationCustom07" name="validationCustom07" <?php if($id != 0) echo "value='" . $language . "' ";?>placeholder="Original Language" required>
    </div>
    
    </div>
        
    
    <button class="btn btn-primary" type="submit"><?php if($id != 0) {echo "Update Book";} else {echo "Add Book";}?></button>
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
         if (isset($_POST['validationCustom01']) && isset($_POST['validationCustom02']) && isset($_POST['validationCustom03']) &&                     isset($_POST['validationCustom04']) && isset($_POST['validationCustom05'])&& isset($_POST['validationCustom06']) &&                       isset($_POST['validationCustom07'])) {
            
            $author;
            $editorial;
             
            $editorialSentence = "SELECT ID from editorial WHERE Name = '" . $_POST['validationCustom04'] . "';";
            $editorialSentence2 = "SELECT ID from author WHERE Name = '" . $_POST['validationCustom03'] . "';";
             
            $result = $conexion->query($editorialSentence);
            $result2 = $conexion->query($editorialSentence2);
            
            if ($row = $result->fetch_assoc()){
                $editorial = $row['ID'];
            }
            if ($row = $result2->fetch_assoc()){
                $author = $row['ID'];
            }
             
            if($id == 0) {
                $sentenciaSQL = "INSERT INTO book VALUES('" . $_POST['validationCustom01'] . "','" . $_POST['validationCustom02'] . "'," . $author . "," . $_POST['validationCustom05'] . "," . $editorial . ",'" . $_POST['validationCustom07'] . "','" . $_POST['validationCustom06'] . "');";
                $registros = $conexion->query ($sentenciaSQL);
                echo "Added book succesfully!";
                echo "<br/>";
                echo "<button class=" . '"' . "btn btn-primary" . '"' . "type=" . '"' . "submit" . '"' . "onClick=" . '"' . "document.location.href=" . "'catalog.php'" . '"' . ">" . "Back" . "</button>";
                exit();
            }
             else {
                 $sentenciaSQL = "UPDATE book SET ISBN = '" . $_POST['validationCustom01'] . "', Name = '" . $_POST['validationCustom02'] . "', Author = " . $author . ", Year = " . $_POST['validationCustom05'] . ", Editorial = " . $editorial . ", Language = '" . $_POST['validationCustom07'] . "', Genre = '" . $_POST['validationCustom06'] . "' WHERE ISBN = '" . $id . "';";
                $registros = $conexion->query ($sentenciaSQL);
                echo "Updated book succesfully!";
                echo "<br/>";
                echo "<button class=" . '"' . "btn btn-primary" . '"' . "type=" . '"' . "submit" . '"' . "onClick=" . '"' . "document.location.href=" . "'catalog.php'" . '"' . ">" . "Back" . "</button>";
                exit();
             }
         }

?>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    </body>
</html>