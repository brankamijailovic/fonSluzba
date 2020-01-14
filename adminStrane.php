<?php
  include 'glavnaSesija.php';
  include 'konekcija.php';
  $rezultat = "";
  $rezultatIzmena = "";
  if(isset($_POST['sacuvaj'])){
    $student = $_POST['student'];
    $broj = $_POST['broj'];
    $telefon = $_POST['telefon'];
    $datum = $_POST['datum'];

    if($konekcija->query("INSERT INTO student(brojIndeksa,imePrezimeStudenta,brojTelefona,datumRodjenja) VALUES ('$broj','$student','$telefon','$datum')")){
      $rezultat = "Uspesno unet student";
    }else{
      $rezultat = "Neuspesno unet student";
    }
  }

  if(isset($_POST['izmeni'])){
    $prijava = $_POST['prijava'];
    $ocena = $_POST['ocena'];
    $nizIDa = explode("_",$prijava);
    $brIndeksa = $nizIDa[0];
    $prID = $nizIDa[1];
    $rID = $nizIDa[2];

    if($konekcija->query("UPDATE prijava set ocena =  $ocena where brojIndeksa = '$brIndeksa' and predmetID=$prID and rokID=$rID")){
      $rezultatIzmena = "Uspesno promenjena ocena";
    }else{
      $rezultatIzmena = "Neuspesno promenjena ocena";
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
</head>
<body class="menu-always-on-top">


  <?php include 'meni.php'; ?>

    <div class="about-block content content-center" id="about">
        <div class="container">
            <h2><strong>Unos</strong> studenta</h2>
            <form method="post" action="">
              <label for="broj">Broj indeksa</label>
                <input type="text" name="broj" id="broj" class="form-control">
              <label for="student">Student</label>
                <input type="text" name="student" id="student" class="form-control">
                <label for="telefon">Telefon</label>
                  <input type="text" name="telefon" id="telefon" class="form-control">
                  <label for="datum">Datum rodjenja</label>
                    <input type="text" name="datum" id="datum" class="form-control datepicker">
                <label for="submit"></label>
                <input type="submit" value="Sacuvaj studenta" name="sacuvaj" class="btn btn-primary margin-top-10">
              </form>
            <div id="rezultat"><?php echo $rezultat; ?></div>
            <h2 class="margin-top-10"><strong>Izmena</strong> ocene</h2>
            <form method="post" action="">
              <label for="prijava">Prijava</label>
              <select name="prijava" id="prijava" class="form-control" name="prijava">
                <?php
                    $q ="SELECT * FROM prijava p join predmet pre on p.predmetID = pre.predmetID join student s on p.brojIndeksa=s.brojIndeksa join rok r on p.rokID=r.rokID join sluzbenik sl on p.sluzbenikID = sl.sluzbenikID";
                    $rez = $konekcija->query($q);
                    while($row = $rez->fetch_assoc()){
                      ?>
                      <option value="<?php echo $row['brojIndeksa'] ?>_<?php echo $row['predmetID'] ?>_<?php echo $row['rokID'] ?>"><?php echo $row['imePrezimeStudenta'] ?> - <?php echo $row['nazivPredmeta'] ?> - <?php echo $row['nazivRoka'] ?> - <?php echo $row['ocena'] ?> </option>
                      <?php
                    }
                 ?>
              </select>
                <label for="ocena">Ocena</label>
                  <input type="text" name="ocena" id="ocena" class="form-control">

                <label for="submit"></label>
                <input type="submit" value="Izmeni ocenu" name="izmeni" class="btn btn-primary margin-top-10">
              </form>
            <div id="rezultat"><?php echo $rezultatIzmena; ?></div>
            <h1>Pregled prijava</h1>
            <table id="prijave" class="table table-hover">
              <thead>
                <tr>
                  <th>Broj indeksa</th>
                  <th>Student</th>
                  <th>Predmet</th>
                  <th>Rok</th>
                  <th>Ocena</th>
                  <th>Datum prijave</th>
                  <th>Sluzbenik</th>
                  <th>Brisanje</th>
                </tr>
              </thead>
              <tbody>
                <?php
                    $rez = $konekcija->query("SELECT * FROM prijava p join predmet pre on p.predmetID = pre.predmetID join student s on p.brojIndeksa=s.brojIndeksa join rok r on p.rokID=r.rokID join sluzbenik sl on p.sluzbenikID = sl.sluzbenikID");
                    while($row = $rez->fetch_assoc()){
                      ?>
                      <tr>
                        <td><?php echo $row['brojIndeksa'] ?></td>
                        <td><?php echo $row['imePrezimeStudenta'] ?></td>
                        <td><?php echo $row['nazivPredmeta'] ?></td>
                        <td><?php echo $row['nazivRoka'] ?></td>
                        <td><?php echo $row['ocena'] ?></td>
                        <td><?php echo $row['datumPrijave'] ?></td>
                        <td><?php echo $row['imePrezime'] ?></td>
                        <td><a href="obrisiPrijavu.php?brojIndeksa=<?php echo $row['brojIndeksa'] ?>&predmetID=<?php echo $row['predmetID'] ?>&rokID=<?php echo $row['rokID'] ?>" class="btn btn-danger"><i class="fa fa-times"></i> Obrisi</a></td>
                      </tr>

                      <?php
                    }
                 ?>
              </tbody>
            </table>
            <h1>Ubaci raspored</h1>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                Ubaci raspored
                <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
                <input type="submit" class="form-control btn-primary margin-top-10" value="Ubaci raspored" name="submit">
            </form>
            <h1>Vizuelni podaci</h1>
            <div id="piechart" style="width: 900px; height: 500px;"></div>
            <h1>Google mapa Fona</h1>
            <div id="mapa" style="height: 600px;"></div>


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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script>
    jQuery(document).ready(function() {
        Layout.init();
    });
</script>
<script>
  $( function() {
    $( "#datum" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
  </script>
  <script>

    $(document).ready(function(){
        $('#prijave').DataTable();
    });
  </script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var podaci;
        $.ajax({
          url: "vratiPodatkeGrafik.php",
          success: function(json){
            podaci = JSON.parse(json);
            var data = google.visualization.arrayToDataTable(podaci);

            var options = {
              title: 'Broj prijava po predmetu',
              is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
          }
        })


      }
    </script>
  
</body>
</html>
