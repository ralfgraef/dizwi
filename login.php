<?php
require_once 'includes/dbconfig.php';

if($user->is_loggedin()!="")
{
 $user->redirect('datenbank.php');
}

if(isset($_POST['btn-login']))
{
 $uname = $_POST['txt_uname_email'];
 $umail = $_POST['txt_uname_email'];
 $upass = $_POST['txt_password'];
  
 if($user->login($uname,$umail,$upass))
 {
  $user->redirect('start.php');
 }
 else
 {
  $error = "Falsche Eingabe !";
 } 
}
?>


<!DOCTYPE html>
<html lang ="en">
  <?php
    include_once 'includes/header.php';
  ?>

<body class = "titel2">
<?php
    //include_once 'menue.php';
?>
 <br>
<br>
<br>
<br>
<br>
<br>
<br>
 <div class="container">
      <div class="form-container">
        <form method="post">
            <h2>Bitte einloggen:</h2><hr />
            <?php
      if(isset($error))
      {
           ?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                     </div>
                     <?php
      }
      ?>
            <div class="form-group">
              <input type="text" class="form-control" name="txt_uname_email" placeholder="Benutzername oder E-mail" required />
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="txt_password" placeholder="Ihr Password" required />
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
              <button type="submit" name="btn-login" class="btn btn-block btn-primary">
                  <i class="glyphicon glyphicon-log-in"></i>&nbsp;LOG IN
                </button>
            </div>
            
        </form>
       </div>

</body>
</html>
