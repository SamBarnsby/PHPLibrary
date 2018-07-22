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
        <title>Delete Comfirmation</title>
    </head>
    <body>
        <form action="#" method="post">
            <input type="submit" id="yes" name="yes" value="Yes"/>
            <input type="submit" id="Cancel" name="Cancel" value="Cancel"/>
        
        </form>
        <?php
            include("login.inc");
            $isbn = $_GET['id'];
            $type = $_GET['type'];
            $conexion = new mysqli ($mysql_server,$mysql_login,$mysql_pass,$servername);

            if ($conexion->connect_errno) {
                header('Location: catalog.php');  
            }
        
            if(isset($_POST['yes']) and $type == "book") {
                $sentenciaSQL = "DELETE FROM book_copy WHERE original_ISBN = '" . $isbn . "';";
                $sentenciaSQL2 = "DELETE FROM book WHERE ISBN = '" . $isbn . "';";
                $deletereturn = $conexion->query ($sentenciaSQL); 
                $deletereturn2 = $conexion->query ($sentenciaSQL2);
                header("Location: catalog.php");
            }
            if(isset($_POST['yes']) and $type == "book_copy") {
                $sentenciaSQL = "DELETE FROM book_copy WHERE id = '" . $isbn . "';";
                $deletereturn = $conexion->query ($sentenciaSQL); 
                header("Location: catalog_copies.php");
            }
            if(isset($_POST['yes']) and $type == "user") {
                $sentenciaSQL = "DELETE FROM user WHERE id = '" . $isbn . "';";
                $deletereturn = $conexion->query ($sentenciaSQL); 
                header("Location: userlist.php");
            }
            if (isset($_POST['Cancel']) and $type == "user") header("Location: userlist.php");
            if (isset($_POST['Cancel']) and $type == "book") header("Location: catalog.php");
            if (isset($_POST['Cancel']) and $type == "book_copy") header("Location: catalog_copies.php");
        ?>
    </body>
</html>