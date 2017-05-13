<html>
  <head>
    <title>Time Table</title>
    <link rel="stylesheet" href="http://bootswatch.com/cosmo/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body >
    <?php
    include 'navigation.php'
    ?>
    <div class = "container">
      <?php
        include 'connect.php';
        include 'addbusstop.php';

        // $GLOBALS['appId'] = "1cf8521a";
        // $GLOBALS['appKey'] = "6cd6ee5796313c2e29cd386be417c46f";
        $GLOBALS['appId'] = "221cce2f";
        $GLOBALS['appKey'] = "d209929236fc97196775650c2bdb639e";

        $query = "SELECT * FROM busstop";
        $result = $conn->query($query);

        if($result->num_rows > 0)
        {
          while($row = $result->fetch_assoc())
          {
            displayBusTimes($row["atco"]);
          }
        }

        function displayBusTimes($atco)
        {
          $request = "https://transportapi.com/v3/uk/bus/stop/". $atco ."/live.json?app_id=". $GLOBALS['appId'] ."&app_key=". $GLOBALS['appKey'] ."&group=no&nextbuses=yes";
          $response = json_decode(file_get_contents($request), true);
          if(!isset($response["error"]))
          {
            // echo json_encode($response);
            echo "<h2>" . $response['name'] .", ". $response['locality'] . "</h2>";
            if($response['departures'])
            {
              echo "<table class='table table-striped table-hover'>
                      <thead>
                        <tr>
                          <th class='col-md-1'>Bus</th>
                          <th class='col-md-1'>Time</th>
                          <th class='col-md-1'>Expected</th>
                          <th>Best</th>
                        </tr>
                      </thead>
                      <tbody>";

              foreach ($response['departures']['all'] as $value)
              {
                echo
                "<tr>".
                "<td>". $value['line'] ."</td>".
                "<td>". $value['aimed_departure_time'] ."</td>".
                "<td>". ($value['expected_departure_time'] ? $value['expected_departure_time'] : $value['aimed_departure_time']) ."</td>".
                "<td>". ($value['best_departure_estimate'] ? $value['best_departure_estimate'] : $value['aimed_departure_time']) ."</td>".
                "</tr>";
              }
              echo "</tbody>";
              echo "</table>";
            }else
            {
              echo "<h3>No buses in the next hour</h3>";
            }
          }
        }







        // $busStop = "1800WF39731";
        //
        // $liveRequest = "https://transportapi.com/v3/uk/bus/stop/". $busStop ."/live.json?app_id=".$appId."&app_key=".$appKey."&group=no&nextbuses=yes";
        // $timetableRequest = "https://transportapi.com/v3/uk/bus/stop/".$busStop."/2017-05-15/03:00/timetable.json?app_id=".$appId."&app_key=".$appKey."&group=route&limit=150";
        // // $response = file_get_contents($liveRequest);
        // $response = json_decode(file_get_contents($liveRequest), true);
      ?>
    </div>
  </body>
</html>
