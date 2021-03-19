<?php
include_once($cfg_main['path_inc'].'mysqli.php');


    require '../mail/index.php';
   // include 'C:/xampp/htdocs/Sarah/autentificare/autentificare_index_ro.php';
	session_start();
	$titlu = 'InStepSHOES | Cos';

	$submeniu = '';

    $banner = '';

    $pozanume = array();

    $username = $_SESSION['auth']['uname'];
    $db = new MySQL();
    
    if (empty($_POST['finalizare'])) {
        $_POST['finalizare'] = ""; 
    }
    
	if (!empty($_GET['tr']) && $_GET['tr'] != '')
    {
        $_SESSION['cos'][$_GET['tr']]['bucati'] = 0;
        $uid = $_GET['uid'];
        $sql = "DELETE FROM incos WHERE username = '".$username."' and uid = $uid";
        $db->query($sql);
        header("location: .");
    }
    $prettotal = 0;
	$fanion = 0;
    $inmail = 
    '
        <div id="divcontinut"><br><br>
        <img src="cid:logo" style="margin-left:30%; width:40%; height:25%;" >
             <center><table border ="1" width="90%">
    ';
	$continut =
	'
		<div id="divcontinut"><br><br>
             <center><table border ="1" width="90%">
    ';

    $sql = "SELECT * FROM incos WHERE username = '".$username."'";
    $result = $db->query($sql);
	if (empty($result))
	{
        $n_prod = 0;
    }
	else
    {
	    $n_prod = count($result);
        $continut .=
            '    
                        <tr>
                            <th>Nume produs</th><th>Poza produs</th><th>Pret unitar</th><th>Numar bucati</th><th>Marime</th><th>Actiune</th>
                        </tr>
            ';
        $inmail .= 
        '    
        <tr>
        <th style="border:0;"></th><th>Nume produs</th><th>Pret unitar</th><th>Numar bucati</th><th>Marime</th>
        </tr>
';
    }
    $i = 1;
	foreach ($result as $value)
    {
        if ($value['bucati'] > 0)
        {
            $prettotal = $prettotal + ($value['pret'] * $value['bucati']);
            $fanion = 1;
            $continut .=
                '    
                    <tr align="center">
                        <td>' . $value['nume'] . '</td><td> <div id="produs3"><img id="pozaprodus2" src="../imagini/' . $value['poza'] . '"></div></td><td>' . $value['pret'] . ' lei</td><td>' . $value['bucati'] . '</td><td>' . $value['marime'] . '</td><td><a href =".?tr=' . $i . '&uid='.$value['uid'].'">Sterge</a></td>
                    </tr>
                ';
            $inmail .=
            '    
            <tr align="center">
            <td><img style="width:60px; height:40px;", src="cid:poza'.strval($i - 1).'"></td><td>' . $value['nume'] . '</td><td>' . $value['pret'] . ' lei</td><td>' . $value['bucati'] . '</td><td>' . $value['marime'] . '</td>
            </tr>
            ';
            array_push($pozanume,$value['poza']);
        }
        $i++;
    }

    $inmail .=
    '
    </table>
    <link href="https://fonts.googleapis.com/css?family=Sofia" rel="stylesheet">
    <b><h1 style ="font-family: Sofia"> Pretul total: '.$prettotal.' lei </h1></b>
    </center>
    </div>
    ';
  /*  if(count($pozanume) != 0){
        $_SESSION['pozanume'] = $pozanume;
    }*/
    
    $_SESSION['continut'] = $inmail;
    if($_POST['finalizare']=='Finalizeaza comanda')
    {
        if ($_SESSION['auth']['status']){
            $db = new MySQL();
            $sql = "SELECT * FROM incos WHERE username = '".$username."'";
            $result = $db->query($sql);
            foreach($result as $v){
                $uid = $v['uid'];
                $marime = trim($v['marime']);
                $sql = "SELECT bucati FROM marimi WHERE idprodus = $uid AND marime = '".$marime."'";
                $r2 = $db->query($sql);
                $bucati = -1;
                foreach($r2 as $v2){
                    $bucati = $v2['bucati'] - $v['bucati'];
                    $bucati = $bucati < 0 ? 0 : $bucati;
                    if($bucati == 0){
                        // NOTIFY THE ADMINISTRATOR THAT THE PRODUS IS OUT OF STOCK
                    }
                }
                $sql = "UPDATE marimi SET bucati = $bucati WHERE idprodus = $uid AND marime = '".$marime."'";
                $db->query($sql);
            }
            trimitemail($_SESSION['uemail'], 'Sarah', $_SESSION['continut'], $pozanume);

            $sql = "DELETE FROM incos where username = '".$username."'";
            $db->query($sql);
            
            for($i = 0; $i < $n_prod ; $i++){
                $nume = $_SESSION['cos'][$i + 1]['nume'];
                $bucati = $_SESSION['cos'][$i + 1]['bucati'];
                $query = "SELECT * FROM vanzari WHERE numeprodus = '".$nume."'";
                $data = $db->query($query);
                $n_data = $db->fetched_rows();
                if($n_data > 0){
                    $numar = $bucati + $data[0]['numar'];
                    $query = "UPDATE vanzari SET numar = ".$numar." WHERE numeprodus = '".$nume."'";
                    $data = $db->query($query);
                }
                else{
                    if($nume != "" &&  $bucati > 0){
                        $query = "INSERT INTO vanzari (numeprodus,numar) values ('".$nume."', ".$bucati.")";
                        $data = $db->query($query);
                        if($data){
                            echo "AR TREBUI SA MEARGA";
                        }
                    }
                 }
            }
            unset($_SESSION['cos']);
            header("Location:../acasa/");

        }
        else{
            header("Location:../autentificare/");
        }
    }
    $continut .=
    '
              </table>
              <form method="post" action="."><br><input type="submit" name="finalizare" value="Finalizeaza comanda"></form>

              </center>
              <br><br>
		</div>
	';

	if ($fanion==0)
    {
       header("Location: ../acasa/");
    }

    include($cfg_main['path_tema'].$cfg_main['tema'].'.php');
	$tema = new $cfg_main['tema']($titlu, $submeniu, $banner, $continut);

	$tema->prelucare();
	$tema->afisare();
