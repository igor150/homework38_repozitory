function updateLink()
	{
		
		
		var ul = document.getElementById('log').value;
		var up = document.getElementById('pass').value;
		console.log(ul);
		
		/***
		var a = document.createElement('a');
		a.id = 'anchor1';
		a.href = "index.php?userlogin=" + ul + "&userpassword=" + up;
		****/
		
		var str_href = "index.php?userlogin=" + ul + "&userpassword=" + up;
		document.getElementById('anchor1').setAttribute('href', str_href);
		updateDiv();
	}
	
	function parseLinkParams(str)
	{
		// we need parse  index.php?userlogin=tema&userpassword=555
		
		var regexp = /^index\.php\?userlogin\=(.*)\&userpassword\=(.*)$/;
		
		var tmp_arr = str.match(regexp);
		 
		
		var arr = [];
		
		arr['userlogin'] = tmp_arr[1];
		arr['userpassword'] = tmp_arr[2];
		
		return arr;
	}
	
	function updateDiv()
	{
		/*
		var list = document.getElementsByTagName('div');
		if(list.length != 0)
		{
			document.body.removeChild(list[0]);
		}
		
		var div = document.createElement('div');
		div.id = 'div_get_href';
		div.innerHTML = document.getElementById('anchor1').getAttribute('href');
		document.body.appendChild(div);
		*/
		var div = document.getElementById('div_get_href');
		div.innerHTML = document.getElementById('anchor1').getAttribute('href');
		
	}
	
	function handleOnChange(e)
	{
		updateLink();
	}
	
	function handle(e) 
	{
		if(e.keyCode == 13) { alert('was enter press: '+this.id); updateLink(); }
	}
	
	function sendFormDataToServer()
	{
	
		var xhr = new XMLHttpRequest();

		var cmd = 'login';
	
		var userlogin = document.getElementById("log").value;
		var userpassword = document.getElementById("pass").value;
		
	
	var body = 'cmd=' + encodeURIComponent(cmd)
	+   '&userlogin=' + encodeURIComponent(userlogin)
	+   '&userpassword=' + encodeURIComponent(userpassword);
	

	xhr.open("POST", 'login.php', true)
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

	xhr.onreadystatechange = function()
	{
		if (this.readyState != 4) return;

		var s = this.responseText;
		
		if(s.indexOf('error[login:') === -1)
		{
			//location = 'index.php';
		}
		else
		{
			if(	s.indexOf("error[login:#1]") !== -1)
			{
				alert('Some error ' + s.replace("error[login:#1]"," >>>>> "));
				
				
				
			}
			
		}
	}

	xhr.send(body);	
}
	
	function checkFormFields ( success, error )
	{
		if( document.getElementById('log').value.trim() == '') error(1);
		else if( document.getElementById('pass').value.trim() == '') error(2);
		
		else sendFormDataToServer();
		
	}
	
	function processError(errnum)
	{
		if(errnum==1)
		{
			document.getElementById('log').style.border = "2px solid red";
		}
		else if(errnum==2)
		{
			document.getElementById('pass').style.border = "2px solid red";
		}
	}
	
	function resetBorders()
	{
		document.getElementById('log').style.border = '';
		document.getElementById('pass').style.border = '';
	}
  
	window.onload = function()
	{
		//alert('script works');
		
		//searchElement();
		
		//var params = parseLinkParams(document.getElementById('anchor1').getAttribute('href'));
		//document.getElementById('log').value = params['userlogin'];
		//document.getElementById('pass').value = params['userpassword'];
	    //console.log(params);
		//updateDiv();
		
		
	//	document.getElementById('log').onkeypress = handle;
	//	document.getElementById('log').onchange = handleOnChange;
	//	document.getElementById('pass').onkeypress = handle;
	//	document.getElementById('pass').onchange = handleOnChange;

		document.getElementById("login_btn").onclick = function()
		{
			resetBorders();
			
			checkFormFields( function(){
				sendFormDataToServer(); //success
			}
			,
			function( errnum ) {
				processError(errnum); //pomilka
			} );
		}

		//dz testuvannya obrobka pomilok za dopomogou red div with fixed position

		
	}
	/*
	[11:23:37] Олег: dz подключить новый (еще один) скрипт джаваскрипт который добавит
 на страницу собственную кнопку

а эпо нажатию на эту кнопку будет производится поиск в DOM [test_tag]
и alert() якщо знайдено  де знайдено HTML DOM CDATA w3cschools
[11:24:55] Олег: Наступне заняття (умовно) в середу, 05.10.2016 Продовження рег1страц1я користувача (залогинення)
*/