<?php

class Sluzbenik{
  public $sluzbenikID;
  public $imePrezime;
  public $username;
  public $password;
  public $uloga;


  function __construct($sluzbenikID,$imePrezime,$username,$password,$uloga) {
			$this->sluzbenikID = $sluzbenikID;
      $this->imePrezime = $imePrezime;
      $this->username = $username;
      $this->password = $password;
      $this->uloga = $uloga;
		}

    public static function ulogujMe($konekcija,$username,$password){
      $q = "SELECT * FROM sluzbenik s join uloga u on s.uloga = u.ulogaID where s.username='$username' AND s.password='$password' LIMIT 1";
      $r = $konekcija->query($q);

        while($row = $r->fetch_assoc()){
          $uloga = new Uloga($row['ulogaID'],$row['nazivUloge']);
          $sluzbenik= new Sluzbenik($row['sluzbenikID'],$row['imePrezime'],$row['username'],$row['password'],$uloga);
          $_SESSION['sluzbenik'] = $sluzbenik;
          return true;
        }

      return false;
    }


    function proveriAdministratora(){

      if($this->uloga != ""){
        if($this->uloga->nazivUloge == "Administrator"){
          return true;
        }
      }

      return false;
    }
}

 ?>
