<?php
session_start();
require 'connect.php';

//check if already logged in move to home page
//if logged in redirect to members page

?>


 
<!DOCTYPE HTML>
<html>
<head>
<meta name = "viewport" width ="device-width, initial scale = 1.0">
	
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" type="text/css" href="main3.css" />
    

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,700' rel='stylesheet' type='text/css'>
<title> Feedool</title>
</head>
<body>
<div class = "header-menu">
<div class ="pull-left">
<ul>
<li><a class="navigation" id = "home"  href="index.html">Home</a></li>
<li><a class="navigation" id = "tournaments" href="tournaments.html">Tournaments</a></li>
<li><a class="navigation" id = "rules" href="rules.html">Rules</a></li>
<li><a class="navigation" id = "faqs" href="index.html">FAQS</a></li>
</ul>
</div>
<div class = "pull-right">
<ul>
<li> <a class="navigation" id = "login" href="login.php">Log In </a></li>
<li><a class="navigation"  id = "signup" href="signup.php">Sign Up</a></li>
</ul>
</div>
<div class = "logo-header">
<a href = "index.html"><img src = "images/logo.png" ></a>
</div>
</div>

<div class = "row">
<div class = "col-4">
</div>
<div class = "col-4">
<div class = "login">
<div class = "header">
<center><h1> LOGIN</h1></center>
</div>
<?php



//If the POST var "login" exists (our submit button), then we can
//assume that the user has submitted the login form.
if($_SERVER["REQUEST_METHOD"] == "POST"){
	 $userErr="";
     $passwordErr="";
     $loginErr="";
	
    if (empty($_POST["username"])||empty($_POST["password"])) {
	     
	
			     $userErr =  "Please fill in a Username or Password";
				 echo "<span class ='error1'>$userErr</span>";
		 
    
	
    }
	
	else{
    //Retrieve the field values from our login form.
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;
    
    //Retrieve the user account information for the given username.
    $sql = "SELECT  * FROM crudentials WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    
    //Bind value.
    $stmt->bindValue(':username', $username);
    
    //Execute.
    $stmt->execute();
    
    //Fetch row.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If $row is FALSE.
   
   if($user  === false){
                  $userErr =  " Incorrect Username or Password";
				 echo "<span class ='error1'>$userErr</span>";
			
			
   }


		else{
        //User account found. Check to see if the given password matches the
        //password hash that we stored in our users table.
        
        //Compare the passwords.
        $validPassword = password_verify($passwordAttempt, $user['password']);
			if($validPassword){
            
            //Provide the user with a login session.
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['logged_in'] = time();
			$_SESSION['username'] = $username;
			$_SESSION['balance']=$user['balance'];
			$_SESSION['won']=$user['won'];
			$_SESSION['drawn']=$user['drawn'];
			$_SESSION['lost']=$user['lost'];
			$_SESSION['matches']=$user['matches'];
			$_SESSION['image']=$user['image'];
			 //Redirect to our protected page, which we called home.php
            header('Location: welcome.php');
            exit;
		    }
			else{
	          $userErr =  " Incorrect Username or Password";
			  echo "<span class ='error1'>$userErr</span>";
            }
	}
    } 

   
   
	
           
    
    }


?>
<form class = "sign-in"id= "sign-in "action="login.php" method="post">
	
	<p><center><p>Username</p><input class="formfield" textarea class="detail-box" type="text" id="username" name="username" size="40" maxlength = '25' placeholder="Username"/></center></p>
	
	<p><center><p>Password</p><input class="formfield" textarea class="detail-box" type="password" id="password" name="password" size="40" maxlength = '25' placeholder="Password"/></center></p>
	<div class = 'form-sub'>
	<center><button class = 'btn-1' id = 'btn-1' type = 'button-1'>Login</button></center>
	<center><p class = "word">
The Arena Awaits You!!!</p></center>
	</div>
	</form>
	
</div>
</div>

	
	
    





<div class = "col-4">
</div>
</div>
</div>
<script type ='text/javascript'src="js/jquery.js"></script>
    <script src="js/cycle.js"></script>	
	<script src="js/tv.js"></script>
	<script src="js/enlarger.js"></script>
	<script src="js/active.js"></script>
</body>
</html>