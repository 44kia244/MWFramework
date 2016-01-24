var ListTable = document.getElementById("ListTable").getElementsByTagName("tbody")[0];

function ReloadCart() {
	var e = new XMLHttpRequest();
	e.onreadystatechange = function() {
		if(e.readyState == 4 && e.status == 200) {
			ListTable.innerHTML = "";
			var data = JSON.parse(e.responseText);
			if(data[0]) {
				for(var i = 1; i < data.length; i++) {
					var tableRow = document.createElement("tr");
					
					var ProductName = document.createElement("td");
					var ProductPrice = document.createElement("td");
					var ProductQty = document.createElement("td");
					
					var Add = document.createElement("td");
					var Subtract = document.createElement("td");
					var Delete = document.createElement("td");
					
					ProductName.innerHTML = data[i]["PRODUCT_NAME"];
					ProductPrice.innerHTML = data[i]["PRODUCT_PRICE"];
					ProductQty.innerHTML = data[i]["PRODUCT_QTY"];
					
					var t = document.createElement("a");
					t.setAttribute("href", "javascript:void(0)");
					t.setAttribute("onclick", "PlusOne(" + data[i]["PRODUCT_ID"] + ")");
					t.innerHTML = "+";
					
					Add.appendChild(t);
					
					var t = document.createElement("a");
					t.setAttribute("href", "javascript:void(0)");
					t.setAttribute("onclick", "SubtractOne(" + data[i]["PRODUCT_ID"] + ")");
					t.innerHTML = "-";
					
					Subtract.appendChild(t);
					
					var t = document.createElement("a");
					t.setAttribute("href", "javascript:void(0)");
					t.setAttribute("onclick", "DeleteFromCart(" + data[i]["PRODUCT_ID"] + ")");
					t.innerHTML = "Remove";
					
					Delete.appendChild(t);
					
					tableRow.appendChild(ProductName);
					tableRow.appendChild(ProductPrice);
					tableRow.appendChild(ProductQty);
					tableRow.appendChild(Add);
					tableRow.appendChild(Subtract);
					tableRow.appendChild(Delete);
					
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
			
			ReloadCart();
		}
	}
	
	e.open("GET", "?mod=mod_cart_view&view=add&id=" + pid + "&qty=1", true);
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
			
			ReloadCart();
		}
	}
	
	e.open("GET", "?mod=mod_cart_view&view=add&id=" + pid + "&qty=-1", true);
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
			
			ReloadCart();
		}
	}
	
	e.open("GET", "?mod=mod_cart_view&view=del&id=" + pid, true);
	e.send();
}

function ClearCart() {
	var e = new XMLHttpRequest();
	e.onreadystatechange = function() {
		if(e.readyState == 4 && e.status == 200) {
			var data = JSON.parse(e.responseText);
			
			if(data["success"] == false) {
				alert("ACTION FAILED !");
			}
			
			ReloadCart();
		}
	}
	
	e.open("GET", "?mod=mod_cart_view&view=clear", true);
	e.send();
}