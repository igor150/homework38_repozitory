function getDefaultDate(){

    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

    return today;
}

function getDate() {
	var date = document.getElementById('date'); 
	date.value = getDefaultDate();
}


window.onload = function() {
	getDate();
	
}




























