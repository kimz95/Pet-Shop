<!DOCTYPE HTML>

<html>

<head>
    <meta charset="utf-8">
    <title>Shopping cart</title>

	<link rel="stylesheet" href="css/cart.css"/>
	
	<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="js/cart.js"></script>
    
</head>

<body>
<div>
<?
session_start();
if(!$_SESSION['login']){
   header("location:login.html");
   die;
}

$conn = new mysqli("localhost", "root", "root","petshop");

if(!$conn){
	echo "Database connection failed!<br>";
	return false;
}
else{
	$email = $_SESSION['email'];
	$sql = "SELECT contains.Product_ID, product.Price, product.Name, order_item.Quantity  FROM order_item, contains, purchase, product 
	WHERE purchase.Cust_email='$email' AND purchase.Order_ID=contains.Order_ID AND contains.Product_ID=order_item.Product_ID AND order_item.Product_ID=product.Product_ID ";
	$result = mysqli_query($conn, $sql);
}

?>
    
</div>

<form name="ShoppingList">
    <fieldset>
        <legend>Shopping cart</legend>
		<? 	
		while ($row = $result->  fetch_assoc()) {
			echo "<fieldset>";
			echo "<legend>".$row['Name']."</legend>";
			echo "<div>";
			echo "<div>";
			echo "<label>Unit price: </label>";
			echo "<label>".$row['Price']."</label>";
			echo "</div>";
			
			echo "<div>";
			echo "<label>Quantity: </label>";
			echo "<input type='number' class='quantity' name='quantity' value ='".$row['Quantity']."'></input>";
			echo "<input class='updatebtn' id='".$row['Product_ID']."' type='button' value='Update'>";
			echo "<input class='deletebtn' id='".$row['Product_ID']."' type='button' value='Remove'>";
			echo "</div>";
			
			echo "</div>";
			echo "</fieldset>";
		}
		?>
    </fieldset>
</form>
</body>
</html>