<?
	if($_SERVER["REQUEST_METHOD"] == "GET"){
		$prod_id = $_GET['prod_ID'];
		$conn = new mysqli("localhost", "root", "root","petshop") or die("Connection failed: %s\n". $conn -> error);
		
		if(!$conn)
			echo "Database connection failed!";
		else{
			$deleted_val = 1;
			$sql = "UPDATE product	SET Deleted_Flag = '$deleted_val'	WHERE Product_ID='$prod_id'";			
			$result = mysqli_query($conn, $sql);
			if (!$result)
				echo "Deletion failed";
			else{
				echo "Deletion sucess";
			}
		}
		mysqli_close($conn);
	}
?>