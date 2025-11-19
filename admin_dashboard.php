<html>
    <head> </head>
        <body>
<a href="login.php" style="float:right; margin:20px; text-decoration:none; color:white; font-size:18px;"><button><i class="fa-solid fa-right-to-bracket">Logout </i></button></a>
   <div style="padding-top: 50px;"> <form align="center" method="post" action="admin_dashboard.php">
        
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
</div>

   <div style="padding-top: 50px;"> <form class="b1" action="admin_dashboard.php" method="post">
        <input type="submit" name="Recent_Stories" value="Recently submitted stories">
</form>
</div>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ddd3dbff;
            margin:auto;
            padding: 0;
        }
        h2 {
            text-align: center;
        }
        .story_card{
              width:1000px;
              justify:center;
              padding:10px;
              background-color:white;
              border-radius:30px;
        }

        form {
            background-color: #ab8c9eff;
            max-width: 600px;
            margin:auto ;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .b1{
            width: 200px;
            background-color: white;
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


           $query = "INSERT INTO story_parts (Title,content, genre, gender) VALUES ('$title','$story', '$genre', '$gender')";
         //  echo $query;
           if ($conn->query($query) === TRUE) {
            echo "<p style='color:green; text-align:center;'>Story uploaded successfully!</p>";
        } else {
            echo "<p style='color:red; text-align:center;'>Error: " . $query . "<br>" . $conn->error . "</p>";
        }
    }
}
if(isset($_POST['Recent_Stories'])){
   $conn=new mysqli("localhost","root","","miniproject");
    if ($conn->connect_error) {
            echo "<p>Connection failed: " . $conn->connect_error . "</p>";
        } else{
            $query="select * from story_parts order by id desc limit 5";
            
            $result1=$conn->query($query);
            if($result1->num_rows > 0)
            {
                while ( $row=$result1->fetch_assoc())
                {
                    ?>
                  <div style="padding-left:300px; padding-top:30px; padding-bottom:30px;">  <div class="story_card"><h4> <?php echo $row['Title'];?></h4><p><?php echo $row['content'];?></p></div>
                </div>
                    <?php
                }
            }
        }

}
    
    ?>
    </body>

</html>
