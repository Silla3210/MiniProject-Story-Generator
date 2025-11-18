<html>
    <head>
        <title>Register page</title>
        <body>
            <h2>Register</h2>
            <form method="post" action="register.php">
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" required><br>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required><br><br>
                <input type="submit" name="register" value="Register">
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
                    max-width: 300px;
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
                div{

                    padding-left:590px;

                }
                
            </style>
        </body>
            </head> 
</html>

<?php
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new mysqli("localhost", "root", "", "miniproject");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "INSERT INTO login (username, password,utype) VALUES ('$username', '$password','user')";
    if ($conn->query($sql) === TRUE) {
        echo "<div>Registration successful. You can now <a href='login.php'>login</a>.</div>";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>