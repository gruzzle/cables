<?php
session_start();
if (!isset($_SESSION['orders'])) {
  $_SESSION['orders'] = array();
}
?>

<html>
  <head>
    <title>Order Cables</title>
    <link rel="stylesheet" type="text/css" href="order.css">

    <script>
     function createRequest() {
       var xmlhttp;
       if (window.XMLHttpRequest)
       {
	 xmlhttp=new XMLHttpRequest();
       }
       else
       {
	 xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
       }
       return xmlhttp;
     }

     window.onload = function() {
       xmlhttp = createRequest();
       xmlhttp.onreadystatechange = function() {
	 if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	   document.getElementById("order-list").innerHTML = xmlhttp.responseText;
	 }
       }
       xmlhttp.open("GET", "displaycart.php", true);
       xmlhttp.send();
     }

     function addOrder() {
       var index = document.getElementById('con1-selector').options[document.getElementById('con1-selector').selectedIndex].value;       
       var con1 = document.getElementById('con1-selector').options[index-1].text;
       index = document.getElementById('con2-selector').options[document.getElementById('con2-selector').selectedIndex].value;
       var con2 = document.getElementById('con2-selector').options[index-1].text;
       index = document.getElementById('core-selector').options[document.getElementById('core-selector').selectedIndex].value;
       var core = document.getElementById('core-selector').options[index-1].text;
       
       var quantity = document.getElementById('quantity-box').value;

       xmlhttp = createRequest();
       xmlhttp.onreadystatechange = function() {
       if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	 document.getElementById("order-list").innerHTML = xmlhttp.responseText;
       }
     }
     xmlhttp.open("GET", "addorder.php?a=" + con1 + "&b=" + con2 + "&c=" + core + "&q=" + quantity, true);
     xmlhttp.send();
     }

     function clearCart() {
       xmlhttp = createRequest();
       xmlhttp.onreadystatechange = function() {
	 if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	   document.getElementById("order-list").innerHTML = xmlhttp.responseText;
	 }
       }
       xmlhttp.open("GET", "clearorder.php", true);
       xmlhttp.send();
     }
     
    </script> 
    
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
    
    $core_query = "SELECT * FROM cores";
    $connector_query = "SELECT * FROM cables";

    echo '<table><tr>';

    echo '<td>Connector A<br><select id="con1-selector">';
    $result = $conn->query($connector_query);
    while ($row = $result->fetch_assoc()) {
      echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
    }
    echo '</select></td>';

    echo '<td>Core<br><select id="core-selector">';
    $result = $conn->query($core_query);
    while ($row = $result->fetch_assoc()) {
      echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
    }      
    echo '</select></td>';      

    echo '<td>Connector B<br><select id="con2-selector">';
    $result = $conn->query($connector_query);
    while ($row = $result->fetch_assoc()) {
      echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
    }      
    echo '</select></td>';
    
    ?>
    
    <td>
      Quantity<br>
      <input type="text" id="quantity-box" size="3" value="1">
    </td>

    <td>
      <br>
      <button type="button" onclick="addOrder()">Order</button>
    </td>

    <td>
      <br>
      <button type="button" onclick="clearCart()">Clear</button>
    </td>

    
      </tr></table>

      <h2>Order:</h2>
      <ul id="order-list">
	<li>test</li>
      </ul>
      
  </body>
</html>

