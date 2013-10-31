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

/** 404.php file
@author Matteo Fabbroni matteo.fabbroni[-at-]regione.toscana.it.
@copyright Copyright, 2013, Matteo Fabbroni
@license http://opensource.org/licenses/gpl-license.php GNU Public License
@version 0.2
*/
session_start();
$cf=$_SESSION['CF'];
echo("
     <HTML>
      <BODY>
       <table border='0'>
        <tr>
         <td width='10%'></td>
         <td><h1><img src='img/logo.png'><img src='img/sst.jpg' align='right'></td>
         <td width='10%'></td><td>
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
          <p align = 'justify'>
          Il codice fiscale rilevato dall'autenticazione &egrave; <b><font color='red'>$cf</b></font color>.<br>
          Siamo spiacenti: questo codice fiscale non risulta associato al rappresentante legale di alcuna farmacia regionale, pertanto non
          &egrave possibile procedere con l'attribuzione di un certificato come previsto dalla RFC 231 di Regione Toscana.<br><br>
          Se ritenete che questo sia un errore, siete invitati a darne comunicazione all'indirizzo <a href='mailto:certificati.farmacie@regione.toscana.it'>
          certificati.farmacie@regione.toscana.it</a> specificando un recapito telefonico al quale essere ricontattati.
          </p>
          </td>
          <td></td>
         </tr>
        </table>
       </BODY>
      </HTML>");
session_unset();
session_destroy();
    die();
?>
