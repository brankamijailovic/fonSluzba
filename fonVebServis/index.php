<?php
require 'flight/Flight.php';
require 'jsonindent.php';
//registracija baze Database
Flight::register('db', 'Database', array('sluzba'));

Flight::route('/', function(){
	die("Izabereti neku od ruta...");
});
Flight::route('GET /studenti', function()
{
	
	header("Content-Type: application/json; charset=utf-8");
	
	$db = Flight::db();
	$db->vratiStudente();
	$niz =  [];
	while ($red = $db->getResult()->fetch_object())
	{
		array_push($niz,$red);
	}
	echo indent(json_encode($niz));
});
Flight::route('GET /rokovi', function()
{
	
	$format=(isset($_SERVER['HTTP_ACCEPT'])&& $_SERVER['HTTP_ACCEPT']=="application/xml")?$_SERVER['HTTP_ACCEPT']:"application/json";
	header("Content-Type: ".$format."; charset=utf-8");
	$db = Flight::db();
	$db->vratiRokove();
	if($format=="application/json"){
		$niz =  [];
		while ($red = $db->getResult()->fetch_object())
		{
			array_push($niz,$red);
		}
	
		echo indent(json_encode($niz));
	}else{
		$dom = new DomDocument('1.0','utf-8');
		$rokovi = $dom->appendChild($dom->createElement('rokovi'));
		while ($red = $db->getResult()->fetch_object())
		{
			$rok=$rokovi->appendChild($dom->createElement('rok'));
			$id = $predmet->appendChild($dom->createElement('id'));
			$id->appendChild($dom->createTextNode($red->rokID));
			$naziv=$rok->appendChild($dom->createElement('naziv'));
			$naziv->appendChild($dom->createTextNode($red->nazivRoka));
			$godnia=$rok->appendChild($dom->createElement('skolskaGodina'));
			$godnia->appendChild($dom->createTextNode($red->skolskaGodina));
		}
		$xml_string = $dom->saveXML(); 
		echo $xml_string;
	}
	
});

Flight::route('GET /predmeti', function()
{
	$format=(isset($_SERVER['HTTP_ACCEPT'])&& $_SERVER['HTTP_ACCEPT']=="application/xml")?$_SERVER['HTTP_ACCEPT']:"application/json";
	header("Content-Type: ".$format."; charset=utf-8");
	
	$db = Flight::db();
	$db->vratiPredmete();

	$niz =  [];
	if($format=="application/json"){
		while ($red = $db->getResult()->fetch_object())
		{
			array_push($niz,$red);
		}
	
		echo indent(json_encode($niz));
	}else{
		$dom = new DomDocument('1.0','utf-8');
		$predmeti = $dom->appendChild($dom->createElement('predmeti'));
		while ($red = $db->getResult()->fetch_object())
		{
			$predmet=$predmeti->appendChild($dom->createElement('predmet'));
			$id = $predmet->appendChild($dom->createElement('id'));
			$id->appendChild($dom->createTextNode($red->predmetID));
			$naziv=$predmet->appendChild($dom->createElement('naziv'));
			$naziv->appendChild($dom->createTextNode($red->nazivPredmeta));
		}
		$xml_string = $dom->saveXML(); 
		echo $xml_string;
		
		
	}
});


Flight::route('POST /unesiPredmet', function()
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
	$podaci = file_get_contents('php://input');
	$niz = json_decode($podaci,true);
	$db->unesiNoviPredmet($niz);
	if($db->getResult())
	{
		$odgovorServera = "Uspesno";
	}
	else
	{
		$odgovorServera = "Greska";

	}

	echo indent(json_encode($odgovorServera));

});
Flight::route('PUT /unesiPredmet',function()
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
	$podaci = file_get_contents('php://input');
	$niz = json_decode($podaci,true);
	$db->izmeniPredmet($niz);
	if($db->getResult())
	{
		$odgovorServera = "Uspesno";
	}
	else
	{
		$odgovorServera = "Greska";

	}

	echo indent(json_encode($odgovorServera));
});
Flight::route('delete /unesiPredmet',function()
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
	$podaci = file_get_contents('php://input');
	$niz = json_decode($podaci,true);
	$db->obrisiPredmet($niz);
	if($db->getResult())
	{
		$odgovorServera = "Uspesno";
	}
	else
	{
		$odgovorServera = "Greska";

	}

	echo indent(json_encode($odgovorServera));

});

Flight::start();
?>
