<html>
    <head> </head>
        <body>
<a href="login.php" style="float:right; margin:20px; text-decoration:none; color:white; font-size:18px;"><button><i class="fa-solid fa-right-to-bracket">Logout </i></button></a>
   
<form align="center" method="post" action="admin_dashboard.php">
        
        <label for ="title">Title:</label>
        <input type="text" id="title" name="title" required><br>

        <label for="genre">Genre:</label>
        <select id="genre" name="genre">
            <option value="fantasy">Fantasy</option>
            <option value="mystery">Mystery</option>
            <option value="romance">Romance</option>
            <option value="sci-fi">Sci-Fi</option>
        </select><br><br>

       
        <label for="gender">Gender:</label>
        <input type="text" id="gender" name="gender" placeholder="male/female" required><br><br>
        <label for="story">Story:</label><br>
        <textarea id="story" name="story" rows="10" cols="50" placeholder="replace character name with {name}" required></textarea><br><br>

        <input type="submit" name="submit" value="Submit Story">
    </form>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ddd3dbff;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
        }
        form {
            background-color: #ab8c9eff;
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"], textarea, select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #22697eff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #359ca5ff;
        }

     </style>

    <?php
    if (isset($_POST["submit"])) {
        $title = $_POST['title'];
        $story = $_POST['story'];
        $genre = $_POST['genre'];
        $gender = $_POST['gender'];
        
        $conn = new mysqli("localhost", "root", "", "miniproject");

        if ($conn->connect_error) {
            echo "<p>Connection failed: " . $conn->connect_error . "</p>";
        } else {
            $story = mysqli_real_escape_string($conn, $_POST['story']);


           $query = "INSERT INTO story_parts (title,content, genre, gender) VALUES ('$title','$story', '$genre', '$gender')";
         //  echo $query;
           if ($conn->query($query) === TRUE) {
            echo "<p style='color:green; text-align:center;'>Story uploaded successfully!</p>";
        } else {
            echo "<p style='color:red; text-align:center;'>Error: " . $query . "<br>" . $conn->error . "</p>";
        }
    }
}
    ?>
    </body>

</html>
