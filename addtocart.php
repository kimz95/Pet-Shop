
<?
	function create_order($conn, $email){
		$status = "New";
		$sql = "SELECT * FROM purchase WHERE Cust_email='$email' AND Order_Status='$status'";
		$result= mysqli_query($conn, $sql);
		
		if (mysqli_num_rows($result) == 0){
			$sql = "INSERT INTO purchase (Order_Status, Cust_email) VALUES ('$status', '$email')";
			$result= mysqli_query($conn, $sql);
			
			$sql = "SELECT * FROM purchase WHERE Cust_email='$email' AND Order_Status='$status'";
			$result= mysqli_query($conn, $sql);
			$row = $result->fetch_assoc();
			
			if(!$result)
				echo "Failed to update order!<br>";
			else
				return $row['Order_ID'];
		}
		else{
			$row = $result->fetch_assoc();
			
			return $row['Order_ID'];
			
		}
	}
	
	function add_order_item($conn, $order_id, $prod_id){
		$sql = "SELECT * FROM order_item WHERE Product_ID='$prod_id'";
		
		$result= mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) == 0){
			$quan = 1;
			
			$sql = "SELECT Price FROM product WHERE Product_ID='$prod_id'";
			$result = mysqli_query($conn, $sql);
			$row = $result->fetch_assoc();
			$price = $row['Price'];
			
			$sql = "INSERT INTO order_item (Product_ID, Quantity, Price) VALUES ('$prod_id', '$quan', '$price')";
			$result= mysqli_query($conn, $sql);
			
			if(!$result){
				echo $conn -> error."\n";
				echo "Failed to update order item!\n";
			}
		}else{
			$incr = 1;
			$sql = "UPDATE order_item, contains SET Quantity = Quantity + '$incr' 
			WHERE order_item.Product_ID='$prod_id' AND order_item.Product_ID=contains.Product_ID AND contains.Order_ID='$order_id'";
			$result= mysqli_query($conn, $sql);
			
			if(!$result){
				echo $conn -> error."\n";
				echo "Failed to update item quantity!\n";
			}
		}
		
		
		
		$sql = "SELECT * FROM contains WHERE Order_ID='$order_id' AND Product_ID='$prod_id'";
		
		$result= mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) == 0){
			$sql = "INSERT INTO contains (Order_ID, Product_ID) VALUES ('$order_id', '$prod_id')";
			$result= mysqli_query($conn, $sql);
			
			if(!$result){
				echo $conn -> error."\n";
				echo "Failed to update cart!\n";
			}
		}
	}
	
	
	session_start();
	
	if($_SERVER["REQUEST_METHOD"] =="GET"){
		$email = $_SESSION['email'];
		$prod_id = $_GET['prod_ID'];
		$conn = new mysqli("localhost", "root", "root","petshop") or die("Connection failed: %s\n". $conn -> error);
		
		if(!$conn)
			echo "Database connection failed!";
		else{
			
			$order_id = create_order($conn, $email);
			
			add_order_item($conn, $order_id, $prod_id);
			
			mysqli_close($conn);
			echo "Added to cart";
		}
	}

?>
