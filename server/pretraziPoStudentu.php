<?php
include 'glavnaSesija.php';
include 'konekcija.php';

$id = $_GET['id'];
$id = $konekcija->real_escape_string($id);
if($id == "0"){
  $q = "SELECT * FROM prijava p join predmet pre on p.predmetID = pre.predmetID join student s on p.brojIndeksa=s.brojIndeksa join rok r on p.rokID=r.rokID join sluzbenik sl on p.sluzbenikID = sl.sluzbenikID";
}else{
  $q = "SELECT * FROM prijava p join predmet pre on p.predmetID = pre.predmetID join student s on p.brojIndeksa=s.brojIndeksa join rok r on p.rokID=r.rokID join sluzbenik sl on p.sluzbenikID = sl.sluzbenikID where s.brojIndeksa='$id'";
}


 ?>
<table class="table table-hover">
  <thead>
    <tr>
      <th>Broj indeksa</th>
      <th>Student</th>
      <th>Predmet</th>
      <th>Rok</th>
      <th>Ocena</th>
      <th>Datum prijave</th>
      <th>Sluzbenik</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $rez = $konekcija->query($q);
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
          </tr>

          <?php
        }
     ?>
  </tbody>
</table>
