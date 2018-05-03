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
    if(isset($_GET['id_user']))

    {
        //Id de l'utilisateur dont on regarde le profil
        $idviewed = $_GET['id_user'];
        
        //Infos sur l'utilisateur dont on regarde le profil
        $user = mysqli_query($con, "DELETE FROM users WHERE (id_user = '$idviewed')");
        $user1 = mysqli_query($con, "DELETE FROM relation WHERE id_user1 = '$idviewed' OR id_user2 = '$idviewed'");
        $user2 = mysqli_query($con, "DELETE FROM post WHERE id_user = '$idviewed'");
        $user3 = mysqli_query($con, "DELETE FROM messages WHERE user_from = '$idviewed' OR user_to = '$idviewed'");
        $user4 = mysqli_query($con, "DELETE FROM like WHERE id_user = '$idviewed'");
        $user5 = mysqli_query($con, "DELETE FROM commentaire WHERE id_user = '$idviewed'");
        $user6 = mysqli_query($con, "DELETE FROM conversation WHERE user_one = '$idviewed' OR user_two = '$idviewed'");
        echo "<script type='text/javascript'> document.location = 'admin.php'; </script>";    
    }
}
?>