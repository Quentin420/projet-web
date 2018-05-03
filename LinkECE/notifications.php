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
    $dist_admin = $_SESSION['admin'];
    $id_user = $_SESSION['id_user'];
    
    
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
            h3{
                text-align: left;
            }
            .notif{
                text-align: left;
            }
        </style>
    </head>
    <body>

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
                        <li><a href="chat/message.php"><span class="glyphicon glyphicon-envelope"></span> Messagerie</a></li>
                        <li><a href="emplois.php"><span class="glyphicon glyphicon-search"></span> Emplois</a></li>
                        <li class="active"><a href="notifications.php"><span class="glyphicon glyphicon-bell"></span> Notifications</a></li>
                        <?php if($dist_admin==1){echo "<li><a href='admin.php'><span class='glyphicon glyphicon-eye-open'></span> Page Admin</a></li>";}?>
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
                <h3 class="well"> Notification</h3>
            
            
            <?php
                $result = mysqli_query($con,"SELECT * FROM notification INNER JOIN post ON notification.id_post = post.id_post WHERE post.id_user = '$id_user'");
                while($notif = mysqli_fetch_array($result)){
                        $time = strtotime($notif['date_notification']);
                        $time2 = strtotime($notif['date_post']);
                        $myFormatForView = date("d/m/y à H:i", $time);
                        $myFormatForView2 = date("d/m/y à H:i", $time2);
                echo "<div class='row'>
                            <div class='col-sm-8'>
                                <div class='well'>
                                    <p class='notif'>Le ".$myFormatForView.", ".$notif['label']."</p>
                                    <p class='notif'>Depuis votre publication du ".$myFormatForView2." : ". $notif['descriptif']."</p>
                                </div>
                            </div>
                        
                            <div class='col-sm-4'>
                                <div class='well'><h5></h5>
                                    <a href='retirernotif.php?id_notification=".$notif['id_notification']."' class='btn btn-danger'><span class='glyphicon glyphicon-remove-circle'></span> Retirer</a><h5></h5>
                                </div>
                            </div>
                        </div>
                        </div>";
                }
            
            
            ?>                     
        </div>
        </div>

        <footer class="container-fluid text-center">
            <p>LinkECE &copy;2018</p>
        </footer>

    </body>
</html>

