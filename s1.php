<html>
<head>
    <title>Story Generator</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
          background-image: url('hope.jpg');
        }

        h1 {
          color: black;
          text-align: center;
        }

        h2 {
            color: white;
            text-align: center;
        }
        h2:hover {
            color: white;
        }
        a{
                text-decoration: none;
                color: white;
            }
        .hi{
            background-color: #3947dbff;
            color: white;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
            font-size: 18px;
            margin: 10px;
        }

        h3 {
          font-family: arial;
          font-size: 20px;
          text-align: center;
        }
        p {
            font-family:'Times New Roman', Times, serif;
            font-size: 18px;
            text-align: center;
        }
    </style>
</head>
<body>
    <a href="login.php" style="float:right; margin:20px; text-decoration:none; color:white; font-size:18px;">Logout <i class="fa-solid fa-right-to-bracket"></i></a>
    <br><br>
    <h2>Generate your own story <i class="fa-solid fa-pencil"></i></h2>
    <br><br>

    <form align="center" method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="genre">Genre:</label>
        <select id="genre" name="genre">
            <option value="fantasy">Fantasy</option>
            <option value="mystery">Mystery</option>
            <option value="romance">Romance</option>
            <option value="sci-fi">Sci-Fi</option>
        </select><br><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="gender">Gender:</label>
        <input type="text" id="gender" name="gender" placeholder="male/female" required><br><br>

        <input type="submit" name="submit" value="Generate Story">
    </form>

    <?php
    if (isset($_POST["submit"])) {
        $title = $_POST['title'];
        $name = $_POST['name'];
        $genre = $_POST['genre'];
        $gender = $_POST['gender'];
        
        $conn = new mysqli("localhost", "root", "", "miniproject");

        if ($conn->connect_error) {
            echo "<p>Connection failed: " . $conn->connect_error . "</p>";
        } else {
           
            $query = "SELECT * FROM story_parts WHERE genre= '$genre' AND gender= '$gender' order by RAND() LIMIT 1";
            $result = $conn->query($query);         
            $query1 = "SELECT * FROM user_stories WHERE genre='$genre' AND gender='$gender' order by RAND() LIMIT 1";
           $result1 = $conn->query($query1); 
    ?>
    <table align="center" >
                <tr>
                    <td>
                        <h3>Generated Stories....</h3>
                    </td>
                </tr>
                
                 <?php
                if($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) 
                { 
                    $id=$row['id'];
                    
                ?>
                <tr>
                   <td><div class="hi"><a href="view_story.php?sid=<?php echo $id ?>&title=<?php echo $title ?> &name=<?php echo $name?>" ><?php echo $title;?></a></div></td>    
                </tr>

                <?php
                //$result->next();
                }   
                }
                 
                 ?>
                  <?php
                 if($result1->num_rows > 0) 
                { 
                 while ($row = $result1->fetch_assoc()) 
                 { 
                    $id=$row['id'];
                    
                 ?>

                 <tr>

                 <td>
                    Story from other users: </td>   
                 </tr>
                 <tr>
                     <td>
                      <div class="hi"><a href="view_story.php?sid=<?php echo $id ?>&title=<?php echo $title ?> &name=<?php echo $name?>" ><?php echo $title;?></a></div></td>   
                 </tr> 

                 <?php
                 //$result->next();
                 }   
                 }
                  ?>
    </table>
<?php
                }
        }
    
           ?>
</body>
</html>