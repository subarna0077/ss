<?php 

include "connection.php";


//filter inputs :
if(isset($_POST['send'])){
    $user_name = FILTER_VAR($_POST['Username'],FILTER_SANITIZE_STRING);
    $pass = FILTER_VAR($_POST['Pass'],FILTER_SANITIZE_STRING);
  
    
    //check details in DB
    $sql = "SELECT * FROM User WHERE Username = '$user_name'  AND Password = '$pass' ";
  
    $result = $connection->query($sql);
  
    if(mysqli_num_rows($result) === 1){
      session_start();
      //Loged in user :
      $_SESSION['user'] = FILTER_VAR($user_name,FILTER_SANITIZE_STRING);
      $_SESSION['loged'] = TRUE;
      
      
      //send user to home page
      echo "<script>
     location.href = 'home.php';
    </script>";
    }
    else{
      $message = "*Password not match";
    }
  }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login page-Rainchat</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-container">
      <header>
           
              <div class="logo">
                  <img src="/download.jpeg" alt="">
              </div>
              <div class="logo-text">Rainchat</div>  
            
        </header>


        <div class="welcome">Welcome to RainChat ✌️</div>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">

             <label for="username"><b>Username</b></label>
              <br>
            <input type="text" placeholder="Username" name="Username" required>

             <label for="Pass"><b>Password</b></label>
              <br>
            <input type="password" placeholder="password" name="Pass" required>
        <a href="">Forget your password?</a>
        <div class="login-btn">
            <button  name ="send" >Login</button>
        </div>
        <div class="register">
            <a href="register.php">Create new Account</a>
        </div>
        </form>
</div>
    
</body>
</html>

