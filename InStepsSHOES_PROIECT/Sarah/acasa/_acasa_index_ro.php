<?php
	session_start();

    include($cfg_main['path_inc'].'mysqli.php');

	$titlu = 'InStepSHOES | Acasa';

	$submeniu =
	'
		<div id="divmeniufiltru">
			<a href="../acasa/?filter=klein"><img id="calvienklein" src="../imagini/calvinklein.jpg"></a>
			<a href="../acasa/?filter=adidas"><img id="adidas" src="../imagini/adidas.png"></a>
			<a href="../acasa/?filter=nike"><img id="nike" src="../imagini/nike.png"></a>
			<a href="../acasa/?filter=newbalance"><img id="newbalance" src="../imagini/newbalance.png"></a>
			<a href="../acasa/?filter=puma"><img id="puma" src="../imagini/puma.png"></a>
			<a href="../acasa/?filter=converse"><img id="converse" src="../imagini/converse.jpg"></a>
		</div>
	';

	$banner =
	'
		<div id="banner">
  			<img id="banner" src="../imagini/banner.png">
		</div>
	';

	$continut =
	'
		<div id="divcontinut">
	';
    
    $db = new MySQL();
    if (empty($_GET['cat'])){
        $_GET['cat'] = "";
    }
    if ($_GET['cat']=='')

        $query = "SELECT * from Produse where nou = 1";

    else

        $query = "SELECT * from categorii, produse where categorii.id = produse.categorie and categorii.nume = '".$_GET['cat']."'";
    if (empty($_GET['filter'])) {
        $_GET['filter'] = "";
    }

    if ($_GET['filter']!='')

    $query = "SELECT * from categorii, produse where categorii.id = produse.categorie and produse.nume like '%".$_GET['filter']."%'";
    
    if(empty($_POST['cauta'])){
        $_POST['cauta'] = "";
    }
    if ($_POST['cauta']!='')

    $query = "SELECT * from categorii, produse where categorii.id = produse.categorie and produse.nume like '%".$_POST['cautare']."%'";

    $data = $db->query($query);
    
    $n_data = $db->fetched_rows();

    $continut .=
    '
    <table>
    ';

    $fanion = false;

    for ($i=0; $i<$n_data; $i++) {

        if ($i%3 == 0) {
            $continut .= '<tr>';
            $fanion = true;
        }
        $continut .=
            '
            <td width="400" height="450" align="center">
                <div id="produs">
                <img id="pozaprodus" src="../imagini/'.$data[$i]['poza'].'">
                    <div id="descriereprodus"style="font-family:Sofia;font-size:130%">'.$data[$i]['nume'].'</div>
                    <div id="pretprodus">
                        <table align="center">
                            <tr align="center">
                                <td width="60" style="font-family:Sofia;font-size:120%"><p id="feher">'.$data[$i]['pret'].' lei </p></td>
                                <td><a href="../produs/?id='.$data[$i]['id'].'"><img src="../imagini/cart.png" height="10" width="30"></a></td>
                            </tr>
                        </table>
                    </div>
                </div>
			</td>
			
	    ';
        if ($i%3==2){
            $continut .='</tr>';
            $fanion = false;
        }
    }

    if ($fanion == true)
        $continut .='</tr>';

    $continut .=
    '
    </table>
    ';

    $continut .=
	'
		</div>
	';

	include($cfg_main['path_tema'].$cfg_main['tema'].'.php');

	$tema = new $cfg_main['tema']($titlu, $submeniu, $banner, $continut);

	$tema->prelucare();
	$tema->afisare();
