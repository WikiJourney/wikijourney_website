<?php
/* ==== NOTE ====

This code is adapted from mwoauth-php. Thanks to the autor !

Check his work on Github : https://github.com/Stype/mwoauth-php

*/

include 'MWOAuthClient.php';
include 'OAuth_id.php';

/* Content of OAuth_id.php :
$consumerKey = 'OurConsumerKey';
$consumerSecret = 'OurSecretKey';
*/


// Configure the connection to the wiki you want to use. Passing title=Special:OAuth as a
// GET parameter makes the signature easier. Otherwise you need to call
// $client->setExtraParam('title','Special:OAuth/whatever') for each step.
// If your wiki uses wgSecureLogin, the canonicalServerUrl will point to http://
$config = new MWOAuthClientConfig(
	'http://en.wikipedia.org/w/index.php?title=Special:OAuth', // url to use
	true, // do we use SSL? (we should probably detect that from the url)
	false // do we validate the SSL certificate? Always use 'true' in production.
);
$config->canonicalServerUrl = 'http://wikijourney.eu';
$config->redirURL = 'http://wikijourney.eu';
$cmrToken = new OAuthToken( $consumerKey, $consumerSecret );
$client = new MWOAuthClient( $config, $cmrToken );
// Step 1 - Get a request token
list( $redir, $requestToken ) = $client->initiate();
// Step 2 - Have the user authorize your app. Get a verifier code from them.
// (if this was a webapp, you would redirect your user to $redir, then use the 'oauth_verifier'
// GET parameter when the user is redirected back to the callback url you registered.
echo "Point your browser to: $redir\n\n";
print "Enter the verification code:\n";
$fh = fopen( "php://stdin", "r" );
$verifyCode = trim( fgets( $fh ) );
// Step 3 - Exchange the request token and verification code for an access token
$accessToken = $client->complete( $requestToken,  $verifyCode );
// You're done! You can now identify the user, and/or call the API (examples below) with $accessToken
?>