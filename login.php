<!DOCTYPE html>
<html>
<body>
<?
	session_start();
	
	if($_SERVER['REQUEST_METHOD'] =='POST'){
		$email = test_input($_POST['email']);
		$pass = test_input($_POST['pass']);
		if(test_email($email)&&test_pass($pass)){
			if(login($email, $pass)){
				echo "login successful!<br>Redirecting..";
				$_SESSION['login'] = true;
				header('Refresh: 4;URL=home.php');
			}
			else 
				login_failed();
		}
		else
			login_failed();
	}
	
	function test_input($data){
		$data=trim($data);
		$data=stripslashes($data);
		$data=htmlspecialchars($data);
		return $data;
	}
	
	function test_email($email){
		if($email=="")
			return false;
		elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
			return false;
		return true;
	}
	
	function test_pass($pass){
		if($pass=="")
			return false;
		elseif(strlen($pass)<6)
			return false;
		return true;
	}
	
	function login_failed(){
		echo "Redirecting..";
		header('Refresh: 4;URL=login.html');
	}
	
	function login($email, $pass){
		$conn = new mysqli("localhost", "root", "root","petshop");
		
		if(!$conn){
			echo "Database connection failed!<br>";
			return false;
		}
		else{
			$password_encrypted = password_hash($pass, PASSWORD_BCRYPT);
			$success=false;
			
			$sql = "SELECT * FROM customer WHERE Email='$email'";
			$result = mysqli_query($conn, $sql);
			
			$sqladmin = "SELECT * FROM employee WHERE Email='$email'";
			$resultadmin = mysqli_query($conn, $sqladmin);
			
			if (mysqli_num_rows($result) == 0 && mysqli_num_rows($resultadmin) == 0){
				echo "Incorrect Email!<br>";
				return $success;
			}
			elseif (mysqli_num_rows($resultadmin) == 0){
				$row = $result->fetch_assoc();
				
				if(password_verify($pass, $row['Pwd'])){
					$success=true;
					$_SESSION["admin"] = false;
					$_SESSION["email"] = $row['Email'];
					$_SESSION["name"] = $row['Name'];
				}
				else
					echo "Incorrect password!<br>";
				
				mysqli_close($conn);
				return $success;
			}
			else{
				$row = $resultadmin->fetch_assoc();
				
				if(password_verify($pass, $row['Pwd'])){
					$success=true;
					$_SESSION["admin"] = true;
					$_SESSION["email"] = $row['Email'];
					$_SESSION["name"] = $row['Name'];
				}
				else
					echo "Incorrect password!<br>";
				
				mysqli_close($conn);
				return $success;
			}
		}
	}
	
?>
</body>
</html>