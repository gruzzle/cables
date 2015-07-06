<?php
session_start();

class Cable {
  public $connectorA = '';
  public $connectorB = '';
  public $core = '';
  public $quantity = 0;
  public $length = 0;

  public function __construct($conA, $conB, $core, $quantity, $length) {
    $this->connectorA = $conA;
    $this->connectorB = $conB;
    $this->core = $core;
    $this->quantity = $quantity;
    $this->length = $length;
  }

  public function __toString() {
    return $this->connectorA . ' to ' . $this->connectorB . ' with ' . $this->core . ', ' . $this->length . 'm (x '. $this->quantity . ')';
  }
}

echo '<ul>';
for ($i = 0; $i < count($_SESSION['orders']); ++$i) {
  echo '<li>' . $_SESSION['orders'][$i];
  echo "\t";
  echo '<button type="button" class="remove-button" onclick="removeItem(' . $i . ')">remove</button>';
  echo '</li>';
}
echo '</ul>';

?>
