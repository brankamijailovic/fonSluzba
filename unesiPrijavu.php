<?php
  include './server/glavnaSesija.php';
  include './server/konekcija.php';
  $rezultat = "";

  if(isset($_POST['sacuvaj'])){
    $predmet = $_POST['predmet'];
    $student = $_POST['student'];
    $rok = $_POST['rok'];
    $sluzbenik = $_SESSION['sluzbenik']->sluzbenikID;

    if($konekcija->query("INSERT INTO prijava(rokID,predmetID,brojIndeksa,sluzbenikID) VALUES ($rok,$predmet,'$student',$sluzbenik)")){
      $rezultat = "Uspesno prijavljen";
    }else{
      $rezultat = "Neuspesno prijavljen";
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
            <h2><strong>Unos</strong> prijave</h2>
            <form method="post" action="">
              <label id="rok">Rok</label>
                <select name="rok" id="rok" class="form-control" name="rok">
                  <?php
                  $zahtev = curl_init("http://localhost/fonsluzba/fonVebServis/rokovi");
            			curl_setopt($zahtev, CURLOPT_RETURNTRANSFER, true);
            			$json = curl_exec($zahtev);
            			$podaci = json_decode($json);
            			curl_close($zahtev);


                      //$q ="SELECT * FROM rok";
                      //$rez = $konekcija->query($q);
                      //while($row = $rez->fetch_assoc()){
                      foreach($podaci as $row){
                        ?>
                        <option value="<?php echo $row->rokID ?>"><?php echo $row->nazivRoka ?> </option>
                        <?php
                      }
                   ?>
                </select>
                <label id="student">Student</label>
                  <select name="student" id="student" class="form-control" name="student">
                    <?php
                    $zahtev = curl_init("http://localhost/fonsluzba/fonVebServis/studenti");
                    curl_setopt($zahtev, CURLOPT_RETURNTRANSFER, true);
                    $json = curl_exec($zahtev);
                    $podaci = json_decode($json);
                    curl_close($zahtev);
                        foreach($podaci as $row){
                          ?>
                          <option value="<?php echo $row->brojIndeksa ?>"><?php echo $row->imePrezimeStudenta ?> </option>
                          <?php
                        }
                     ?>
                  </select>
                  <label id="predmet">Predmet</label>
                    <select name="predmet" id="predmet" class="form-control" name="predmet">
                      <?php
                      $zahtev = curl_init("http://localhost/fonsluzba/fonVebServis/predmeti");
                      curl_setopt($zahtev, CURLOPT_RETURNTRANSFER, true);
                      $json = curl_exec($zahtev);
                      $podaci = json_decode($json);
                      curl_close($zahtev);
                          foreach($podaci as $row){
                            ?>
                            <option value="<?php echo $row->predmetID ?>"><?php echo $row->nazivPredmeta ?> </option>
                            <?php
                          }
                       ?>
                    </select>
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
