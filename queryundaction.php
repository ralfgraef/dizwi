<?php
include_once 'dbconfig.php';
?>

<h3 class="player">Datenbank:</h2> 
<br>    

<table  class="table table-bordered table-striped table-dark tabi">
	<thead>
		<tr>
		<th>ID</th>
		<th>Titel</th>
		<th>Hashwert</th>
		<th>Speicherort</th>
		<th>Ingestiert am</th>
    <th>Checked</th>
		</tr>
	</thead>
	<tbody>

	<?php
	$query = $DB_con->query('SELECT * FROM daten');
	while($r = $query->fetch(PDO::FETCH_OBJ)) {
      if ($r->checked == 0) {
        $r->checked = 'false';
      } else {
        $r->checked = 'true';
      }
	    //echo "<li><p><span class='neu'>Titel: <a class='iframe' href='iframe.php?songid=$r->id'> $r->title</a></span> Signatur: <a class='iframe' href='$r->iserver'>$Sr</a></p></li>";
	//<li><span class='neu'><audio controls='controls' oncontextmenu = 'return false'> <source src='$r->url' type='audio/ogg' />  </audio></li>";
	    echo "<tr><td>$r->id</td><td>$r->title</a></td>"
	        . "<td>$r->hash</td>" . "<td>$r->url</td>" . "<td>$r->timestamp</td>" . "<td>$r->checked</td>" ;
	}
	
	?>
	</tbody>
</table>     