<?php
session_start();

class Cable {
  public $connectorA = '';
  public $connectorB = '';
  public $core = '';
  public $quantity = 0;

  public function __construct($conA, $conB, $core, $quantity) {
    $this->connectorA = $conA;
    $this->connectorB = $conB;
    $this->core = $core;
    $this->quantity = $quantity;
  }

  public function __toString() {
    return $this->connectorA . ' to ' . $this->connectorB . ' with '
			    . $this->core .' (x '. $this->quantity . ')';
  }
}


foreach ($_SESSION['orders'] as $cableorder ) {
  echo $cableorder . '<br>';
}

?>