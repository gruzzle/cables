<?php
session_start();

class Cable {
  public $connectorA = '';
  public $connectorB = '';
  public $core = '';
  public $quantity = 0;
  public $length = 0;

  public function __construct($conA, $conB, $core, $length, $quantity) {
    $this->connectorA = $conA;
    $this->connectorB = $conB;
    $this->core = $core;
    $this->length = $length;
    $this->quantity = $quantity;
  }

  public function __toString() {
    return $this->connectorA . ' to ' . $this->connectorB . ' with ' . $this->core . ', ' . $this->length . 'm (x '. $this->quantity . ')';
  }
}

$cab = new Cable($_GET["a"], $_GET["b"], $_GET["c"], $_GET["l"], $_GET["q"]);
array_push($_SESSION['orders'], $cab);

/*
echo '<ul>';

for ($i = 0; $i < count($_SESSION['orders']); ++$i) {
  echo '<li>' . $_SESSION['orders'][$i];
  echo '<button type="button" onclick="removeItem(' . $i . ')">Remove item ' . $i . '</button>';
  echo '</li>';
}

//foreach ($_SESSION['orders'] as $cableorder ) {
//  echo '<li>' . $cableorder . '</li>';
//}
echo '</ul>';
*/
?>
