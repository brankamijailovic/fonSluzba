<?php
  include 'domen/uloga.php';
  include 'domen/sluzbenik.php';
  session_start();

  if(!isset($_SESSION['sluzbenik'])){
    if(!isset($_POST['login'])){
      header("Location:login.php");
    }

  }

 ?>
