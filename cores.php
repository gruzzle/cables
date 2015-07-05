<html>
  <head>
    <title>Products</title>
    <link rel="stylesheet" type="text/css" href="products.css">
  </head>
  
  <body>
    <h1>Cores</h1>
    <?php
    
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "cables";

    // $conn is a mysqli object
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    $query = "SELECT * FROM cores";

    // $result is a mysqli_result object
    $result = $conn->query($query);

    echo '<table align="center" cellpadding="30">';
    $count = 0;
    while ($row = $result->fetch_assoc()) {
      if ($count % 2 == 0) {	
	echo "\n\t\t<tr>\n";
      }
      echo "\t\t\t<td>";
      echo '<a href="coredetails.php?id=' . $row["id"] . '">';
      echo '<h2>' . $row["name"] . '</h2></a>';
      echo '<a href="coredetails.php?id=' . $row["id"] . '">';
      echo '<img src="images/' . $row["image_url"] . '"></a><br><br>';
      echo $row["short_desc"] . '<br>';
      
      echo "</td>\n";
      if ($count % 2 == 1) {
	echo "\t\t</tr>\n";
      }
      $count++;
    }
    if ($count % 2 == 1) {
      echo "\t\t</tr>\n";
    }
    echo "\t</table>\n";
    
    ?>
  </body>
  
</html>
