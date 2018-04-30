<?php
  session_start();
  $_SESSION['message'] = '';

  $mysqli = new mysqli('localhost', 'root', 'root', 'linkece');

  if ($_SERVER['REQUEST_METHOD'] == 'POST'){

  	//Les mots de passe sont égaux
  	if($_POST['password'] == $_POST['confirmpassword']){

  		$username = $mysqli->real_escape_string($_POST['username']);
  		$email = $mysqli->real_escape_string($_POST['email']);
  		$password = md5($_POST['password']); //md5 fonction de hashage du mdp
  		$avatar_path = $mysqli->real_escape_string('image/'.$_FILES['avatar']['name']);

  		//S'assurer que le fichier image est bien une image
  		if(preg_match("!image!", $_FILES['avatar']['type'])){

  			//Copier l'image dans le dossier Image/
  			if (copy($_FILES['avatar']['tmp_name'], $avatar_path)){

  				$_SESSION['username'] = $username;
  				$_SESSION['avatar'] = $avatar_path;

  				$sql = "INSERT INTO users (username, email, password, avatar)" ."VALUES ('$username', '$email', '$password', '$avatar_path')";

  				//Si la requete marche, on renvoie sur welcome.php
  				if($mysqli->query($sql)===true) {
  					$_SESSION['message'] = "Inscription réussie, bienvenue sur LinkECE $username !";
  					header("location: welcome.php");
  				}
  				else {
  					$_SESSION['message'] = "L'utilisateur n'a pas pu être ajouté à la base de données";
  				}
  			}
  			//Si erreur fichier
  			else {
  				$_SESSION['message'] = "Erreur d'upload de l'avatar";
  			}
  		}
  		//Si le fichier n'est pas une image
  		else{
  			$_SESSION['message'] = "Le formate de l'image doit être GIF, JPG, ou PNG!";
  		}
  	}
  	//Si les mots de passe ne sont pas égaux
  	else{
  		$_SESSION['message'] = "Les mots de passe ne sont pas identiques !";
  	}

  }
?>




<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="form.css" type="text/css">
<div class="body-content">
  <div class="module">
    <h1>Créer un compte LinkECE</h1>
    <form class="form" action="form.php" method="post" enctype="multipart/form-data" autocomplete="off">
      <div class="alert alert-error"><?= $_SESSION['message']?></div>
      <input type="text" placeholder="Nom d'utilisateur" name="username" required />
      <input type="email" placeholder="Adresse e-mail" name="email" required />
      <input type="password" placeholder="Mot de passe" name="password" autocomplete="new-password" required />
      <input type="password" placeholder="Confirmer le mot de passe" name="confirmpassword" autocomplete="new-password" required />
      <div class="avatar"><label>Choisissez votre photo de profil :</label><input type="file" name="avatar" accept="image/*" required /></div>
      <input type="submit" value="Enregistrer" name="register" class="btn btn-block btn-primary" />
    </form>
  </div>
</div>