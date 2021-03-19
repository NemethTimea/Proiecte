<?php
	session_start();

	$titlu = 'InStepSHOES | Contact';

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
    <p style="text-align:center;font-size:300%;font-family:Sofia" ><b>Ne puteți contacta... </b></p>
            <fieldset id="elerheto">
            <table cellspacing="50" cellpading="50">
               <tr>
                 <td><p id="cim">InStepsSHOES</p>
                 <p id="felirat1"> 
                   str. Sever Bocu, nr. 2, Timișoara, județtul Timiș</p> <br>
                   </td>
                   <td>
                   <p id="felirat"><b><u> Nr. de telefon:</u></b> <br>
                       0757899466</p><br>
                   </td>
                    <td>
                    <p id="felirat"><b><u>Deschis</u></b> <br>
                    Luni-Vineri : 10:00-20:00<br>
                    Sâmbătă: 10:00-19:00<br>
                    Duminică: ÎNCHIS</p><br>
                    </td>
               </tr>
           </table>
</fieldset>
 <fieldset id="elerheto">
            <table cellspacing="50" cellpading="50">
               <tr>
                 <td><p id="cim">InStepsSHOES Online Store</p>
                 <p id="felirat1"> 
                    str. Sever Bocu, nr. 2(la etaj)</p> <br>
                   </td>
                   <td>
                   <p id="felirat"><b><u> Nr. de telefon:</u></b> <br>
                       0757.899.466 - 07566.432.318</p><br>
                   </td>
                    <td>
                    <p id="felirat"><b><u>Deschis</u></b> <br>
                    Luni-Vineri : 10:00-20:00<br>
                    Sâmbătă: 10:00-19:00 <br>
                    Duminică: ÎNCHIS</p><br>
                    </td>
               </tr>
           </table>
</fieldset>
<fieldset id="elerheto">
            <table cellspacing="50" cellpading="50">
               <tr>
                 <td><p id="cim">InStepsSHOES Sovata</p>
                 <p id="felirat1"> 
                   str. Rose, nr. 89</p> <br>
                   </td>
                   <td>
                   <p id="felirat"><b><u> NR. de telefon:</u></b> <br>
                       0733256789</p><br>
                   </td>
                    <td>
                    <p id="felirat"><b><u>Deschis</u></b> <br>
                    Marți-Duminică : 10:00-18:00<br>
                    </p><br>
                    </td>
               </tr>
           </table>
</fieldset>
<fieldset id="elerheto">
            <table cellspacing="50" cellpading="50">
               <tr>
                 <td><p id="cim">Centrul comercial Galeria 1 Timișoara</p>
                 <p id="felirat1"> 
                   str. Sever Bocu, nr. 2 (Etaj)</p> <br>
                   </td>
                   <td>
                   <p id="felirat"><b><u> Nr. de telefon:</u></b> <br>
                       0757.899.466 - 07566.432.318</p><br>
                   </td>
                    <td>
                    <p id="felirat"><b><u>Deschis</u></b> <br>
                    Luni-Vineri : 10:00-20:00<br>
                    Sâmbătă: 10:00-19:00</p><br>
                    </td>
               </tr>
           </table>
</fieldset>
		</div>
	';

	include($cfg_main['path_tema'].$cfg_main['tema'].'.php');

	$tema = new $cfg_main['tema']($titlu, $submeniu, $banner, $continut);

	$tema->prelucare();
	$tema->afisare();
