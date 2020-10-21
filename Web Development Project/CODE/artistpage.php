<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Artists : Music Library</title>
    <link rel="stylesheet" href="./css/style.css">
  </head>

  <body id="artistpagebody">
    <header>
      <h1> Artists</h1>
      <ul>
        <li> <a href="homepage.php"> Home </a> </li>
        <li class="current"> <a href="artistpage.php"> Artists </a> </li>
        <li> <a href="albumspage.php"> Albums </a> </li>
        <li> <a href="trackspage.php"> Tracks </a> </li>
      </ul>
    </header>

    <form class="searchbar" action="artistpage.php" method="post">
      <input type="text" name="search" placeholder="Search..." class="searchboxdesign">
    </form>

    <a href="addartistpage.php" class="button"> Add Artist</a>

    <?php
    $originaltable=mysqli_query($connection,"SELECT * FROM artist ORDER BY artID ASC");
    if(isset($_POST['search'])){ //If searched
      $searchq=$_POST['search'];
      $searchresults=mysqli_query($connection,"SELECT * FROM artist WHERE artName LIKE '%$searchq%' ORDER BY artID ASC");
      if (mysqli_num_rows($searchresults)>0){ //If more than one row returned
        showtable($searchresults);
      }
      else{ //If no results
        echo "<h2>No Results</h2>";
      }
    }
    else{
      showtable($originaltable);
    }

    function showtable($table){
      echo "<table border='3' table width='37%' table style='background-color:#32a0c2'>";
      echo "<tr align='center'><td>Artist ID</td><td>Artist Title</td><td colspan='2'> Actions </td><tr> ";
      if (mysqli_num_rows($table)>0){ //If not searched
        while($row=mysqli_fetch_array($table)){
          echo "<tr align='center'><td> {$row[0]} </td><td> {$row[1]} </td><td> <a href='editartistpage.php?id=$row[0]'> Edit  </td><td> <a href='specificalbumpage.php?id=$row[0]'> Albums </td><tr>";
        }
      }
    }
    ?>
  </body>
</html>
