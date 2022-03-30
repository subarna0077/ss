<?php

/* TODO :
**-- Add a connection.php to connect php with mysql database
**-- Database :
            1. Id (Primary key && Auto increment)
            2. Username (**Must be unique id)
            3. Email (**Must be unique id)
            4. No need to add re email in DB
            5. Password (**No requirements)
-- Take inputs and filter the inputs using filter_var
-- Validate re-enter password and allow the data to pass to the database only if it matches with the previous email entered
*/

//Including connection.php

include "connection.php";

$email_error = "";

if(isset($_POST['send'])){

// Taking inputs
$user_name = FILTER_VAR($_POST['Username'],FILTER_SANITIZE_STRING);
$email = FILTER_VAR($_POST['Email'],FILTER_SANITIZE_EMAIL);
$re_email = FILTER_VAR($_POST['re_email'],FILTER_SANITIZE_EMAIL);
$pass = FILTER_VAR($_POST['pass'],FILTER_SANITIZE_STRING);

//Check if re-enterd email matches with the previous
$check = FALSE;

if(strcmp($email,$re_email) != 0){
  $email_error = "*Email doesnot match <br>";
}
else{
  $check = TRUE;
}

// Sending to database

if($check == TRUE){
  $sql = "INSERT INTO `User`(`Username`, `Email`, `Password`) VALUES ('$user_name','$email','$pass')";

  $result = $connection->query($sql);

  if($result == 1){
    echo "<script>
    window.location.href = 'login.php';
    </script>";
  }
  else{
    echo "<script>
    alert('The username or the email has already been used');
    </script>";
  }

}
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
      body {
        min-height: 100vh;
        position: relative;
        font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS",
          sans-serif;
      }
      .container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px,
          rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;
        padding: 15px;
        border: 1 px solid gainsboro;
      }
      header {
        display: flex;
        font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS",
          sans-serif;
        font-size: 30px;
        text-align: center;
      }
      .logo img {
        height: 50px;
      }
      .logo-text {
        height: 50px;
        margin: 10px 0px;
      }
      form {
        min-height: 50vh;
        display: flex;
        flex-direction: column;
      }

      input {
        min-width: 30vw;
        border: 1px solid gray;
        padding: 10px 30px;
        margin: 5px 0px;
        border: 2px solid rgb(116, 116, 212);
        border-radius: 15px;
        outline: none;
      }

      label {
        text-align: left;
        font-weight: lighter;
        font-size: larger;
      }

      .button-container {
        display: flex;
        justify-content: space-between;
      }
      #login-c {
        display: flex;
        flex-direction: column;
      }
      button {
        padding: 10px 5px;
      }

      .register {
        display: flex;
        flex-direction: column;
        margin-bottom: 5px;
        align-items: center;
        justify-content: center;
      }
      .register-btn {
        border: 2px solid black;
        background: white;
        padding: 6px 7px;
        font-size: 16px;
        transition: all 0.3s;
        cursor: pointer;
        margin-bottom: 8px;
      }
      .register-btn:hover {
        background: rgb(116, 116, 212);
        color: white;
      }
    </style>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
  </head>
  <body>
    <div class="container">
      <header>
        <div class="logo">
          <img src="/download.jpeg" alt="" />
        </div>
        <div class="logo-text">Rainchat</div>
      </header>

      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
        <label for="username"><b>Username</b></label>
        <br />
        <input type="text" placeholder="Username" name="Username" required>

        <label for="email"><b>Email</b></label>
        <br />
        <input type="text" placeholder="Email" name="Email" required>
        <label for="Re"><b>Re-enter email</b></label>
        <br />

        <input type="text" placeholder="Re" name="re_email" required>
        <p style = "color:red;"><?php echo $email_error;?></p>
        <label for="Pass"><b>Password</b></label>
        <br />
        <input type="password" placeholder="password" name="pass" required>
      <div class="register">
        <br><button class="register-btn" name="send">Register</button>
        <a href="login.php">Already have a account?</a>
      </div>
      </form>
    </div>
  </body>
</html>
