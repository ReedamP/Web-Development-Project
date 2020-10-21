<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html>

  <head>
    <title>Add Album : Music Library</title>
    <script src="js.js"> </script>
    <link rel="stylesheet" href="./css/style.css">
  </head>

  <body id="addtalbumbody">

    <header>
      <h1> Add Album</h1>
      <ul>
        <li> <a href="homepage.php"> Home </a> </li>
        <li> <a href="artistpage.php"> Artists </a> </li>
        <li> <a href="albumspage.php"> Albums </a> </li>
        <li> <a href="trackspage.php"> Tracks </a> </li>
      </ul>
    </header>

    <form action="" method="POST" onsubmit="return validateaddalbum()">
      <table class="editalbform"> <!--table due to multiple fields-->
        <tr>
          <td class="editalbtext">Title:</td>
          <td><input id="namebox2" class="editalbtype" name="title" type="text" </td> <!--Cannot have an input element (id) which contains matching letters to the name attribute, hence the name "namebox x"  -->
        </tr>

        <tr>
          <td class="editalbtext">Artist:</td>
          <td>
            <select id="namebox6" class="editalbtype" name="artist">
              <option value="Select">Select</option>
              <?php
              $sql="SELECT artName FROM artist ORDER BY artID ASC";
              $result=mysqli_query($connection,$sql);

              while($row=mysqli_fetch_array($result)){
                echo "<option value ='".$row['artName']."'>".$row['artName']."</option>";
              }

              ?>
            </select>
          </td>
        </tr>

        <tr>
          <td class="editalbtext">Price:</td>
          <td><input input id="namebox3" class="editalbtype" name="price" type="number" step="0.01" min="0" max="10" </td>
        </tr>
        <tr>
          <td class="editalbtext">Genre:</td>
          <td><input input id="namebox4" class="editalbtype" name="genre" type="text" </td>
        </tr>
      <input id="editaddbuttontext" value="Add Album" type="submit" name="add">
    </form>

    <?php
    if (isset($_POST['add'])){
      $title=$_POST['title'];
      $artist=$_POST['artist'];
      $price=$_POST['price'];
      $genre=$_POST['genre'];

      $artistid=mysqli_query($connection,"SELECT artID FROM artist WHERE artist.artName='$artist'"); //Matches the artist name with the ID
      $x=mysqli_fetch_array($artistid); //x contains the array of objects representing the fields in a result set
      $artid=$x[0]; //Gets the ID of the artist

      $check=mysqli_query($connection,"SELECT * FROM album WHERE artID='$artid' AND cdTitle='$title'");
      $x=mysqli_num_rows($check);

      if ($x==0){
        if (mysqli_query($connection,"INSERT INTO album (artID,cdTitle,cdPrice,cdGenre) VALUES ('$artid','$title','$price','$genre')"));
          {
          echo "<h3>Album added</h3>";
          }
      }
      else{
        echo "<h3>Album already exists</h3>";
      }
    }
    ?>
  </body>
</html>
