<?php
include 'glavnaSesija.php';
include 'konekcija.php';

$brojIndeksa = $konekcija->real_escape_string($_GET['brojIndeksa']);
$predmetID= $konekcija->real_escape_string($_GET['predmetID']);
$rokID = $konekcija->real_escape_string($_GET['rokID']);
$konekcija->query("DELETE FROM prijava where brojIndeksa = '$brojIndeksa' AND predmetID=$predmetID and rokID= $rokID");
header("Location:adminStrane.php");


 ?>
