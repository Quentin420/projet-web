<?php
//header('Location: modifprofile.php');
session_start();
include('connect.php');

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: error.php");    
}
else {
    // Makes it easier to read

    $id_user = $_SESSION['id_user'];
    
    $avatar_path= mysqli_real_escape_string($con,'img/'.$_FILES['avatar']['name']);
    
    if(preg_match("!image!",$_FILES['avatar']['type']))
    {
        if(copy($_FILES['avatar']['tmp_name'],$avatar_path)){
            $_SESSION['avatar']=$avatar_path;
            
            $sql="UPDATE users SET avatar='$avatar_path' WHERE id_user='$id_user'"; 
            if (mysqli_query($con,$sql) === TRUE) {
                echo "New record created successfully";
                header("location: profil.php");
            } else {
                echo "Error: ";
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