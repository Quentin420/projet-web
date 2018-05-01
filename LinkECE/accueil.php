<?php
/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: error.php");    
}
else {
    // Makes it easier to read
    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];
    $email = $_SESSION['email'];
    $username = $_SESSION['username'];
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Bienvenue sur LinkECE</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>    
            /* Set black background color, white text and some padding */
            footer {
                background-color: #555;
                color: white;
                padding: 15px;
            }

            #accueil{
                text-align: left;
            }
        </style>
    </head>
    <body background="img/back.png">

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <style>.navbar-brand {font-weight: bold;}</style>
                    <a class="navbar-brand" href="accueil.php">LinkECE</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#"><span class="glyphicon glyphicon-home"></span> Accueil</a></li>
                        <li><a href="reseau.php"><span class="glyphicon glyphicon-globe"></span> Réseau</a></li>
                        <li><a href="messagerie.php"><span class="glyphicon glyphicon-envelope"></span> Messagerie</a></li>
                        <li><a href="emplois.php"><span class="glyphicon glyphicon-search"></span> Emplois</a></li>
                        <li><a href="notifications.php"><span class="glyphicon glyphicon-bell"></span> Notifications</a></li>
                    </ul>


                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="profil.php"><span class="glyphicon glyphicon-user"></span> <?= $prenom.' '.$nom ?> </a></li>
                        <li><a href="login-system/logout.php"><span class="glyphicon glyphicon-log-out"></span> Déconnexion</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container text-center">    
            <div class="row">
                <div class="col-sm-9">
                    <div class="well" id="accueil">
                        <form method="post" action="statut.php">
                            <textarea rows="4" cols="50" name="statut">Des nouveautés à partager ?</textarea>
                            <button type="submit" class="btn btn-primary">
                                <span class="glyphicon glyphicon-bullhorn"></span> Poster
                            </button>
                        </form>

                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <div class="well">
                                <p>John</p>
                                <img src="img/avatar.svg" class="img-circle" height="55" width="55" alt="Avatar">
                            </div>
                        </div>

                        <div class="col-sm-10">
                            <div class="well">
                                <p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
                                <button type="button" class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-comment"></span> Commenter
                                </button> 
                                <button type="button" class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-share"></span> Partager
                                </button>
                                <button type="button" class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-thumbs-up"></span> Like
                                </button>  

                            </div>
                        </div>  
                    </div>

                    <div class="row">

                        <div class="col-sm-2">
                            <div class="well">
                                <p>Bo</p>
                                <img src="img/mec1.png" class="img-circle" height="55" width="55" alt="Avatar">
                            </div>
                        </div>

                        <div class="col-sm-10">
                            <div class="well">
                                <p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
                                <button type="button" class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-comment"></span> Commenter
                                </button> 
                                <button type="button" class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-share"></span> Partager
                                </button>
                                <button type="button" class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-thumbs-up"></span> Like
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <div class="well">
                                <p>Jane</p>
                                <img src="img/fille1.png" class="img-circle" height="55" width="55" alt="Avatar">
                            </div>
                        </div>

                        <div class="col-sm-10">
                            <div class="well">
                                <p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
                                <button type="button" class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-comment"></span> Commenter
                                </button> 
                                <button type="button" class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-share"></span> Partager
                                </button>
                                <button type="button" class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-thumbs-up"></span> Like
                                </button>    
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <div class="well">
                                <p>Anja</p>
                                <img src="img/avatar.svg" class="img-circle" height="55" width="55" alt="Avatar">
                            </div>
                        </div>
                        <div class="col-sm-10">
                            <div class="well">
                                <p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
                                <button type="button" class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-comment"></span> Commenter
                                </button> 
                                <button type="button" class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-share"></span> Partager
                                </button>
                                <button type="button" class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-thumbs-up"></span> Like
                                </button>
                            </div>
                        </div>
                    </div>     
                </div>

                <div class="col-sm-3">
                    <div class="well">
                        <p><a href="profil.php">Mon Profil</a></p>
                        <img src="img/avatar.svg" class="img-circle" height="55" width="55" alt="Avatar">
                    </div>

                    <div class="well">
                        <a href="elargir.php" class="btn btn-success"><span class="glyphicon glyphicon-briefcase"></span> Élargir son réseau</a>
                    </div>

                    <div class="thumbnail">
                        <p>Évènemets à venir :</p>
                        <img src="paris.jpg" alt="Paris" width="400" height="300">
                        <p><strong>Paris</strong></p>
                        <p>Vendredi 27 Novembre 2015</p>
                    </div>



                </div>
            </div>
        </div>

        <footer class="container-fluid text-center">
            <p>LinkECE &copy;2018</p>
        </footer>

    </body>
</html>

