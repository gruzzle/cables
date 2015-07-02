<html>
  <head>
    <title>Order Cables</title>
    <link rel="stylesheet" type="text/css" href="order.css">
  </head>

  <body>
    <select>
      <?php
      $servername = "localhost";
      $username = "root";
      $password = "root";
      $dbname = "cables";

      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
      }
      
      $query = "SELECT * FROM cables";
      $result = $conn->query($query);

      while ($row = $result->fetch_assoc()) {
	echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
      }

      ?>
    </select>
  </body>
</html>

