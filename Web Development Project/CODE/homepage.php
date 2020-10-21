<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html>

  <head>
    <title>Home : Music Library</title>
    <link rel="stylesheet" href="./css/style.css">
  </head>

  <body id="homepagebody">
    <header>

      <h1> Home</h1>

      <ul>
        <li class="current"> <a href="homepage.php"> Home </a> </li>
        <li> <a href="artistpage.php"> Artists </a> </li>
        <li> <a href="albumspage.php"> Albums </a> </li>
        <li> <a href="trackspage.php"> Tracks </a> </li>
      </ul>
    </header>

    <section id="homepagemid">
      <h2> Database Metrics</h2>

      <?php
      $resultsartist=mysqli_query($connection,"SELECT * FROM artist");
      $artrows = mysqli_num_rows($resultsartist);

      $resultsalbums=mysqli_query($connection,"SELECT * FROM album");
      $albrows = mysqli_num_rows($resultsalbums);

      $resultstracks=mysqli_query($connection,"SELECT * FROM tracks");
      $trarows = mysqli_num_rows($resultstracks);
      ?>
<h2 id="artistcounttag">
      <section id="midbullets">
        <ul>
          <li> Number of Artists: <?php echo "<font size='10px' color='white' font-style='text-align:right' > $artrows\n"; ?> </li>
          <li> Number of Albums: <?php echo "<font size='10px' color='white' font-style='text-align:right' > $albrows\n"; ?>  </li>
          <li> Number of Tracks:  <?php echo "<font size='10px' color='white' font-style='text-align:right' > $trarows\n"; ?>  </li>
        </ul>
      </section>
    </section>
  </body>
</html>
