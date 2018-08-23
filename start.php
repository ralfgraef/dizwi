<!DOCTYPE html>
<html lang ="en">
	
	
	<?php
		include_once 'includes/header.php';
	?>

	<?php
    include_once 'includes/dbconfig.php';
    if(!$user->is_loggedin())
    {
      $user->redirect('login.php');
    }
    $user_id = $_SESSION['user_session'];
    $stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
    $stmt->execute(array(":user_id"=>$user_id));
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	?>

	<body class = "bg_titel">
		
		<?php
		include_once 'includes/menue.php';
		?>
		<br>
		<br>
		<br>
		<br>
		
		<div class = "container">
		<br>
		<br>
		<div id = "upload" class="titel col-md-12">
		<h2 class="titel">Archiv der sozialen Demokratie</h2>
		<br>	
		<h1 class="titel">Digitales Zwischenarchiv</h1>
		<br>
		<h2 class="titel">Version: 1.2.0</h2>
		<br>
		<br>
		
		</div><!-- /.titel col-md-12 -->
		</div><!-- /.container -->
		
	</body>
</html>