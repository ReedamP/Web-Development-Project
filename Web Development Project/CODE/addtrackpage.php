<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Add Track : Music Library</title>
    <script src="js.js"> </script>
    <link rel="stylesheet" href="./css/style.css">
  </head>

  <body id="addtrackbody">

    <header>
      <h1> Add Track</h1>
      <ul>
        <li> <a href="homepage.php"> Home </a> </li>
        <li> <a href="artistpage.php"> Artists </a> </li>
        <li> <a href="albumspage.php"> Albums </a> </li>
        <li> <a href="trackspage.php"> Tracks </a> </li>
      </ul>
    </header>

    <form action="" method="POST" onsubmit="return validateaddtrack()">
      <table class="editalbform"> <!--table due to multiple fields-->
        <tr>
          <td class="editalbtext">Title:</td>
          <td><input id="namebox8" class="editalbtype" name="title" type="text" </td> <!--Cannot have an input element (id) which contains matching letters to the name attribute, hence the name "namebox x"  -->
        </tr>

        <tr>
          <td class="editalbtext">Album:</td>
          <td>
            <select id="namebox10"class="editalbtype" name="album">
              <option value="Select">Select Album</option>
              <?php
              $sql="SELECT cdTitle FROM album ORDER BY artID ASC";
              $result=mysqli_query($connection,$sql);

              while($row=mysqli_fetch_array($result)){
                echo "<option value ='".$row['cdTitle']."'>".$row['cdTitle']."</option>";
              }

              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td class="editalbtext">Duration (Seconds):</td>
          <td><input id="namebox9" class="editalbtype" name="duration" type="number" ></td>
        </tr>
      <input id="editaddbuttontext" value="Add Track" type="submit" name="add">
    </form>

    <?php
    error_reporting(0);//To remove the warning notice of not selecting an "Artist" e.g. when the user doesn't want to change the artisft of the album when editing

    if (isset($_POST['add'])){
      $title=$_POST['title'];
      $album=$_POST['album'];
      $duration=$_POST['duration'];


      $albumid=mysqli_query($connection,"SELECT cdID FROM album WHERE album.cdTitle='$album'"); //Matches the album name with the ID
      $x=mysqli_fetch_array($albumid); //x contains the array of objects representing the fields in a result set
      $albumid=$x[0]; //Gets the ID of the album

      $artid=mysqli_query($connection,"SELECT artID FROM album WHERE cdID='$albumid'");
      $y=mysqli_fetch_array($artid); //x contains the array of objects representing the fields in a result set
      $ARTISID=$y[0];

      $check=mysqli_query($connection,"SELECT * FROM tracks WHERE cdID='$albumid' AND title='$title'");
      $x=mysqli_num_rows($check);

      if ($x==0){
        if (!mysqli_query($connection,"INSERT INTO tracks (artID,cdID,title,seconds) VALUES ('$ARTISID','$albumid','$title','$duration')"));
          {
          echo "<h3>Track added</h3>";
          }
      }
      else
      {
        echo("<h3>Track already exists</h3>");
      }
    }
    ?>

  </body>
</html>
