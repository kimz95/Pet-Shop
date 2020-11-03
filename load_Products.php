<?
	if($_SERVER["REQUEST_METHOD"] == "GET"){
		$conn = new mysqli("localhost", "root", "root","petshop") or die("Connection failed: %s\n". $conn -> error);
		//$name = $_GET["name"];
		//$price = $_GET["price"];
		
		if(!$conn)
			echo "Database connection failed!";
		else{
			$sql = "SELECT * FROM product ORDER BY name";
		}
		
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) == 0)
			echo "No products found";
		else{
			echo "<products>";
			while ($row = $result->fetch_assoc()){
				echo "<product>";
				echo "<name>".$row['Name']."</name>";
				echo "<price>".$row['Price']."</price>";
				echo "<img_file>".$row['Img_File']."</img_file>";
				echo "<prod_id>".$row['Product_ID']."</prod_id>";
				echo "<deleted>".$row['Deleted_Flag']."</deleted>";
				echo "</product>";
			}
			echo "</products>";
		}
		mysqli_close($conn);
	}
?>