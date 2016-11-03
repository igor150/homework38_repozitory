<?php
require_once "lib/config_db.php";

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

//print_r($_POST);

 if( isset($_POST['cmd']) && $_POST['cmd']=='login' )
 {
	if( isset($_POST['userlogin']) && isset($_POST['userpassword']) ) {
	
			if( ( isNotEmpty($_POST['userlogin']) == false ) || (isNotEmpty($_POST['userpassword']) == false ) ) {
					header('Refresh:3;url=/'); //location = '/';
					echo "<br>The some fields is empty. Try again.";
					die();
				}
			
			
			
			$userlogin = trim($_POST['userlogin']);
			
			$userpassword = trim($_POST['userpassword']);
			
			$user = get_from_database_user_table( $conn, $userlogin );
			
			
			
			if($user == NULL) {
				header('Refresh:3;url=/');	
				echo "error[login:#1]<br>Your login or password is wrong or your not registered. Try again.";
				//echo '<br>If you not register you can register here: <a href="registration.php">click</a>';
				die();
			}
	
	
	
		$userlogin = trim($_POST['userlogin']); //test,12345,77777
		
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
				echo '<br>If you not register you can register here: <a href="/?cmd=register">click</a>';
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
			setcookie("userlogin", $_POST['userlogin']);
			setcookie("userpassword", $_POST['userpassword']);
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
    $conn->close();
}	

else {echo "<br>Error: POST is empty"; die();}
	

?>
