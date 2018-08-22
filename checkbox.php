<?php
include_once 'dbconfig.php';

      $id = ($_POST["id"]);
    
      $checked = ($_POST["checked"]);
    
      $user->update($_POST);
  
?>