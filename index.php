<!DOCTYPE html>
<html lang ="en">
	
	
	<?php
		include_once 'header.php';
	?>

	<body class = "bg_titel">
		
		<?php
		include_once 'menue.php';
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
		

		<script>
		$('.menu li a').click(function(e) {
		var $this = $(this);
		if (!$this.hasClass('active')) {
			$this.addClass('active');
		}
		e.preventDefault();
		});
		</script>
		<!-- <script>
		$(document).ready(function(){
			$(".iframe").colorbox({iframe:true, innerWidth: 980, innerHeight: 900});  
			$("#click").click(function(){ 
			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
			});
		});
		</script> -->
	</body>
</html>