<?php
session_start();
// Include Librari Google Client (API)
include_once 'google-client/Google_Client.php';
include_once 'google-client/contrib/Google_Oauth2Service.php';
$client_id = '377562500790-58nduove7masmqtv771ab6dti2em5d38.apps.googleusercontent.com'; // Google client ID
$client_secret = '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'; // Google Client Secret
$redirect_url = 'http://localhost/absensi/index.php'; // Callback URL
// Call Google API
$gclient = new Google_Client();
$gclient->setApplicationName('Google Login'); // Set dengan Nama Aplikasi Kalian
$gclient->setClientId($client_id); // Set dengan Client ID
$gclient->setClientSecret($client_secret); // Set dengan Client Secret
$gclient->setRedirectUri($redirect_url); // Set URL untuk Redirect setelah berhasil login
$google_oauthv2 = new Google_Oauth2Service($gclient);
?>