<?php
/* Displays user information and some useful messages */
require_once("connect.php");
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
     $_SESSION['message'] = "Vous n'êtes pas connecté!";
     header("location: ../login-system/error.php");    
}
else {
    // Makes it easier to read
    $user_id = $_SESSION['id_user']; 
    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];
    $email = $_SESSION['email'];
    $username = $_SESSION['username'];
    $dist_admin = $_SESSION['admin'];

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
        <link rel="stylesheet" type="text/css" href="style.css">
        <style>    
            /* Set black background color, white text and some padding */
            footer {
                background-color: #555;
                color: white;
                padding: 15px;
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
                    <a class="navbar-brand" href="../accueil.php">LinkECE</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><a href="../accueil.php"><span class="glyphicon glyphicon-home"></span> Accueil</a></li>
                        <li><a href="../reseau.php"><span class="glyphicon glyphicon-globe"></span> Réseau</a></li>
                        <li class="active"><a href="#"><span class="glyphicon glyphicon-envelope"></span> Messagerie</a></li>
                        <li><a href="../emplois.php"><span class="glyphicon glyphicon-search"></span> Emplois</a></li>
                        <li><a href="../notifications.php"><span class="glyphicon glyphicon-bell"></span> Notifications</a></li>
                        <?php if($dist_admin==1){echo "<li><a href='admin.php'><span class='glyphicon glyphicon-eye-open'></span> Page Admin</a></li>";}?>
                    </ul>


                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="../profil.php"><span class="glyphicon glyphicon-user"></span> <?= $prenom.' '.$nom ?> </a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Déconnexion</a></li>
                    </ul>
                </div>
            </div>
        </nav>

          

            <center>
        <strong>Bonjour <?php echo $_SESSION['prenom']; ?></strong>
    </center>
     
    <div class="message-body">
        <div class="message-left">
            <ul>
                <?php
                    //show all the users expect me
                    $q = mysqli_query($con, "SELECT DISTINCT id_user, prenom, nom, avatar, username FROM users
                    INNER JOIN relation ON users.id_user = relation.id_user1 OR users.id_user = relation.id_user2
                    WHERE (relation.id_user1 = '$user_id' OR relation.id_user2 = '$user_id') AND users.id_user!='$user_id'
                    ORDER BY users.nom ASC");

                    //display all the results
                    while($row = mysqli_fetch_assoc($q)){
                        echo "<a href='message.php?id_user={$row['id_user']}'><li><img src='../{$row['avatar']}'> {$row['nom']} {$row['prenom']}</li></a>";
                    }
                ?>
            </ul>
        </div>
 
        <div class="message-right">
            <!-- display message -->
            <div class="display-message">
            <?php
                //check $_GET&#91;'id'&#93; is set
                if(isset($_GET['id_user'])){
                    $user_two = trim(mysqli_real_escape_string($con, $_GET['id_user']));
                    //check $user_two is valid
                    $q = mysqli_query($con, "SELECT `id_user` FROM `users` WHERE id_user='$user_two' AND id_user!='$user_id'");

                    //valid $user_two
                    if(mysqli_num_rows($q) == 1){
                        //check $user_id and $user_two has conversation or not if no start one
                        $conver = mysqli_query($con, "SELECT * FROM `conversation` WHERE (user_one='$user_id' AND user_two='$user_two') OR (user_one='$user_two' AND user_two='$user_id')");
 
                        //they have a conversation
                        if(mysqli_num_rows($conver) == 1){
                            //fetch the converstaion id
                            $fetch = mysqli_fetch_assoc($conver);
                            $conversation_id = $fetch['id'];
                        }else{ //they do not have a conversation
                            //start a new converstaion and fetch its id
                            $q = mysqli_query($con, "INSERT INTO `conversation` (user_one, user_two) VALUES ('$user_id','$user_two')");
                            $conversation_id = mysqli_insert_id($con);        
                        }
                    }
                    else
                    {
                        die("Invalid $_GET ID.");
                    }
                }else 
                {
                    die("Clickez sur un utilisateur pour lancer un chat.");
                }
            ?>
            </div>
            <!-- /display message -->
 
            <!-- send message -->
            <div class="send-message">
                <!-- store conversation_id, user_from, user_to so that we can send send this values to post_message_ajax.php -->
                <input type="hidden" id="conversation_id" value="<?php echo base64_encode($conversation_id); ?>">
                <input type="hidden" id="user_form" value="<?php echo base64_encode($user_id); ?>">
                <input type="hidden" id="user_to" value="<?php echo base64_encode($user_two); ?>">
                <div class="form-group">
                    <textarea class="form-control" id="message" placeholder="Entrez votre message"></textarea>
                </div>
                <button class="btn btn-primary" id="reply">Envoyer</button> 
                <span id="error"></span>
            </div>
            <!-- / send message -->
        </div>
    </div>
            


         <script type="text/javascript" src="https://code.jquery.com/jquery.min.js"></script>
         <script type="text/javascript" src="script.js"></script> 

    </body>
</html>