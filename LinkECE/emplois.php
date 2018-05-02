<?php
/* Displays user information and some useful messages */
session_start();
include('connect.php');
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
    $id_user = $_SESSION['id_user'];
    
       $req = "SELECT * FROM emploi ORDER BY date_emploi DESC";
        
    $resultat = mysqli_query($con, $req);
    
}
//Requete speciale pour recuperer avatar et background du user logged
$av = mysqli_query($con,"SELECT * FROM users WHERE id_user='$id_user'");
$user_obj = $av->fetch_assoc();
$dist_av=$user_obj['avatar'];
$dist_back=$user_obj['background'];
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
            #post-offre{
                text-align: left;
                color: grey;
            }
            #post-type{
                text-align: left;
                color: black;
            }
            #post-intitule{
                text-align: left;
                color: grey;
            }
            #post-description{
                text-align: justify;
            }
            #post-entreprise{
                color: grey;
                text-align: left;
                font-weight: bold;
            }
            footer {
                background-color: #555;
                color: white;
                padding: 15px;
            }
        </style>
    </head>
    <body background="<?= $dist_back ?>">

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
                        <li><a href="accueil.php"><span class="glyphicon glyphicon-home"></span> Accueil</a></li>
                        <li><a href="reseau.php"><span class="glyphicon glyphicon-globe"></span> Réseau</a></li>
                        <li><a href="messagerie.php"><span class="glyphicon glyphicon-envelope"></span> Messagerie</a></li>
                        <li class="active"><a href="#"><span class="glyphicon glyphicon-search"></span> Emplois</a></li>
                        <li><a href="notifications.php"><span class="glyphicon glyphicon-bell"></span> Notifications</a></li>
                    </ul>


                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="profil.php"><span class="glyphicon glyphicon-user"></span> <?= $prenom.' '.$nom ?> </a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Déconnexion</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container text-center">    
            <div class="row">
                <div class="col-sm-9">
                    
                    
                    <h2 class="well">Les offres d'emplois</h2>
                <?php
    while($post = mysqli_fetch_array($resultat)){

        $time = strtotime($post['date_emploi']);
        $myFormatForView = date("d/m/y à H:i", $time);

        echo "<div class='row'>
                    
                

                        <div class='col-sm-12'>


                            <div class='well'>";
        
            echo "<p id='post-entreprise'>".$post['entreprise']."</p>";
        echo "<p id='post-intitule'>".$post['intitule_offre']."</p>";
        echo "<p id='post-description'>".$post['descriptif_emploi']."</p>";

        echo "
                                <div class='row'>
                                <div class='col-sm-6'>
                                <p id='post-type'> ".$post['type_offre']." </p>
                                <p id='post-offre'>Offre posté le ".$myFormatForView."</p>
                                
                                <button type='button' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-comment'></span> Postuler</button>
                                <button type='button' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-share'></span> Partager</button>  
                                
                                </div>
                                
                                </div>
                            </div>
                        </div>  
                    </div>";
    }?>    
                    
                    
                    
                </div>
            </div>
        </div>

        <footer class="container-fluid text-center">
            <p>LinkECE &copy;2018</p>
        </footer>

    </body>
</html>

