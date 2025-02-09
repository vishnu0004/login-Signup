<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Form</title>
    <link rel="stylesheet" href="../css/signup.css">
</head>

<body>
    <div class="form-container">
        <h2>Register</h2>
        <?php
        include('../config/conn.php');
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $con_password = $_POST['con_password'];
            if ($password == $con_password) {
                $hash = password_hash($password, PASSWORD_BCRYPT);

                //check email are already exists
                $check = "SELECT * FROM `user` WHERE email = '$email'";
                $run = $conn->query($check);
                if ($run->num_rows > 0) {
                    echo "email are already exists";
                } else {
                    $sql = "INSERT INTO `user`(`name`, `email`, `password`) values('$name','$email','$hash')";
                    $result = $conn->query($sql);
                    if ($result) {
                        echo "data are inserted";
                    } else {
                        echo "something wrongs";
                    }
                }
            }
            else{
                echo "password or conform password are decant matched ";
            }
        }
        ?>
        <form action="#" method="post">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter password" required>

            <label for="con_password">Confirm Password</label>
            <input type="password" id="con_password" name="con_password" placeholder="Confirm password" required>

            <button type="submit" class="btn" name="submit">Register</button>
            <p>Don't have an account? <a href="login.php">Login here</a></p>
        </form>
    </div>
</body>

</html>