<?php
session_start();
$_SESSION['orders'] = array();

echo '<ul>';
for ($i = 0; $i < count($_SESSION['orders']); ++$i) {
  echo '<li>' . $_SESSION['orders'][$i];
  echo '<button type="button" onclick="removeItem(' . $i . ')">Remove item ' . $i . '</button>';
  echo '</li>';
}
echo '</ul>';

?>
