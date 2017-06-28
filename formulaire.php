<?php
  // S'il y des données de postées
if ($_SERVER['REQUEST_METHOD']=='POST') {
  // Code PHP pour traiter l'envoi de l'email
 
  $nombreErreur = 0; // Variable qui compte le nombre d'erreur
  // Définit toutes les erreurs possibles
  
  if (!isset($_POST['email'])) { // Si la variable "email" du formulaire n'existe pas (il y a un probl&egraveme)
    $nombreErreur++; // On incrémente la variable qui compte les erreurs
    $erreur1 = '<p class="centrage">Il y a un probl&egraveme avec la variable "email".</p>';
  } else { // Sinon, cela signifie que la variable existe (c'est normal)
    if (empty($_POST['email'])) { // Si la variable est vide
      $nombreErreur++; // On incrémente la variable qui compte les erreurs
      $erreur2 = '<p class="centrage">Vous avez oublié de donner votre email.</p>';
    } else {
      if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $nombreErreur++; // On incrémente la variable qui compte les erreurs
        $erreur3 = '<p class="centrage">Cet email ne ressemble pas un email.</p>';
      }
    }
  }
 
  if (!isset($_POST['nom'])) {
    $nombreErreur++;
    $erreur4 = '<p class="centrage">Il y a un probl&egraveme avec la variable "nom".</p>';
  } else {
    if (empty($_POST['nom'])) {
      $nombreErreur++;
      $erreur5 = '<p class="centrage">Vous avez oublié de donner un nom.</p>';
    }
  }    // (3) Ici, il sera possible d'ajouter plus tard un code pour vérifier un captcha anti-spam.
 
 
  if ($nombreErreur==0) { 
     
      // Récupération des variables et sécurisation des données
      $nom     = htmlspecialchars($_POST['nom']); // htmlspecialchars() convertit des caract&egraveres "spéciaux" en équivalent HTML
      $prenom  = htmlspecialchars($_POST['prenom']);
      $email   = htmlspecialchars($_POST['email']);
      $societe = htmlspecialchars($_POST['societe']);
      $adresse = htmlspecialchars($_POST['adresse']);
      $complement = htmlspecialchars($_POST['complement']);
      $code    = htmlspecialchars($_POST['code']);
      $ville   = htmlspecialchars($_POST['ville']);
      $pays    = htmlspecialchars($_POST['pays']);
      $tel     = htmlspecialchars($_POST['number']);
      $from    = $email;

    
      
     
      // Variables concernant l'email
     
      $destinataire = 'm.blondeau@agram.fr'; // Adresse email du webmaster (à personnaliser)
      $sujet = 'Demande de catalogue'; // Titre de l'email
      $contenu = '<html><head><title>Titre du message</title></head><body>';
      $contenu .= '<p>Bonjour, vous avez reçu un message pour une demande de catalogue.</p>';
      $contenu .= '<p><strong>Nom</strong>: '.$nom.'</p>';
      $contenu .= '<p><strong>Prenom</strong>:'.$prenom.'</p>';
      $contenu .= '<p><strong>Email</strong>: '.$email.'</p>';
      $contenu .= '<p><strong>Societe</strong>:'.$societe.'</p>';
      $contenu .= '<p><strong>Adresse</strong>:'.$adresse.'</p>';
      $contenu .= '<p><strong>Complement</strong>:'.$complement.'</p>'; 
      $contenu .= '<p><strong>Code</strong>:'.$code.'</p>';
      $contenu .= '<p><strong>Ville</strong>:'.$ville.'</p>';
      $contenu .= '<p><strong>Pays</strong>:'.$pays.'</p>';    
      $contenu .= '<p><strong>Tel</strong>:'.$tel.'</p>';
      $contenu .= '</body></html>'; // Contenu du message de l'email (en XHTML)
      // Pour envoyer un email HTML, l'en-tête Content-type doit être défini
      $headers =  'MIME-Version: 1.0'."\r\n";
      $headers .= 'Content-type: text/html; charset=UTF-8'."\r\n";
      $headers .= 'From : '.$from. "\r\n ";
      
     
      // Envoyer l'email
      mail($destinataire, $sujet, $contenu, $headers); // Fonction principale qui envoi l'email
      echo '<h4>Votre message a &eacute;t&eacute; envoy&eacute;!</h4>'; // Afficher un message pour indiquer que le message a été envoyé
      // (2) Fin du code pour traiter l'envoi de l'email
      } 

    else { // S'il y a un moins une erreur
    echo '<div id ="erreur">';
    echo '<p class ="centrage">D&eacute;sol&eacute;, il y a eu '.$nombreErreur.' erreur(s). Voici le d&eacute;tail des erreurs:</p>';
    if (isset($erreur1)) echo '<p class ="centrage">'.$erreur1.'</p>';
    if (isset($erreur2)) echo '<p class ="centrage">'.$erreur2.'</p>';
    if (isset($erreur3)) echo '<p class ="centrage">'.$erreur3.'</p>';
    if (isset($erreur4)) echo '<p class ="centrage">'.$erreur4.'</p>';
    if (isset($erreur5)) echo '<p class ="centrage">'.$erreur5.'</p>';
    // (4) Ici, il sera possible d'ajouter un code d'erreur supplémentaire si un captcha anti-spam est erroné.
    echo '</div>';
  }
}

  ?>
