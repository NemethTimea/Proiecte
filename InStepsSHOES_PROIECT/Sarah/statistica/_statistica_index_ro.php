<?php
include_once($cfg_main['path_inc'].'mysqli.php');

	session_start();

	$titlu = 'InStepSHOES | Statistica';

	$submeniu = '
	<div id="divmeniufiltru">
			<a href="../acasa/?filter=klein"><img id="calvienklein" src="../imagini/calvinklein.jpg"></a>
			<a href="../acasa/?filter=adidas"><img id="adidas" src="../imagini/adidas.png"></a>
			<a href="../acasa/?filter=nike"><img id="nike" src="../imagini/nike.png"></a>
			<a href="../acasa/?filter=newbalance"><img id="newbalance" src="../imagini/newbalance.png"></a>
			<a href="../acasa/?filter=puma"><img id="puma" src="../imagini/puma.png"></a>
			<a href="../acasa/?filter=converse"><img id="converse" src="../imagini/converse.jpg"></a>
		</div>
	';

	$banner = '';

	$continut =
	'
        <div id="divcontinut">
        	<link href="https://fonts.googleapis.com/css?family=Sofia" rel="stylesheet">
       		<p style="text-align:center;font-size:300%;font-family:Sofia;color:black;text-shadow:1px 1px 2px black" ><u><b>Top 5 cele mai vândute pantofi! </b></u></p>
			<center><table border="1" width="90%">
			<tr style="font-size:2vw;">
				<th style="border:none"></th><th>Poza produs</th><th>Nume produs</th><th>Pret unitar</th>
			</tr>
		
	';

	function integerToRoman($integer)
	{
	 // Convert the integer into an integer (just to make sure)
	 $integer = intval($integer);
	 $result = '';
	 
	 // Create a lookup array that contains all of the Roman numerals.
	 $lookup = array('M' => 1000,
	 'CM' => 900,
	 'D' => 500,
	 'CD' => 400,
	 'C' => 100,
	 'XC' => 90,
	 'L' => 50,
	 'XL' => 40,
	 'X' => 10,
	 'IX' => 9,
	 'V' => 5,
	 'IV' => 4,
	 'I' => 1);
	 
	 foreach($lookup as $roman => $value){
	  // Determine the number of matches
	  $matches = intval($integer/$value);
	 
	  // Add the same number of characters to the string
	  $result .= str_repeat($roman,$matches);
	 
	  // Set the integer to be the remainder of the integer and the value
	  $integer = $integer % $value;
	 }
	 
	 // The Roman numeral should be built, return it
	 return $result;
	}


	$db = new MySQL();
	$query = "SELECT * FROM vanzari ORDER BY numar DESC";
	$data = $db->query($query);
	$n_data = $db->fetched_rows();
	$i = 0 ;

	foreach($data as $value){
		if($i == 5){
		break;
		}
		$numeprod = $value['numeprodus'];
		$query = "SELECT pret,poza FROM produse WHERE nume = '$numeprod' limit 1";
		$result = $db->query($query);

		foreach($result as $s){
			$poza = $s['poza'];
			$pret = $s['pret'];
			$continut .= '
			<tr align="center">
				<td style="font-size:2vw;border:none;font-family:Sofia;" > '.integerToRoman($i+1).'. </td><td> <div id="produs3"><img id="pozaprodus2" src="../imagini/' .$poza. '"></div></td><td>' .$numeprod. '</td><td>' .$pret. ' lei</td>
			</tr>
			';
		}
		$i++;
	}
	$continut .='
		</table>
		</div>
	';


	include($cfg_main['path_tema'].$cfg_main['tema'].'.php');

	$tema = new $cfg_main['tema']($titlu, $submeniu, $banner, $continut);

	$tema->prelucare();
	$tema->afisare();
