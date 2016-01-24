var ListTable = document.getElementById("ListTable").getElementsByTagName("tbody");

function ReloadCart() {
	var e = new XMLHttpRequest();
	e.onreadystatechange = function() {
		if(e.readyState == 4 && e.status == 200) {
			ListTable.innerHTML = "";
			var data = JSON.parse(e.responseText);
			if(data[0]) {
				for(var i = 1; i < data.length; i++) {
					var tableRow = document.createElement("tr");
					for(var key in data[i]) {
						var td = document.createElement("td");
						td.innerHTML = data[i][key];
						tableRow.appendChild(td);
					}
					
					/*
						Add Action for + / - / remove / edit
					*/
					
					ListTable.appendChild(tableRow);
				}
			}
		}
	}
	
	e.open("GET", "?mod=mod_cart_view&view=list", true);
	e.send();
}

function PlusOne(pid) {
	var e = new XMLHttpRequest();
	e.onreadystatechange = function() {
		if(e.readyState == 4 && e.status == 200) {
			var data = JSON.parse(e.responseText);
			
			if(data["success"] == false) {
				alert("ACTION FAILED !");
			}
		}
	}
	
	e.open("GET", "?mod=mod_cart_view&view=add&pid=" + pid + "&qty=1", true);
	e.send();
}

function SubtractOne(pid) {
	var e = new XMLHttpRequest();
	e.onreadystatechange = function() {
		if(e.readyState == 4 && e.status == 200) {
			var data = JSON.parse(e.responseText);
			
			if(data["success"] == false) {
				alert("ACTION FAILED !");
			}
		}
	}
	
	e.open("GET", "?mod=mod_cart_view&view=add&pid=" + pid + "&qty=-1", true);
	e.send();
}

function DeleteFromCart(pid) {
	var e = new XMLHttpRequest();
	e.onreadystatechange = function() {
		if(e.readyState == 4 && e.status == 200) {
			var data = JSON.parse(e.responseText);
			
			if(data["success"] == false) {
				alert("ACTION FAILED !");
			}
		}
	}
	
	e.open("GET", "?mod=mod_cart_view&view=del&pid=" + pid, true);
	e.send();
}