
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>
        <?php
        session_start();
    include('../config/conn.php');
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
         $sql = "select * from user where email = '$email'";
         $result = $conn->query($sql);
         if(mysqli_num_rows($result) > 0 ){
            echo "login to home page ";
            // header("refresh:1; url=home.php");

            $row = $result->fetch_assoc();
            if(password_verify($password, $row['password'])){
                $_SESSION['password'] = $row['name'];
            }else{
                echo "error";
            }
         }
         else{
            echo "somethings wrong";
         }
    }
    ?>
        <form action="login.php" method="post">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <button type="submit" class="btn" name="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Register here</a></p>
    </div>
</body>
</html>
