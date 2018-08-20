<?php
include_once 'dbconfig.php';
?>

<h2 class="player">Datenbank:</h2> 
<br>    

<table  class="table table-bordered table-condensed table-striped">
	<thead>
		<tr>
		<th>ID</th>
		<th>Titel</th>
		<th>Hashwert</th>
		<th>Speicherort</th>
		<th>Ingestiert am</th>
		</tr>
	</thead>
	<tbody>

	<?php
	$query = $DB_con->query('SELECT * FROM daten');
	while($r = $query->fetch(PDO::FETCH_OBJ)) {
	    $Sr ='6/TONH'.str_pad($r->id, 6 ,'0', STR_PAD_LEFT);
	    //echo "<li><p><span class='neu'>Titel: <a class='iframe' href='iframe.php?songid=$r->id'> $r->title</a></span> Signatur: <a class='iframe' href='$r->iserver'>$Sr</a></p></li>";
	//<li><span class='neu'><audio controls='controls' oncontextmenu = 'return false'> <source src='$r->url' type='audio/ogg' />  </audio></li>";
	    echo "<tr><td>$r->id</td><td>$r->title</a></td>"
	        . "<td>$r->hash</td>" . "<td>$r->url</td>" . "<td>$r->timestamp</td>";
	}
	
	?>
	</tbody>
</table>     