<?php
/* Displays user information and some useful messages */
session_start();
include('connect.php');

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
     $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");    
}

else{

    //ID de l'utilisateur
    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];
    $email = $_SESSION['email'];
    $username = $_SESSION['username'];
    $id_user = $_SESSION['id_user'];
    if(isset($_GET['id_user']))

    {
        //Id de l'utilisateur dont on regarde le profil
        $idviewed = $_GET['id_user'];
        
        //Infos sur l'utilisateur dont on regarde le profil
        $user = mysqli_query($con, "SELECT * FROM `users` WHERE id_user='$idviewed'");
                //Assoc de l'user viewed
                $user_viewed = mysqli_fetch_assoc($user);
                //On récupère tous ses paramètres
                $user_viewed_nom = $user_viewed['nom'];
                $user_viewed_prenom = $user_viewed['prenom'];
                $user_viewed_avatar = $user_viewed['avatar'];
                $user_viewed_email = $user_viewed['email'];
                $user_viewed_username = $user_viewed['username'];
                $user_viewed_adresse = $user_viewed['adresse'];
                $user_viewed_resume = $user_viewed['resume'];
                $user_viewed_promotion = $user_viewed['promotion'];

        //Recupère les post de l'utilisateur
        $resultat = mysqli_query($con,"SELECT * FROM post WHERE id_user='$idviewed'");

        //Requete pour compter les relations
        $result1 = mysqli_query($con,"SELECT COUNT(*) as nb_relation FROM relation WHERE id_user1='$idviewed'");
        $nb_relation = $result1->fetch_assoc();
        $result2 = mysqli_query($con,"SELECT COUNT(*) as nb_relation FROM relation WHERE id_user2='$id_user'");
        $nb = $result2->fetch_assoc();
                

    }
}
?>


<!DOCTYPE html>
<html>

    <head>
        <title>Bienvenue sur le profil de <?php echo $user_viewed_prenom; echo ' '.$user_viewed_nom; ?></title>
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

                <div class="col-sm-3">
                    <h1 class="entete"><?= $user_viewed_prenom.' '.$user_viewed_nom ?></h1>
                    <div class="well">
                        
                       <img src="<?= $user_viewed_avatar ?>" class="img-circle" height="150" width="150" alt="Avatar">
                       
                        
                    </div>
                    <a href="<?= $dist_cv ?>" download="<?= $dist_cv ?>">
                        <button type="button" class="btn btn-info"><span class="glyphicon glyphicon-file"></span> Consulter CV</button>
                    </a>     

                </div>

                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-4">

                            <div class="infos">
                            <h2> <br/> </h2>
                            <h3> Informations : </h3>
                            <p>  Pseudo LinkECE : <?= $user_viewed_username ?></p>
                            <p>  Promotion : <?= $user_viewed_promotion ?></p>
                            <p>  Adresse email : <a href="mailto:<?= $user_viewed_email ?>"><?= $user_viewed_email ?></a></p>
                            <p>  Adresse : <?= $user_viewed_adresse ?></p>
                            <p>  </p>
                            <p  class="entete">En réseau avec <?= $nb_relation['nb_relation']+$nb['nb_relation']?> personnes.</p>
                            </div>

                        </div>


                        <div class="col-sm-6">
                            <div class="infos">
                            <h2><br/></h2>
                            <h3> Résumé : </h3>
                            <p><?= $user_viewed_resume ?></p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <div class="row">

                <h2>Activité : </h2>

                <?php
                                while($post = mysqli_fetch_array($resultat)){
                                echo "
                                <div class='col-sm-12'>
                                    <div class='well'>
                                        <p class='profil'>". $post['descriptif']."</p>
                                        <p class='profil'>". $post['lieu']."</p>
                                        <p class='profil'>". $post['date_post']."</p>
                                        <p class='profil'>". $post['humeur']."</p>
                                        <button type='button' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-comment'></span> Commenter</button>
                                        <button type='button' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-share'></span> Partager</button>
                                        <button type='button' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-thumbs-up'></span> Like</button> 
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
