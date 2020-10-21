<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html>

  <head>
    <title>Add Artists : Music Library</title>
    <script src="js.js"> </script>
    <link rel="stylesheet" href="./css/style.css">
  </head>

  <body id="addartistbody">

    <header>
      <h1> Add Artist</h1>
      <ul>
        <li> <a href="homepage.php"> Home </a> </li>
        <li> <a href="artistpage.php"> Artists </a> </li>
        <li> <a href="albumspage.php"> Albums </a> </li>
        <li> <a href="trackspage.php"> Tracks </a> </li>
      </ul>
    </header>

    <form class="addartistpagebar" action="" method="POST" onsubmit="return validateartistname()">
      <input id="addartistnamebox" type ="text" name="name" placeholder="Add an Artist..." class="addartistpagebardesign">
      <input id="editaddbuttontext" value="Submit" type="submit" name="submitname">
    </form>

    <?php
      if (isset($_POST['submitname'])){
        $Name=$_POST['name'];
        if (!mysqli_query($connection,"INSERT INTO artist (artName) VALUES ('$Name')"))
          {
          die("<h3>Artist already exists<h3>");
          }
        echo "<h3>Artist added<h3>";
      }
    ?>
  </body>
</html>
