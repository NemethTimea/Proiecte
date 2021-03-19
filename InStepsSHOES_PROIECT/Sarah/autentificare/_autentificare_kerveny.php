<?php
session_start();

$titlu = 'InStepSHOES | Formular';

$submeniu = '';

$banner ='';

$continut =
    '<div id="divcontinut2"><center>
   <form id="a" action="." method="POST">
       <table border="1" >
       <tr>
          <td colspan="2" >
        <p id="tipus"><b>Te rugăm să completezi formularul de înregistrare!</b> </p>
          </td>
       </tr>

	  <tr>
	  <td>
	  <p id="tipus2">Tip persoană:</p>
      </td>
      <td> <input id="radio" type="radio" name="radio" value="fiz">Fizică<br>
          <input id="radio" type="radio" name="radio" value="jogi">Juridică</td>
        </tr>
         
       <tr>
         <td>
         <p id="tipus2">Nume: </p>
         </td>
          <td>
           <input  type="text" name="nev">
          </td>
       </tr> 

<tr>
         <td>
         <p id="tipus2"> Prenume: </p>
         </td>
          <td>
         <input  type="text" name="knev">
          </td>
       </tr> 
       
       <tr>
         <td>
         <p id="tipus2"> E-mail: </p>
         </td>
          <td>
           <input  type="text" name="email">
          </td>
       </tr> 
       
       <tr>
         <td>
         <p id="tipus2">Oraș:</p>
         </td>
          <td>
           <input  type="text" name="varos">
          </td>
       </tr> 
       
       <tr>
         <td>
        <p id="tipus2"> Județ: </p>
         </td>
          <td>
            <input  type="text" name="megye">
          </td>
       </tr> 
       
       <tr>
         <td>
          <p id="tipus2"> Data:</p>
         </td>
          <td>
        <input  type="date" name="datum">
          </td>
       </tr> 
       
       <tr>
         <td>
        <p id="tipus2"> Nume utilizator: </p>
         </td>
          <td>
 <input  type="text" name="fnev" placeholder="Cel puțin 6 litere!" >
          </td>
       </tr> 
       
       <tr>
         <td>
        <p id="tipus2"> Password: </p>
         </td>
          <td>
    <input type="password" name="kod" placeholder="Cel puțin 6 litere!">
          </td>
       </tr> 
       
       <tr>
         <td>
         Accept condițiile site-ului.
         </td>
          <td>
          <input  type="checkbox" name="bifa" value="igen">
          </td>
       </tr> 
       
       <tr align="center">
         <td colspan="2">
           <input type="submit" name="kuldes2" value="TRIMITE">
         </td>
       </tr> 
	</table></form>
</form>

   </div>';


include($cfg_main['path_tema'].$cfg_main['tema'].'.php');

$tema = new $cfg_main['tema']($titlu, $submeniu, $banner, $continut);

$tema->prelucare();
$tema->afisare();
