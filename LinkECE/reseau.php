<?php
/* Displays user information and some useful messages */
session_start();
include('connect.php');
// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
    $_SESSION['message'] = "Vous devez être connecté pour acceder à ce contenu!";
    header("location: login-system/error.php");    
}
else {
    // Makes it easier to read
    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];
    $email = $_SESSION['email'];
    $username = $_SESSION['username'];
    $id_user = $_SESSION['id_user'];
    
    $req = "SELECT DISTINCT id_user, prenom, nom, avatar FROM users
INNER JOIN relation ON users.id_user = relation.id_user1 OR users.id_user = relation.id_user2
WHERE relation.id_user1 = 36 OR relation.id_user2 = '36'
ORDER BY users.nom ASC";
    
    $resultat = mysqli_query($con, $req);
}
//Requete speciale pour recuperer avatar et background du user logged
$av = mysqli_query($con,"SELECT * FROM users WHERE id_user='$id_user'");
$user_obj = $av->fetch_assoc();
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
            h3{
                text-align: left;
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
                        <li class="active"><a href="#"><span class="glyphicon glyphicon-globe"></span> Réseau</a></li>
                        <li><a href="chat/message.php"><span class="glyphicon glyphicon-envelope"></span> Messagerie</a></li>
                        <li><a href="emplois.php"><span class="glyphicon glyphicon-search"></span> Emplois</a></li>
                        <li><a href="notifications.php"><span class="glyphicon glyphicon-bell"></span> Notifications</a></li>
                    </ul>


                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="profil.php"><span class="glyphicon glyphicon-user"></span>  <?= $prenom.' '.$nom ?> </a></li>
                        <li><a href="login-system/logout.php"><span class="glyphicon glyphicon-log-out"></span> Déconnexion</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container text-center">    
            <div class="row">
                <h3 class="well">Votre réseau LinkECE</h3>
            <?php
                    while($post = mysqli_fetch_array($resultat)){
                        if($post['id_user']!=$id_user){
                        echo "<div class='row'>
                                <div class='col-sm-2'>
                                <div class='well'>
                                    <img src=".$post['avatar']." class='img-circle' height='55' width='55' alt='Avatar'>
                                </div>
                                </div>
                                <div class='col-sm-10'>
                                <div class='well'>
                                <div class='row'>
                                
                                
                                    <div class='col-sm-10'><a href='viewprofile.php?id_user=".$post['id_user']."'>".$post['prenom']." ".$post['nom']."</a></div>
                                    <div class='col-sm-2'><a href='suppAmi.php?id_user=".$post['id_user']."' class='btn btn-danger'><span class='glyphicon glyphicon-remove-circle'></span> Supprimer</a></div>
                                </div>
                                </div> 
                                </div>
                            </div>";
                        }
                    }?>   
            </div>
        </div>

        <footer class="container-fluid text-center">
            <p>LinkECE &copy;2018</p>
        </footer>

    </body>
</html>

