<?php
include('../session.php');
?>
<html lang="en">

<head>

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-115740420-2"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-115740420-2');
  </script>


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <?php
  $servername = "127.0.0.1";
  $username = "root";
  $password = "thesis";
  $dbname = "thesis";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  mysqli_set_charset($conn, "utf8");

  $sql = "SELECT * FROM projects WHERE evaladm = 0";
  $result = $conn->query($sql);

  ?>

  <title>Master Thesis - CDSS for RPA</title>
</head>

<body>

  <div style="float:right">
    <form align="right" name="form1" method="post" action="../logout.php" style="margin: 10px;">
      <label class="logoutLblPos">
        <input name="submit2" type="submit" id="submit2" value="Log ud" class="btn btn-default btn-sm">
      </label>
    </form>
  </div>



  <!--  <a href="index.html" download class="btn btn-info" role="button">Download kildekoden</a> -->

  <div class="container">
    <br />

    <a href="../index.php"> <img src="../skat-logo.png" alt="SKAT" style="height:75px;"> </a>
    <hr>

    <h4>Vælg det projekt i listen, som du ønsker at redigere</h4>
    <br>



    <form action="edit.php" method="get">
      <input type="text" name="id" class="form-control formBlock" placeholder="Indtast et ID" style="width:300px;"><br />
      <input type="submit" type="button" class="btn btn-success" id="button" disabled=true value="Rediger projekt" style="width:150px;">
    </form>



    <table class="table table-striped table-bordered">
      <br />
      <hr />

      <tr>
        <th>ID</th>
        <th>Navn</th>
        <th>Beskrivelse</th>
        <th>Evalueret af udvikler?</th>
        <th>Evalueret af processkonsulent?</th>
        <th>Evalueret af leverancekoordinator?</th>
        <th>Egenevaluering</th>
        <th>Score</th>


      </tr>

      <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

          $evaldev = $row['evaldev'];
          $evalpro = $row['evalpro'];
          $evallev = $row['evallev'];


          if ($evaldev == 1) {
            $evalvaldev = 'Ja';
          } else {
            $evalvaldev = 'Nej';
          }
          if ($evalpro == 1) {
            $evalvalpro = 'Ja';
          } else {
            $evalvalpro = 'Nej';
          }
          if ($evallev == 1) {
            $evalvallev = 'Ja';
          } else {
            $evalvallev = 'Nej';
          }

          $scoredev = $row['scoredev'];
          $scorepro = $row['scorepro'];
          $scorelev = $row['scorelev'];
          $score = (($scoredev + $scorepro + $scorelev) / 3);


          echo '<tr>
      <td>' . $row['id'] . '</td>
      <td>' . $row['name'] . '</td>
      <td>' . $row['descr'] . '</td>
      <td>' . $evalvaldev . '</td>
      <td>' . $evalvalpro . '</td>
      <td>' . $evalvallev . '</td>
      <td>' . $row['evalself'] . '</td>
      <td>' . $score . '</td>

    </tr>';
        }
      } else {
        echo "0 results";
      }

      $conn->close();

      ?>

      <script>
        $('input').keyup(function() {
          document.getElementById("button").disabled = false;

        });
      </script>
</body>

</html>