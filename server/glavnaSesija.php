<?php
  include 'C:\xampp\htdocs\fonSluzba\fonSluzba\domen\uloga.php';
  include 'C:\xampp\htdocs\fonSluzba\fonSluzba\domen\sluzbenik.php';
  session_start();

  if(!isset($_SESSION['sluzbenik'])){
    if(!isset($_POST['login'])){
      header("Location: ./login.php");
    }

  }

 ?>
