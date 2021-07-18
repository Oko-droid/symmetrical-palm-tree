<?php 
    session_start();
    // connect to database
    $db = mysqli_connect("localhost", "root", "", "authentication");
    // the authentication will be used to create a folder in phpMyAdmin
    if (isset($POST['register_btn'])){
        session_start();
        $username = mysql_real_escape_string($_POST['username']);
        $email = mysql_real_escape_string($_POST['email']);
        $password = mysql_real_escape_string($_POST['password']);
        $password2 = mysql_real_escape_string($_POST['password2']);
        
        if ($password == $password2) {
            // create user
            $password = md5($password); //hash password before storing forsecurity purposes
            $sql = "INSERT INTO users(username, email, password) VAULES('$username', '$email', '$password')";
            mysql_query($db, $sql);
            $_SESSION['message'] = "You welcome";
            $_SESSION['username'] = "$username";
            header("location: home.php") //redirect to home page
        }else{
            // failed
            $_SESSION['message'] = "Your two password does not match";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registeration Form</title>
</head>
<body>
    <div class="header">
    <h1>Register Now</h1>
    </div>

    <form action="register.php" method="post">
        <div>
            <input type="text" name="username" id="username">
        </div>
        <div>
            <input type="email" name="email" id="email">
        </div>
        <div>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <input type="password" name="password2" id="password">            
        </div>
        <div>
            <input type="submit" name="register_btn" value="Register">
        </div>
    </form>
</body>
</html>