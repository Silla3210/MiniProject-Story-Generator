<html>
    <head>
        <title>Login Page</title>
        <body>
            <h2>Login</h2>
            <form method="post" action="login.php">
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" required><br>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required><br><br>
                <input type="submit"  name="Submit" value="Login"><br><br>
      <a href="register.php">New User? Register Here</a>
</form>
            <style>
                body {
                     background-image: url('download .jpg');
                    font-family: Arial, sans-serif;
                    background-color: #f2f2f2;
                    margin: 0;
                    padding: 0;
                }
                h2 {
                    text-align: center;
                }
                form {
                  
                    background-color: #ffffff;
                    max-width: 400px;
                    margin: auto;
                    padding: 20px;
                    border-radius: 5px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                input[type="text"], input[type="password"] {
                    width: 100%;
                    padding: 10px;
                    margin: 5px 0 15px 0;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                }
                input[type="submit"] {
                    width: 100%;
                    background-color: #B9AEDC;
                    color: white;
                    padding: 10px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                }
                input[type="submit"]:hover {
                    background-color: #B9AEDC;
                }
                a{
                    padding-left: 70px;

                }
</style>
        </body>
            </head>
</html>

<?php

 if (isset($_POST['Submit'])) {
    $uname = $_REQUEST['username'];
    $pwd = $_REQUEST['password'];
    $conn = new mysqli("localhost", "root", "", "miniproject");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM login WHERE username='$uname' AND password='$pwd'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $ran=$result->fetch_assoc();
        $role=$ran['utype'];
        if($role=="admin"){
            header("Location: admin_dashboard.php");
        }
        else if($role=="user"){
            header("Location: s1.php");

        }} else {
        echo "<script>alert('Invalid username or password'); window.location.href='login.php';</script>";

    }
    }

 
?>
