<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Edit Album : Music Library</title>
    <script src="js.js"> </script>
    <link rel="stylesheet" href="./css/style.css">
  </head>

  <body id="editalbumbody">

    <header>
      <h1> Edit Album</h1>
      <ul>
        <li> <a href="homepage.php"> Home </a> </li>
        <li> <a href="artistpage.php"> Artists </a> </li>
        <li> <a href="albumspage.php"> Albums </a> </li>
        <li> <a href="trackspage.php"> Tracks </a> </li>
      </ul>
    </header>

    <?php
    $id=$_GET['id'];
    $name=mysqli_query($connection,"SELECT * FROM album, artist WHERE (album.artID=artist.artID) AND cdID='$id'");
    $row=mysqli_fetch_array($name);

    $title=$row['cdTITLE'];
    $artist=$row['artID'];
    $price=$row['cdPrice'];
    $genre=$row['cdGenre'];
    //$tracks=$row['cdNumTracks'];

    $sql=mysqli_query($connection,"SELECT artName FROM artist WHERE artID='$row[1]'");
    $x=mysqli_fetch_array($sql);
    ?>

    <form action="" method="post" onsubmit="return validateaddalbum()">
      <table class="editalbform"> <!--table due to multiple fields-->
        <tr>
          <td class="editalbtext">Title:</td>
          <td><input id="namebox2" class="editalbtype" name="edittitle" value="<?=$title?>" type="text" </td>
        </tr>

        <tr>
          <td class="editalbtext">Artist:</td>
          <td>
            <select id="namebox6" class="editalbtype" name="editartist">
              <option selected="selected" selected disabled hide value=""><?php echo $x[0];?></option>
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
          <td><input input id="namebox3" class="editalbtype" name="editprice" value="<?=$price?>" type="number" step="0.01" min="0" max="10" </td>
        </tr>
        <tr>
          <td class="editalbtext">Genre:</td>
          <td><input input id="namebox4" class="editalbtype" name="editgenre" value="<?=$genre?>" type="text" </td>
        </tr>
      <input id="editaddbuttontext" value="Edit Album" type="submit" name="edit">
      <input id="deletebutton" value="Delete Album" type="submit" name="delete">
    </form>

    <?php

      error_reporting(0);//To remove the warning notice of not selecting an "Artist" e.g. when the user doesn't want to change the artisft of the album when editing
      if (isset($_POST['edit'])){
        $edittitle=$_POST['edittitle'];
        $editartist="";
        $editartist=$_POST['editartist'];
        if ($editartist==null){
          $editartist=$x[0];
        }

        $editprice=$_POST['editprice'];
        $editgenre=$_POST['editgenre'];
        //$edittracks=$_POST['edittracks'];

        $sql=mysqli_query($connection,"SELECT artID FROM artist WHERE artName='$editartist'");
        $x=mysqli_fetch_array($sql);

        $check=mysqli_query($connection,"SELECT * FROM album WHERE artID='$x[0]' AND cdTitle='$edittitle' AND cdPrice='$editprice' AND cdGenre='$editgenre'");
        $rows=mysqli_num_rows($check);

        if ($rows==0){
          if (!mysqli_query($connection,"UPDATE album SET artID='$x[0]',cdTitle='$edittitle',cdPrice='$editprice',cdGenre='$editgenre' WHERE cdID='$id'"))
            {
            die('Error:'.mysqli_error($connection));
            }
            echo "<h3>Album edited</h3>";
        }
        else{
          echo "<h3>Album already exists </h3>";
        }
      }

        if (isset($_POST['delete'])){
          $edittitle=$_POST['edittitle'];
          $editartist="";
          $editartist=$_POST['editartist'];
          if ($editartist==null){
            $editartist=$x[0];
          }

          $editprice=$_POST['editprice'];
          $editgenre=$_POST['editgenre'];

          $query=mysqli_query($connection,"SELECT * FROM album WHERE cdTitle='$edittitle'");
          $rows=mysqli_num_rows($query);

          if ($rows!=0){ //if record exists
            if (!mysqli_query($connection,"DELETE FROM album WHERE cdTitle='$edittitle'"))
              {
              die(mysqli_error($connection));
              }
            else
              {
                echo "<h3>Album deleted</h3>";
              }
          }
          else
          {
          echo "<h3>Album already deleted or does not exist </h3>";
          }
        }
    ?>
  </body>
</html>
