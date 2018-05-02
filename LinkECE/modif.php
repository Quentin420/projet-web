<?php
//header('Location: modifprofile.php');
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: error.php");    
}
else {
    // Makes it easier to read
    $host = 'localhost';
    $user = 'root';
    $pass = 'root'; 
    $db = 'linkece';

    $id_user = $_SESSION['id_user'];
    $mysqli = new mysqli($host,$user,$pass,$db);
    
    
    // print_r($_FILES);die;
    
    $avatar_path= $mysqli->real_escape_string('image/'.$_FILES['avatar']['name']);
    $back_path= $mysqli->real_escape_string('image/'.$_FILES['background']['name']);
    $cv_path= $mysqli->real_escape_string('image/'.$_FILES['cv']['name']);
    
    //echo $cv_path; die;
    
    if(preg_match("!image!",$_FILES['avatar']['type']) && preg_match("!image!",$_FILES['background']['type']) && preg_match("!image!",$_FILES['cv']['type']))
    {
        //echo $cv_path; die;
        if(copy($_FILES['avatar']['tmp_name'],$avatar_path) && copy($_FILES['background']['tmp_name'],$back_path) && copy($_FILES['cv']['tmp_name'],$cv_path)){
            $_SESSION['avatar']=$avatar_path;
            $_SESSION['background']=$back_path;
            $_SESSION['cv']=$cv_path;
            $sql="UPDATE users SET avatar='$avatar_path', background='$back_path', cv='$cv_path' WHERE id_user='$id_user'"; 
            if ($mysqli->query($sql) === TRUE) {
                echo "New record created successfully";
                header("location: profil.php");
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            } 
        }
        else{
            $_SESSION['message']="File upload failed!";
        }
    }
    else{
        $_SESSION['message']="Please only upload PNG, SVG images!";
    }

    
}?>