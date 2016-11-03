<?php

	if(isset($_POST['cmd']) && ($_POST['cmd']=='emailto'))
	{
		if(isset($_POST['address']) == false )
		{
			//error when address is no set
			echo "error[mail:#1]";
			die;
		}
		else  if ( filter_var( trim($_POST['address']), FILTER_VALIDATE_EMAIL ) == false ) //address not valid?
		{
			//error Invalid email format 
			echo "error[mail:4]";
			die;
		}
		
		if(isset($_POST['subject']) == false )
		{
			//error when subj is no set
			echo "error[mail:#2]";
			die;
		}
		
		if(isset($_POST['message']) == false )
		{
			//error when msg is no set
			echo "error[mail:#3]";
			die;
		}
		
		$address = $_POST['address'];
		
		$subj = trim($_POST['subject']);
		
		// the message
		$msg = trim($_POST['message']); // "First line of text\nSecond line of text";

		// use wordwrap() if lines are longer than 70 characters
		$msg = wordwrap($msg,70);
		
		// send email
		mail( $address , $subj, $msg );
	}
	
	else phpinfo();
?>