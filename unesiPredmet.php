<?php
  include 'glavnaSesija.php';
  include 'konekcija.php';
  $rezultat = "";

  if(isset($_POST['sacuvaj'])){
    $predmet = $_POST['predmet'];

    $niz = array("predmet"=>$predmet);
    $json = json_encode($niz);
    $zahtev = curl_init("http://localhost/fonsluzba/fonVebServis/unesiPredmet");
    curl_setopt($zahtev, CURLOPT_POST, true);
    curl_setopt($zahtev, CURLOPT_POSTFIELDS,$json);
    curl_setopt($zahtev, CURLOPT_RETURNTRANSFER, true);
    $podaci = curl_exec($zahtev);

    if(json_decode($podaci) == "Uspesno"){
      $rezultat = "Uspesno unet predmet";
    }else{
      $rezultat = "Neuspesno unet predmet";
    }
  }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Sluzba Fakulteta organizacionih nauka</title>

<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<meta content="" name="description">
<meta content="" name="keywords">
<meta content="" name="author">

<link rel="shortcut icon" href="favicon.ico">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Pathway+Gothic+One|PT+Sans+Narrow:400+700|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">
<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="assets/pages/css/animate.css" rel="stylesheet">
<link href="assets/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
<link href="assets/pages/css/components.css" rel="stylesheet">
<link href="assets/pages/css/slider.css" rel="stylesheet">
<link href="assets/onepage/css/style.css" rel="stylesheet">
<link href="assets/onepage/css/style-responsive.css" rel="stylesheet">
<link href="assets/onepage/css/themes/turquoise.css" rel="stylesheet" id="style-color">
<link href="assets/onepage/css/custom.css" rel="stylesheet">
</head>
<body class="menu-always-on-top">


  <?php include 'meni.php'; ?>

    <div class="about-block content content-center" id="about">
        <div class="container">
            <h2><strong>Unos</strong> predmeta</h2>
            <form method="post" action="">

                  <label id="predmet">Predmet</label>
                    <input type="text" name="predmet" id="predmet" class="form-control">
                    <label for="submit"></label>
                    <input type="submit" value="Sacuvaj" name="sacuvaj" class="btn btn-primary margin-top-10">
              </form>
            <div id="rezultat"><?php echo $rezultat; ?></div>

        </div>
    </div>


    <?php include 'footer.php'; ?>

<script src="assets/plugins/jquery.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
<script src="assets/plugins/jquery.easing.js"></script>
<script src="assets/plugins/jquery.parallax.js"></script>
<script src="assets/plugins/jquery.scrollTo.min.js"></script>
<script src="assets/onepage/scripts/jquery.nav.js"></script>
<script src="assets/onepage/scripts/layout.js" type="text/javascript"></script>
<script src="assets/pages/scripts/bs-carousel.js" type="text/javascript"></script>
<script>
    jQuery(document).ready(function() {
        Layout.init();
    });
</script>

</body>
</html>
