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
    $promotion = $_SESSION['promotion'];
    $adresse = $_SESSION['adresse'];
    $resume = $_SESSION['resume'];

    if(isset($_GET['id_post']))

    {
        //Id du post qu'on regarde
        $idviewed = $_GET['id_post'];

                

 
        $req = "SELECT DISTINCT id_post, id_user, prenom, nom, lieu, humeur, date_post, document, avatar, descriptif FROM post
        NATURAL JOIN users
        INNER JOIN relation ON post.id_user = relation.id_user1 OR post.id_user = relation.id_user2 
        WHERE relation.id_user1 = '$id_user' OR relation.id_user2 = '$id_user' 
        ORDER BY post.date_post DESC";
        $ruq = "SELECT * FROM post WHERE id_post='$idviewed'";
        $resultatprofil = mysqli_query($con, $ruq);
        

    }

    //requete pour recuperer avatar et background du user logged
    $av = mysqli_query($con,"SELECT * FROM users WHERE id_user='$id_user'");
    $user_obj = $av->fetch_assoc();
    $dist_av=$user_obj['avatar'];
    $dist_back=$user_obj['background'];
    $dist_cv=$user_obj['cv'];
    $dist_admin=$user_obj['admin'];

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
            #post-ami{
                color: black;
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
            #date-comment{
                 text-align: left;
                color: grey;
                font-weight: normal;
                margin-left: 25px;
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



                <div class="col-sm-12">
                    
                    <br>

                    <h3 class="well">Publication LinkECE</h3>
                    
                    <?php
                        
                        while($post = mysqli_fetch_array($resultatprofil)){
                            $blindage=0;
                            $test = mysqli_query($con,"SELECT * FROM commentaire WHERE id_post=".$idviewed."");
                            $test_obj = $test->fetch_assoc();
                            $dist_test=$test_obj['id_post'];
                            if($post['id_post']==$test_obj['id_post']){
                                $blindage=1;
                            }
                            $time = strtotime($post['date_post']);
                            $myFormatForView = date("d/m/y à H:i", $time);
                            echo "
                                <div class='well'>";
                            if($post['humeur'] != "---"){
                                echo "<p id='post-humeur'>".$post['humeur']."</p>";
                            }
                            echo "<p id='post-description'>".$post['descriptif']."</p>";
                            if($post['document']){
                                echo"<img src=".'img/'.$post['document']." width='400px' ><p><br></p>";
                            }
                            echo" <div class='row'>
                                        <div class='col-sm-10'>
                                            <p id='post-lieu'> Posté depuis ".$post['lieu']." le ".$myFormatForView."</p>
                                        </div>
                                    </div>";
                                

                            echo "</div>";
                            
                            if($blindage==1 ){
                                $req3 = "SELECT commentaire.id_commentaire, commentaire.id_user, commentaire.id_post, commentaire.commenatire, commentaire.date_commentaire, users.id_user, users.prenom, users.nom FROM commentaire, users WHERE commentaire.id_user = users.id_user AND commentaire.id_post=".$idviewed." ORDER BY commentaire.date_commentaire";
                                $resultat3 = mysqli_query($con, $req3);
                                while($sku = mysqli_fetch_array($resultat3)){
                                    $ish = strtotime($sku['date_commentaire']);
                                    $myFormatForView = date("d/m/y à H:i", $ish);
                                    echo "
                                    <div class='row'>
                                        <div class='col-sm-3'></div>
                                            <div class='col-sm-9'>
                                                <div class='well'>                                    
                                                    <p id='post-ami'> Commentaire de ".$sku['prenom'].' '.$sku['nom']."<span id='date-comment'>(".$myFormatForView.")<span></p>
                                                    <p id='post-description'> ".$sku['commenatire']."</p>";
                                                   
                                                    if($sku['id_user']==$id_user){
                                                        echo"
                                                        <a href='suppcommentaire.php?id_commentaire=".$sku['id_commentaire']."&id_post=".$idviewed."' class='btn btn-danger'><span class='glyphicon glyphicon-remove-circle'></span> Supprimer</a>";
                                                    }
                                                echo "</div>
                                                
                                            </div>
                                        </div>";
                                }
                            }
                        }?>     
                    
                </div>
            </div>
        </div>


    </body>
</html>
