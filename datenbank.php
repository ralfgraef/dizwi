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
							 
							

							// $query = $DB_con->query('SELECT * FROM daten');
							// while($r = $query->fetch(PDO::FETCH_OBJ)) {
							//     if ($r->checked == 0) {
							//       $r->checked = 'nein';
							//     } else {
							//       $r->checked = 'ja';
							//     }
									
							//     echo "<tr><td>$r->id</td><td>$r->title</a></td>"
							//         . "<td>$r->hash</td>" . "<td>$r->url</td>" . "<td>$r->timestamp</td>" . "<td>$r->checked</td>" ;
							// }
							
							?>
							</tbody>
						</table> 
						<?php $user->paginglink($query,$records_per_page); ?> 									
					</div>
				</div>
			</div>

			<!-- <script>
				function updateDiv()
				{
							$('#upload').load('queryundaction.php');
				}
				window.setInterval("updateDiv()", (2000));
			</script> -->
	</body>
</html>