<form class="form-group" action="home.php" method="post">
  <div class="input-group">
    <span class="input-group-addon">Bus Stop ATCO</span>
    <input type="text" name="atco" class="form-control">
    <span class="input-group-btn">
      <button class="btn btn-default" type="submit">Add New Stop</button>
    </span>
  </div>
</form>

<?php
  include 'connect.php';

  if(isset($_POST['atco']))
  {
    //add value to db
    $value = mysql_escape_string($_POST['atco']);
    $sql = "INSERT INTO busstop (atco)
            VALUES ('$value')";

    //check did it work? if not why?
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
?>
