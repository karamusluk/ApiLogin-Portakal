<?php

$servername = "localhost";
$username = ""; //database kullanici adi
$password = ""; // database kullanici sifresi
$dbname = ""; // database adi
$userTbl    = 'users'; // veritabani tablo adi - DEGISTIRILMESI TAKDIRINDE VERITABANINDAKI TABLO ADI DA DEGISTIRILMELIDIR


define('servername', $servername);
define('username', $username);
define('password', $password);
define('dbname', $dbname);
define('userTbl', $userTbl);

/*
 * Configuration and setup Google API
 */

$clientId = '485415493185-rb0qq8ln9bludbdlogr55v1k3kno3n06.apps.googleusercontent.com'; //DGMED_PROXY_API@GMAIL.COM client ID 
$clientSecret = '0WTYa1WdF35AGAiF9WFOjEr8'; //DGMED_PROXY_API@GMAIL.COM client secret
$redirectURL = 'http://srv1.cinedia.net'; //Callback URL - geri cagrilma adresi - PHP SERVER/API nin kurulu oldugu web site adresi.

?>