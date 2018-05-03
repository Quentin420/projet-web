<?php
/* Displays user information and some useful messages */
session_start();
include('connect.php');
// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: login-system/error.php");    
}
else {
    // Makes it easier to read
    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];
    $email = $_SESSION['email'];
    $username = $_SESSION['username'];
    $id_user = $_SESSION['id_user'];

    $req = "SELECT * FROM users";
    $resultat = mysqli_query($con, $req);
}
//Requete speciale pour recuperer avatar et background du user logged
$av = mysqli_query($con,"SELECT * FROM users WHERE id_user='$id_user'");
$user_obj = $av->fetch_assoc();
$dist_av=$user_obj['avatar'];
$dist_back=$user_obj['background'];
$dist_admin=$user_obj['admin'];
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


            .profil{
                text-align:left; 
            }

            #post-description{
                text-align: justify;
            }

            textarea
            {
                resize: none;
            }

            #post-humeur{
                color: grey;
                text-align: left;
                font-weight: bold;
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
                        <?php if($dist_admin==1){echo "<li class='active'><a href='admin.php'><span class='glyphicon glyphicon-eye-open'></span> Page Admin</a></li>";}?>
                    </ul>


                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="profil.php"><span class="glyphicon glyphicon-user"></span> <?= $prenom.' '.$nom ?> </a></li>
                        <li><a href="login-system/logout.php"><span class="glyphicon glyphicon-log-out"></span> Déconnexion</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container text-center">    
           
             <div class="col-sm-12">
                    <h3 class="well">Ajouter un utilisateur</h3>
                    
                    <div class="row">
                             <form class="form" action="addUser.php" method="post" autocomplete="off">  
                                <div class="col-sm-12">
                                    <div class='well'>
                                        <p class='profil'><label>Nom<span class="req">*</span></label>
                                        <input type="text" class="form-control" required autocomplete="off" name='nom' /></p>
                                        <p class='profil'><label>Prénom <span class="req">*</span></label>
                                        <input type="text"required autocomplete="off" class="form-control" name='prenom' /></p>
                                        <p class='profil'><label>Pseudo<span class="req">*</span></label>
                                        <input class="form-control" type="text"required autocomplete="off" name='username' /></p>
                                        <p class='profil'><label>Adresse Email<span class="req">*</span></label>
                                        <input class="form-control" type="email"required autocomplete="off" name='email' /></p>
                                        <p class='profil'><label>Mot de passe<span class="req">*</span></label>
                                        <input class="form-control" type="password"required autocomplete="off" name='password'/></p><br>
                                        <input type="submit" value="Enregistrer" name="Enregistrer" class="btn btn-block btn-primary" /> 
                                    </div>
                                </div>
                        </form>  
                       
                    </div>
                </div>


            <div class="row">
                
                
                <div class="col-sm-12">      
           
                <h3 class="well">Supprimer un utilisateur</h3>
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
                                
                                
                                    <div class='col-sm-9'><a href='viewprofile.php?id_user=".$post['id_user']."'>".$post['prenom']." ".$post['nom']."</a></div>
                                    <div class='col-sm-3'><a href='suppUser.php?id_user=".$post['id_user']."' class='btn btn-danger'><span class='glyphicon glyphicon-remove-circle'></span> Supprimer cet utilisateur</a></div>
                                </div>
                                </div> 
                                </div>
                            </div>";
                        }
                    }?> 
            </div>


        </div>
        </div>

    <footer class="container-fluid text-center">
        <p>LinkECE &copy;2018</p>
    </footer>

    </body>
</html>




               


 
              