<!DOCTYPE html>
<html lang="fr">
   <head>
      
    <meta charset="UTF-8"/>
    <meta name="author" content="Martinez Manuel" />
	  <meta name="viewport" content="width=device-width, initial-scale=1">      
	  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	  <link type="text/css" rel="stylesheet" href="Materialize/css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" type="text/css" href="Materialize/css/style.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>           
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script> 
    <title>Formulaire demande de catalogue</title>
   
   </head>
   <body class="container">   
      <div class="row">
         <h1>Formulaire de demande de catalogue</h1>
         <form class="col s12" action="formulaire.php" method="post">
            <div class="row">
               <div class="input-field col s6">
                  <input id="inputnom" name="nom" type="text" pattern="([a-zA-Z\s]){1,30}" value="<?php echo isset($_SESSION['inputs']['nom'])? $_SESSION['inputs']['nom'] : ''; ?>"required></input>
                  <label for="inputnom">Nom</label>
               </div>
               <div class="input-field col s6">      
                  <label for="inputprenom">Pr&eacute;nom</label>
                  <input  id="inputprenom" name="prenom" type="text" pattern="([a-zA-Z\s]){1,30}" value="<?php echo isset($_SESSION['inputs']['prenom'])? $_SESSION['inputs']['prenom'] : ''; ?>"required></input>         
               </div>
            </div>
            <div class="row">
               <div class="input-field col s6">
                  <label for="inputsociete">Soci&eacute;t&eacute;</label>
                  <input id="inputsociete" name="societe" type="text" value="<?php echo isset($_SESSION['inputs']['societe'])? $_SESSION['inputs']['societe'] : ''; ?>" ></input>   
               </div> 
                <div class="input-field col s6">
                  <input id="inputemail" name="email" type="email" value="<?php echo isset($_SESSION['inputs']['email'])? $_SESSION['inputs']['email'] : ''; ?>"required></input>
                  <label for="inputemail">Email</label>
               </div>
            </div>
            <div class="row">
               <div class="input-field col s12">
                  <input id="inputadresse" name="adresse" type="text" value="<?php echo isset($_SESSION['inputs']['adresse'])? $_SESSION['inputs']['adresse'] : ''; ?>"required></input>
                  <label for="inputadresse">Adresse</label>
               </div>
            </div>			
            <div class="row">
               <div class="input-field col s12">
                  <input  id="inputcomplement" name="complement" type="text" value="<?php echo isset($_SESSION['inputs']['complement'])? $_SESSION['inputs']['complement'] : ''; ?>"  ></input>
                  <label for="inputcomplement">Complement d'adresse</label>
               </div>
            </div>
            <div class="row">
               <div class="input-field col s6">
                  <input  id="inputcode" name="code" type="text" value="<?php echo isset($_SESSION['inputs']['code'])? $_SESSION['inputs']['code'] : ''; ?>"required></input>
                  <label for="inputcode">Code Postal</label>  
               </div>
               <div class="input-field col s6">
                  <input  id="inputville" name="ville" type="text"  value="<?php echo isset($_SESSION['inputs']['ville'])? $_SESSION['inputs']['ville'] : ''; ?>"required ></input>
                  <label for="inputville">Ville</label>
               </div>   
            </div>
            <div class="row">
               <div class="input-field col s6">
                  <input  id="inputpays" name="pays" type="text"  value="<?php echo isset($_SESSION['inputs']['pays'])? $_SESSION['inputs']['pays'] : ''; ?>"required></input>
                  <label for="inputpays">Pays</label>  
               </div>
               <div class="input-field col s6">
                  <input id="inputnumber" name="number" type="tel"  value="<?php echo isset($_SESSION['inputs']['number'])? $_SESSION['inputs']['number'] : ''; ?>"required ></input>
                  <label for="inputnumber">T&eacute;l&eacute;phone</label>
               </div>
               <div class="button">
                  <button class="btn waves-effect waves-light light-blue" type="submit" value="envoyer">envoyer<i class="material-icons right">send</i></button>
               </div>  
            </div> 
      <?php
        unset($_SESSION['inputs']); 
        unset($_SESSION['success']);
        unset($_SESSION['errors']);
      ?>          
         </form>       
      </div>
   </body>   
</html>
   