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
    

    $result1 = mysqli_query($con,"SELECT COUNT(*) as nb_relation FROM relation WHERE id_user1='$id_user'");
    $nb_relation = $result1->fetch_assoc();
    $result2 = mysqli_query($con,"SELECT COUNT(*) as nb_relation FROM relation WHERE id_user2='$id_user'");
    $nb = $result2->fetch_assoc();
   
    
    $resultat = mysqli_query($con,"SELECT * FROM post WHERE id_user='$id_user' ORDER BY date_post DESC");
    
    //requete pour recuperer avatar et background du user logged
    $av = mysqli_query($con,"SELECT * FROM users WHERE id_user='$id_user'");
    $user_obj = $av->fetch_assoc();
    $dist_av=$user_obj['avatar'];
    $dist_back=$user_obj['background'];
    $dist_cv=$user_obj['cv'];
    
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
            
            .infos{
                text-align: left;
            }

            #post-humeur{
                color: grey;
                text-align: left;
                font-weight: bold;
            }
            #post-lieu{
                text-align: left;
                color: grey;
            }

            #post-description{
                text-align: justify;
            }
            h3{
                text-align: left;
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
                        <li><a href="chat/message.php"><span class="glyphicon glyphicon-envelope"></span> Messagerie</a></li>
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
                    <br>
                    <div class="well">
                    <h1 class="entete"><?= $prenom.' '.$nom?></h1>
                    <?php if($nb_relation['nb_relation']+$nb['nb_relation']>1){
                                echo "<p class='entete'>En réseau avec ". ($nb_relation['nb_relation']+$nb['nb_relation'])." personnes</p>";
                            }
                            else{
                                echo "<p class='entete'>En réseau avec ". ($nb_relation['nb_relation']+$nb['nb_relation'])." personne</p>";
                            }?>
                       
                        <br>
                       <img src="<?= $dist_av ?>" class="img-circle" height="150" width="150" alt="Avatar">
                       
                        
                    </div>
                    <a href="<?= $dist_cv ?>" download="<?= $dist_cv ?>">
                        <button type="button" class="btn btn-info"><span class="glyphicon glyphicon-file"></span> Consulter CV</button>
                    </a>  
                    <a href="modifprofile.php">
                        <button type="button" class="btn btn-info"><span class="glyphicon glyphicon-cog"></span> Modifier profil</button>
                    </a>  
                </div>

                <div class="col-sm-9">
                    <div class="row">
                        
                        <div class="col-sm-5">
                            <h3 class="well">Informations</h3>
                            <div class="well">
                            <div class="infos">
                                
                                <p>  Pseudo LinkECE : <?= $user_viewed_username ?></p>
                                <p>  Promotion : <?= $user_viewed_promotion ?></p>
                                <p>  Adresse email : <a href="mailto:<?= $user_viewed_email ?>"><?= $user_viewed_email ?></a></p>
                                <p>  Adresse : <?= $user_viewed_adresse ?></p>
                                <p>  </p>
                                
                            </div>
                            </div>

                        </div>


                        <div class="col-sm-7">
                            <h3 class="well">Résumé</h3>
                            <div class="well">
                            <div class="infos">
                                
                                <p><?= $user_viewed_resume ?></p>
                            </div>
                            </div>
                        </div>


                    </div>
                    <br>
                



                   <h3 class="well">Activité</h3>
                   
                                <?php
                                $time = strtotime($post['date_post']);
                                $myFormatForView = date("d/m/y à H:i", $time);
                                
                                while($post = mysqli_fetch_array($resultat)){
                                echo "
                                    <div class='well'>";
                                    
                                    if($post['humeur'] != "---"){
                                        echo "<p id='post-humeur'>".$post['humeur']."</p>";
                                    }
                                    echo "<p id='post-description'>".$post['descriptif']."</p>";

                                    if($post['document']){
                                        echo"<img src=".'img/'.$post['document']." width='400px' ><p><br></p>";
                                    
                                    }
                                       echo" <p id='post-lieu'> Posté depuis ".$post['lieu']." le ".$post['date_post']."</p>
                                   
                                </div>";    
                    
                                
                                }?>
                        
                            
                    </div>
                </div>
            </div>
        </div>

        <footer class="container-fluid text-center">
            <p>LinkECE &copy;2018</p>
        </footer>

    </body>
</html>

