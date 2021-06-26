<?php
   // Initialize the session
   session_start();
    
   // Check if the user is already logged in, if yes then redirect him to welcome page
   if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
       header("location: ./panel/main.php");
       exit;
   }
    
   // Include config file
   require_once "./requires/config.php";
    
   // Define variables and initialize with empty values
   $username = $password = "";
   $username_err = $password_err = $login_err = "";
    
   // Processing form data when form is submitted
   if($_SERVER["REQUEST_METHOD"] == "POST"){
    
       // Check if username is empty
       if(empty(trim($_POST["username"]))){
           $username_err = "Please enter username.";
       } else{
           $username = trim($_POST["username"]);
       }
       
       // Check if password is empty
       if(empty(trim($_POST["password"]))){
           $password_err = "Please enter your password.";
       } else{
           $password = trim($_POST["password"]);
       }
       
       // Validate credentials
       if(empty($username_err) && empty($password_err)){
           // Prepare a select statement
           $sql = "SELECT id, username, password FROM users WHERE username = ?";
           
           if($stmt = mysqli_prepare($link, $sql)){
               // Bind variables to the prepared statement as parameters
               mysqli_stmt_bind_param($stmt, "s", $param_username);
               
               // Set parameters
               $param_username = $username;
               
               // Attempt to execute the prepared statement
               if(mysqli_stmt_execute($stmt)){
                   // Store result
                   mysqli_stmt_store_result($stmt);
                   
                   // Check if username exists, if yes then verify password
                   if(mysqli_stmt_num_rows($stmt) == 1){                    
                       // Bind result variables
                       mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                       if(mysqli_stmt_fetch($stmt)){
                           if(password_verify($password, $hashed_password)){
                               // Password is correct, so start a new session
                               session_start();
                               
                               // Store data in session variables
                               $_SESSION["loggedin"] = true;
                               $_SESSION["id"] = $id;
                               $_SESSION["username"] = $username;                            
                               
                               // Redirect user to welcome page
                               header("location: ./panel/main.php");
                           } else{
                               // Password is not valid, display a generic error message
                               $login_err = "Invalid username or password.";
                           }
                       }
                   } else{
                       // Username doesn't exist, display a generic error message
                       $login_err = "Invalid username or password.";
                   }
               } else{
                   echo "Oops! Something went wrong. Please try again later.";
               }
   
               // Close statement
               mysqli_stmt_close($stmt);
           }
       }
       
       // Close connection
       mysqli_close($link);
   }
 ?>
 
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>َVultric Panel - Login</title>
      <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="apple-touch-icon" sizes="180x180" href="../assets/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicons/favicon-16x16.png">
        <link rel="manifest" href="../assets/favicons/site.webmanifest">
        <link rel="mask-icon" href="../assets/favicons/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#2d89ef">
        <meta name="theme-color" content="#ffffff">
   </head>
   <body>
      <form class="box" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" data-dashlane-rid="c1b5f0374d0a71bf" data-form-type="login">
          <img src="../assets/images/vultric.png" alt="HTML" width="350" height="100">
         <h1>Login</h1>
         <div class="form-group">
            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
            <span class="invalid-feedback"><?php echo $username_err; ?></span>
         </div>
         <div class="form-group">
            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
         </div>
         <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login">
         </div>
      </form>
   </body>
</html>