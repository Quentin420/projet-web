<?php
/* Displays user information and some useful messages */
session_start();
include('connect.php');

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: login-system/error.php");    
}

else{

    //ID de l'utilisateur
    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];
    $email = $_SESSION['email'];
    $username = $_SESSION['username'];
    $id_user = $_SESSION['id_user'];
    $dist_admin = $_SESSION['admin'];
    
    if(isset($_GET['id_user']))

    {
        //Id de l'utilisateur dont on regarde le profil
        $idviewed = $_GET['id_user'];

        //Infos sur l'utilisateur dont on regarde le profil
        $user = mysqli_query($con, "SELECT * FROM `users` WHERE id_user='$idviewed'");

                //Assoc de l'user viewed
                $user_viewed = mysqli_fetch_assoc($user);
                //On récupère tous ses paramètres
                $user_viewed_id= $user_viewed['id_user'];
                $user_viewed_nom = $user_viewed['nom'];
                $user_viewed_prenom = $user_viewed['prenom'];
                $user_viewed_avatar = $user_viewed['avatar'];
                $user_viewed_email = $user_viewed['email'];
                $user_viewed_username = $user_viewed['username'];
                $user_viewed_adresse = $user_viewed['adresse'];
                $user_viewed_resume = $user_viewed['resume'];
                $user_viewed_promotion = $user_viewed['promotion'];
                $user_viewed_cv= $user_viewed['cv'];
                $user_viewed_active= $user_viewed['active'];


        //Recupère les post de l'utilisateur
        $resultat = mysqli_query($con,"SELECT * FROM post WHERE id_user='$idviewed' ORDER BY date_post DESC");

        //Requete pour compter les relations
        $result = mysqli_query($con,"SELECT COUNT(*) as nb_relation FROM relation WHERE id_user1 = '$idviewed'OR id_user2 = '$idviewed'");
        $nb = $result->fetch_assoc();
        
        $req = mysqli_query($con,"SELECT COUNT(*) as ami FROM relation WHERE (id_user1 = '$idviewed' AND id_user2='$id_user' )OR (id_user2 = '$idviewed' AND id_user1='$id_user' )");
        $ami = $req->fetch_assoc();
        
        $res = mysqli_query($con,"SELECT COUNT(*) as nb FROM requeteami WHERE id_from = '$id_user' AND id_to = '$idviewed'");
        $requeteami = $res->fetch_assoc();
        
        
        $ruq = "SELECT DISTINCT id_post, id_user, prenom, nom, active, lieu, humeur, date_post, document, avatar, descriptif FROM post
        NATURAL JOIN users
        INNER JOIN relation ON post.id_user = relation.id_user1 OR post.id_user = relation.id_user2 
        WHERE relation.id_user1 = '$id_user' OR relation.id_user2 = '$id_user' 
        ORDER BY post.date_post DESC";
        $resultatprofil = mysqli_query($con, $ruq);
        

    }
