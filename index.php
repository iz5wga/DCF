<?php
/**
* Progetto di Regione Toscana - Dematerializzazione 
* Release: 31 oct 2013
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

/** index.php file
@author Matteo Fabbroni matteo.fabbroni[-at-]regione.toscana.it.
@copyright Copyright, 2013, Matteo Fabbroni
@license http://opensource.org/licenses/gpl-license.php GNU Public License
@version 0.2
*/
include('functions.php');
session_start();
// Dichiaro le variabili
$OPENSSL="/usr/bin/openssl";
$ZIP="/usr/bin/zip";
$LOG='log.txt';
$posizioni=array();
$certificati=array();
$numeroFarmacia=array();
$nuovicertificati=array();
$db = 'db.txt';	
$password = rand_string(8);
$cf=substr($_SERVER['SSL_CLIENT_S_DN_CN'],0,16);

// Se esiste gia' la sessione...

if(isset($_SESSION['CERTIFICATI'])){
$certificati = $_SESSION['CERTIFICATI'];
$password = $_SESSION['PASSWORD'];
$cf=$_SESSION['CF'];
$emissione=$_SESSION['EMISSIONE'];
$ip=IndirizzoIpReale();
 for($i=0; $i<count($certificati);$i++){
  $nomeFarmacia[$i] = $certificati[$i];
  $certificati[$i]='certcontent/'.$certificati[$i].'.p12';
  $nuovicertificati[$i]='certificati/'.$nomeFarmacia[$i].'.p12';
  $cmd1=$OPENSSL." pkcs12 -in ".$certificati[$i]." -out temp.pem -passin pass:123456 -passout pass:$password";
  $cmd2=$OPENSSL." pkcs12 -export -in temp.pem -out ".$nuovicertificati[$i]." -passin pass:$password -passout pass:$password"; 
  $cmd3=$ZIP." ".$cf.".zip ".$nuovicertificati[$i]." > /dev/null";
  file_put_contents($LOG, $ip.";".$cf.";".$nomeFarmacia[$i].";".$emissione.";\n", FILE_APPEND | LOCK_EX); 
  system($cmd1);
  system($cmd2);
  system($cmd3);
}
 header('Content-Type: application-download');
 header('Content-Disposition: attachment; filename='.basename($cf.".zip"));
 readfile($cf.".zip");

 session_unset();
 session_destroy(); 
}
else{
 // Controllo che ci sia almeno un certificato disponibile per il CF
 $posizioni = trovaOccorrenza($db, $cf);
 for($i=0; $i<count($posizioni); $i++){
  $certificati[$i] = leggiLinea($db, $posizioni[$i], $delimitatore="\n");
 }
 if(!$certificati[0]){
 $_SESSION['CF'] = $cf;
 header( "refresh:0;url=404.php" );
 }
else{
 // Se siamo arrivati fino a qui, allora esistono certificati associati
 $_SESSION['CF'] = $cf;
 $_SESSION['PASSWORD'] = $password;
 $_SESSION['CERTIFICATI'] = $certificati;
 $_SESSION['NOME']=$_SERVER['SSL_CLIENT_S_DN_G'];
 $_SESSION['COGNOME']=$_SERVER['SSL_CLIENT_S_DN_S'];
 $_SESSION['EMISSIONE']=date("d/m/y;H:i:s", time());
 header("refresh:0;url=cf_presente.php");
 }
}
?>
