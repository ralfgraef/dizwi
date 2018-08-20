<?php
include_once 'dbconfig.php';
?>	

<div class = "demo">
<form method = "post" enctype = "multipart/form-data">
	
	<?php
    $query = $DB_con->query('SELECT DISTINCT url FROM speicherorte');
	while($results[] = $query->fetch(PDO::FETCH_OBJ));
    array_pop ( $results );
	?>

	<label for="Folder">Vorhandenen Speicherort auswählen ...</label>
	<br>
	<select name="Folder" id = "Folder" class="form-control">
     <?php foreach ( $results as $option ) : ?>
          <option value="<?php echo $option->url; ?>"><?php echo $option->url; ?></option>
     <?php endforeach; ?>
	</select>

	<br>

	<label for="Ordner">... oder neuen Speicherort erstellen:</label>
	<br>
	<input name="Ordner" id = "Ordner" class="form-control" type="text">
   
	<br>

	<label for="Input">Datei(en) auswählen:</label>
	<div class="input-group">
		<span class="input-group-btn">
			<span class="btn btn-secondary btn-file">
				Browse <input id = "Input" name = "files[]"  type="file" multiple="multiple/form-data" >
			</span>
		</span>
		<input type="text" placeholder = "Auswahl, bitte ..."  class="form-control" readonly>
	</div>
	
	<br>

	<input type = "submit" value = "Upload"  class="btn btn-secondary" />
	
	<input type="submit" name="sent"  value = "Clear" class="btn btn-secondary"/>

</form>

<?php 
	if(!empty($_POST["Ordner"]) && empty($_POST["Folder"])) 
	{

		$speicherordner = $_POST["Ordner"];
		if (!mkdir("ZwischenArchiv" . $speicherordner, 0777, true)) {
    	die('Erstellung der Verzeichnisse schlug fehl...');
		}     
		foreach ($_FILES['files']['name'] as $f => $name) 
		{
			
			$startname = $_FILES['files']['tmp_name'][$f];
			$name = $_FILES['files']['name'][$f];
			$title =  basename($name);
      $zielname = "ZwischenArchiv" . $speicherordner  . basename($name);
      $checked = false;
			echo $zielname;
			if (@move_uploaded_file($startname, $zielname)) 
			{
				
				$hash = md5_file($zielname);
				$url = $speicherordner;
				$iserver = "http://www.fes.de/lnk/1rh";
				$user->dataupload($title,$iserver,$url,$hash,$checked);
				$user->urlupload($url);

				echo "<div id = 'anz'>";
				echo "<br>";
				
				echo"<p>Status: " . $name . " ";
				echo " Datei hochgeladen <br> Ort: "  . $speicherordner . "</p>";
				echo "Md5-Hashwert von " .  $title . ":";
				echo "<br>" .  md5_file($zielname);
				echo "</div>";

				
			} 

			else if (isset($_POST['sent']))
			{
			
				echo "<script>
				$( '#anz' ).empty();
				</script>";

			}


			else 
			{
				echo "<br>";
				echo"<div class='alert alert-danger'>
	            <i class='glyphicon glyphicon-warning-sign'>      Fehler Error</i>"; 
	            echo "</div>";

			}
			
		}
	}
	else if(empty($_POST["Ordner"]) && !empty($_POST["Folder"]))
	{
		$speicherordner = $_POST["Folder"];
				
		foreach ($_FILES['files']['name'] as $f => $name) 
		{
			
			$startname = $_FILES['files']['tmp_name'][$f];
			$name = $_FILES['files']['name'][$f];
			$title =  basename($name);
			$zielname = "ZwischenArchiv" . $speicherordner  . basename($name);
      $checked = false;
      
			if (@move_uploaded_file($startname, $zielname)) 
			{
				
				$hash = md5_file($zielname);
				$url = $speicherordner;
				$iserver = "http://www.fes.de/lnk/1rh";
				$user->dataupload($title,$iserver,$url,$hash,$checked);

				echo "<div id = 'anz'>";
				echo "<br>";
				
				echo"<p>Status: " . $name;
				echo "Datei hochgeladen <br> Ort: "  . $speicherordner . "</p>";
				echo "Md5-Hashwert von " .  $title . ":";
				echo "<br>" .  md5_file($zielname);
				echo "</div>";

				
			} 

			else if (isset($_POST['sent']))
			{
			
				echo "<script>
				$( '#anz' ).empty();
				</script>";

			}


			else 
			{
				echo "<br>";
				echo"<div class='alert alert-danger'>
	            <i class='glyphicon glyphicon-warning-sign'>      Fehler Error</i>"; 
	            echo "</div>";

			}
			
		}
	}
?>
</div>