<?php
/**
* Progetto di Regione Toscana - Dematerializzazione 
* Release: 24 oct 2013
* Copyright (C) 2013 Matteo Fabbroni
* mailto:matteo.fabbroni[-at-]regione.toscana.it
*
* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program; if not, write to the Free Software
* Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA 
*/

/** cf_presente.php file
@author Matteo Fabbroni matteo.fabbroni[-at-]regione.toscana.it.
@copyright Copyright, 2013, Matteo Fabbroni
@license http://opensource.org/licenses/gpl-license.php GNU Public License
@version 0.2
*/
session_start();
$certificati=$_SESSION['CERTIFICATI'];
$cf=$_SESSION['CF'];
$password=$_SESSION['PASSWORD'];
$nome= $_SESSION['NOME'];
$cognome=$_SESSION['COGNOME'];
$emissione=$_SESSION['EMISSIONE'];
echo ("
   <HTML>
    <BODY>
     <table border='0'>
      <tr>
       <td width='10%'></td>
       <td><h1><img src='img/logo.png'><img src='img/sst.jpg' align='right'></td>
       <td width='10%'></td>
       <td></td>
      </tr>
      <tr>
       <td></td>
       <td><h1><p align='center'><font face ='Times New Roman'>Progetto di Regione Toscana dematerializzazione DM 2011</h1></td>
       <td></td>
      </tr>
      <tr>
       <td></td>
       <td><h2><p align='center'><font face ='Times New Roman'>Assegnazione certificato erogatore</h2></td>
       <td></td>
      </tr>

      <tr>
       <td></td>
       <td><font face='courier'>
       <p align = 'justify'>");
if(count($certificati)==1)
echo("
       La farmacia regionale associata al codice fiscale presentato &egrave la n. <b><font color='red'>$certificati[0]</b></font color>.<br><br>");
else{
echo("LE farmacie regionali associate al codice fiscale presentato sono le n.:<br>");
for($i=0; $i<count($certificati); $i++)
 echo("<font color='red'><b>$certificati[$i]</b></font color><br>");
}
echo("
       Nell'ambito della trasmissione degli eventi come stabilito dalla RFC 231 di Regione Toscana, il file contenente il certificato assegnato alla farmacia, 
       e denominato <b><font color='red'>$cf.zip</b></font color>, &egrave; disponibile e sar&agrave; scaricato entro 5 secondi.<br><br>
       <b>Attenzione:</b> la password associata alla chiave privata relativa al certificato &egrave; <b><font color='red'>$password</b></font color>. Si &egrave;
       invitati a custodirla in un luogo sicuro. In caso di smarrimento &egrave; possibile tornare su questa pagina per ottenere nuovamente il certificato
       e relativa password, che sar&agrave; differente dall'attuale.<br><br>
       Qualora si riscontrassero degli errori nell'associazione Anagrafica - Numero di farmacia, si invita a darne tempestiva comunicazione scrivendo
       all'indirizzo <a href='mailto:certificati.farmacie@regione.toscana.it'>certificati.farmacie@regione.toscana.it</a>.
       <br><br>
       Se il file non viene scaricato entro 5 secondi,  cliccare <a href='index.php'>qui</a>.
      </p>
      <p align = 'justify'>
       Per comodit&agrave; &egrave; possibile stampare il seguente talloncino:<br><br>
       <table align='center' width='40%' style='border:1px solid black;'>
        <tr><td><b>Direttore</b>:</td><td>$nome $cognome</td></tr>
        <tr><td><b>Codice Fiscale</b>:</td><td>$cf</td></tr>
        <tr><td><b>N. Farmacia</b>:</td><td>$certificati[0]</td></tr>");
for($i=1; $i<count($certificati); $i++)
 echo("<tr><td></td><td>$certificati[$i]</td></tr>");
echo("
        <tr><td><b>Password</b>:</td><td><font color='red'><b>$password</b></font color></td></tr>
	<tr><td></td></tr>
	<tr><td><b>Data emissione</b>:</td><td>$emissione</td></tr>
       </table>
       </br>
      </p>
       </td>
       <td></td>
     </tr>
    </table>
   </BODY>
  </HTML>
 ");
//$_SESSION['CERTIFICATI']=$certificati;
header("refresh:5;url=index.php");
?>
