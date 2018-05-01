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
    $id_user = $_SESSION['id_user'];
    $host = 'localhost';
    $user = 'root';
    $pass = 'root'; 
    $db = 'linkece';
    $mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
    $result = mysqli_query($mysqli,"SELECT COUNT(*) as nb_relation FROM relation WHERE id_user1='$id_user'");
    $nb_relation = $result->fetch_assoc();
    $result = mysqli_query($mysqli,"SELECT COUNT(*) as nb_relation FROM relation WHERE id_user2='$id_user'");
    $nb = $result->fetch_assoc();
    
    $result = $mysqli->query("SELECT DISTINCT(id_post) FROM post WHERE id_user='$id_user'");
    $nb_poste = $result->fetch_assoc();
    //for ($x = 0; $x < $nb_poste['id_post']; $x++) {
       // echo "The number is: $x <br>";
   // } 
    
  //  $stack = array();
    
    // while ($data = mysqli_fetch_row($result)) {   
     //echo "ID: " . $data[0] . '<br>';  
      //   array_push($stack,$data[0]);
       
    //}
    
    //print_r($stack);

    
    //for ($x = 0; $x < $nb_poste['id_post']; $x++) {
      //  echo "The number is: $x <br>";
   //} 
    
    
    $resultat = mysqli_query($mysqli,"SELECT descriptif FROM post WHERE id_user='$id_user'");
    
    
    $result = mysqli_query($mysqli,"SELECT * FROM users WHERE id_user='$id_user'");
    $user_obj = $result->fetch_assoc();
    $dist=$user_obj['avatar'];
    
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
            
            .profil{
                text-align:left; 
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
                        <li><a href="messagerie.php"><span class="glyphicon glyphicon-envelope"></span> Messagerie</a></li>
                        <li><a href="emplois.php"><span class="glyphicon glyphicon-search"></span> Emplois</a></li>
                        <li><a href="notifications.php"><span class="glyphicon glyphicon-bell"></span> Notifications</a></li>
                    </ul>


                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="profil.php"><span class="glyphicon glyphicon-user"></span> <?= $prenom.' '.$nom ?></a></li>
                        <li><a href="login-system/logout.php"><span class="glyphicon glyphicon-log-out"></span> Déconnexion</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container text-center">    
            <div class="row">

                <div class="col-sm-3">
                    <h1 class="profil">Profil</h1>
                    <div class="well">
                        
                       <img src="<?= $dist ?>" class="img-circle" height="150" width="150" alt="Avatar">
                       
                        
                    </div>
                    
                    <button type="button" class="btn btn-info"><span class="glyphicon glyphicon-file"></span> Consulter CV</button>
                </div>

                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-4">
                            <h2 class="profil"><?= $prenom.' '.$nom?></h2>
                            <p class="profil">En réseau avec <?= $nb_relation['nb_relation']+$nb['nb_relation']?> personnes.</p>
                        </div>

                    </div>
                    
                    <div class="row">
                        <?
                            for ($x = 0; $x < $nb_poste['id_post']; $x++) {
                                $post_obj = mysqli_fetch_assoc($resultat);?>
                                <div class="col-sm-9">
                                    <div class="well">
                                        <p class="profil"><?= $prenom.' '.$nom?></p>
                                        <p class="profil"><?= $post_obj['lieu'].', '.$post_obj['humeur']?></p>
                                        <p class="profil"><?= $post_obj['descriptif']?></p>
                                        <p class="profil"><?= $post_obj['date_post']?></p>
                                        <button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-comment"></span> Commenter</button>
                                        <button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-share"></span> Partager</button>
                                        <button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-thumbs-up"></span> Like</button> 
                                    </div>
                                </div>
                        <?  }?>
                        

                    </div>
                </div>
            </div>
        </div>

        <footer class="container-fluid text-center">
            <p>LinkECE &copy;2018</p>
        </footer>

    </body>
</html>

