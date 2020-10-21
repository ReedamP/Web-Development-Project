<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Albums : Music Library</title>
    <link rel="stylesheet" href="./css/style.css">
  </head>

  <body id="specificalbumpagebody">

    <header>
      <h1> Album </h1>
      <ul>
        <li> <a href="homepage.php"> Home </a> </li>
        <li> <a href="artistpage.php"> Artists </a> </li>
        <li class="current"> <a href="albumspage.php"> Albums </a> </li>
        <li> <a href="trackspage.php"> Tracks </a> </li>
      </ul>
    </header>

    <p> </p>
    <?php
    $id=$_GET['id'];

    $table=mysqli_query($connection,"SELECT cdID, artID, cdTitle, cdPrice, cdGenre, cdNumTracks FROM album WHERE artID='$id'");

    if (mysqli_num_rows($table)!=0){
      if (isset($_GET['id'])){
        echo "<table border='3' table width='60%' table style='background-color:#32a0c2'>";
        echo "<tr align='center'> <td> Album ID </td> <td> Artist Name </td> <td> Album Title </td> <td> Price </td> <td> Genre </td> <td> Tracks </td> <td colspan='2'> Actions </td><tr> ";
        while($row=mysqli_fetch_array($table)){
          $sql=mysqli_query($connection,"SELECT artName FROM artist WHERE artID='$row[1]'");
          $x=mysqli_fetch_array($sql);
          echo "<tr align='center'><td> {$row[0]} </td><td> {$x[0]} </td> <td> {$row[2]} </td> <td> {$row[3]} </td> <td> {$row[4]} </td> <td> {$row[5]} </td> <td> <a href='editalbumpage.php?id=$row[0]'> Edit  </td><td> <a href='trackspage.php'> Tracks </td><tr>";
          }
        }
      }

      else{
        echo"<h4>Artist has no albums!</h4>";
      }
    ?>

    <a href="addalbumpage.php" class="specificbutton"> Add Album</a>
    <a href="artistpage.php" class="backbutton"> Back</a>
  </body>
</html>
