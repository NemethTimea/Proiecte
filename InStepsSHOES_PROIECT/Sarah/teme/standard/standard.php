<?php
include_once($cfg_main['path_inc'].'mysqli.php');

if(empty($_GET['logout'])){
    $_GET['logout'] = "";
}
if ($_GET['logout'] == 'ok')
    unset($_SESSION['auth']);

class standard
{
    private $titlu='';

    private $submeniu='';

    private $banner='';

    protected $continut='';

    private $pagina='';

    protected $n_prod = 0;

    public function __construct($titlu='', $submeniu='', $banner='', $continut='')
    {
        $this->titlu = $titlu;
        $this->submeniu = $submeniu;
        $this->banner = $banner;
        $this->continut = $continut;
    }

    function prelucare()
    {

        $db = new MySQL();

        $query = "SELECT * from categorii";

        $data = $db->query($query);

        $n_data = $db->fetched_rows();
        $username = '';
        //$result = array();
        if(isset($_SESSION['auth']['uname'])){
            $username = $_SESSION['auth']['uname'];
        }
        $pret = 0;
        if($username != ''){
            $sql = "SELECT * FROM incos WHERE username = '".$username."'";
            $result = $db->query($sql);
            if($result){
                if(!empty($result) && gettype($result) != "boolean"){
                    foreach($result as $value){
                        $this->n_prod += $value['bucati'];
                        $pret += $value['pret'] * $value['bucati'];
                    }
                }
            }
        }

        /*if (empty($_SESSION['cos']))
            $transactions = 0;
        else
            $transactions = count($_SESSION['cos']);

        for ($i=1;$i<=$transactions;$i++)
        {
            $n_prod += $_SESSION['cos'][$i]['bucati'];
            $pret += $_SESSION['cos'][$i]['bucati'] * $_SESSION['cos'][$i]['pret'];
        }*/
        $this->pagina = '
        
        <html lang="ro">
            <head>
                <link rel="stylesheet" type="text/css" href="../teme/standard/stil.css">
                <link href="https://fonts.googleapis.com/css?family=Sofia" rel="stylesheet">
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>'.$this->titlu.'</title>
            </head>
            
            <body bgcolor="#a9a9a9">
        
                <div id="divantet">
	                <div id="divsubantet">
	                    <a href="../acasa/"> <img id="logo" src="../imagini/Logo.png" ></a>
  	                </div>
                    <div id="divsubantet">
		                <table align="right">
			                <tr align="center">
                            ';
        if(isset($_SESSION['host'])){
            if($_GET['logout'] != 'ok'){

                $this->pagina .= '
                
                <td width="150px" height="150px">
                    <form method="POST" action="adaugareprodus.php"  style="width:100%; height:30%; background:lightgreen; margin-top:20%;">
                        <input type = "submit" name="adauga" value="ADAUGA"   style="width:100%; height:100%; background:lightgreen; font-weight:bold; font-size:120% ">
    
                    </form>
                </td>
                
                ';

            }
            else{
                unset($_SESSION['host']);
            }
        }
        
        
        if (empty($_SESSION['auth']['status'])){
            $_SESSION['auth']['status'] = "";
        }


        if ($_SESSION['auth']['status']){
            $this->pagina .='   <td width="150" height="150"  style="font-family:Sofia;font-size:120%"><a href="../acasa/test.php">Logout</a><br>'.$_SESSION['auth']['nume'].'</td>';
            $this->pagina .= '<td><a href="../cos/"> <img src="../imagini/cart.png" height="40" id = "cos"></a></td>';
            $this->pagina .= '<td  style="font-family:Sofia;font-size:100%"><a href="../cos/" style="font-family:Sofia;font-size:130%"> Coșul de cumpărături</a><br>'.$this->n_prod.' produse - '.$pret.' lei</td>';
        }
        else{
            $this->pagina .='   <td width="150" height="150"><a href="../autentificare/"style="font-family:Sofia;font-size:130%">Autentificare</a></td>';
            $this->pagina .= '<td><a href="../autentificare/"> <img src="../imagini/cart.png" height="40" id = "cos"></a></td>';
            $this->pagina .= '<td  style="font-family:Sofia;font-size:100%"><a href="../autentificare/" style="font-family:Sofia;font-size:130%"> Coșul de cumpărături</a><br>'.$this->n_prod.' produse - '.$pret.' lei</td>';
        }
        $this->pagina .= '
			                </tr>
		                </table>
  	                </div>
                </div> 
                
                <div id="divmeniu">
	                <div id="divsubmeniu1">
		                <ul style="font-family:Sofia;font-size:120%">
			                <li><a href="../acasa/">Home</a></li>
			                <li class="dropdown">
				                <a href="javascript:void(0)" class="dropbtn">Produse</a>
				                    <div class="dropdown-content">
        ';
		for ($i=0;$i<$n_data;$i++)
        {
            $this->pagina .= '<a href="../acasa/?cat='.$data[$i]['nume'].'">'.$data[$i]['nume'].'</a>';
        }

        $this->pagina .= '
				                    </div>
			                </li>
                            <li><a href="../contact/">Ne puteți contacta...</a></li>
                            <li><a href="../statistica/">Statistică</a></li>
		                </ul>
	                </div>
	                <div id="divsubmeniu2" style="width:30%">
	                    <form action="." method="post" >
	                        <input type="text" name="cautare" placeholder="Ce cauți?">
	                        <input type="submit" name="cauta" value="Caută!">
                        </form>
                    </div>                  
                </div>
                
                '.$this->submeniu.'
                '.$this->banner.'
                '.$this->continut.'
                                
                <div id="divsubsol">
                    <hr>
                </div>
         
            </body>
        </html>

        ';
    }

    function afisare()
    {
        print $this->pagina;
    }
}
