<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
    <form action="addbustime.php" method="post">
      <p>Location: <input type="text" name="location" /></p>
      <p>Day:
        <select name="day">
          <option value="Mon-Fri">Mon-Fri</option>
          <option value="Saturday">Saturday</option>
          <option value="Sunday">Sunday</option>
        </select>
      </p>
      <p>Time: <input type="text" name="time" /></p>
      <?php
        include 'connect.php';

        $sql = "SELECT ID,Name FROM bus";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            $select = "<p>Bus: <select name='bus_number'>";
            while($row = $result->fetch_assoc()) {
                $select.= "<option value=". $row["ID"] .">". $row["Name"] . "</option>";
            }
            $select.= "</select></p>";
        } else {
            echo "0 results";
        }
        echo $select;
       ?>
      <p><input type="submit" /></p>
    </form>

  <?php
    if(isset($_POST['bus_number']))
    {
      //add value to db
      $location = mysql_escape_string($_POST['location']);
      $day = mysql_escape_string($_POST['day']);
      $time = mysql_escape_string($_POST['time']);
      $bus_number = mysql_escape_string($_POST['bus_number']);
      $sql = "INSERT INTO times (Location, Day, Times, Bus_ID)
              VALUES ('$location',' $day',' $time',' $bus_number')";


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
