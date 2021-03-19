<?php 

    include('../inc/mysqli.php');

    function getmarime($mar){
        $m = 'S';
        switch($mar){
            case 38:
                $m = 'M';
                break;
            case 39:
                $m = 'L';
                break;
            case 40:
                $m = 'XL';
                break;
            default:
                $m = 'S';
        }
        return $m;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $db = new MySQL();
        $numeprodus = $_POST['nume'];
        $pret = (int)$_POST['pret'];
        $bucati = (int)$_POST['bucati'];
        $categorii = (int)$_POST['categorii'];
        $marime = getmarime($_POST['marime']);
        $nou = $_POST['nou'] == 'on' ? 1 : 0;
        $query = "SELECT id from produse where nume = '".$numeprodus."' LIMIT 1";
        $result = $db->query($query);
        $id = -1;
        if($result){
            foreach($result as $vl){
                $id = $vl['id'];
            }
        }
        if($id == -1){
            $p1name = basename($_FILES["poza1"]["name"]);
            $p2name = basename($_FILES["poza2"]["name"]);
            echo $p1name. ' ' . $p2name;
            $target_dir = "../imagini/";
            $target_file = $target_dir . basename($_FILES["poza1"]["name"]);
            $target_file2 = $target_dir . basename($_FILES["poza2"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $imageFileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));
    
            // Allow certain file formats
            if($imageFileType != "jpg" || $imageFileType2 != "jpg" ) { 
                    $uploadOk = 0;
            }
    
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["poza1"]["tmp_name"], $target_file) && move_uploaded_file($_FILES["poza2"]["tmp_name"], $target_file2)) {
                    echo "The files has been uploaded.";
                    $query = "INSERT INTO produse (categorie, nume, pret, poza, poza2, nou) VALUES
                    (".$categorii.", '$numeprodus', $pret , '".$p1name."', '".$p2name."', $nou)";
                    $data = $db->query($query);
                    if($data){
                        $query = "SELECT id from produse where nume = '$numeprodus'";
                        $result = $db->query($query);
                        if($result){
                            foreach($result as $vl){
                                $id = $vl['id'];
                            }
                        }
                        $query = "INSERT INTO marimi (idprodus, marime, bucati) VALUES(".$id.", '".$marime."', $bucati)";
                        $result = $db->query($query);
                        if($result){
                            header('Location: adaugareprodus.php');
                        }
                        else{
                            echo "CEVA E GRESIT";
                        }
                    }
                    else{
                        echo "NU AM REUSIT SA INCARC IN TABELA!";
                    }
    
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
        else{
            $buc = -1;
            $query = "SELECT bucati from marimi where idprodus = ".$id." and marime = '".$marime."'";
            $result = $db->query($query);
            if($result){
                foreach($result as $v){
                    $buc = $v['bucati'];
                }
            }
            if($buc != -1){
                $bucati += $buc;
                $query = "UPDATE marimi SET bucati = ".$bucati." where idprodus = ".$id." and marime = '".$marime."'";
                $result = $db->query($query);
                if($result){
                    header('Location: adaugareprodus.php');
                }
            }
            else{
                echo "CEVA NU E BINE";
            }
        }
    }
    
    ?>