<?php
include_once 'includes/dbconfig.php';

      $id = ($_POST["id"]);
    
      $checked = ($_POST["checked"]);
    
      $user->update($_POST);
  
?>