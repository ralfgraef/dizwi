<?php
include_once 'includes/dbconfig.php';
	if(!$user->is_loggedin())
	{
	  $user->redirect('start.php');
	}
	$user_id = $_SESSION['user_session'];
	$stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang ="en">
	
	<?php
		include_once 'includes/header.php';
	?>

	<body class="titel2">
  
		<?php
			include_once 'includes/navbar.php';
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
						<table  class="table table-bordered table-striped tabi">
							<thead>
								<tr>
								<th>ID</th>
								<th>Titel</th>
								<th>Prüfsumme</th>
								<th>Speicherort</th>
								<th>Ingestiert am</th>
                <th>Bewertung</th>
								<th>DLZA</th>
								</tr>
							</thead>
							<tbody>

							<?php
							
							$query = "SELECT * FROM daten";       
							$records_per_page=9;
							$newquery = $user->paging($query,$records_per_page);
							$user->dataview($newquery);
							 
							?>
							</tbody>
						</table> 
						<?php $user->paginglink($query,$records_per_page); ?> 									
					</div>
				</div>
			</div>


			<script>		
					$('.my_checkbew').on('click', function() {
							console.log('ID_BEW: ', $(this).attr('id')); 
							console.log('Checked_BEW: ', $(this)[0].checked );
						
					var id= $(this).attr('id');
          var checked = $(this)[0].checked;
          
					var url = 'checkbew.php';

				
          $.ajax({
            type: "POST",
            url: url,
            data: {id: id, checked: checked},
            success: function(data){
                alert(data);
            }
          });
        });
			</script>

			<script>		
					$('.my_checkdlza').on('click', function() {
							console.log('ID_DLZA: ', $(this).attr('id')); 
							console.log('Checked_DLZA: ', $(this)[0].checked );
						
					var id= $(this).attr('id');
          var checked = $(this)[0].checked;
          
					var url = 'checkdlza.php';

				
          $.ajax({
            type: "POST",
            url: url,
            data: {id: id, checked: checked},
            success: function(data){
                alert(data);
            }
          });
        });
			</script>

		
	</body>
</html>