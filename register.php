<!DOCTYPE html>
<html>
<body>
<?
	session_start();
	
	if($_SERVER['REQUEST_METHOD'] =='POST'){
		$email = test_input($_POST['email']);
		$pass = test_input($_POST['pass']);
		$cnfpass = test_input($_POST['cnfpass']);
		$name = test_input($_POST['name']);
		$address = test_input($_POST['adr']);
		if(test_email($email)&&test_pass($pass)&&test_cnfpass($pass,$cnfpass)){
			if(create_user($email, $pass, $name, $address)){
				echo "Registration successful.<br>Please login using your new credentials.<br>Redirecting..";
				header('Refresh: 4;URL=login.html');
			}
			else
				registration_unsucessful();
		}
		else
			registration_unsucessful();
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
	
	function test_cnfpass($pass, $cnfpass){
		if(!test_pass($cnfpass))
			return false;
		elseif($pass!=$cnfpass)
			return false;
		return true;
	}
	
	function registration_unsucessful(){
		echo "Registration unsuccessful.<br> Redirecting..";
		header('Refresh: 4;URL=register.html');
	}
	
	function create_user($email, $pass, $name, $address){
		$conn = new mysqli("localhost", "root", "root","petshop");
		
		if(!$conn){
			echo "Database connection failed!<br>";
			return false;
		}
		else{
			$password_encrypted = password_hash($pass, PASSWORD_BCRYPT);
			$sql = "INSERT INTO customer (Email, Pwd, Name, Address) VALUES ('$email', '$password_encrypted', '$name', '$address')";
			if(mysqli_query($conn, $sql)){
				mysqli_close($conn);
				return true;
			}
			else{
				echo "Failed to create new account!<br>";
				mysqli_close($conn);
				return false;
			}
		}
	}
?>
</body>
</html>