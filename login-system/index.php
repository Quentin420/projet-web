<?php 
/* Page de création/connexion */
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['login'])) { //utilisateur se connecte

        require 'login.php';
        
    }
    
    elseif (isset($_POST['register'])) { //utilisateur s'enregistre
        
        require 'register.php';
        
    }
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Se connecter/S'enregistrer</title>
  <?php include 'css/css.html'; ?>
</head>


<body>
  <div class="form">
      
      <ul class="tab-group">
        <li class="tab"><a href="#signup">S'enregistrer</a></li>
        <li class="tab active"><a href="#login">Se connecter</a></li>
      </ul>
      
      <div class="tab-content">

         <div id="login">   
          <h1>Bienvenue !</h1>
          
          <form action="index.php" method="post" autocomplete="off">
          
            <div class="field-wrap">
            <label>
              Adresse Email<span class="req">*</span>
            </label>
            <input type="email" required autocomplete="off" name="email"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Mot de passe<span class="req">*</span>
            </label>
            <input type="password" required autocomplete="off" name="password"/>
          </div>
          
          <p class="forgot"><a href="forgot.php">Mot de passe oublié?</a></p>
          
          <button class="button button-block" name="login" />Se connecter</button>
          
          </form>

        </div>
          
        <div id="signup">   
          <h1>Créer un compte</h1>
          
          <form action="index.php" method="post" autocomplete="off">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                Nom<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='nom' />
            </div>
        
             <div class="field-wrap">
              <label>
                Prénom <span class="req">*</span>
              </label>
              <input type="text"required autocomplete="off" name='prenom' />
            </div>
          </div>

          <div class="field-wrap">
            <label>
              Pseudo<span class="req">*</span>
            </label>
            <input type="text"required autocomplete="off" name='username' />
          </div>


          <div class="field-wrap">
            <label>
              Adresse Email<span class="req">*</span>
            </label>
            <input type="email"required autocomplete="off" name='email' />
          </div>

          
          
          <div class="field-wrap">
            <label>
              Mot de passe<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off" name='password'/>
          </div>
          
          <button type="submit" class="button button-block" name="register" />Enregistrer</button>
          
          </form>

        </div>  
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
