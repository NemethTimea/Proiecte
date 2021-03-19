<?php
	session_start();
    error_reporting(E_ERROR);
    ini_set('display_errors', 1);
    include($cfg_main['path_inc'].'mysqli.php');

    function checkBuc($bucati, $db, $pid, $marime){
        $sql = "SELECT bucati FROM marimi WHERE idprodus = $pid and marime = '".$marime."'";
        $result = $db->query($sql);
        return $result[0]['bucati'];;
    }

	$titlu = 'InStepSHOES | Produs';
    $db = new MySQL();
    $_SESSION['id']=$_GET['id'];
    $_SESSION['poza']=$_GET['poza'];

    if (empty($_POST['Adauga'])){
        $_POST['Adauga']="";
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['Adauga'] == 'Adauga')/*$_POST['Adauga']=='Adauga')*/
    {
        if(isset($_SESSION['auth']['uname'])){
            $fanion = 0;
            $username = $_SESSION['auth']['uname'];
            $uid = (int)$_SESSION['id'];
            $marime = $_POST['marime'];

            if(empty($_SESSION['cos']))
            {
                $transaction = 0;
            }
            else
            {
                // $transaction = number of produse in cos
                $transaction = count($result);
                $sql = "SELECT * FROM incos WHERE username = '".$username."'";
                $result = $db->query($sql);
                foreach($result as $value)
                {
                    // CHECK IF PRODUS IS IN COS
                    if($value['uid'] == $_SESSION['id'] && $value['marime'] == $_POST['marime'])
                    {
                        // UPDATE TABLE incos HERE
                        //$_SESSION['cos'][$i]['bucati'] += $_POST['bucati'];
                        $buc = $_POST['bucati'];
                        if($buc >= 0){
                            $bucati = (int)$value['bucati'] + $buc;
                            $buc = checkBuc($bucati, $db, $uid, $marime);
                            if($buc <= $bucati){
                                $bucati = (int)$value['bucati'] + $buc - (int)$value['bucati'];
                            }
                            $uid = (int)$value['uid'];
                            $sql = "UPDATE incos SET bucati = $bucati where username = '".$username."' and uid = $uid";
                            $db->query($sql);
                        }
                        $fanion = 1;
                        break;
                    }
                }
            }
            // IF PRODUS NOT FOUND IN COS
            if ($fanion == 0)
            {
                // ADD TO TABLE incos HERE
                $transaction++;
                
                $pname = $_POST['nume'];
                $poza = $_POST['poza'];
                $price = (int)$_POST['pret'];
                $bucati = (int)$_POST['bucati'];
                $buc = checkBuc($bucati, $db, $uid, $marime);
                if($buc < $bucati){
                    $bucati = $buc;
                }
                $_SESSION['cos'][$transaction]['id'] = $uid;
                $_SESSION['cos'][$transaction]['nume'] = $pname;
                $_SESSION['cos'][$transaction]['poza'] = $poza;
                $_SESSION['cos'][$transaction]['pret'] = $price;
                $_SESSION['cos'][$transaction]['marime'] = $marime;
                $_SESSION['cos'][$transaction]['bucati'] = $bucati;
                $sql = "INSERT INTO incos(uid, username, nume, poza, pret, marime, bucati) VALUES($uid, '".$username."', '".$pname."', '".$poza."', $price, '".$marime."', $bucati)";
                $db->query($sql);
            }
        }
        else{
            header("location: ../autentificare/");
        }
    }

	$continut =
	'
		<div id="divcontinut"><br><br>
    ';
    
    $query = "SELECT * from categorii, produse where categorii.id = produse.categorie and produse.id = '".$_GET['id']."'";

    $data = $db->query($query);

    $query = "SELECT * from marimi where bucati > 0 and idprodus = '".$_GET['id']."'";

    $data1 = $db->query($query);

    $n_data1 = $db->fetched_rows();

    $continut .=
    '
    <center><table>
    ';
        $continut .=
            '
            <tr>
            <td width="600" height="600" align="center" valign="top">
                <div id="produs2">
            ';
            if (empty($_GET['poza'])) {
                $_GET['poza'] = ""; 
            }

        if ($_GET['poza']=='' || $_GET['poza']=='1')
            $continut .=
                '
                    <img id="pozaprodus" src="../imagini/'.$data[0]['poza'].'">
                ';
        else
            $continut .=
                '
                    <img id="pozaprodus" src="../imagini/'.$data[0]['poza2'].'">
                ';
        $continut .=
            '    
                 </div>
			</td>
			<td width="500" height="600" align="center" valign="top">

                    <form action=".?id='.$_SESSION['id'].'&poza='.$_SESSION['poza'].'" method="post"><table align="center" width="300">
                        <tr align="center">
                            <td colspan="2"><h1>'.$data[0]['nume'].'</h1><input type="hidden" name="nume" value="'.$data[0]['nume'].'"><input type="hidden" name="poza" value="'.$data[0]['poza'].'"><hr></td>
                        </tr>
            
             ';

            if(empty($n_data1) == false) {
                $continut .=
                    ' 
                       <tr align="left">
                            <td>
                                <p id="red1">'.$data[0]['pret'].' lei</p><input type="hidden" name="pret" value="'.$data[0]['pret'].'">
                            </td>
                            <td>
                                <p id="red2">In stoc</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><hr></td>
                            </tr>
                        <tr>
                            <td colspan="2">Optiuni disponibile:<br><br>
                    ';


                for ($i = 0; $i < $n_data1; $i++)
                {
                    $continut .=
                        '
                                <input type="radio" name="marime" value="' . $data1[$i]['marime'] . '"
                        ';

                    if($i==0)
                        $continut .= ' checked ';

                    $sql = "SELECT bucati FROM marimi WHERE marime = '".$data1[$i]['marime']."' AND idprodus = '".$_GET['id']."'";
                    $result = $db->query($sql);
                    $buc = $result[0]['bucati'];
                    $continut .=
                        '    
                        /><label> Marime:' . $data1[$i]['marime'] .' | Bucati: '.$buc.'</label><br>
                        ';
                };

                $continut .=
                    '
                               <hr>
                          </td>
                      </tr>
                    ';
                
                $continut .=
                    '            
                        <tr>
                          <td>Numar bucati:
                                <input type="number" name="bucati" value="1" size="1" min="1", max="30"/>
                          </td>
                          <td>
                                <p id="submit"><input type="submit" name="Adauga" value ="Adauga"/></p>
                          </td>
                      </tr>
                      <tr>
                      <td colspan="2"><hr></td>
                      </tr>
                    ';
            }
            else
            {
                $continut .=
                    ' 
                       <tr align="left">
                            <td>
                                <p id="red1">'.$data[0]['pret'].' lei</p>
                            </td>
                            <td>
                                <p id="red2">Lipsa stoc</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><hr></td>
                        </tr>
                    ';
            }

                $continut .=
                    '            
                        <tr>
                            <td width="150" height="250" align="center" valign="bottom">
                                <div id="produs3">
                                    <a href=".?id='.$_SESSION['id'].'&poza=1"><img id="pozaprodus2" src="../imagini/'.$data[0]['poza'].'"></a>
                                </div>
			                </td>
			                <td width="150" height="250" align="center" valign="bottom">
                                <div id="produs3">
                                    <a href=".?id='.$_SESSION['id'].'&poza=2"><img id="pozaprodus2" src="../imagini/'.$data[0]['poza2'].'"></a>
                                </div>
			                </td>
			            </tr>
                    ';

                $continut .=
                    '
                   </table></form>
                </td>
                </tr>			
	        ';

    $continut .=
    '
    </table></center>
    ';

    $continut .=
	'
		<br><br></div>
	';

	include($cfg_main['path_tema'].$cfg_main['tema'].'.php');

	$tema = new $cfg_main['tema']($titlu, $submeniu, $banner, $continut);

	$tema->prelucare();
	$tema->afisare();
