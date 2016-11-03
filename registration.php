<?php

	require_once "lib/config_db.php";
	
	function generateSalt() {
		
		$salt = '';
		$length = rand(5,10); // длина соли (от 5 до 10 сомволов)
		for($i=0; $i<$length; $i++) {
			 $salt .= chr(rand(33,126)); // символ из ASCII-table
		}
		$salt = str_replace("'","#",$salt);
		$salt = str_replace('"',"#",$salt);
		return $salt;
		
	}
	
	function get_from_database_access_table($conn, $userlogin)
	{
		
		$sql = "SELECT * FROM `access` WHERE `userlogin`='$userlogin'";
        $result = $conn->query($sql);
		
		if ($result->num_rows > 0) { return $result->fetch_assoc(); }
		
		return null;
		
		
	}
	
	function get_from_database_users_table($conn, $email)
	{
		
		$sql = "SELECT * FROM `users` WHERE `e_mail`='$email'";
        $result = $conn->query($sql);
		
		if ($result->num_rows > 0) { return $result->fetch_assoc(); }
		
		return null;
	
	}
	
	function exist_login_or_email( $conn, $login, $email) {
		$userlogin = get_from_database_access_table($conn, $login);
		if($userlogin == null)
		{
			$e_mail = get_from_database_users_table($conn, $email);
			if($e_mail == null) return false;
		}
		return true;
	}
	
	
	
	/*** works!
	echo "1<br>";
	$sql = "SELECT * FROM `users`"; //WHERE `e_mail`='$email'";
        $result = $conn->query($sql);
		
		if ($result->num_rows > 0) //{ return $result->fetch_assoc(); }
	
	 while($row = $result->fetch_assoc()) {
         echo "<br> id: ". $row["userid"]. " - Reg_Date: ". $row["reg_date"]. " - First Name: ". $row["first_name"]. " " . $row["las_tname"]. "E-mail: " .  $row["e_mail"] . "<br>";
     }
     else {
     echo "0 results";
		}

	$conn->close();
	die;
	****/
	
	if(isset($_POST['userlogin']) && isset($_POST['userpassword1']) && isset($_POST['userpassword2']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email'])) 
	{
	
		$login = trim($_POST['userlogin']);
		
		
		$password1 = trim($_POST['userpassword1']);
		$password2 = trim($_POST['userpassword2']);
		if($password1 != $password2) 
		{
			//header('Refresh:5;url=registration.php');
			header('Refresh:5;url=index2.html#win2');
			echo "<br>Paroli ne spivpadaut";
			die();
		}
		
		$fname = trim($_POST['fname']);
		$lname = trim($_POST['lname']);
		$email = trim($_POST['email']);
		
		SetCookie("userlogin",$login);
		SetCookie("fname",$fname);
		SetCookie("lname",$lname);
		SetCookie("email",$email);
		
		if ( exist_login_or_email( $conn, $login, $email ) == true )
		{
			
			//header('Refresh:5;url=registration.php');
			header('Refresh:3;url=index2.html#win2');
			echo "<br>Cey login abo email uzhe zaynyatiy";
			die();
			
		}
		
		
		
		
		$s = '';
		
		//obrobiti vhidni danni
		$salt = generateSalt(5,10);
		$criptedpassword = md5(md5($password1).$salt);
		$sql = "INSERT INTO `access` (`userid`,`userlogin`,`criptedpassword`,`salt`) VALUES ( NULL, '$login','$criptedpassword','$salt')";
		if ($conn->query($sql) === TRUE) {
			$s .= "<br>New record created successfully";
		} else {
			die( "Error: " . $sql . "<br>" . $conn->error );
		}
		
		
		$userid = $conn->insert_id; //last insert record id (autoincrement)
		$reg_date = date("Y-m-d H:i:s");
		
		$sql = "INSERT INTO `users` (`userid`, `reg_date`, `first_name`, `last_name`, `e_mail`)
				VALUES (  '$userid', '$reg_date', '$fname', '$lname', '$email')";

		if ($conn->query($sql) === TRUE) {
			$s .= "<br>New record created successfully";
		} else {
			die ("Error: " . $sql . "<br>" . $conn->error);
		}

		$conn->close();
		
		//header('Refresh');
		
		header('Refresh:3;url=index2.html');
		
		echo $s. " <br>information for user: check your email for confirmation letter";
		//DZ 10 registraciy ta 10 loginiv
		
	}
	else
	{
		//print_r($_GET);
		$html = file_get_contents("templates/registration_page.html.tmpl"); //div win2 register
		$html = str_replace("[fname]",$_COOKIE['fname'],$html);
		$html = str_replace("[lname]",$_COOKIE['lname'],$html);
		$html = str_replace("[email]",$_COOKIE['email'],$html);
		$html = str_replace("[userlogin]",$_COOKIE['userlogin'],$html);
	}

	
	echo $html;

	
	
?>