function whenClickedOnSendEmailButton()
{
	var xhr = new XMLHttpRequest();

	var cmd = 'emailto';
	
	var addr = document.getElementById("address").value;
	var subj = document.getElementById("subject").value;
	var msg = document.getElementById("message").value;
	
	var body = 'cmd=' + encodeURIComponent(cmd)
	+   '&subject=' + encodeURIComponent(subj)
	+   '&address=' + encodeURIComponent(addr)
	+   '&message=' + encodeURIComponent(msg)
	;

	xhr.open("POST", 'send_email.php', true)
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

	xhr.onreadystatechange = function()
	{
		if (this.readyState != 4) return;

		var s = this.responseText;
		
		if(s.indexOf('error[') === -1)
		{
			alert('Vash message otoslan');
		}
		else
		{
			if(	s == "error[mail:#1]")
			{
				alert('Nevirna adresa');
			}
			else if (	s == "error[mail:#2]")
			{
				alert('Nevirna tema pisma');
			}
			else if (	s == "error[mail:#4]")
			{
				alert('Nevirna adresa');
			}
			else if (	s == "error[mail:#3]")
			{
				alert('Nezapovneno textove pole ');
			}
		}
	}

	xhr.send(body);	
}


function divHiddenTrue() {

	var divHidden = document.getElementById('div_hidden');
	divHidden.hidden = true;

}

function divHiddenFalse() {
	var divHidden = document.getElementById('div_hidden');
	divHidden.hidden = false;
	
	var divNew = document.getElementById('div_new');
	divNew.hidden = true;
}

function divNewFalse() {
	var divHidden = document.getElementById('div_hidden');
	divHidden.hidden = true;
	
	var divNew = document.getElementById('div_new');
	divNew.hidden = false;
}


function whenOnclickBtnView() {
	var btnView = document.getElementById('view');
	btnView.setAttribute('onclick','divHiddenFalse()' );
}

function whenOnclickBtnNew() {
	var btnNew = document.getElementById('new');
	btnNew.setAttribute('onclick','divNewFalse()' );
	
}



window.onload = function() {
	divHiddenTrue();
	whenOnclickBtnView();
	whenOnclickBtnNew();
}




















