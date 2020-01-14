<div class="header header-mobi-ext">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-2">
                <a class="scroll site-logo" href="#promo-block"><img src="assets/onepage/img/fonlogo.png" alt="Logo FONa"></a>
            </div>
            <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>
            <div class="col-md-10 pull-right">
                <ul class="header-navigation">
                    <li><a href="index.php">Pretraga prijava</a></li>
                    <li><a href="unesiPrijavu.php">Nova prijava</a></li>
                    <li><a href="pretragaPoStudentu.php">Pretraga po studentu</a></li>
                    <li><a href="unesiPredmet.php">Novi predmet</a></li>
                    <?php if($_SESSION['sluzbenik']->proveriAdministratora()){
                      ?>
                      <li><a href="adminStrane.php">Admin strane</a></li>
                      <?php
                    } ?>
                    <li><a href="randomSlikaSmirenje.php">Smiri se</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
