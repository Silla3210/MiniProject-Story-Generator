<html>
    <head>
        <title>View Story</title>
        <style>
            body {
                background-image: url('download .jpg');
            }
            h3 {
                font-family: arial;
                font-size: 20px;
                text-align: center;
                color: black;
            }
            p {
                font-family:'Times New Roman', Times, serif;
                font-size: 18px;
                text-align: center;
                color: black;
            }
            textarea {
                width: 80%;
                height: 300px;
            }
        </style>
<?php
$story_id=$_REQUEST['sid'];

        
        $conn = new mysqli("localhost", "root", "", "miniproject");

        if ($conn->connect_error) {
            echo "<p>Connection failed: " . $conn->connect_error . "</p>";
        } else {
           
            $query = "select * from user_stories where id=$story_id union select * from story_parts where id=$story_id";

            $result = $conn->query($query);         
          
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
                 $title = $row['title'];
                 $story = $row['story'];
                    $name = $row['name'];
                    $gender = $row['gender'];
                    $genre = $row['genre'];

                  }
   }
                                                                  
?>

 <?php  // $story = str_replace("{name}", $name, $row['content']);
                //echo "<center><div style='color:white; text-align:justify; margin:30px; font-size:20px; width:50%;'><h3>$title</h3><p>$story</p></div></center>";
                echo '<form method="post" style="text-align:center;">
                        <label for="story">Submit your edited story:</label><br>
                        <input type="hidden" name="title" value="'.$title.'">
                        <input type="hidden" name="name" value="'.$name.'">
                        <input type="hidden" name="gender" value="'.$gender.'">
                        <input type="hidden" name="genre" value="'.$genre.'">
                        <textarea name="story" rows="10" cols="80">'.$story.'</textarea><br>
                        <input type="submit" name="submit_story" value="Save Story">
                      </form>';

    
if (isset($_POST["submit_story"])) {
   
    $story = $_POST["story"]; 
    $title = $_POST["title"];
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $genre = $_POST["genre"];

    $conn = new mysqli("localhost", "root", "", "miniproject");

    if ($conn->connect_error) {
        echo "<p style='color:red; text-align:center;'>Connection failed: " . $conn->connect_error . "</p>";
    } else {
              $story = mysqli_real_escape_string($conn, $_POST['story']);
         
       $query="insert into user_stories (title, name,gender,genre,story) values ('$title', '$name', '$gender', '$genre', '$story')";

     

        if ($conn->query($query) === TRUE) {
            echo "<p style='color:black; text-align:center;'>Your story has been saved successfully!</p>";
        } else {
            echo "<p style='color:red; text-align:center;'>Error saving story: " . $stmt->error . "</p>";
        }


    
        $conn->close();
    }
}

    ?>
    </head>
</html>