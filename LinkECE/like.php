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
    $id_session = $_SESSION['id_user'];
    if(isset($_GET['id_post']))
    {
        //Id de l'utilisateur dont on regarde le profil
        $idpost = $_GET['id_post'];
        $url = $_GET['id_url'];
        $text = "Nouvelle mention \"J\'aime\"";
        //Infos sur l'utilisateur dont on regarde le profil
        $req = mysqli_query($con,"INSERT INTO notification (id_post, label, id_user) VALUES ('$idpost', '$text', '$id_session')");
        $user = mysqli_query($con, "INSERT INTO `like` (id_user, id_post) VALUES ('$id_session', '$idpost');");?>
        
        <script type='text/javascript'> document.location = '<?= $url?>'; </script>";  <?php
    }
}
?>