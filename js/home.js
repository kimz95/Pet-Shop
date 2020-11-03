function add_product($prod_name, $prod_price, $prod_img, $prod_id) {
	$list_item = "<li>";
	$list_item += "<img class=smallimg src= \"images/square/"+ $prod_img+"\" alt=\"" + $prod_name + "\" >";
	$list_item += "<h5>" + $prod_name + "<a class='pull-right deletebtn' id='" + $prod_id + "'><span class='glyphicon glyphicon-remove'></span></a></h5>";
	$list_item += "<label class='priceField'>$"+$prod_price+"<a class='pull-right addtocart' id='" + $prod_id + "'><span class='glyphicon glyphicon-shopping-cart'></span></a></label>";
	$list_item += "<button class='updatebtn'>Update price</button>";
	$list_item += "</li>";
	$(".gallery").append($list_item);
	
	
	$(".gallery li .smallimg").last().mouseenter(function(event){
		$(this).addClass("gray");
		mydiv = $("<div id=“preview”><img src=\"images/medium/" + $prod_img + "\">" + "</p></div>");
		mydiv.css("position","absolute"); 
		mydiv.css("left",event.pageX + 5);
		mydiv.css("top",event.pageY + 5);
		mydiv.css("color","white");
		$("body").append(mydiv);
	});
	
	$(".gallery li .smallimg").last().mouseleave(function(event){
		$(this).removeClass("gray");
		$("#“preview”").remove();
	});
	
	$(".gallery li .smallimg").last().mousemove(function(event){
		$("#“preview”").css("left",event.pageX+4);
		$("#“preview”").css("top",event.pageY+4);
	});
	
	//Customer adds product to cart
	$(".gallery li .addtocart").last().click(function(){
		var xhttp2 = new XMLHttpRequest();
		
		xhttp2.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				alert("Item added to cart");
			}
		};
		xhttp2.open("GET", "addtocart.php?prod_ID=" + this.id, true);
		xhttp2.send();
	});
	
	//Admin deletes product
	$('.deletebtn').last().click(function(){
		var xhttp3 = new XMLHttpRequest();
		
		xhttp3.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				alert(this.responseText);
				location.reload();
			}
		};
		xhttp3.open("GET", "removeProduct.php?prod_ID=" + this.id, true);
		xhttp3.send();
	});
	
}
	
	
function load_products(){
	var xhttp = new XMLHttpRequest();
	
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			parser = new DOMParser();
			xmlDoc = parser.parseFromString(this.responseText,"text/xml");
			
			a = xmlDoc.getElementsByTagName('name');
			b = xmlDoc.getElementsByTagName('price');
			c = xmlDoc.getElementsByTagName('img_file');
			d = xmlDoc.getElementsByTagName('prod_id');
			e = xmlDoc.getElementsByTagName('deleted');
			
			for (i = 0; i < a.length; i++) {
				$prod_deleted = Boolean(Number(e[i].childNodes[0].nodeValue));
				if(!$prod_deleted){
					$prod_name = a[i].childNodes[0].nodeValue;
					$prod_price = b[i].childNodes[0].nodeValue;
					$prod_img = c[i].childNodes[0].nodeValue;
					$prod_id = d[i].childNodes[0].nodeValue;
					add_product($prod_name, $prod_price, $prod_img, $prod_id);
				}
			}
		}
	};
	
	xhttp.open("GET","load_Products.php",true);
	xhttp.send();	
}

$(document).ready(function() {
	
	load_products();
	
	//var $name = $('#search').val();
	//var $price = $('#price').val();
	
	
});

