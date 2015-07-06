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
       //displayCart();
       dc();
       /*
       xmlhttp = createRequest();
       xmlhttp.onreadystatechange = function() {
       if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
       document.getElementById("order-list").innerHTML = xmlhttp.responseText;
       }
       }
       xmlhttp.open("GET", "displaycart.php", true);
       xmlhttp.send();
	*/
     }

     function dc() {
       xmlhttp = createRequest();
       xmlhttp.onreadystatechange = function() {
	 if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	   document.getElementById("order-list").innerHTML = xmlhttp.responseText;
	 }
       }
       xmlhttp.open("GET", "displaycart.php", true);
       xmlhttp.send();
       
     }

     function getSelectorText(id) {
       var index = document.getElementById(id).options[document.getElementById(id).selectedIndex].value;       
       return document.getElementById(id).options[index-1].text;
       
     }

     function addOrder() {
       var con1 = getSelectorText('con1-selector');
       var con2 = getSelectorText('con2-selector');
       var core = getSelectorText('core-selector');
       var length = document.getElementById('length-box').value;
       var quantity = document.getElementById('quantity-box').value;

       xmlhttp = createRequest();
       /*
       xmlhttp.onreadystatechange = function() {
       if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
       document.getElementById("order-list").innerHTML = xmlhttp.responseText;
       }	 
       }
	*/
       // TODO using synch here, fix
       xmlhttp.open("GET", "addorder.php?a=" + con1 + "&b=" + con2 + "&c=" + core + "&l=" + length
		    + "&q=" + quantity, false);
       xmlhttp.send();
       dc();
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

     function removeItem(index) {
       
       xmlhttp = createRequest();
       
       xmlhttp.onreadystatechange = function() {
	 if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	   document.getElementById("order-list").innerHTML = xmlhttp.responseText;
	 }
       }
       // TODO using synch here, fix
       xmlhttp.open("GET", "removeitem.php?i=" + index, false);
       xmlhttp.send();
       dc();       
     }

     function displayCart() {
       xmlhttp = createRequest();
       xmlhttp.onreadystatechange = function() {
	 if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	   document.getElementById("order-list").innerHTML = xmlhttp.responseText;
	 }
       }
       xmlhttp.open("GET", "displaycart.php" . index, true);
       xmlhttp.send(); 
     }

     function sendOrder() {
       alert("Thank you for your order!\n\nWe will contact you as soon as possible.");
     }
     
    </script> 
    
  </head>

  <body>

    <form>
      <p>
	<label>Name</label>
	<input type="text" name="first"><br>
      </p>
      <p>
	<label>Phone</label>
	<input type="text" name="last"><br>
      </p>
      <p>
	<label>Email</label>
	<input type="text" name="email"><br>
      </p>
    </form>
    <br>

    <p>

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
	Length (m)<br>
	<input type="text" id="length-box" size="3" value="1.0">
      </td>

      <td>
	<br>
	<button type="button" onclick="addOrder()">Add to Order</button>
      </td>

      <td>
	<br>
	<button type="button" onclick="clearCart()">Clear</button>
      </td>

      
      </tr></table>

      <h2>Order:</h2>
      <ul id="order-list">
	
      </ul>

      <br>
      <button onclick="sendOrder()">
	Submit order
      </button>

      
  </body>
</html>

