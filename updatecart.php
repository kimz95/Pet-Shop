<?
session_start();
	
if($_SERVER["REQUEST_METHOD"] =="GET"){
	$email = $_SESSION['email'];
	$prod_id = $_GET['prod_ID'];
	$quantity = (int)$_GET['quantity'];
	
	$conn = new mysqli("localhost", "root", "root","petshop") or die("Connection failed: %s\n". $conn -> error);
	
	if(!$conn)
		echo "Database connection failed!";
	else{
		
		$sql = "UPDATE order_item, contains, purchase SET Quantity = '$quantity' 
		WHERE order_item.Product_ID='$prod_id' AND order_item.Product_ID=contains.Product_ID AND contains.Order_ID=purchase.Order_ID AND purchase.Cust_email='$email'";
		$result = mysqli_query($conn, $sql);
		
		if(!$result){
			echo $conn -> error."\n";
			echo "Failed to update order item!\n";
		}
		else
			echo "Product Updated";
		
		mysqli_close($conn);
	}
}
?>