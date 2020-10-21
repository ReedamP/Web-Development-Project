<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Albums : Music Library</title>
    <link rel="stylesheet" href="./css/style.css">
  </head>

  <body id="specifictrackpagebody">

    <header>
      <h1> Tracks </h1>
      <ul>
        <li> <a href="homepage.php"> Home </a> </li>
        <li> <a href="artistpage.php"> Artists </a> </li>
        <li> <a href="albumspage.php"> Albums </a> </li>
        <li class="current"> <a href="trackspage.php"> Tracks </a> </li>
      </ul>
    </header>

    <p> </p>
    <?php
    $id=$_GET['id'];
    $table=mysqli_query($connection,"SELECT trackID, tracks.artID, tracks.cdID, title, Seconds FROM tracks,album WHERE tracks.cdID=album.cdID AND tracks.cdID='$id'");
    if (mysqli_num_rows($table)!=0){

      if (isset($_GET['id'])){
        echo "<table border='3' table width='60%' table style='background-color:#32a0c2'>";
        echo "<tr align='center'> <td> Track ID </td> <td> Artist Name </td> <td> Album Title </td> <td> Track </td> <td> Duration (Seconds) </td> <td colspan='2'> Actions </td><tr> ";
        while($row=mysqli_fetch_array($table)){
          $sql=mysqli_query($connection,"SELECT artName FROM artist WHERE artID='$row[1]'");
          $x=mysqli_fetch_array($sql);
          $sql=mysqli_query($connection,"SELECT cdTitle FROM album WHERE cdID='$row[2]'");
          $y=mysqli_fetch_array($sql);


          echo "<tr align='center'><td> {$row[0]} </td><td> {$x[0]} </td> <td> {$y[0]} </td> <td> {$row[3]} </td> <td> {$row[4]} </td> <td> <a href='editalbumpage.php?id=$row[0]'> Edit  </td><td> <a href='trackspage.php'> Tracks </td><tr>";
          }
        }
      }
      else{
        echo"<h4>Album has no tracks!</h4>";
      }
    ?>
    <a href="addtrackpage.php" class="specificbutton"> Add Track</a>
    <a href="albumspage.php" class="backbutton"> Back</a>
  </body>
</html>
