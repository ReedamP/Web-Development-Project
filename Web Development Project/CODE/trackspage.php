<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Tracks : Music Library</title>
    <link rel="stylesheet" href="./css/style.css">
  </head>

  <body id="addtalbumbody">
    <header>
      <h1> Tracks</h1>
      <ul>
        <li> <a href="homepage.php"> Home </a> </li>
        <li> <a href="artistpage.php"> Artists </a> </li>
        <li> <a href="albumspage.php"> Albums </a> </li>
        <li class="current"> <a href="trackspage.php"> Tracks </a> </li>
      </ul>
    </header>

    <form class="searchbar" action="trackspage.php" method="post">
      <input type="text" name="search" placeholder="Search..." class="searchboxdesign">
    </form>

    <a href="addtrackpage.php" class="button"> Add Track</a>

    <?php
    $originaltable=mysqli_query($connection,"SELECT trackID, artName, cdTitle, title, seconds FROM tracks,album,artist WHERE tracks.cdID=album.cdID AND album.artID=artist.artID ");


    if(isset($_POST['search'])){
      $searchq=$_POST['search'];
      $searchresults=mysqli_query($connection,"SELECT trackID, artist.artName, album.cdTitle, title, seconds FROM tracks,album,artist WHERE tracks.cdID=album.cdID AND album.artID=artist.artID AND title LIKE '%$searchq%'");

      if (mysqli_num_rows($searchresults)>0){ //While more than one row
        showtable($searchresults);
      }
      else{
        echo "<h2>No Results</h2>";
        }
      }
    else{
      showtable($originaltable);
    }

    function showtable($table){

      echo "<table border='3' table width='60%' table style='background-color:#32a0c2'>";
      echo "<tr align='center'> <td> Track ID </td> <td> Artist </td> <td> Album </td> <td> Title </td> <td> Duration (Seconds) </td> <td> Actions </td><tr> ";
      if (mysqli_num_rows($table)>0){ //If not searched
        while($row=mysqli_fetch_array($table)){

          echo "<tr align='center'><td> {$row[0]} </td><td> {$row[1]} </td> <td> {$row[2]} </td> <td> {$row[3]} </td> <td> {$row[4]} </td> <td> <a href='edittrackpage.php?id=$row[0]'> Edit  </td><tr>";
      }
    }
  }
    ?>
  </body>
</html>
