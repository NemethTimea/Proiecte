<?php
    session_start();

    include_once($cfg_main['path_inc'].'mysqli.php');
    include_once($cfg_main['path_inc'].'auth.php');

	$titlu = 'InStepSHOES | Autentificare';

	$submeniu = '';

  $banner ='';
  
  if (empty($_POST['kuldes2'])) {
    $_POST['kuldes2'] = ""; 
}

	if ($_POST['kuldes2']=='TRIMITE')
    {
        $db=new MySQL();
        $query='insert into utilizatori (tipus,nev,keresztnev,email,varos,megye,datum,fnev,kod) values("'.$_POST['radio'].'","'.$_POST['nev'].'","'.$_POST['knev'].'","'.$_POST['email'].'","'.$_POST['varos'].'","'.$_POST['megye'].'","'.$_POST['datum'].'","'.$_POST['fnev'].'","'.$_POST['kod'].'")';
        $data = $db->query($query);
    }
  
    if (empty($_POST['kuldes1'])) {
      $_POST['kuldes1'] = ""; 
  }
  

	if ($_POST['kuldes1']=='TRIMITE')
    {
        $auth = new BaseAuth();
        $auth->login($_POST['fnev1'],$_POST['kulcs1']);
        if ($auth->_auth()){
          $db=new MySQL();
          $fnev = $_POST['fnev1'];
          $query = "SELECT email FROM utilizatori WHERE fnev = '$fnev'";
          $result = $db->query($query);
          foreach($result as $s){
            $_SESSION['uemail'] = $s['email'];
          }
          if($_SESSION['uemail'] == "srh.nemeth@gmail.com"){
            $_SESSION['host'] = true;
          }
          header("Location:../acasa/");
        }
    }

	$continut =
  ' <link href="https://fonts.googleapis.com/css?family=Sofia" rel="stylesheet">
  <div id="divcontinut"><center>
     <table>';
	if ($_POST['kuldes2']!='TRIMITE')
    $continut .='
        <tr>
         <td id="sz">
         <p id="feliratkozom" style="font-family:Sofia;font-size:280%;text-align:center" >Mă înregistrez!</p>
         <p id="felirat" style="font-family:Sofia;font-size:130%;text-align:center" > Dacă dorești un cont nou atunci trebuie sa completezi formularul cu datele tale.
		 Cu contul tău poți comanda mai rapid și poți ține în evindență produsele pe care le-ai pus în coș.</p>
         <form method="post" action="./?f=kerveny"><input id="gomb" type="submit" name="gomb" value="URMĂTORUL"></form>
          </td>
     ';
    $continut .='
          <td>
          <fieldset id="fields">
   <form id="a" action="." method="post">
       <p id="feliratkozom" style="font-family:Sofia;font-size:280%;text-align:center"><u>Deja am cont </u>.  .  .</p>
          <p id="tipus" style="font-family:Sofia;font-size:180%"> Dacă ați mai cumpărat de la noi, atunci autentifică-te și comandă! </p><br>
        <table  style="font-size:140%;align:center">
          <tr>
            <td>
	          Nume utilizator:<br>
	        </td>
	        <td>
	           <input type="text" name="fnev1" placeholder="Cel puțin 6 litere!" style="text-align:center"><br>
	         </td>
	      </tr>
	      <tr>
	        <td>
	          Password:
	        </td>
	          <td> 
	            <input type="password" name="kulcs1" placeholder="Cel puțin 6 litere!" style="text-align:center">
                <input id="kuldes" type="submit" name="kuldes1" value="TRIMITE">
	         </td>
           </td>
          </tr>
		   </form>
		  
	</table>
<br><br><br><br><br><br>
</td>
</tr> 
</table></center>
</fieldset>
   </div>';

	include($cfg_main['path_tema'].$cfg_main['tema'].'.php');

	$tema = new $cfg_main['tema']($titlu, $submeniu, $banner, $continut);

	$tema->prelucare();
	$tema->afisare();