//Requete speciale pour recuperer avatar et background du user logged
$av = mysqli_query($con,"SELECT * FROM users WHERE id_user='$id_user'");
$user_obj = $av->fetch_assoc();
$dist_av=$user_obj['avatar'];
$dist_back=$user_obj['background'];
$dist_admin=$user_obj['admin'];    
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

            #post-humeur{
                color: grey;
                text-align: left;
                font-weight: bold;
            }
            #refus{
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
                        <li><a href="profil.php"><span class="glyphicon glyphicon-user"></span> <?= $prenom.' '.$nom ?> </a></li>
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
                    <h1 class="entete"><?= $user_viewed_prenom.' '.$user_viewed_nom ?></h1>
                    
                        <?php if($nb['nb_relation']>1){
                                echo "<p class='entete'>En réseau avec ". $nb['nb_relation']." personnes</p>";
                            }
                            else{
                                echo "<p class='entete'>En réseau avec ". $nb['nb_relation']." personne</p>";
                            }?>
                       
                        <br>
                        <img src="<?= $user_viewed_avatar ?>" class="img-circle" height="150" width="150" alt="Avatar">


                    </div>
                    <div class="well">
                    <a href="<?= $user_viewed['cv'] ?>" download="<?= $user_viewed['cv'] ?>">
                        <button type="button" class="btn btn-info"><span class="glyphicon glyphicon-file"></span> Consulter son CV</button>
                    </a><p></p>
                    
                    <?php
            if($user_viewed_id!=$_SESSION['id_user']){
                    if($ami['ami']==0){
                        if($requeteami['nb']==0){
                            echo "<a href='ajouterAmi.php?id_user=".$user_viewed_id."'>
                        <button type='button' class='btn btn-success'><span class='glyphicon glyphicon-plus'></span> Ajouter au réseau </button>
                    </a>";
                        }
                        else{
                        echo 
                        "<button class='btn btn-success'><span class='glyphicon glyphicon-plus'></span> Demande en cours </button>";
                        
                    }}
                    else{
                        echo "<a href='chat/message.php?id_user=". $user_viewed_id ."'>
                        <button type='button' class='btn btn-info'><span class='glyphicon glyphicon-inbox'></span> Envoyer un message</button>
                    </a><p></p>
                    <a href='suppAmi.php?id_user=".$user_viewed_id."'>
                        <button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-remove-circle'></span> Supprimer la relation</button>
                    </a>";
                    }
                     }        
                        
                    ?>
                    </div>
                </div>

                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-5">
                            <h3 class="well"> Informations</h3>
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
                        
                        if($ami['ami']!=0 || $user_viewed_id==$_SESSION['id_user'] || $user_viewed['active']==0)
                        {
                            while($post = mysqli_fetch_array($resultat)){
                                
                                $blindage=0;
                                $test = mysqli_query($con,"SELECT * FROM commentaire WHERE id_post=".$post['id_post']."");
                                $test_obj = $test->fetch_assoc();
                                $dist_test=$test_obj['id_post'];
                                if($post['id_post']==$test_obj['id_post']){
                                    $blindage=1;
                                }
                                
                                $time = strtotime($post['date_post']);
                            $myFormatForView = date("d/m/y à H:i", $time);
                                
                                 $id_post = $post['id_post'];
                                
                                $req_like = mysqli_query($con,"SELECT COUNT(*) as nb FROM `like` WHERE `like`.id_post='$id_post'");
                                $nb = $req_like->fetch_assoc();
                                $req_like = mysqli_query($con,"SELECT COUNT(*) as nb FROM `like` WHERE `like`.id_post='$id_post' AND `like`.id_user='$id_user'");
                                $bool = $req_like->fetch_assoc();
                                $url = "viewprofile.php?id_user=" . $user_viewed_id ;
                                $txt = "Posté par ".$user_viewed['prenom']. " ".$user_viewed['nom']." depuis ".$post['lieu']." le ".$myFormatForView." : ".$post['descriptif'];
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
                                        <div class='col-sm-6'>
                                            <p id='post-lieu'> Posté depuis ".$post['lieu']." le ".$myFormatForView."</p>
                                        </div>
                                        <div class='col-sm-6 '>
                                        <form class='form' action='commentaire.php?id_post=".$post['id_post']."' method='post' autocomplete='off'>       
                                            <input type='text' class='form-control' name='commentaire' placeholder='Écrire un commentaire...' required><p></p>
                                            <button type='submit' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-comment'></span> Commenter</button>
                                        </form><p></p>";
                                        ?> 
                                  <a href="mailto: ?subject=LinkECE - Post à voir&body=<?=$txt?>"><button type='button' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-share'></span> Partager</button></a>  
                                <?php
                                
                                if($bool['nb']>0){
                                    ?><a href='dislike.php?id_post=<?= $id_post?>&id_url=<?= $url?>'><button class='btn btn-default btn-sm'><span class='glyphicon glyphicon-thumbs-up'></span> Déjà aimé (<?=$nb['nb']?>)</button></a><?php
                                }
                                
                                else{
                                    ?><a href='like.php?id_post=<?= $id_post?>&id_url=<?= $url?>'><button type='button' class='btn btn-success btn-sm'><span class='glyphicon glyphicon-thumbs-up'></span> J'aime (<?=$nb['nb']?>)</button></a><?php
                                } 
                                echo "
                                        
                                        </div>
                                    </div>
                                    </div>
                                ";
                                
                                if($blindage==1 ){
                                    
                                    $req3 = "SELECT commentaire.id_commentaire, commentaire.id_user, commentaire.id_post, commentaire.commenatire, commentaire.date_commentaire, users.id_user, users.prenom, users.nom FROM commentaire, users WHERE commentaire.id_user = users.id_user AND commentaire.id_post=".$dist_test." ORDER BY commentaire.date_commentaire";
                                    
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
                                                    <p id='post-description'> ".$sku['commenatire']."</p>
                                                </div>
                                            </div>
                                        </div>";
                                    }
                                }
                            }
                        }
                        else{
                            echo "<div class='well'><p id=refus>Cet utilisateur a mis ses informations en privées, vous ne pouvez donc pas voir ses publications !<br>Vous devez d'abord l'ajouter à votre réseau !</p></div>";
                        }
                    ?>
                    
                </div>
            </div>
        </div>

    </body>
</html>
