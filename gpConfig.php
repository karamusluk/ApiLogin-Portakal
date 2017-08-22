<?php
session_start();

//Include Google client library 
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
$clientId = '485415493185-rb0qq8ln9bludbdlogr55v1k3kno3n06.apps.googleusercontent.com'; //Google client ID
$clientSecret = '0WTYa1WdF35AGAiF9WFOjEr8'; //Google client secret
$redirectURL = 'http://srv1.cinedia.net'; //Callback URL

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to CodexWorld.com');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>