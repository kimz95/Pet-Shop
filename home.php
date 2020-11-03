<!DOCTYPE HTML>

<?
session_start();
if(!$_SESSION['login']){
   header("location:login.html");
   die;
}
if($_SESSION['admin']){
	$deleteDisplay= "block";
}
else{
	$deleteDisplay= "none";
}

?>

<html>

<head>
    <meta charset="utf-8">
    <title>PetShop</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  
    
    <link rel="stylesheet" href="css/home/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/home/bootstrap-theme.css"/>
	<link rel="stylesheet" href="css/home/gallery.css"/>
    
	<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="js/home.js"></script>
	
	<style>
		.deletebtn{
			color: red;
			display: <?=$deleteDisplay?>;
		}
		
		.updatebtn{
			text-align: center;
			font-size: 12px;
			border-radius:2px;
			display: <?=$deleteDisplay?>;
		}
		
		.priceField{
			width:100px;
		}

	</style>
	
</head>

<body>
    <header>
        <div class="topHeaderRow">
            <div class="container">
                <div class="pull-right">
                    <ul class="list-inline">
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
						<li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end topHeaderRow -->

        <nav class="navbar navbar-default ">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <p class="navbar-brand">Welcome to PetShop</p>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-left">
                        <li><a href="home.php">Home</a></li>
                    </ul>


                    <form class="navbar-form navbar-right" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <!-- /.navbar-collapse -->


            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>
    


    <!-- Page Content -->
    <main class="container">     

		<ul class="gallery">        
      	</ul>
    </main>
    
      
</body>

</html>