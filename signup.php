<!DOCTYPE HTML>
<html>
<head>
<meta name = "viewport" width ="device-width, initial scale = 1.0">
	
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	
    
	<link rel="stylesheet" type="text/css" href="main3.css" />
	
<link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,700' rel='stylesheet' type='text/css'>

<?php
 
//register.php
 
/**
 * Start the session.
 */
session_start();
 require'connect.php';
 
/**
 * Include ircmaxell's password_compat library.
 */

/**
 * Include our MySQL connection.
 */

    
 
 
//If the POST var "register" exists (our submit button), then we can
//assume that the user has submitted the registration form.
    // define variables and set to empty values
$fnameErr=$lnameErr= $nameErr=$nameErr2  = $emailErr = $passErr = $passErr2 =$passErr3 = $passErr3=$tickErr = "";
$username = $email = $password = "";
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if (empty($_POST["username"])) {
      
        $nameErr= "Username is required";
        echo"<p class = 'error'> $nameErr </p>"; 
      
   } else {
     $username = test_input($_POST['username']);
     
   }
    
  if (empty($_POST['password'])) {
    $passErr= ' Password is required !';
    echo"<p class = 'error'> $passErr </p>"; 
   } 
   else {
    
    if(strlen(trim($_POST["password"])) < 6){
        $passErr2 = "Password must have atleast 6 characters.";
         echo"<p class = 'error'> $passErr2 </p>";
    }
    else{
       $pass = test_input($_POST['password']);
     }
    
      
    } 
    
    if(empty($_POST['password2'])){
     $passErr3 = ' second Password is required !';
     echo"<p class = 'error4'> $passErr3 </p>";
    }
    else{
       $pass2 = test_input($_POST['password2']);  
    }

    $pass = test_input($_POST['password']);
    $pass2 = test_input($_POST['password2']); 
    if($pass!=$pass2){
       $passErr4 = 'passwords do not match';
       echo"<p class = 'error5'> $passErr4 </p>";
    }
    else{
          $password = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));  
        }
    
    if (empty($_POST["email"])) {
     $emailErr=  "Email is required";
        echo"<p class = 'error6'> $emailErr </p>";
   } else {
     
     // check if e-mail address is well-formed
     
         $email = test_input($_POST["email"]);
          
         
     
   }
    
   if (empty($_POST["tick"])) {
      $tickErr = "please tick the box";
         echo"<p class = 'error8'> $tickErr </p>"; 
       
   }
      
    else {
       $tick = $_POST['tick'];
   }
    
     if(empty($emailErr) && empty($passErr) && empty($passErr2)&& empty($passErr3)&& empty($passErr4)){
    
    $sql = "SELECT COUNT(username) AS num FROM crudentials WHERE username = :username ";
    $stmt = $pdo->prepare($sql);
    
    //Bind the provided username to our prepared statement.
    $stmt->bindValue(':username', $username);
    
    //Execute.
    $stmt->execute();
    
    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If the provided username already exists - display error.
    //TO ADD - Your own method of handling this error. For example purposes,
    //I'm just going to kill the script completely, as error handling is outside
    //the scope of this tutorial.
    $sql = "SELECT COUNT(email) AS num2 FROM crudentials WHERE  email = :email";
    $stmt = $pdo->prepare($sql);
    
    //Bind the provided username to our prepared statement.
   
    $stmt->bindValue(':email', $email);
    //Execute.
    $stmt->execute();
    
    //Fetch the row.
    $row2 = $stmt->fetch(PDO::FETCH_ASSOC);
       
    if($row['num']==0 && $row2['num2']==0){
            //Prepare our INSERT statement.
    $result = $stmt->execute();
    $image = "Nil";
    $balance=0;
    $win=0;
    $draw=0;
    $loss=0;
    $games =0;
        
    //Remember: We are inserting a new row into our users table.
    $sql = "INSERT INTO user (username,email,password,balance,) VALUES (:username,:email, :password,:balance)";
        
    $stmt = $pdo->prepare($sql);   
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);
    //Execute the statement and insert the new account.
    $stmt->bindValue(':balance', $balance);

    $result = $stmt->execute();
        
            
    
    //If the signup process is successful.
    if($result){
        //What you do here is up to you!
        echo '<p2>Thank you for registering with our website.</p2>';
    }
    

   
     
  
      
   
        
        
    }
       
         
    else{
        if ($row['num']== 0 &&$row2['num2']>0){
           $nameErr2= 'email already registered!';
         echo"<p class = 'error9'> $nameErr2 </p>";  
        }
        elseif($row['num']> 0 &&$row2['num2']==0){
            $nameErr2= 'Username already taken!';
         echo"<p class = 'error9'> $nameErr2 </p>"; 
   }
      
    }
   
    } 
    
    //Construct the SQL statement and prepare it.
  
   
    }
   
    
    
    
    
 
?>

	
	
<title> Ruffles</title>
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

<center><h1>Sign Up</h1></center>
</div>




<form class = "sign-up"id= "sign-up " action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
	
  
    
	<input class="formfield" textarea class="detail-box" type="text" id="username" name="username" size="40" placeholder="Username"  /></center></p>
    
	
    
    
	<input class="formfield" textarea class="detail-box" type="email" id="email" name="email" size="40" maxlength = '25' placeholder="Email"  /></center></p>
	
  
	<input class="formfield" textarea class="detail-box" type="password" id="password" name="password" size="40" maxlength = '25' placeholder="Password"   /></center></p>
	<span class = "error">
    
   
	<input class="formfield" textarea class="detail-box" type="password" id="password2" name="password2" size="40" maxlength = '25' placeholder="Re-enter Password"   /></center></p>
	



	<input type="checkbox" name="tick" id="tick" class="tick" I AM OVER 18 YEARS OF AGE AND I AGREE TO THE <a href="terms.html">TERMS OF USE</a>
	<input type="hidden" name="form_submitted" value="1"
	
	
	<div class = 'form-sub'>
	
	<center><input type = "submit" class = 'btn-1' id = 'btn-1' type = 'button-1'></center>
	<center><p class = "word">
Join gamers from around the World!!! </p></center>
	</div>

	</form>
</div>
</div>
<div class = "col-4">
</div>
</div>
</div>


</body>
</html>