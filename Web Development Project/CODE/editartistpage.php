<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Edit Artist : Music Library</title>
    <script src="js.js"> </script>
    <link rel="stylesheet" href="./css/style.css">
  </head>

  <body id="editartistbody">

    <header>
      <h1> Edit Artist</h1>
      <ul>
        <li> <a href="homepage.php"> Home </a> </li>
        <li> <a href="artistpage.php"> Artists </a> </li>
        <li> <a href="albumspage.php"> Albums </a> </li>
        <li> <a href="trackspage.php"> Tracks </a> </li>
      </ul>
    </header>


    <?php
      $id=$_GET['id'];
      $query=mysqli_query($connection,"SELECT artName FROM artist WHERE artID='$id'");
      $row=mysqli_fetch_array($query);
      $name=$row[0];

      if (isset($_POST['add'])){
        $newname=$_POST['editname'];
        if (!mysqli_query($connection,"UPDATE artist SET artName='$newname' WHERE artID='$id'"))
          {
            echo "<h3>Artist already exists!</h3>";
          }
        else{
          echo "<h3>Artist edited</h3>";
        }
      }

      if (isset($_POST['delete'])){
        $name=$_POST['editname'];
        $query=mysqli_query($connection,"SELECT artName FROM artist WHERE artName='$name'");
        $rows=mysqli_num_rows($query);

        if ($rows!=0){
          if (!mysqli_query($connection,"DELETE FROM artist WHERE artName='$name'"))
            {
            echo'<Error: ';
            }
          else{
              echo "<h3>Artist deleted</h3>";
            }
        }
        else{
          echo "<h3>Artist already deleted or does not exist</h3>";
        }
        }
    ?>
    <form class="addartistpagebar" action="" method="POST" onsubmit="return validateartistname()">
      <input id="addartistnamebox" type ="text" name="editname" value="<?=$name?>" class="addartistpagebardesign">
      <input id="editaddbuttontext" value="Edit" type="submit" name="add">
      <input id="deletebutton" type="submit" value="Delete" name="delete">
    </form>


  </body>
</html>
