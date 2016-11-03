<?php

	if(isset($_COOKIE['userlogin']) && isset($_COOKIE['userpassword']))
	{
		echo "test ok";
		print_r($_COOKIE);
		print_r($_POST);
	}
	else
	{
		echo "<br>Spershu, bud laska, zalogintes";
		//croudfounding z miru po nitke
		//excel -> CSVformat  ,fjlgh,fgntn,dgrn,fgh,gjhb,
	}

?>