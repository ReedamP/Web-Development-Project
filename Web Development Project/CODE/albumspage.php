<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Albums : Music Library</title>
    <link rel="stylesheet" href="./css/style.css">
  </head>

  <body id="albumpagebody">
    <header>
      <h1> Albums</h1>
      <ul>
        <li> <a href="homepage.php"> Home </a> </li>
        <li> <a href="artistpage.php"> Artists </a> </li>
        <li class="current"> <a href="albumspage.php"> Albums </a> </li>
        <li> <a href="trackspage.php"> Tracks </a> </li>
      </ul>
    </header>

    <form class="searchbar" action="albumspage.php" method="post">
      <input type="text" name="search" placeholder="Search..." class="searchboxdesign">
    </form>

    <a href="addalbumpage.php" class="button"> Add Album</a>

    <?php



    $originaltable=mysqli_query($connection,"SELECT cdID, artName, cdTitle, cdPrice, cdGenre, cdNumTracks FROM album,artist WHERE artist.artID = album.artID ORDER BY cdID ASC");

    if(isset($_POST['search'])){
      $searchq=$_POST['search'];
      $searchresults=mysqli_query($connection,"SELECT cdID, artName, cdTitle, cdPrice, cdGenre, cdNumTracks FROM album,artist WHERE artist.artID = album.artID AND cdTitle LIKE '%$searchq%'ORDER BY cdID ASC");
      if (mysqli_num_rows($searchresults)>0){ //If more than one row returned
        showtable($searchresults,$connection);
      }
      else{
        echo "<h2>No Results</h2>";
      }
    }
    else{
      showtable($originaltable,$connection);
    }

    function showtable($table,$connection){
      echo "<table border='3' table width='60%' table style='background-color:#32a0c2'>";
      echo "<tr align='center'> <td> Album ID </td> <td> Artist Name </td> <td> Album Title </td> <td> Price </td> <td> Genre </td> <td> Tracks </td> <td colspan='2'> Actions </td><tr> ";
      if (mysqli_num_rows($table)>0){ //If not searched
        while($row=mysqli_fetch_array($table)){
          $x=mysqli_query($connection,"SELECT * FROM tracks WHERE cdID='$row[0]'"); //Getting the track counter
          $trackscounter=mysqli_num_rows($x);
          echo "<tr align='center'><td> {$row[0]} </td><td> {$row[1]} </td> <td> {$row[2]} </td> <td> {$row[3]} </td> <td> {$row[4]} </td> <td> {$trackscounter} </td> <td> <a href='editalbumpage.php?id=$row[0]'> Edit  </td><td> <a href='specifictrackpage.php?id=$row[0]'> Tracks </td><tr>";
        }
      }
    }
    ?>
  </body>
</html>
