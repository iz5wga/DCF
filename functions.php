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

/** functions.php file
@author Matteo Fabbroni matteo.fabbroni[-at-]regione.toscana.it.
@copyright Copyright, 2013, Matteo Fabbroni
@license http://opensource.org/licenses/gpl-license.php GNU Public License
@version 0.2
*/

// Questa funzione prende in ingresso un file di database, un codice fiscale e
// restituisce un array in cui ogni posizione presente la linea del certificato.
function trovaOccorrenza($db, $cf){
$dbfile=file($db);
$posizioni = array();
 foreach($dbfile as $numeroLinea => $linea)
  if(strpos($linea,$cf) !== FALSE)
   $posizioni[]=$numeroLinea+2;
return $posizioni;
}
// Questa funzione restituisce cio' che e' scritto sulla linea data, al file dato
function leggiLinea($file, $numeroLinea, $delimitatore="\n"){
 $i = 1;
 $fp = fopen( $file, 'r');
 while (!feof ($fp)){
  $buffer = stream_get_line( $fp, 1024, $delimitatore );
  if( $i == $numeroLinea )
  return $buffer;
  $i++;
  $buffer = '';
  }
 return false;
}
// Questa funzione crea una password random di lunghezza data
function rand_string( $length )
{
 $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
 return substr(str_shuffle($chars),0,$length);
 }
// Questa funzione cerca di restituire l'indirizzo ip reale del client
function IndirizzoIpReale(){
 if (!empty($_SERVER['HTTP_CLIENT_IP']))
  $ip=$_SERVER['HTTP_CLIENT_IP'];
 elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
 else
  $ip=$_SERVER['REMOTE_ADDR'];
 return $ip;
}
?>
