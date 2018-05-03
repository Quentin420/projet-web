<?php
/* Displays user information and some useful messages */
//header('Location: profil.php');
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
    $dist_admin=$_SESSION['admin'];
   
    

    $result1 = mysqli_query($con,"SELECT COUNT(*) as nb_relation FROM relation WHERE id_user1='$id_user'");
    $nb_relation = $result1->fetch_assoc();
    $result2 = mysqli_query($con,"SELECT COUNT(*) as nb_relation FROM relation WHERE id_user2='$id_user'");
    $nb = $result2->fetch_assoc();
   
    
    $resultat = mysqli_query($con,"SELECT * FROM post WHERE id_user='$id_user'");
    
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
            
            .profil{
                text-align:left; 
            }
            .entete{
                text-align:left;
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
                        <li><a href="emplois.php"><span class="glyphicon glyphicon-search"></span> Emplois</a></li>
                        <li><a href="notifications.php"><span class="glyphicon glyphicon-bell"></span> Notifications</a></li>
                        <?php if($dist_admin==1){echo "<li><a href='admin.php'><span class='glyphicon glyphicon-eye-open'></span> Page Admin</a></li>";}?>
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
                    <div class="well">
                    <h1 class="entete"><?= $prenom.' '.$nom?></h1>
                    <p>En réseau avec <?= $nb_relation['nb_relation']+$nb['nb_relation']?> personnes.</p>
                    
                        
                       <img src="<?= $dist_av ?>" class="img-circle" height="150" width="150" alt="Avatar">
                       
                        <br>
                    </div> 
                </div>

                <div class="col-sm-9">
                    
                    
                    <div class="row">
                             <form class="form" action="modif.php" method="post" enctype="multipart/form-data" autocomplete="off">  
                                <div class='col-sm-9'>
                                    <div class='well'>
                                        <p class='profil'>Changer d'avatar :</p>
                                        <p><input name="avatar" type="file" accept="image/*" required></p>
                                        <input type="submit" value="Sauvegarder" name="Sauvegarder" class="btn btn-block btn-primary" /> 
                                    </div>
                                </div>
                        </form>
                        <form class="form" action="modif2.php" method="post" enctype="multipart/form-data" autocomplete="off">
                                <div class='col-sm-9'>
                                    <div class='well'>
                                        <p class='profil'>Changer d'image de fond :</p>
                                        <p><input name="background" type="file" accept="image/*" required></p>
                                        <input type="submit" value="Sauvegarder" name="Sauvegarder" class="btn btn-block btn-primary" /> 
                                    </div>
                                </div>
                        </form>
                         <form class="form" action="modif3.php" method="post" enctype="multipart/form-data" autocomplete="off">  
                                <div class='col-sm-9'>
                                    <div class='well'>
                                        <p class='profil'>Upload un CV :</p>
                                        <p><input name="cv" type="file" accept="application/pdf" required></p>
                                        <input type="submit" value="Sauvegarder" name="Sauvegarder" class="btn btn-block btn-primary" /> 
                                    </div>
                                </div>
                             </form>   
                        <form class="form" action="modif4.php" method="post" autocomplete="off">  
                                <div class='col-sm-9'>
                                    <div class='well'>
                                        <p class='profil'>Modifier mon adresse :</p>
                                        <p><input type="text" row="3" class="form-control" name="adresse" placeholder="Mon adresse" required></p>
                                        <input type="submit" value="Sauvegarder" name="Sauvegarder" class="btn btn-block btn-primary" /> 
                                    </div>
                                </div>
                             </form>   
                        <form class="form" action="modif5.php" method="post" autocomplete="off">  
                                <div class='col-sm-9'>
                                    <div class='well'>
                                        <p class='profil'>Modifier mon résumé :</p>
                                        <p><input type="text" row="3" class="form-control" name="resume" placeholder="Mon résumé" required></p>
                                        <input type="submit" value="Sauvegarder" name="Sauvegarder" class="btn btn-block btn-primary" /> 
                                    </div>
                                </div>
                             </form>   
                        <form class="form" action="modif6.php" method="post" autocomplete="off">  
                                <div class='col-sm-9'>
                                    <div class='well'>
                                        <p class='profil'>Modifier ma promotion :</p>
                                        <p><input type="text" row="3" class="form-control" name="promotion" placeholder="Ma promotion" required></p>
                                        <input type="submit" value="Sauvegarder" name="Sauvegarder" class="btn btn-block btn-primary" /> 
                                    </div>
                                </div>
                             </form>   
                        <form class="form" action="modif7.php" method="post" autocomplete="off">  
                                <div class='col-sm-9'>
                                    <div class='well'>
                                        <p class='profil'>Modifier mon prénom :</p>
                                        <p><input type="text" row="3" class="form-control" name="prenom" placeholder="Mon prénom" required></p>
                                        <input type="submit" value="Sauvegarder" name="Sauvegarder" class="btn btn-block btn-primary" /> 
                                    </div>
                                </div>
                             </form>   
                        <form class="form" action="modif8.php" method="post" autocomplete="off">  
                                <div class='col-sm-9'>
                                    <div class='well'>
                                        <p class='profil'>Modifier mon nom :</p>
                                        <p><input type="text" row="3" class="form-control" name="nom" placeholder="Mon nom" required></p>
                                        <input type="submit" value="Sauvegarder" name="Sauvegarder" class="btn btn-block btn-primary" /> 
                                    </div>
                                </div>
                             </form>   
                        <form class="form" action="modif9.php" method="post" autocomplete="off">  
                                <div class='col-sm-9'>
                                    <div class='well'>
                                        <p class='profil'>Modifier mon username :</p>
                                        <p><input type="text" row="3" class="form-control" name="username" placeholder="Mon username" required></p>
                                        <input type="submit" value="Sauvegarder" name="Sauvegarder" class="btn btn-block btn-primary" /> 
                                    </div>
                                </div>
                             </form>  
                        <form class="form" action="modif10.php" method="post" autocomplete="off">  
                                <div class='col-sm-9'>
                                    <div class='well'>
                                        <p class='profil'>Modifier ma visibilité (0 pour public ou 1 pour privé) :</p>
                                        <p><input type="text" row="3" class="form-control" pattern="[0-1]{1}" required autocomplete="off" name='visibilite' placeholder="Ma visibilité" /></p>
                                        <input type="submit" value="Sauvegarder" name="Sauvegarder" class="btn btn-block btn-primary" /> 
                                    </div>
                                </div>
                             </form> 
                    </div>
                </div>
            </div>
        </div>

        <footer class="container-fluid text-center">
            <p>LinkECE &copy;2018</p>
        </footer>

    </body>
</html>