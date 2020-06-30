<?php
 header("Access-Control-Allow-Origin: *");
 header('Access-Control-Allow-Origin: http://razarservice.com:80/challenge/index.php', true);

// set post fields
$post = [
    'name' => $_POST['name'],
    'password' => $_POST['password'],
    'confirm_password'   => $_POST['confirm_password'],
    'op1' => $_POST['op1'],
    'op2' => $_POST['op2'],
    'op3' => $_POST['op3'],
    'op4' => $_POST['op4']
];

$ch = curl_init('http://razarservice.com:80/challenge/index.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

$response = curl_exec($ch);

curl_close($ch);

echo $response;
?>