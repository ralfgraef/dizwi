<?php
include_once 'dbconfig.php';
	if(!$user->is_loggedin())
	{
	  $user->redirect('login.php');
	}
	$user_id = $_SESSION['user_session'];
	$stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang ="en">
	
	<?php
		include_once 'header.php';
	?>

	<body class="titel2">
  <?php
		include_once 'navbar.php';
	?>	
		<br>
			<div class = "container">
			<br>
			<br>
			
			<h3 class="right">Digitales Zwischenarchiv</h3>
			<img src="images/fes.png" class = "fes">
			<hr class = "trenner">
			<br>
		
				<div class ="row"> 
					<div id = "upload" class="player col-md-12">
								
							<?php
							include_once 'queryundaction.php';
							?>
							        
					</div> <!-- /.titel col-md-12 -->

					
				</div><!-- /.row -->
			</div><!-- /.container -->

		<script>
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip(); 
			});
		</script> 


		<script>
			function updateDiv()
			{
			      $('#upload').load('queryundaction.php');
			}
			window.setInterval("updateDiv()", (2000));
		</script>
	</body>
</html>