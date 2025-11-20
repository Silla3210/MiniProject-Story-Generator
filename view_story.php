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
$title=$_REQUEST['title'];
$name=$_REQUEST['name'];

        
        $conn = new mysqli("localhost", "root", "", "miniproject");

        if ($conn->connect_error) {
            echo "<p>Connection failed: " . $conn->connect_error . "</p>";
        } else {
           
            $query = "select * from user_stories where id=$story_id union select * from story_parts where id=$story_id";

            $result = $conn->query($query);         
          
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
                 $story = $row['story'];
                    $gender = $row['genre'];
                    $genre = $row['gender'];
                    $story = str_replace("{name}", $name, $story);
                    $story= str_replace("*", "\"", $story);
                    $story= str_replace("#", "'", $story);


                  }
   }
                                                                  
?>

 <?php  
                echo "<center><div style='color:white; text-align:justify; margin:30px; font-size:20px; width:50%;'><h3>$title</h3></div></center>";
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
    $story= str_replace($name,"{name}", $story);
    $story= str_replace("'","#", $story);
    $story= str_replace("\"","*", $story);
    
$conn = new mysqli("localhost", "root", "", "miniproject");

    if ($conn->connect_error) {
        echo "<p style='color:red; text-align:center;'>Connection failed: " . $conn->connect_error . "</p>";
    } else {
              
         
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