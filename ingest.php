<!DOCTYPE html>
<html lang ="en">
	
	<?php
		include_once 'includes/header.php';
	?>

	<body class = "titel2">
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
				<div class="row">
					

					<div class="player col-md-6">
						<h3 class="player">Dateiupload:</h3> 
						<br>
						<?php
							include_once 'includes/upload.php';
						?>
					</div> <!-- /.titel col-md-6 -->

					<div class="player col-md-2">
					</div>


					<div id = "upload" class="tree col-md-4">
						<h3 class="player">Laufwerk B:/</h3>	
						<br>
						<div id="fileTreeDemo_1" class="demo">
						</div> <!-- /.fileTreeDemo_1 -->
					</div> <!-- /.titel col-md-6-->
				

				</div>
					
				
			</div><!-- /.container -->

		<script type="text/javascript">
			

			$(document).ready( function() {
				$('#fileTreeDemo_1').fileTree({ root: '../ZwischenArchiv/', 
					expandedFolders: [	'../ZwischenArchiv/01_Personen/', 
										'../ZwischenArchiv/02_Organisationen/', 
										'../ZwischenArchiv/03_Sammlungen/',
										'../ZwischenArchiv/03_Sammlungen/Audiovisuelle Sammlungen/', 
										'../ZwischenArchiv/03_Sammlungen/Audiovisuelle Sammlungen/Tonarchiv/',
										'../ZwischenArchiv/03_Sammlungen/Audiovisuelle Sammlungen/Tonarchiv/Digitalisate/',
										'../ZwischenArchiv/03_Sammlungen/',
										'../ZwischenArchiv/03_Sammlungen/Audiovisuelle Sammlungen/', 
										'../ZwischenArchiv/03_Sammlungen/Audiovisuelle Sammlungen/Plakate/',
										'../ZwischenArchiv/03_Sammlungen/Audiovisuelle Sammlungen/Plakate/Digitalisate/'
										], 
					script: 'connectors/jqueryFileTree.php' }, function(file) { 
					window.open('./ZwischenArchiv/' + file);
				});
			});

			
		</script>
			
		
		<script>
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip(); 
			});
		</script> 

		<script type="text/javascript">
		$(document).on('change', '.btn-file :file', function() {
		  var input = $(this),
		      numFiles = input.get(0).files ? input.get(0).files.length : 1,
		      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		  input.trigger('fileselect', [numFiles, label]);
		});

		$(document).ready( function() {
		    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
		        
		        var input = $(this).parents('.input-group').find(':text'),
		            log = numFiles > 1 ? numFiles + ' files selected' : label;
		        
		        if( input.length ) {
		            input.val(log);
		        } else {
		            if( log ) alert(log);
		        }
		        
		    });
		});
		</script>
	</body>
</html>