<?php

	require_once "lib/config_db.php";
	
	header("Cache-Control: no-cache, must-revalidate");


	function get_from_database_user_table($conn, $userlogin)
	{
		
		$sql = "SELECT * FROM `access` WHERE `userlogin`='$userlogin'";
        $result = $conn->query($sql);
		
		if ($result->num_rows > 0) { return $result->fetch_assoc(); }
		
		return null;
		
		
	}
	
	function isNotEmpty($val)
	{
		if( isset($val) == $result ) return false; 
		
		if( strlen( trim ( $_POST['userlogin'] ) ) == 0 ) return false;
		
		return true;
	}
	
	//t45.com/install_db.php
	
/*
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "my_first_database"; //php IDE abo IDE for developing PHP
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		die("<br>[#all_conn_err]Connection failed: " . $conn->connect_error);
	} 
	
	//dz design form login, and read http://phpfaq.ru/mysql/slashes 
	//интересно почитати: гугл формы атак на php сайт
			
	//echo "1";
*/	
	//отримуєм введені данні у формі welcom та звіряємо їх з данними які знаходяться в базі данних
	if(isset($_GET['userlogin']) && isset($_GET['userpassword']))
	{
			//echo "2";
		$userlogin = trim($_GET['userlogin']); //test,12345,77777
		
		$user = get_from_database_user_table( $conn, $userlogin );
		//echo "user= ";
		//print_r($user);
		$compare_value = md5(md5($userpassword).$user['salt']);
		//echo "<br>$compare_value<br>";
		
		//дії якщо логін та пароль (welcom) які ввів користувач у форму немає в базі данних
		if($user == NULL) 
		{
			// DZ if userlogin is not exist in database
			if( ( isNotEmpty($_POST['userlogin']) == false ) || (isNotEmpty($_POST['userpassword']) == false ) ) {
				header('Refresh:3;url=/'); //location = '/';
			    echo "<br>The some fields is empty. Try again.";
			}
			else {
				//header('Refresh:3;url=/'); //location = '/';
				echo "<br>Your login and password is wrong or your not registered.";
				echo '<br>If you not register you can register here: <a href="?cmd=register">click</a>';
			}
			
			//header('Refresh:3;url=/'); //location = '/';
			
			//echo "<br>Your login and password is wrong or your not registered. Try again.";
			//echo '<br>If you not register you can register here: <a href="?cmd=register">click</a>';
			
			die();
		}
		
		
		
		// $user – информация о пользователе из таблицы user
		else if ($compare_value == $user['criptedpassword']) 
		{
			// проверка прошла успешно. логиним!

			//yakscho buv GET zapros z params userlogin ta userpassword
			//ta ci parametri korektni
			setcookie("userlogin", $_GET['userlogin']);
			setcookie("userpassword", $_GET['userpassword']);
			//....
			header('Refresh:3;url=/');
			
			echo "<br>Thank you very m...";
			//$html_notes = file_get_contents("notes.html");
			//echo $html_notes;
		}
		else
		{
			// DZ if password wrong
			echo "<br>Your password is wrong.Try again.";
		}
	
	}
	//else if(isset($_GET['cmd']))
	else if(isset($_GET['cmd']))
	{
		
		
			//echo "3";
		//yakscho buv GET zapros z param cmd
		$cmd = trim($_GET['cmd']);
		
		if($cmd == "register") ///index.php?cmd=register
		{	//echo "4";
			//$html = file_get_contents("templates/registration_page.html.tmpl");
			$html = file_get_contents("index.html");
			$html = str_replace("[userlogin]","",$html);
			$html = str_replace("[fname]","",$html);
			$html = str_replace("[lname]","",$html);
			$html = str_replace("[email]","",$html);
			echo $html;
			//echo htmlspecialchars($html)."<br>";
		}
		else
		{	
			setcookie("userlogin", $_GET['userlogin']);
			setcookie("userpassword", $_GET['userpassword']);
			header('Refresh:3;url=/'); //refresh:5;url=wherever.php
		}
	}
	else if(isset($_POST['login']) && isset($_POST['userlogin']) && isset($_POST['userpassword']))
	{
		
		
		$userlogin = trim($_POST['userlogin']); //test,12345,77777
		
		$userpassword = trim($_POST['userpassword']); 
		
		// DZ if userlogin is not exist in database
			if( ( isNotEmpty($_POST['userlogin']) == false ) || (isNotEmpty($_POST['userpassword']) == false ) ) {
				header('Refresh:3;url=/'); //location = '/';
			    echo "<br>The some fields is empty. Try again.";
				die();
			}
			
			
		
		$user = get_from_database_user_table( $conn, $userlogin );
		//echo "user= ";
		//print_r($user);
		
		$compare_value = md5(md5($userpassword).$user['salt']);
		//var_dump($compare_value);
		//var_dump($user['criptedpassword']);
		
		//echo "<br>$compare_value<br>";
		
		//дії якщо логін та пароль (welcom) які ввів користувач у форму немає в базі данних
		if($user == NULL) 
		{
			
			header('Refresh:3;url=/'); //location = '/';
			
			echo "<br>Your login and password is wrong or your not registered. Try again.";
			echo '<br>If you not register you can register here: <a href="registration.php">click</a>';
			
			die();
		}
		
		
		
		// $user – информация о пользователе из таблицы user
		else if ($compare_value == $user['criptedpassword']) 
		{
			// проверка прошла успешно. логиним!

			//yakscho buv GET zapros z params userlogin ta userpassword
			//ta ci parametri korektni
			setcookie("userlogin", $_GET['userlogin']);
			setcookie("userpassword", $_GET['userpassword']);
			//....
			header('Refresh:3;url=notes.html');
			
			echo "<br>Thank you very m...";
		}
		else
		{
			// DZ if password wrong
			header('Refresh:3;url=index2.html#win1');//tut1 31.10.2016
			echo "<br>Your password is wrong.Try again.";
		}
		
		
		
		die;
	}
	else
	{	//echo "5";
		if(isset($_COOKIE['userlogin']) && isset($_COOKIE['userpassword'] ))
		{
				//echo "6";
			
			$html = file_get_contents("templates/for_logined_user.html.tmpl");
			$cookie_str = "<br>Login: " . $_COOKIE['userlogin'] . "<br>Password: ".$_COOKIE['userpassword']."<br>";
			$html = str_replace("[cookie]",$cookie_str,$html);
			
			//plan on misyac: perenapravlennya na profile.php view Notes, my photo my data of birthday, my interest
		}
		else
		{
			//echo "7";
			//$html = file_get_contents("templates/login.html.tmpl");
			$html = file_get_contents("templates/index.html.tmpl");
			
		}
		
		
	}
	
	//echo "<h1>Test ok</h1>";
	
	//DZ dobaviti input type=text -> onchange -> <a>
	
	//DZ - pereviriti mozhlivist prenesennya javascript (yakiy u php) u otdelniy file (reading with help file_get_contents)

	$conn->close();
	
	//D(T)Z f(html, css, javascript client) => registration page -> submit -> send to server data: login, parol, email, fullname
		
	echo $html;	
		
?>





