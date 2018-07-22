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
        <div id="topbox">
            <style>
            @font-face { font-family: Nutshell; src: url('Nutshell.ttf'); } 
                h1 {
                    font-family: Nutshell
                }
            </style>
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
                  <li class="nav-item active">
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
        </div>
        <br/>
        <br/>
        <div id="sizecarousel" class="newsizecarousel">
            <h2>Featured books</h2>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="images/got1.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="images/Skulduggery1.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="images/hp1.jpg" alt="Third slide">
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
        </div>
        <div class="sizecards">
            <div class="card" style="width: 10rem; height: 20rem;">
                <img class="card-img-top" src="images/lotr.jpg" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text">Price: 9.99€</p>
                    <a href="#" class="btn btn-primary">Buy</a>
                </div>
            </div>
        </div>
    
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    </body>
</html>