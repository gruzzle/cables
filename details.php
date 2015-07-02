<html>
  <head>
    <title>Product Detail</title>
    <link rel="stylesheet" type="text/css" href="details.css">
  </head>
  <body>
    <?php
    
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "cables";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    $query = "SELECT * FROM cables where id=" . $_GET['id'];
    $result = $conn->query($query);

    $row = $result->fetch_assoc();
    echo '<h2>' . $row["name"] . '</h2>';
    echo '<img src="images/' . $row["image_url"] . '"><br><br>';
    echo $row["short_desc"] . '<br><br>';
    echo '<h3>Details:</h3>';
    echo $row["long_desc"] . '<br><br>';

    ?>

    <script>
      document.write('<a href="' + document.referrer + '">Back to products</a>');
    </script>
    
  </body>
</html>
