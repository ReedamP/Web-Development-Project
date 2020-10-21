<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Edit Track : Music Library</title>
    <script src="js.js"> </script>
    <link rel="stylesheet" href="./css/style.css">
  </head>

  <body id="edittrackbody">

    <header>
      <h1> Edit Track</h1>
      <ul>
        <li> <a href="homepage.php"> Home </a> </li>
        <li> <a href="artistpage.php"> Artists </a> </li>
        <li> <a href="albumspage.php"> Albums </a> </li>
        <li> <a href="trackspage.php"> Tracks </a> </li>
      </ul>
    </header>

    <?php
    $id=$_GET['id'];

    $name=mysqli_query($connection,"SELECT * FROM album,tracks WHERE album.cdID=tracks.cdID AND trackID='$id'");
    $row=mysqli_fetch_array($name);

    $album=$row['cdID'];
    $title=$row['title'];
    $duration=$row['Seconds'];

    $x=$row[2];
    ?>

    <form action="" method="post" onsubmit="return validateaddtrack()">
      <table class="editalbform"> <!--table due to multiple fields-->
        <tr>
          <td class="editalbtext">Title:</td>
          <td><input id="namebox8" class="editalbtype" name="edittitle" value="<?=$title?>" type="text" </td>
        </tr>

        <tr>
          <td class="editalbtext">Album:</td>
          <td>
            <select id="namebox10" class="editalbtype" name="editalbum">
              <option  selected disabled hide value=""><?php echo "$row[2]" ?></option>
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
          <td id="namebox9" class="editalbtext">Duration (Seconds):</td>
          <td><input id="namebox7" class="editalbtype" name="editduration" value="<?=$duration?>" type="number" > </td>
        </tr>
      <input id="editaddbuttontext" value="Edit Track" type="submit" name="edit">
      <input id="deletebutton" value="Delete Track" type="submit" name="delete">
    </form>

    <?php
      error_reporting(0);//To remove the warning notice of not selecting an "Artist" e.g. when the user doesn't want to change the artisft of the album when editing

      if (isset($_POST['edit'])){
        $edittitle=$_POST['edittitle'];

        $editalbum="";
        $editalbum=$_POST['editalbum'];
        if ($editalbum==null){
          $editalbum=$x;
        }

        $editduration=$_POST['editduration'];

        $sql=mysqli_query($connection,"SELECT cdID FROM album WHERE cdTITLE='$editalbum'");
        $x=mysqli_fetch_array($sql);

        $check=mysqli_query($connection,"SELECT * FROM tracks WHERE cdID='$x[0]' AND title='$edittitle' AND Seconds='$editduration'");
        $rows=mysqli_num_rows($check);

        $y=mysqli_query($connection,"SELECT artID FROM album WHERE cdID='$x[0]' ");
        $y=mysqli_fetch_array($y);

        if ($rows==0){
          if (!mysqli_query($connection,$sql="UPDATE tracks SET artID='$y[0]',cdID='$x[0]',title='$edittitle',Seconds='$editduration' WHERE trackID='$id'"))
            {
            die('Error:'.mysqli_error($connection));
            }
            echo "<h3>Track edited</h3>";
        }
        else{
          echo "<h3>Track already exists</h3>";
        }
      }

      if (isset($_POST['delete'])){
        $edittitle=$_POST['edittitle'];

        $editalbum="";
        $editalbum=$_POST['editalbum'];
        if ($editalbum==null){
          $editalbum=$x;
        }

        $editduration=$_POST['editduration'];

        $query=mysqli_query($connection,"SELECT * FROM tracks WHERE title='$edittitle'");
        $rows=mysqli_num_rows($query);

        if ($rows!=0){ //if record exists
          if (!mysqli_query($connection,"DELETE FROM tracks WHERE title='$edittitle'"))
          {
            die('Error:'.mysqli_error($connection));

          }
          echo "<h3>Track deleted</h3>";
        }
        else{
        echo "<h3>Track has already been deleted or does not exist</h3>";
        }
      }


    ?>

  </body>
</html>
