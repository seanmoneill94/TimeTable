<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
    <form action="addbus.php" method="post">
      <p>Bus Number: <input type="text" name="bus_number" /></p>
      <p><input type="submit" /></p>
    </form>

  <?php
    include 'connect.php';

    if(isset($_POST['bus_number']))
    {
      //add value to db
      $value = mysql_escape_string($_POST['bus_number']);
      $sql = "INSERT INTO bus (Name)
              VALUES ('$value')";


      //check did it work? if not why?
      if ($conn->query($sql) === TRUE) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }



  ?>
 </body>
</html>
