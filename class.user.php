<?php
class USER {
	private $db;
	
	function __construct($DB_con) {
		$this->db = $DB_con;
	}
	
	public function register($fname,$lname,$uname,$umail,$upass) {
		try {
			$new_password = password_hash($upass, PASSWORD_DEFAULT);
			
			$stmt = $this->db->prepare("INSERT INTO users(user_name,user_email,user_pass) 
		                                               VALUES(:uname, :umail, :upass)");
												  
			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":upass", $new_password);										  
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}				
	}
	

	public function urlupload($url) {
		try {
			$stmt = $this->db->prepare("INSERT INTO speicherorte(url) VALUES(:url)");
												  
			$stmt->bindparam(":url", $url);										  
			
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}				
	}

	public function dataupload($title,$iserver,$url,$hash, $checked) {
		try {			
			$stmt = $this->db->prepare("INSERT INTO daten(title,iserver,url, hash, checked) VALUES(:title, :iserver, :url, :hash, :checked)");
												  
			$stmt->bindparam(":title", $title);
			$stmt->bindparam(":iserver", $iserver);
			$stmt->bindparam(":url", $url);										  
      $stmt->bindparam(":hash", $hash);
      $stmt->bindparam(":checked", $checked);

			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}				
	}

	public function login($uname,$umail,$upass) {
		try {

			$stmt = $this->db->prepare("SELECT * FROM users WHERE user_name=:uname OR user_email=:umail LIMIT 1");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

			if($stmt->rowCount() > 0) {
				if(password_verify($upass, $userRow['user_pass'])) {
					$_SESSION['user_session'] = $userRow['user_id'];
					return true;
				}
				else {
					return false;
				}
			}
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
	}
	
	public function is_loggedin() {
		if(isset($_SESSION['user_session'])) {
			return true;
		}
	}
	
	public function redirect($url) {
		header("Location: $url");
	}
	
	public function logout() {
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}

	public function dataview($query) {
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		if($stmt->rowCount()>0) {
			while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
				?>
				<tr>
				<td><?php echo $row['id']; ?></td>
				<td><?php echo $row['title']; ?></td>
				<td><?php echo $row['hash']; ?></td>
				<td><?php echo $row['url']; ?></td>
				<td><?php echo $row['timestamp']; ?></td>
        <td><?php echo $row['bewertung']; ?></td>
				<td><?php echo $row['checked']; ?></td>
				</tr>
				<?php
			}
		}
		else {
			?>
			<tr>
			<td>Nothing here...</td>
			</tr>
			<?php
		}
 	}
 
	public function paging($query,$records_per_page) {
		$starting_position=0;
		if(isset($_GET["page_no"])) {
			$starting_position=($_GET["page_no"]-1)*$records_per_page;
		}
		$query2=$query." limit $starting_position,$records_per_page";
		return $query2;
	}
 
 	public function paginglink($query,$records_per_page) {
  
		$self = $_SERVER['PHP_SELF'];

		$stmt = $this->db->prepare($query);
		$stmt->execute();

		$total_no_of_records = $stmt->rowCount();

		if($total_no_of_records > 0) {
			?><tr><td colspan="3"><?php
			$total_no_of_pages=ceil($total_no_of_records/$records_per_page);
			$current_page=1;
			if(isset($_GET["page_no"])) {
				$current_page=$_GET["page_no"];
			}
			if($current_page!=1) {
				$previous =$current_page-1;
				echo "<nav aria-label='Page navigation example'>";
				echo "<ul class='pagination'>";
					echo "<li class='page-item'>";
					echo "<a class='page-link' href='".$self."?page_no=1'>Erste</a>&nbsp;&nbsp;";
					echo "</li>";
					echo "<li class='page-item'>";
					echo "<a class='page-link' href='".$self."?page_no=".$previous."'>Vorherige</a>&nbsp;&nbsp;";
					echo "</li>";	
				}
			for($i=1;$i<=$total_no_of_pages;$i++) {
				if($i==$current_page) {
					echo "<ul class='pagination'>";
					echo "<li class='page-item'>";
					echo "<a class='page-link' href='".$self."?page_no=".$i."' style='color:red;text-decoration:none'>".$i."</a>&nbsp;&nbsp;";
					echo "</li>";
				}
				else {
					echo "<li class='page-item'>";
					echo "<a class='page-link' href='".$self."?page_no=".$i."'>".$i."</a>&nbsp;&nbsp;";
					echo "</li>";
				}
   		}
   		if($current_page!=$total_no_of_pages) {
				$next=$current_page+1;
					echo "<li class='page-item'>";
        	echo "<a class='page-link' href='".$self."?page_no=".$next."'>Nächste</a>&nbsp;&nbsp;";
					echo "</li>";
					echo "<li class='page-item'>";
					echo "<a class='page-link' href='".$self."?page_no=".$total_no_of_pages."'>Letzte</a>&nbsp;&nbsp;";
					echo "</li>";
				echo "</ul>";	
				}
   		?></td></tr><?php
  	}
 	}
}
?>