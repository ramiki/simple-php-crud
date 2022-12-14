<?php
  // Initialiser la session
  session_start();
  $isdestroyed = session_destroy();
  // Détruire la session.
  // or if(session_destroy())
  if($isdestroyed)
  {
    // Redirection vers la page de connexion
    header("Location: login.php");
  }
?>