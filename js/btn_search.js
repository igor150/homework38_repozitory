function searchElement() {
	
	var divSearchBtn = document.createElement("div");
	
	var btnSearch = document.createElement("button");
	btnSearch.id = "search_btn"
	btnSearch.type = "button";
	//btnSearch.className = "prev";
	btnSearch.innerHTML = 'searchElem';
	//ul.insertBefore(btnPrev, ul.firstChild);
	divSearchBtn.appendChild(btnSearch);
	
	document.body.insertBefore(divSearchBtn, document.body.lastChild);
	 
	for (var i = 0; i < document.body.childNodes.length; i++) {
      console.log( document.body.childNodes[i] ); // Text, DIV, Text, UL, ..., SCRIPT
    
	}
	 
}
