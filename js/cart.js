$(document).ready(function() {
	$('.updatebtn').click(function(){
		var xhttp = new XMLHttpRequest();
		
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				alert(this.responseText);
			}
		};
		$newQuantity = $(this).siblings(".quantity").val();
		
		xhttp.open("GET", "updatecart.php?prod_ID=" + this.id + "&quantity=" + $newQuantity, true);
		xhttp.send();
	});
	
	$('.deletebtn').click(function(){
		var xhttp = new XMLHttpRequest();
		
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				alert(this.responseText);
				location.reload();
			}
		};
		$newQuantity = $(this).siblings(".quantity").val();
		
		xhttp.open("GET", "removefromcart.php?prod_ID=" + this.id, true);
		xhttp.send();
	});
});

