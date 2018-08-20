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

<?php 
	function echoActiveClassIfRequestMatches($requestUri) {
	$current_file_name = basename($_SERVER['REQUEST_URI'], ".php");
	if ($current_file_name == $requestUri)
        echo 'active';
	}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <div class="container">
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item <?=echoActiveClassIfRequestMatches("index")?>"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item <?=echoActiveClassIfRequestMatches("ingest")?>"><a class="nav-link" href="ingest.php">Ingest</a></li>
        <li class="nav-item <?=echoActiveClassIfRequestMatches("datenbank")?>"><a class="nav-link" href="datenbank.php">Datenbank</a></li>
      </ul>
      <ul class="navbar-nav ml-auto">
      <?php
        if(!$user->is_loggedin()) {?>
	        <li class="nav-item"<?=echoActiveClassIfRequestMatches("login")?>><a class="nav-link" href="login.php">Log in</a></li>
        <?php } else {?>
          <li class="nav-item"><a class="nav-link" href="#">Eingelogt als: <?php print($userRow['user_name']); ?></a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php?logout=true"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
        <?php } ?>
      </ul> 
    </div>
    </div>
</nav>