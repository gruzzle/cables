<?php
session_start();

$index = $_GET["i"];
array_splice($_SESSION["orders"], $index, 1);
//var_dump($_SESSION["orders"]);

?>
