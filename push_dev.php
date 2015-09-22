<?php

// Put your device token here (without spaces):
$deviceToken = '2d40340ff479099e45f3af85c75e5faeea2267c9b9f55623e7510abc86d2d074';

// Put your private key's passphrase here:
$passphrase = '123456';

// Put your alert message here:
$message = 'My first push notification!';

////////////////////////////////////////////////////////////////////////////////

$ctx = stream_context_create();
stream_context_set_option($ctx, 'ssl', 'local_cert', 'dev.pem');
stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

// Open a connection to the APNS server
$fp = stream_socket_client(
	'ssl://gateway.sandbox.push.apple.com:2195', $err,
	$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

if (!$fp)
	exit("Failed to connect: $err $errstr" . PHP_EOL);

echo 'Connected to APNS' . PHP_EOL;

// Create the payload body
// $body['current_count'] = 1;
// $body['advertisement_id'] = 200;
// $body['next_recover'] = '1';
$body['aps'] = array(
	"content-available" => 1,
	'alert' => $message,
	'sound' => 'default',
	// 'image_url' => 'iphone.jpg'
	'image_url' => 'samsung.jpg'
	);
// Encode the payload as JSON
$payload = json_encode($body);

// Build the binary notification
$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

// Send it to the server
$result = fwrite($fp, $msg, strlen($msg));

if (!$result)
	echo 'Message not delivered' . PHP_EOL;
else
	echo 'Message successfully delivered' . PHP_EOL;

// Close the connection to the server
fclose($fp);
