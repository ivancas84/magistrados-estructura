<?php

$curl = curl_init();

curl_setopt($curl, CURLOPT_POST, 1);

curl_setopt($curl, CURLOPT_URL, "https://votes.flowics.com/api/votes/o/12564/6012d664aeea3d06b03f1537?s=100&f=MZ5pHtHHTIneC1oMV6pkNg%3D%3D");

curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);

print_r($result);