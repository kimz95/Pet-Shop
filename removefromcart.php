<?
session_start();
	
if($_SERVER["REQUEST_METHOD"] =="GET"){
	$email = $_SESSION['email'];
	$prod_id = $_GET['prod_ID'];
	
	$conn = new mysqli("localhost", "root", "root","petshop") or die("Connection failed: %s\n". $conn -> error);
	
	if(!$conn)
		echo "Database connection failed!";
	else{
		
		$sql = "DELETE FROM order_item
		WHERE order_item.Product_ID='$prod_id' AND order_item.Product_ID IN 
		(	SELECT contains.Product_ID
			FROM contains, purchase
			WHERE contains.Order_ID=purchase.Order_ID AND purchase.Cust_email='$email')";

		$result = mysqli_query($conn, $sql);
		
		if(!$result){
			echo $conn -> error."\n";
			echo "Failed to remove order item!\n";
		}
		else
			echo "Product Deleted";
		
		mysqli_close($conn);
	}
}
?>