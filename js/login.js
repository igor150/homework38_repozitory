function overLay() {
	var winId = document.getElementById('win1');
	if(winId) {
		var divPopUp = document.getElementById('content');
		divPopUp.innerHTML = 'test2';
	}
}


function modalWindow() {
	var enterBtn = document.getElementById('login_btn');
	enterBtn.onclick = overLay;
}



window.onload = function() {
	modalWindow();
}













