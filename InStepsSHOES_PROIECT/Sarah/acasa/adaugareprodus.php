<?php

    if($_SERVER["REQUEST_METHOD"] == "POST" || $_SESSION['host']){
        echo "
        <fieldset style = 'margin-top: 1% ; margin-left:40%; width:30%; font-size:160%;'>
        <form method=POST action='adauga.php' style='display:inline-block;' enctype='multipart/form-data'>
            Nume produs: <input type = 'text' required name = 'nume'><br><br>
            Poza1 URL: <input type  = 'file' required name = 'poza1'><br><br>
            Poza2 URL: <input type  = 'file' required name = 'poza2'><br><br>
            Pret: <input type = 'number' min = '1' required name = 'pret'><br><br>
            Categorii: <input type = 'number' min = '1' max = '3' required name = 'categorii'><br><br>
            Marime: <input type = 'number' min = '37' max = '40' required name = 'marime'><br><br>
            Bucati: <input type = 'number' min = '1' max = '1000' required name = 'bucati'><br><br>
            <input type = 'checkbox' name = 'nou'> NOU <br><br>
            <input type = 'submit' name = 'trimite' value = 'ADAUGA'>
            <a href='../' style='float:right;'> INAPOI </a>
            </form>
            </fieldset>
        ";
    }
    else{
        header('Location: ../acasa/');
    }
    
?>

