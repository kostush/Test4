<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);

echo 'begin test auth';
$data = array(
    'login'=> 'test_login',
    'pass' => 'test_pass'
);
$curl_options = array(
    CURLOPT_RETURNTRANSFER =>true,
    CURLOPT_POST =>true,
    CURLOPT_POSTFIELDS => http_build_query($data),
    CURLOPT_URL =>'https://skk-studio.com/Test4/api/auth',
);
$curl = curl_init('skk_studio.com/Test4/auth');
curl_setopt_array($curl,$curl_options);
echo 'curl';
$result = curl_exec($curl);

echo var_dump(json_decode($result));
return json_decode($result);

?>
